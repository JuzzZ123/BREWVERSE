<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class UserController extends Controller
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function getProfile()
    {
        // Check if user is logged in
        if (!session()->has('user_id')) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'User not authenticated'
            ]);
        }

        try {
            $userId = session('user_id');
            $user = $this->userModel->find($userId);

            if (!$user) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'User not found'
                ]);
            }

            // Convert profile picture to base64 if it exists
            if ($user['profile_picture']) {
                $user['profile_picture'] = base64_encode($user['profile_picture']);
            }

            // Remove sensitive data
            unset($user['password'], $user['reset_token'], $user['verification_token']);

            return $this->response->setJSON([
                'success' => true,
                'user' => $user
            ]);

        } catch (\Exception $e) {
            log_message('error', 'Profile fetch error: ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'An error occurred while fetching profile'
            ]);
        }
    }

    /**
     * Update user profile
     */
    public function updateProfile()
    {
        // Check if user is logged in
        if (!session()->has('user_id')) {
            session()->setFlashdata('error', 'You must be logged in to update your profile.');
            return redirect()->back();
        }

        // Validation rules
        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => [
                'rules' => 'required|min_length[3]|max_length[50]|is_unique[users.username,id,' . session('user_id') . ']',
                'errors' => [
                    'required' => 'Username is required',
                    'min_length' => 'Username must be at least 3 characters',
                    'max_length' => 'Username cannot exceed 50 characters',
                    'is_unique' => 'Username already exists'
                ]
            ],
            'address' => [
                'rules' => 'permit_empty|max_length[500]',
                'errors' => [
                    'max_length' => 'Address cannot exceed 500 characters'
                ]
            ],
            'phone' => [
                'rules' => 'permit_empty|max_length[20]',
                'errors' => [
                    'max_length' => 'Phone number cannot exceed 20 characters'
                ]
            ]
        ]);

        // Handle profile picture upload
$profilePicture = $this->request->getFile('profile_picture');
if ($profilePicture && $profilePicture->isValid() && !$profilePicture->hasMoved()) {
    // Validate file
    if ($profilePicture->getSize() > 2048000) { // 2MB limit
        session()->setFlashdata('error', 'Image size cannot exceed 2MB');
        return redirect()->back();
    }
    
    $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
    if (!in_array($profilePicture->getMimeType(), $allowedTypes)) {
        session()->setFlashdata('error', 'Only JPG, JPEG, and PNG files are allowed');
        return redirect()->back();
    }
    
    // Read the image file as binary data
    $imageData = file_get_contents($profilePicture->getTempName());
    $updateData['profile_picture'] = $imageData;
}
        if (!$validation->withRequest($this->request)->run()) {
            session()->setFlashdata('error', 'Validation failed: ' . implode(', ', $validation->getErrors()));
            return redirect()->back();
        }

        try {
            $userId = session('user_id');
            
            // Prepare data for update
            $updateData = [
                'username' => $this->request->getPost('username'),
                'address' => $this->request->getPost('address') ?: null,
                'phone' => $this->request->getPost('phone') ?: null,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            // Handle profile picture upload
            $profilePicture = $this->request->getFile('profile_picture');
            if ($profilePicture && $profilePicture->isValid() && !$profilePicture->hasMoved()) {
                // Read the image file as binary data
                $imageData = file_get_contents($profilePicture->getTempName());
                $updateData['profile_picture'] = $imageData;
            }

            // Update the user
            if ($this->userModel->update($userId, $updateData)) {
                // Update session data
                session()->set([
                    'username' => $updateData['username'],
                    'address' => $updateData['address'],
                    'phone' => $updateData['phone']
                ]);

                // Update profile picture in session if uploaded
                if (isset($updateData['profile_picture'])) {
                    session()->set('profile_picture', $updateData['profile_picture']);
                }

                session()->setFlashdata('success', 'Profile updated successfully!');
                return redirect()->back();
            } else {
                session()->setFlashdata('error', 'Failed to update profile. Please try again.');
                return redirect()->back();
            }

        } catch (\Exception $e) {
            log_message('error', 'Profile update error: ' . $e->getMessage());
            session()->setFlashdata('error', 'An error occurred while updating your profile.');
            return redirect()->back();
        }
    }

    /**
     * Delete profile picture
     */
    public function deleteProfilePicture()
    {
        if (!session()->has('user_id')) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'User not authenticated'
            ]);
        }

        try {
            $userId = session('user_id');
            
            if ($this->userModel->update($userId, ['profile_picture' => null])) {
                session()->remove('profile_picture');
                
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Profile picture deleted successfully'
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Failed to delete profile picture'
                ]);
            }

        } catch (\Exception $e) {
            log_message('error', 'Profile picture deletion error: ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'An error occurred while deleting profile picture'
            ]);
        }
    }

    public function orders()
    {
        // Check if user is logged in
        if (!session()->has('user_id')) {
            return redirect()->to('/auth/login')->with('error', 'Please login to view your orders.');
        }

        $userId = session('user_id');
        $orderModel = new \App\Models\OrderModel();

        // Get paginated orders with items
        $page = $this->request->getGet('page') ?? 1;
        $perPage = 10;

        $orders = $orderModel->where('user_id', $userId)
                           ->orderBy('created_at', 'DESC')
                           ->paginate($perPage);

        // Get order items for each order
        foreach ($orders as &$order) {
            $order['items'] = $orderModel->getOrderItems($order['id']);
        }

        $data = [
            'orders' => $orders,
            'pager' => $orderModel->pager
        ];

        return view('user/orders', $data);
    }
}