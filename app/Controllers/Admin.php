<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Admin extends Controller
{
    public function __construct()
    {
        $session = session();

        if (!$session->get('isLoggedIn') || $session->get('is_admin') != 1) {
            redirect()->to('/auth/login')->send();
            exit;
        }

        // Check if admin is archived
        $userModel = new UserModel();
        $user = $userModel->find($session->get('user_id'));
        
        if ($user && $user['is_archived'] == 1) {
            $session->destroy();
            redirect()->to('/auth/login')->with('error', 'Your account has been archived. Please contact the administrator.')->send();
            exit;
        }
    }

    public function index()
    {
        return $this->dashboard();
    }

    public function dashboard()
    {
        $session = session();
        $db = \Config\Database::connect();
        $userModel = new UserModel();
        $orderModel = new \App\Models\OrderModel();

        // Get total users
        $total_users = $userModel->countAll();
        $admin_count = $userModel->where('is_admin', 1)->countAllResults();
        $regular_count = $userModel->where('is_admin', 0)->countAllResults();

        // Get order statistics
        $total_orders = $orderModel->countAll();
        $pending_orders = $orderModel->where('status', 'Pending')->countAllResults();
        $completed_orders = $orderModel->whereIn('status', ['Validated', 'Completed'])->countAllResults();
        
        // Calculate total sales
        $total_sales = $db->table('orders')
            ->selectSum('total_amount')
            ->whereIn('status', ['Validated', 'Completed'])
            ->get()
            ->getRow()
            ->total_amount ?? 0;

        // Get order data for chart (last 7 days)
        $order_data = $db->table('orders')
            ->select('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at >=', date('Y-m-d', strtotime('-7 days')))
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get()
            ->getResultArray();

        $order_dates = array_column($order_data, 'date');
        $order_counts = array_column($order_data, 'count');

        // Get sales data for chart (last 7 days)
        $sales_data = $db->table('orders')
            ->select('DATE(created_at) as date, SUM(total_amount) as amount')
            ->where('created_at >=', date('Y-m-d', strtotime('-7 days')))
            ->whereIn('status', ['Validated', 'Completed'])
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get()
            ->getResultArray();

        $sales_dates = array_column($sales_data, 'date');
        $sales_amounts = array_column($sales_data, 'amount');

        // Initialize variables with default values for login history
        $admin_logins = [];
        $user_logins = [];
        $perPage = 10;

        // Admin logins
        $adminLoginsBuilder = $db->table('user_login_logs')
            ->select('user_login_logs.*, users.email, users.username')
            ->join('users', 'users.id = user_login_logs.user_id')
            ->where('users.is_admin', 1)
            ->orderBy('user_login_logs.login_time', 'DESC');
        $adminPage = (int)($this->request->getGet('page_admin_logins') ?? 1);
        $total_admin_logs = $adminLoginsBuilder->countAllResults(false);
        $admin_logins = $adminLoginsBuilder
            ->limit($perPage, ($adminPage - 1) * $perPage)
            ->get()
            ->getResultArray();

        // User logins
        $userLoginsBuilder = $db->table('user_login_logs')
            ->select('user_login_logs.*, users.email, users.username')
            ->join('users', 'users.id = user_login_logs.user_id')
            ->where('users.is_admin', 0)
            ->orderBy('user_login_logs.login_time', 'DESC');
        $userPage = (int)($this->request->getGet('page_user_logins') ?? 1);
        $total_user_logs = $userLoginsBuilder->countAllResults(false);
        $user_logins = $userLoginsBuilder
            ->limit($perPage, ($userPage - 1) * $perPage)
            ->get()
            ->getResultArray();

        $pager = \Config\Services::pager();
        $pager->setPath('admin/dashboard', 'admin_logins');
        $pager->setPath('admin/dashboard', 'user_logins');

        return view('admin/dashboard', [
            'total_users' => $total_users,
            'admin_count' => $admin_count,
            'regular_count' => $regular_count,
            'admin_logins' => $admin_logins,
            'user_logins' => $user_logins,
            'pager' => $pager,
            'adminPage' => $adminPage,
            'userPage' => $userPage,
            'perPage' => $perPage,
            'total_admin_logs' => $total_admin_logs,
            'total_user_logs' => $total_user_logs,
            'total_orders' => $total_orders,
            'pending_orders' => $pending_orders,
            'completed_orders' => $completed_orders,
            'total_sales' => $total_sales,
            'order_dates' => $order_dates,
            'order_counts' => $order_counts,
            'sales_dates' => $sales_dates,
            'sales_amounts' => $sales_amounts
        ]);
    }

    public function users()
    {
        $session = session();
        $userModel = new UserModel();

        $search = $this->request->getGet('search');
        $page = $this->request->getGet('page') ?? 1;
        $perPage = 10;

        // Build the query
        $query = $userModel->where('is_archived', 0); // Only show non-archived users

        if ($search) {
            $query = $query->groupStart()
                          ->like('username', $search)
                               ->orLike('email', $search)
                          ->groupEnd();
        }

        // Get total count for pagination
        $total = $query->countAllResults(false);
        
        // Get paginated results
        $users = $query->limit($perPage, ($page - 1) * $perPage)
                      ->find();

        // Create pager
        $pager = service('pager');
        $pager->setPath('admin/users');
        $pager->makeLinks($page, $perPage, $total);

        return view('admin/users', [
            'users' => $users,
            'pager' => $pager,
            'search' => $search,
            'total' => $total,
            'currentPage' => $page,
            'perPage' => $perPage
        ]);
    }

    public function getUser($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);

        if ($user) {
            return $this->response->setJSON([
                'success' => true,
                'user' => $user
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'User not found'
        ]);
    }

    public function editUser($id = null)
    {
        if ($id === null) {
            return redirect()->to('admin/users')->with('error', 'User ID not specified.');
        }

        $userModel = new UserModel();
        $user = $userModel->find($id);

        if ($user === null) {
            return redirect()->to('admin/users')->with('error', 'User not found.');
        }

        return view('admin/edit_user', [
            'user' => $user
        ]);
    }

    public function updateUser($id = null)
    {
        if ($id === null) {
            return redirect()->to('admin/users')->with('error', 'User ID not specified.');
        }

        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            return redirect()->to('admin/users')->with('error', 'User not found.');
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'is_admin' => $this->request->getPost('is_admin')
        ];

        if ($userModel->update($id, $data)) {
            return redirect()->to('admin/users')->with('success', 'User updated successfully!');
        }

        return redirect()->back()->withInput()->with('error', 'Failed to update user.');
    }

    public function deleteUser($id = null)
    {
        if ($id === null) {
            return redirect()->to('admin/users')->with('error', 'User ID not specified.');
        }

        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            return redirect()->to('admin/users')->with('error', 'User not found.');
        }

        // Instead of deleting, mark as archived
        if ($userModel->update($id, ['is_archived' => 1])) {
            return redirect()->to('admin/users')->with('success', 'User archived successfully.');
        }

        return redirect()->back()->with('error', 'Failed to archive user.');
    }

    public function archivedUsers()
    {
        $session = session();
        $userModel = new UserModel();

        $search = $this->request->getGet('search');
        $page = $this->request->getGet('page') ?? 1;
        $perPage = 10;
        
        // Build the query for archived users
        $query = $userModel->where('is_archived', 1);
        
        if ($search) {
            $query = $query->groupStart()
                          ->like('username', $search)
                          ->orLike('email', $search)
                          ->groupEnd();
        }
        
        // Get total count for pagination
        $total = $query->countAllResults(false);
        
        // Get paginated results
        $users = $query->limit($perPage, ($page - 1) * $perPage)
                         ->find();
        
        // Create pager
        $pager = service('pager');
        $pager->setPath('admin/archived-users');
        $pager->makeLinks($page, $perPage, $total);
        
        return view('admin/archived_users', [
            'users' => $users,
            'pager' => $pager,
            'search' => $search,
            'total' => $total,
            'currentPage' => $page,
            'perPage' => $perPage
        ]);
    }

    public function restoreUser($id = null)
    {
        if ($id === null) {
            return redirect()->to('admin/archived-users')->with('error', 'User ID not specified.');
        }

        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            return redirect()->to('admin/archived-users')->with('error', 'User not found.');
        }

        // Restore the user by setting is_archived to 0
        if ($userModel->update($id, ['is_archived' => 0])) {
            return redirect()->to('admin/archived-users')->with('success', 'User restored successfully.');
        }

        return redirect()->back()->with('error', 'Failed to restore user.');
    }

    public function createProduct()
    {
        return view('admin/product_form');
    }

    public function storeProduct()
    {
        $productModel = new \App\Models\ProductModel();

        $data = [
            'product_name' => $this->request->getPost('product_name'),
            'price' => $this->request->getPost('price'),
            'category' => $this->request->getPost('category'),
            'description' => $this->request->getPost('description'),
            'status' => $this->request->getPost('status') ?? 'in_stock',
            'rating' => $this->request->getPost('rating') ?: null,
        ];

        // Handle image upload
        if ($imagefile = $this->request->getFile('image')) {
            if ($imagefile->isValid() && !$imagefile->hasMoved()) {
                try {
                    // Read the image file content
                    $imageData = file_get_contents($imagefile->getTempName());
                    if ($imageData !== false) {
                        $data['image'] = $imageData;
                    } else {
                        log_message('error', 'Failed to read image file');
                        return redirect()->back()->withInput()->with('error', 'Failed to read image file');
                    }
                } catch (\Exception $e) {
                    log_message('error', 'Image upload error: ' . $e->getMessage());
                    return redirect()->back()->withInput()->with('error', 'Failed to process image: ' . $e->getMessage());
                }
            } elseif (!$imagefile->isValid()) {
                log_message('error', 'Invalid file upload: ' . $imagefile->getErrorString());
                return redirect()->back()->withInput()->with('error', 'Invalid image file: ' . $imagefile->getErrorString());
            }
        }

        if ($productModel->insert($data)) {
            return redirect()->to('admin/products')->with('success', 'Product created successfully!');
        }

        return redirect()->back()->withInput()->with('error', 'Failed to create product.');
    }

    public function editProduct($id = null)
    {
        if ($id === null) {
            return redirect()->to('admin/products')->with('error', 'Product ID not specified.');
        }

        $productModel = new \App\Models\ProductModel();
        $product = $productModel->find($id);

        if ($product === null) {
            return redirect()->to('admin/products')->with('error', 'Product not found.');
        }

        // Set default status if not set
        if (!isset($product['status'])) {
            $product['status'] = 'in_stock';
        }

        return view('admin/edit_product', [
            'product' => $product
        ]);
    }

    public function updateProduct($id = null)
    {
        if ($id === null) {
            return redirect()->to('admin/products')->with('error', 'Product ID not specified.');
        }

        $productModel = new \App\Models\ProductModel();
        
        // Get the current product data
        $currentProduct = $productModel->find($id);
        if (!$currentProduct) {
            return redirect()->to('admin/products')->with('error', 'Product not found.');
        }
        
        $data = [
            'product_name' => $this->request->getPost('product_name'),
            'price' => $this->request->getPost('price'),
            'category' => $this->request->getPost('category'),
            'description' => $this->request->getPost('description'),
            'status' => $this->request->getPost('status'),
            'rating' => $this->request->getPost('rating') ?: null,
        ];

        // Add debug logging
        log_message('debug', 'Updating product with data: ' . json_encode($data));
        log_message('debug', 'Current product data: ' . json_encode($currentProduct));
        log_message('debug', 'Status from form: ' . $this->request->getPost('status'));

        // Handle image upload only if a new file is actually uploaded
        $imagefile = $this->request->getFile('image');
        if ($imagefile && $imagefile->isValid() && !$imagefile->hasMoved()) {
            try {
                // Read the image file content
                $imageData = file_get_contents($imagefile->getTempName());
                if ($imageData !== false) {
                    $data['image'] = $imageData;
                } else {
                    log_message('error', 'Failed to read image file');
                    return redirect()->back()->withInput()->with('error', 'Failed to read image file');
                }
            } catch (\Exception $e) {
                log_message('error', 'Image upload error: ' . $e->getMessage());
                return redirect()->back()->withInput()->with('error', 'Failed to process image: ' . $e->getMessage());
            }
        }

        if (!$productModel->validate($data)) {
            $errors = $productModel->errors();
            log_message('debug', 'Validation errors: ' . json_encode($errors));
            return redirect()->back()->withInput()->with('errors', $errors);
        }

        try {
            $result = $productModel->update($id, $data);
            log_message('debug', 'Update result: ' . json_encode($result));
            log_message('debug', 'Last query: ' . $productModel->db->getLastQuery());
            
            if ($result) {
                return redirect()->to('admin/products')->with('success', 'Product updated successfully!');
            } else {
                log_message('debug', 'Update query failed. DB Error: ' . json_encode($productModel->errors()));
                return redirect()->back()->withInput()->with('error', 'Failed to update product.');
            }
        } catch (\Exception $e) {
            log_message('error', 'Exception during update: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Error updating product: ' . $e->getMessage());
        }
    }

    public function products()
    {
        $productModel = new \App\Models\ProductModel();
        
        // Get search query if any
        $search = $this->request->getGet('search');
        
        // Set up pagination
        $perPage = 10;
        $page = $this->request->getGet('page') ?? 1;
        
        // Build the query
        $query = $productModel;
        
        if ($search) {
            $query = $query->groupStart()
                          ->like('product_name', $search)
                          ->orLike('category', $search)
                          ->groupEnd();
        }
        
        // Get total count for pagination
        $total = $query->countAllResults(false);
        
        // Get paginated results
        $products = $query->orderBy('id', 'DESC')
                         ->limit($perPage, ($page - 1) * $perPage)
                         ->find();
        
        // Create pager
        $pager = service('pager');
        $pager->setPath('admin/products');
        $pager->makeLinks($page, $perPage, $total);
        
        return view('admin/products', [
            'products' => $products,
            'pager' => $pager,
            'search' => $search,
            'total' => $total,
            'currentPage' => $page,
            'perPage' => $perPage
        ]);
    }

    public function displayImage($id)
    {
        $productModel = new \App\Models\ProductModel();
        $product = $productModel->find($id);
        
        if ($product && $product['image']) {
            // Detect mime type from image content
            $finfo = new \finfo(FILEINFO_MIME_TYPE);
            $mimeType = $finfo->buffer($product['image']);
            
            // Set the content type header
            header('Content-Type: ' . $mimeType);
            
            // Output the image data
            echo $product['image'];
            exit;
        }
        
        // If no image found, return a 404
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    public function orders()
    {
        $session = session();
        $orderModel = new \App\Models\OrderModel();

        // Get filters from request
        $status = $this->request->getGet('status');
        $payment_method = $this->request->getGet('payment_method');
        $date = $this->request->getGet('date');
        $page = $this->request->getGet('page') ?? 1;
        $perPage = 10;

        // Build the query
        $builder = $orderModel->select('orders.*, users.username as user_name')
                            ->join('users', 'users.id = orders.user_id');

        // Apply filters
        if ($status) {
            $builder->where('orders.status', $status);
        }
        if ($payment_method) {
            $builder->where('orders.payment_method', $payment_method);
        }
        if ($date) {
            $builder->where('DATE(orders.created_at)', $date);
        }

        // Get paginated results
        $data['orders'] = $builder->orderBy('orders.created_at', 'DESC')
                                ->paginate($perPage);
        
        $data['pager'] = $orderModel->pager;

        // Pass filter values to the view
        $data['current_status'] = $status;
        $data['current_payment_method'] = $payment_method;
        $data['current_date'] = $date;
        
        return view('admin/orders', $data);
    }

    public function viewOrder($id)
    {
        $orderModel = new \App\Models\OrderModel();
        $userModel = new \App\Models\UserModel();
        
        // Get order details with user information
        $order = $orderModel->select('orders.*, users.username, users.email, users.profile_picture, users.created_at as user_created_at')
                          ->join('users', 'users.id = orders.user_id')
                          ->where('orders.id', $id)
                          ->first();

        if (!$order) {
            return redirect()->to('admin/orders')->with('error', 'Order not found.');
        }

        // Get customer's total orders count
        $customerOrderCount = $orderModel->where('user_id', $order['user_id'])->countAllResults();
        
        // Get validator information if order is validated
        $validator = null;
        if ($order['admin_validated']) {
            $validator = $userModel->select('username')->find($order['admin_validated']);
        }
        
        // Get order items with product details
        $orderItems = $orderModel->getOrderItems($id);
        
        return view('admin/view_order', [
            'order' => $order,
            'customer' => [
                'username' => $order['username'],
                'email' => $order['email'],
                'profile_picture' => $order['profile_picture'],
                'total_orders' => $customerOrderCount,
                'created_at' => $order['user_created_at']
            ],
            'validator' => $validator,
            'order_items' => $orderItems
        ]);
    }

    public function validateOrder($id)
    {
        $session = session();
        $orderModel = new \App\Models\OrderModel();
        
        // Get order details
        $order = $orderModel->find($id);
        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }

        // Update order status
        $data = [
            'status' => ($order['payment_method'] === 'Walk-in') ? 'Completed' : 'Validated',
            'admin_validated' => $session->get('user_id'),
            'validation_date' => date('Y-m-d H:i:s'),
            'validation_notes' => $this->request->getPost('notes')
        ];

        if ($orderModel->update($id, $data)) {
            $status = ($order['payment_method'] === 'Walk-in') ? 'completed' : 'validated';
            return redirect()->to('admin/orders/view/' . $id)->with('message', 'Order ' . $status . ' successfully.');
        }

        return redirect()->back()->with('error', 'Failed to validate order.');
    }

    public function rejectOrder($id)
    {
        $session = session();
        $orderModel = new \App\Models\OrderModel();
        
        // Get order details
        $order = $orderModel->find($id);
        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }

        // Update order status
        $data = [
            'status' => 'Rejected',
            'admin_validated' => $session->get('user_id'),
            'validation_date' => date('Y-m-d H:i:s'),
            'validation_notes' => $this->request->getPost('notes')
        ];

        if ($orderModel->update($id, $data)) {
            return redirect()->to('admin/orders/view/' . $id)->with('message', 'Order rejected successfully.');
        }

        return redirect()->back()->with('error', 'Failed to reject order.');
    }

    public function displayReceipt($filename)
    {
        $path = WRITEPATH . 'uploads/' . $filename;
        
        if (!file_exists($path)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $mime = mime_content_type($path);
        header('Content-Type: ' . $mime);
        header('Content-Length: ' . filesize($path));
        readfile($path);
        exit;
    }
}
