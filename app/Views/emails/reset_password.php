<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Brewverse Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #0A0F1C;
            color: #E0E0E0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: linear-gradient(145deg, #1a1f2e 0%, #0d1117 100%);
            border: 1px solid rgba(123, 76, 255, 0.2);
            border-radius: 24px;
        }
        .header {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid rgba(123, 76, 255, 0.2);
        }
        .logo {
            max-width: 150px;
            height: auto;
        }
        .content {
            padding: 30px 20px;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 12px;
            margin: 20px 0;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(135deg, #7B4CFF 0%, #4C2EAA 100%);
            color: #ffffff;
            text-decoration: none;
            border-radius: 50px;
            margin: 20px 0;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid rgba(123, 76, 255, 0.2);
            font-size: 12px;
            color: #A8B2D1;
        }
        .note {
            font-size: 12px;
            color: #A8B2D1;
            margin-top: 20px;
        }
        h1 {
            color: #7B4CFF;
            margin: 0;
            padding: 0;
        }
        p {
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="<?= base_url('images/logo.png') ?>" alt="Brewverse Logo" class="logo">
            <h1>Password Reset Request</h1>
        </div>
        
        <div class="content">
            <p>Greetings, Cosmic Explorer!</p>
            
            <p>We received a request to reset your password for your Brewverse account. If you didn't make this request, please ignore this email.</p>
            
            <p>To reset your password, click the button below. This link will expire in 1 hour for security purposes.</p>
            
            <center>
                <a href="<?= $resetLink ?>" class="button">Reset Password</a>
            </center>
            
            <p class="note">If the button doesn't work, copy and paste this link into your browser:</p>
            <p style="word-break: break-all; font-size: 12px; color: #7B4CFF;">
                <?= $resetLink ?>
            </p>
        </div>
        
        <div class="footer">
            <p>This is an automated message from Brewverse. Please do not reply to this email.</p>
            <p>&copy; <?= date('Y') ?> Brewverse. All rights reserved.</p>
        </div>
    </div>
</body>
</html> 