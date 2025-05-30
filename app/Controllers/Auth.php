<?php

namespace App\Controllers;

use App\Models\UserModel;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require ROOTPATH . 'vendor/autoload.php';

class Auth extends BaseController
{
    public function register()
    {
        return view('auth/register');
    }

    public function save()
    {
        $userModel = new UserModel();

        $validationRules = [
            'username' => [
                'rules' => 'required|min_length[3]|max_length[20]',
                'errors' => [
                    'required' => 'Username is required.',
                    'min_length' => 'Username must be at least 3 characters.',
                    'max_length' => 'Username cannot exceed 20 characters.'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => 'Email is required.',
                    'valid_email' => 'Please enter a valid email address.',
                    'is_unique' => 'This email is already registered.'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[8]|regex_match[/(?=.*[A-Z])(?=.*\d).+/]',
                'errors' => [
                    'required' => 'Password is required.',
                    'min_length' => 'Password must be at least 8 characters.',
                    'regex_match' => 'Password must have at least 1 uppercase letter and 1 number.'
                ]
            ],
            'confirm_password' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Please confirm your password.',
                    'matches' => 'Passwords do not match.'
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('error', implode('<br>', $this->validator->getErrors()));
        }

        $email = $this->request->getPost('email');
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Generate verification token
        $verificationToken = bin2hex(random_bytes(32));

        // Send verification email FIRST before creating user
        if ($this->sendVerificationEmail($email, $verificationToken, $username)) {
            // Store pending registration data in session temporarily
            session()->set('pending_registration', [
                'username' => $username,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'verification_token' => $verificationToken,
                'timestamp' => time()
            ]);

            return redirect()->to('/auth/register')->with('verification_sent', 'Please check your email and click the verification link to complete your registration.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Failed to send verification email. Please try again.');
        }
    }

    private function sendVerificationEmail($email, $token, $username = '')
    {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'naquilakennethv@gmail.com';
            $mail->Password = 'bzxf urmz nfmp zksm';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('coffeeshop@gmail.com', 'Brewverse Coffee Shop');
            $mail->addAddress($email);
            $mail->Subject = 'Welcome to Brewverse - Verify Your Email';
            
            $verificationLink = base_url("/auth/verify/$token");
            $mail->isHTML(true);
            $mail->Body = "
                <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; background-color: #0A0F1C; color: #E0E0E0; padding: 30px; border-radius: 10px;'>
                    <div style='text-align: center; margin-bottom: 30px;'>
                        <img src='" . base_url('images/logo.png') . "' alt='Brewverse Logo' style='height: 60px;'>
                        <h2 style='color: #7B4CFF; font-family: Orbitron, sans-serif; margin: 20px 0;'>Welcome to Brewverse!</h2>
                    </div>
                    
                    <p style='margin-bottom: 20px;'>Hello" . ($username ? " $username" : "") . ",</p>
                    
                    <p>Welcome to Brewverse, where coffee meets the cosmos! To start your interstellar journey with us, please verify your email address by clicking the button below:</p>
                    
                    <div style='text-align: center; margin: 30px 0;'>
                        <a href='$verificationLink' style='background: linear-gradient(135deg, #7B4CFF 0%, #4C2EAA 100%); color: white; padding: 12px 30px; text-decoration: none; border-radius: 50px; display: inline-block; font-weight: bold;'>Verify Email Address</a>
                    </div>
                    
                    <p>If the button doesn't work, you can copy and paste this link into your browser:</p>
                    <p style='background: rgba(123, 76, 255, 0.1); padding: 10px; border-radius: 5px; word-break: break-all;'>$verificationLink</p>
                    
                    <p style='color: #A8B2D1; font-size: 0.9em; margin-top: 30px;'>This verification link will expire in 1 hour for security reasons.</p>
                    
                    <div style='margin-top: 40px; padding-top: 20px; border-top: 1px solid rgba(123, 76, 255, 0.3); text-align: center; font-size: 0.9em; color: #A8B2D1;'>
                        <p>Brewverse Coffee Shop<br>Where Coffee Meets Cosmos</p>
                    </div>
                </div>
            ";
            
            $mail->send();
            return true;
        } catch (Exception $e) {
            log_message('error', 'Email verification failed: ' . $mail->ErrorInfo);
            return false;
        }
    }

