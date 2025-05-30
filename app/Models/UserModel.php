<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'username',
        'email',
        'password',
        'is_admin',
        'is_archived',
        'reset_token',
        'reset_token_expires',
        'verification_token',
        'is_verified',
        'email_verified',
        'profile_picture',
        'address',
        'phone',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $dateFormat = 'datetime';

    protected $validationRules = [
        'username' => 'permit_empty|min_length[3]|max_length[50]',
        'email' => 'permit_empty|valid_email',
        'password' => 'permit_empty|min_length[6]',
        'is_admin' => 'permit_empty|in_list[0,1]'
    ];

    protected $skipValidation = true;

    protected $validationMessages = [
        'username' => [
            'required' => 'Username is required',
            'min_length' => 'Username must be at least 3 characters long',
            'max_length' => 'Username cannot exceed 20 characters',
            'is_unique' => 'This username is already taken'
        ],
        'email' => [
            'required' => 'Email is required',
            'valid_email' => 'Please enter a valid email address',
            'is_unique' => 'This email is already registered'
        ],
        'password' => [
            'required' => 'Password is required',
            'min_length' => 'Password must be at least 6 characters long'
        ],
        'is_admin' => [
            'required' => 'User role is required',
            'in_list' => 'Invalid user role selected'
        ]
    ];

    protected $cleanValidationRules = true;

    public function beforeUpdate(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }

    // Method to get user by email
    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    // Method to get user by username
    public function getUserByUsername($username)
    {
        return $this->where('username', $username)->first();
    }

    // Method to update user profile (excluding password)
    public function updateProfile($userId, $data)
    {
        // Remove password from data if present
        unset($data['password']);
        
        return $this->update($userId, $data);
    }

    // Method to change password
    public function changePassword($userId, $newPassword)
    {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        return $this->update($userId, ['password' => $hashedPassword]);
    }

    // Method to get unverified users (for cleanup purposes)
    public function getUnverifiedUsers($olderThanHours = 24)
    {
        return $this->where('email_verified', 0)
                   ->where('created_at <', date('Y-m-d H:i:s', strtotime("-$olderThanHours hours")))
                   ->findAll();
    }

    // Method to delete unverified users older than specified hours
    public function deleteUnverifiedUsers($olderThanHours = 24)
    {
        return $this->where('email_verified', 0)
                   ->where('created_at <', date('Y-m-d H:i:s', strtotime("-$olderThanHours hours")))
                   ->delete();
    }
}