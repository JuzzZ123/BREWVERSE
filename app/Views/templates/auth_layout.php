<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brewverse - <?= $title ?? 'Authentication' ?></title>
    
    <!-- Bootstrap and Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <!-- Space Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #0A0F1C 0%, #1A1F2E 100%);
            font-family: 'Space Grotesk', sans-serif;
            color: #E0E0E0;
            position: relative;
            overflow-x: hidden;
        }

        /* Animated Stars Background */
        .stars {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            background: 
                radial-gradient(circle at 15% 15%, rgba(123, 76, 255, 0.1) 0%, transparent 25%),
                radial-gradient(circle at 85% 85%, rgba(123, 76, 255, 0.1) 0%, transparent 25%);
            animation: twinkle 8s infinite;
        }

        @keyframes twinkle {
            0%, 100% { opacity: 0.8; }
            50% { opacity: 0.4; }
        }

        .auth-container {
            max-width: 450px;
            margin: 2rem auto;
            padding: 2.5rem;
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(123, 76, 255, 0.2);
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .logo-container {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo-container img {
            height: 60px;
            margin-bottom: 1rem;
        }

        .brand-text {
            font-family: 'Orbitron', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            background: linear-gradient(135deg, #fff 0%, #7B4CFF 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin: 0;
        }

        .form-label {
            color: #E0E0E0;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(123, 76, 255, 0.2);
            border-radius: 12px;
            color: #E0E0E0;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: #7B4CFF;
            box-shadow: 0 0 0 2px rgba(123, 76, 255, 0.2);
            color: #E0E0E0;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .cosmic-btn {
            background: linear-gradient(135deg, #7B4CFF 0%, #4C2EAA 100%);
            color: #fff;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 500;
            transition: all 0.3s ease;
            width: 100%;
        }

        .cosmic-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(123, 76, 255, 0.3);
            color: #fff;
        }

        .cosmic-link {
            color: #7B4CFF;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .cosmic-link:hover {
            color: #9D7BFF;
            text-decoration: underline;
        }

        /* Toast Styling */
        .toast {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(123, 76, 255, 0.2);
            border-radius: 12px;
        }

        .toast.text-bg-danger {
            background: rgba(220, 53, 69, 0.2) !important;
            border-color: rgba(220, 53, 69, 0.4);
        }

        .toast.text-bg-success {
            background: rgba(25, 135, 84, 0.2) !important;
            border-color: rgba(25, 135, 84, 0.4);
        }

        /* Modal Styling */
        .modal-content {
            background: linear-gradient(145deg, #1a1f2e 0%, #0d1117 100%);
            border: 1px solid rgba(123, 76, 255, 0.1);
            border-radius: 24px;
        }

        .modal-header {
            border-bottom: 1px solid rgba(123, 76, 255, 0.1);
            padding: 1.5rem 2rem;
        }

        .modal-title {
            color: #E0E0E0;
            font-family: 'Orbitron', sans-serif;
        }

        .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
        }

        .spinner-border {
            color: #7B4CFF !important;
        }

        /* Password Toggle Button */
        .input-group .btn-outline-secondary {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(123, 76, 255, 0.2);
            color: #E0E0E0;
        }

        .input-group .btn-outline-secondary:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: #7B4CFF;
            color: #7B4CFF;
        }

        /* Responsive Adjustments */
        @media (max-width: 576px) {
            .auth-container {
                margin: 1rem;
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="stars"></div>
    
    <div class="container">
        <div class="auth-container">
            <div class="logo-container">
                <img src="<?= base_url('images/logo.png') ?>" alt="Brewverse Logo">
                <h1 class="brand-text">Brewverse</h1>
            </div>
            
            <?= $this->renderSection('content') ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?= $this->renderSection('scripts') ?>
</body>
</html> 