    public function verify($token)
    {
        $userModel = new UserModel();
        
        // First check if this is a pending registration in session
        $pendingRegistration = session()->get('pending_registration');
        
        if ($pendingRegistration && $pendingRegistration['verification_token'] === $token) {
            // Check if token is not expired (1 hour limit)
            if ((time() - $pendingRegistration['timestamp']) > 3600) {
                session()->remove('pending_registration');
                return redirect()->to('/auth/register')->with('error', 'Verification link has expired. Please register again.');
            }
            
            // Check if email is still unique (someone else might have registered with same email)
            $existingUser = $userModel->where('email', $pendingRegistration['email'])->first();
            if ($existingUser) {
                session()->remove('pending_registration');
                return redirect()->to('/auth/register')->with('error', 'Email is already registered. Please use a different email.');
            }
            
            // Create the user account now
        

$userData = [
    'username' => $pendingRegistration['username'],
    'email' => $pendingRegistration['email'],
    'password' => $pendingRegistration['password'],
    'email_verified' => 1,
    'verification_token' => null,
    'is_admin' => 0  // Add this line - default to regular user
];

            $userModel->insert($userData);
            session()->remove('pending_registration');
            
            return redirect()->to('/auth/login')->with('registration_complete', 'Registration completed successfully! You can now login to your account.');
        }
        
        // If not found in session, check database (for existing users who need reverification)
        $user = $userModel->where('verification_token', $token)->first();
        
        if (!$user) {
            return redirect()->to('/auth/register')->with('error', 'Invalid or expired verification token.');
        }

        if ($user['email_verified'] == 1) {
            return redirect()->to('/auth/login')->with('info', 'Email is already verified. You can now login.');
        }

        // Verify the email for existing user
        $userModel->update($user['id'], [
            'email_verified' => 1,
            'verification_token' => null
        ]);

        return redirect()->to('/auth/login')->with('verification_success', 'Email verified successfully! You can now login to your account.');
    }

    public function resendVerification()
    {
        $email = $this->request->getPost('email');
        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Email not found.');
        }

        if ($user['email_verified'] == 1) {
            return redirect()->back()->with('info', 'Email is already verified.');
        }

        // Generate new verification token
        $verificationToken = bin2hex(random_bytes(32));
        $userModel->update($user['id'], ['verification_token' => $verificationToken]);

        if ($this->sendVerificationEmail($email, $verificationToken)) {
            return redirect()->back()->with('resend_success', 'Verification email sent successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to send verification email. Please try again.');
        }
    }

    public function login()
    {
    
        return view('auth/login');
    }
    

    private function logUserLogin($userId, $username, $isAdmin)
    {
        try {
            $db = \Config\Database::connect();
            
            // Check if table exists, create if it doesn't
            if (!$db->tableExists('user_login_logs')) {
                $forge = \Config\Database::forge();
                $fields = [
                    'id' => [
                        'type' => 'INT',
                        'constraint' => 11,
                        'unsigned' => true,
                        'auto_increment' => true
                    ],
                    'user_id' => [
                        'type' => 'INT',
                        'constraint' => 11
                    ],
                    'username' => [
                        'type' => 'VARCHAR',
                        'constraint' => 255
                    ],
                    'user_type' => [
                        'type' => 'ENUM',
                        'constraint' => ['admin', 'user']
                    ],
                    'login_time' => [
                        'type' => 'TIMESTAMP',
                        'null' => false,
                        'default' => 'CURRENT_TIMESTAMP'
                    ]
                ];
                
                $forge->addField($fields);
                $forge->addKey('id', true);
                $forge->addKey('user_id');
                $forge->createTable('user_login_logs', true);
            }

            // Insert login record
            $data = [
                'user_id' => $userId,
                'username' => $username,
                'user_type' => $isAdmin ? 'admin' : 'user'
                // login_time will be automatically set by MySQL CURRENT_TIMESTAMP
            ];
            
            $db->table('user_login_logs')->insert($data);
        } catch (\Exception $e) {
            log_message('error', 'Failed to log user login: ' . $e->getMessage());
        }
    }

    public function doLogin()
    {
        $session = session();
        $userModel = new UserModel();
        $login = $this->request->getPost('email');  // username or email
        $password = $this->request->getPost('password');
    
        // Find user by email OR username
        $user = $userModel->where('email', $login)
                          ->orWhere('username', $login)
                          ->first();
    
        if ($user && password_verify($password, $user['password'])) {
            // Check if user is archived
            if ($user['is_archived'] == 1) {
                return redirect()->to('/auth/login')->with('error', 'This account has been archived. Please contact the administrator.');
            }

            // Set session data
            $session->set([
                'id' => $user['id'],
                'user_id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'is_admin' => $user['is_admin'],
                'address' => $user['address'],
                'profile_picture' => $user['profile_picture'],
                'isLoggedIn' => true
            ]);
    
                // Log the login
                $this->logUserLogin($user['id'], $user['username'], $user['is_admin'] == 1);
    
            if ($user['is_admin'] == 1) {
                session()->setFlashdata('admin_login_success', 'Admin login successful!');
                return redirect()->to('/auth/login'); // Go back to auth/login to show modal
            } else {
                session()->setFlashdata('login_success', 'Login successful!');
                return redirect()->to('/auth/login'); // Go back to auth/login to show modal
            }
        }
    
        // Login failed
        return redirect()->to('/auth/login')->with('error', 'Invalid credentials');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/main_dashboard');
    }

    public function dashboard()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/auth/login');
        }
        return view('auth/dashboard');
    }

    public function forgot()
    {
        return view('auth/forgot_password');
    }

    public function sendReset()
    {
        $email = $this->request->getPost('email');
        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        if (!$user) {
            return redirect()->to('/auth/forgot')->with('error', 'Email not found');
        }

        $token = bin2hex(random_bytes(32));
        $userModel->update($user['id'], ['reset_token' => $token]);

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
             $mail->Username = 'naquilakennethv@gmail.com';
            $mail->Password = 'bzxf urmz nfmp zksm';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('coffeeshop@gmail.com', 'Brewverse Coffee Shop');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Reset Your Brewverse Password';

            $resetLink = base_url("/auth/reset/$token");
            
            // HTML Email Template
            $mail->Body = "
                <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; background-color: #0A0F1C; color: #E0E0E0; padding: 30px; border-radius: 10px;'>
                    <div style='text-align: center; margin-bottom: 30px;'>
                        <img src='" . base_url('images/logo.png') . "' alt='Brewverse Logo' style='height: 60px;'>
                        <h2 style='color: #7B4CFF; font-family: Orbitron, sans-serif; margin: 20px 0;'>Password Reset Request</h2>
                    </div>
                    
                    <p style='margin-bottom: 20px;'>Hello " . $user['username'] . ",</p>
                    
                    <p>We received a request to reset your password for your Brewverse account. Click the button below to set a new password:</p>
                    
                    <div style='text-align: center; margin: 30px 0;'>
                        <a href='$resetLink' style='background: linear-gradient(135deg, #7B4CFF 0%, #4C2EAA 100%); color: white; padding: 12px 30px; text-decoration: none; border-radius: 50px; display: inline-block; font-weight: bold;'>Reset Password</a>
                    </div>
                    
                    <p>If you didn't request this password reset, you can safely ignore this email - your password won't be changed.</p>
                    
                    <p style='color: #A8B2D1; font-size: 0.9em; margin-top: 30px;'>This password reset link will expire in 1 hour for security reasons.</p>
                    
                    <div style='margin-top: 40px; padding-top: 20px; border-top: 1px solid rgba(123, 76, 255, 0.3); text-align: center; font-size: 0.9em; color: #A8B2D1;'>
                        <p>Brewverse Coffee Shop<br>Where Coffee Meets Cosmos</p>
                    </div>
                </div>
            ";

            $mail->send();
            return redirect()->to('/auth/forgot')->with('reset_link_sent', true);
        } catch (Exception $e) {
            return redirect()->to('/auth/forgot')->with('error', 'Failed to send reset email. Please try again.');
        }
    }

    public function reset($token)
    {
        return view('auth/reset_password', ['token' => $token]);
    }

    public function updatePassword()
    {
        $token = $this->request->getPost('token');
        $password = $this->request->getPost('password');

        // Validation rules
        $rules = [
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[8]|regex_match[/(?=.*[A-Z])(?=.*\d).+/]',
                'errors' => [
                    'required' => 'Password is required.',
                    'min_length' => 'Password must be at least 8 characters.',
                    'regex_match' => 'Password must contain at least 1 uppercase letter and 1 number.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->to("/auth/reset/$token")->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();
        $user = $userModel->where('reset_token', $token)->first();

        if ($user) {
            // Check if new password is same as current
            if (password_verify($password, $user['password'])) {
                // Add custom error
                $errors = ['password' => 'New password cannot be the same as the current password.'];
                return redirect()->to("/auth/reset/$token")->withInput()->with('errors', $errors);
            }

            // Update password and clear token
            $userModel->update($user['id'], [
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'reset_token' => null
            ]);
            return redirect()->to("/auth/reset/$token")->with('reset_success', true);
        }

        return redirect()->to('/auth/login')->with('error', 'Invalid or expired token.');
    }
}