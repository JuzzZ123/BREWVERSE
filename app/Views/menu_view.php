<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Brewverse Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Base Styles */
        body {
            font-family: 'Space Grotesk', sans-serif;
            color: #E0E0E0;
            background-color: #0A0F1C;
        }

        /* Navbar Styling */
        .navbar {
            background: rgba(13, 17, 23, 0.95) !important;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding: 1rem 2rem;
            transition: all 0.3s ease;
            z-index: 1001;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: #7B4CFF !important;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .navbar-logo {
            height: 35px;
            width: auto;
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover .navbar-logo {
            transform: rotate(10deg);
        }

        .nav-link {
            color: #E0E0E0 !important;
            font-weight: 500;
            position: relative;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            width: 0;
            height: 2px;
            background: #7B4CFF;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .nav-link:hover {
            color: #7B4CFF !important;
        }

        /* Dropdown Menu Styling */
        .dropdown-menu {
            background: rgba(13, 17, 23, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            margin-top: 1rem;
            padding: 0.5rem;
        }

        .dropdown-item {
            color: #E0E0E0;
            transition: all 0.3s ease;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
        }

        .dropdown-item:hover {
            background: rgba(123, 76, 255, 0.1);
            color: #7B4CFF;
        }

        .dropdown-divider {
            border-color: rgba(255, 255, 255, 0.1);
            margin: 0.5rem 0;
        }

        /* Profile Button Styling */
        .profile-button {
            background: linear-gradient(135deg, #7B4CFF 0%, #4C2EAA 100%);
            border: none;
            border-radius: 50px;
            padding: 0.5rem 1.5rem;
            color: white !important;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .profile-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(123, 76, 255, 0.3);
            color: white !important;
        }

        .profile-button.dropdown-toggle::after {
            display: none; /* Remove default dropdown arrow */
        }

        .profile-image-container {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            overflow: hidden;
            border: 2px solid rgba(255, 255, 255, 0.2);
            flex-shrink: 0;
        }

        .profile-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Default avatar styling */
        .profile-image-container .default-avatar {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #4C2EAA;
            color: white;
            font-weight: bold;
            font-size: 1.2rem;
        }

        /* Responsive adjustments */
        @media (max-width: 991px) {
            .navbar-collapse {
                background: rgba(13, 17, 23, 0.98);
                padding: 1rem;
                border-radius: 12px;
                margin-top: 1rem;
            }

            .dropdown-menu {
                background: rgba(13, 17, 23, 0.98);
                margin-top: 0.5rem;
            }

            .nav-item.dropdown {
                padding: 0.5rem 0;
            }
        }

        /* Menu Section Styles */
        .menu-container {
            padding-top: 100px;
            min-height: 100vh;
           
        }

        .menu-header {
            text-align: center;
            margin-bottom: 3rem;
            padding-top: 2rem;
        }

        .menu-title {
            font-family: 'Orbitron', sans-serif;
            font-size: 2.5rem;
            background: linear-gradient(135deg, #7B4CFF 0%, #9D7BFF 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 1rem;
        }

        .menu-subtitle {
            color: #A8B2D1;
            font-size: 1.1rem;
        }

        .category-title {
            font-family: 'Orbitron', sans-serif;
            color: #7B4CFF;
            margin-bottom: 2rem;
            font-size: 1.8rem;
            text-align: center;
        }

        .menu-card {
            background: rgba(21, 28, 50, 0.8);
            border: 1px solid rgba(123, 76, 255, 0.2);
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(123, 76, 255, 0.2);
        }

        .menu-card img {
            height: 200px;
            object-fit: cover;
            border-bottom: 1px solid rgba(123, 76, 255, 0.2);
        }

        .menu-card .card-body {
            padding: 1.5rem;
        }

        .menu-card .card-title {
            color: #fff;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .menu-card .card-text {
            color: #A8B2D1;
        }

        .menu-card .price {
            color: #7B4CFF;
            font-weight: 700;
            font-size: 1.2rem;
        }

        .add-to-cart-btn {
            background: linear-gradient(135deg, #7B4CFF 0%, #4C2EAA 100%);
            border: none;
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .add-to-cart-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(123, 76, 255, 0.3);
        }

        /* Cart Sidebar Styling */
        .cart-sidebar {
            background: linear-gradient(145deg, #0A0F1C 0%, #151C32 100%);
            backdrop-filter: blur(10px);
            border-left: 1px solid rgba(123, 76, 255, 0.2);
            position: fixed;
            top: 0;
            right: -100%;
            width: 350px;
            height: 100vh;
            transition: right 0.3s ease;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            padding-top: 80px;
        }

        .cart-sidebar.active {
            right: 0;
        }

        .cart-icon {
            position: fixed;
            top: 100px;
            right: 30px;
            background: linear-gradient(135deg, #7B4CFF 0%, #4C2EAA 100%);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            box-shadow: 0 4px 15px rgba(123, 76, 255, 0.3);
            z-index: 999;
            transition: all 0.3s ease;
        }

        .cart-icon:hover {
            transform: scale(1.1);
        }

        .cart-header {
            background: rgba(123, 76, 255, 0.1);
            padding: 1.5rem;
            border-bottom: 1px solid rgba(123, 76, 255, 0.2);
            position: sticky;
            top: 80px;
            z-index: 1002;
        }

        .cart-header h2 {
            font-family: 'Orbitron', sans-serif;
            color: #7B4CFF;
            font-size: 1.5rem;
            margin: 0;
            padding-top: 1rem;
        }

        .close-btn {
            background: none;
            border: none;
            color: #A8B2D1;
            font-size: 0.9rem;
            padding: 0;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .close-btn:hover {
            color: #7B4CFF;
            transform: translateX(-5px);
        }

        .cart-content {
            flex: 1;
            overflow-y: auto;
            padding: 1.5rem;
            max-height: calc(100vh - 80px);
        }

        .cart-item {
            background: rgba(21, 28, 50, 0.8);
            border: 1px solid rgba(123, 76, 255, 0.2);
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }

        .cart-item:hover {
            transform: translateY(-2px);
            border-color: rgba(123, 76, 255, 0.4);
            box-shadow: 0 4px 15px rgba(123, 76, 255, 0.1);
        }

        .cart-item h6 {
            color: #fff;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }

        .quantity-controls button {
            background: rgba(123, 76, 255, 0.1);
            border: 1px solid rgba(123, 76, 255, 0.2);
            color: #7B4CFF;
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .quantity-controls button:hover {
            background: rgba(123, 76, 255, 0.2);
            transform: scale(1.1);
        }

        .quantity-controls span {
            color: #E0E0E0;
            min-width: 30px;
            text-align: center;
        }

        .cart-item .price {
            color: #7B4CFF;
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 0.3rem;
        }

        .cart-item .text-danger {
            color: #ff4d4d !important;
            text-decoration: none;
            font-size: 0.85rem;
            transition: all 0.3s ease;
        }

        .cart-item .text-danger:hover {
            color: #ff6666 !important;
            text-decoration: underline;
        }

        .cart-footer {
            background: rgba(21, 28, 50, 0.95);
            border-top: 1px solid rgba(123, 76, 255, 0.2);
            padding: 1.5rem;
        }

        .cart-footer h5 {
            color: #E0E0E0;
            font-weight: 600;
        }

        .cart-footer .btn-primary {
            background: linear-gradient(135deg, #7B4CFF 0%, #4C2EAA 100%);
            border: none;
            padding: 0.8rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .cart-footer .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(123, 76, 255, 0.3);
        }

        .cart-footer .btn-outline-danger {
            background: transparent;
            border: 1px solid rgba(255, 77, 77, 0.5);
            color: #ff4d4d;
            padding: 0.8rem;
            transition: all 0.3s ease;
        }

        .cart-footer .btn-outline-danger:hover {
            background: rgba(255, 77, 77, 0.1);
            border-color: #ff4d4d;
            transform: translateY(-2px);
        }

        /* Scrollbar Styling */
        .cart-content::-webkit-scrollbar {
            width: 6px;
        }

        .cart-content::-webkit-scrollbar-track {
            background: rgba(123, 76, 255, 0.1);
        }

        .cart-content::-webkit-scrollbar-thumb {
            background: rgba(123, 76, 255, 0.3);
            border-radius: 3px;
        }

        .cart-content::-webkit-scrollbar-thumb:hover {
            background: rgba(123, 76, 255, 0.5);
        }

        /* Empty Cart Message */
        .cart-content .text-muted {
            color: #A8B2D1 !important;
            font-style: italic;
        }

        /* Footer Styles */
        .footer-section {
      
        position: relative;
        overflow: hidden;
        padding: 80px 0 30px;
        color: #E0E0E0;
        font-family: 'Exo 2', sans-serif;
    }

    /* Brand Section */
    .footer-logo {
        text-decoration: none;
        position: relative;
        display: inline-block;
    }

    .gradient-text {
        font-family: 'Orbitron', sans-serif;
        font-size: 1.8rem;
        font-weight: 700;
        background: linear-gradient(135deg, #7B4CFF 0%, #9D7BFF 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        letter-spacing: 1px;
    }

    .footer-about {
        color: #A8B2D1;
        line-height: 1.8;
        margin-top: 1.5rem;
        font-size: 0.95rem;
        position: relative;
        padding-left: 1rem;
        border-left: 2px solid rgba(123, 76, 255, 0.3);
    }

    /* Enhanced Social Links */
    .social-links {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
    }

    .social-link {
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(123, 76, 255, 0.1);
        border: 1px solid rgba(123, 76, 255, 0.2);
        border-radius: 12px;
        color: #7B4CFF;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
    }

    .social-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #7B4CFF 0%, #4C2EAA 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 0;
    }

    .social-link i {
        position: relative;
        z-index: 1;
        transition: all 0.3s ease;
    }

    .social-link:hover {
        transform: translateY(-5px) scale(1.1);
        box-shadow: 0 5px 15px rgba(123, 76, 255, 0.3);
    }

    .social-link:hover::before {
        opacity: 1;
    }

    .social-link:hover i {
        color: white;
    }

    /* Enhanced Footer Titles */
    .footer-title {
        font-family: 'Orbitron', sans-serif;
        color: #FFF;
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 1.8rem;
        position: relative;
        padding-bottom: 0.8rem;
        letter-spacing: 1px;
    }

    .footer-title::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 40px;
        height: 3px;
        background: linear-gradient(90deg, #7B4CFF, transparent);
        transition: width 0.3s ease;
    }

    .footer-title:hover::after {
        width: 100px;
    }

    /* Enhanced Footer Links */
    .footer-links {
        list-style: none;
        padding: 0;
    }

    .footer-links li {
        margin-bottom: 1rem;
    }

    .footer-links a {
        color: #A8B2D1;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s ease;
        position: relative;
        padding-left: 0;
    }

    .footer-links a::before {
        content: '→';
        position: relative;
        left: 0;
        opacity: 0;
        margin-right: 0;
        transition: all 0.3s ease;
        color: #7B4CFF;
    }

    .footer-links a:hover {
        color: #7B4CFF;
        padding-left: 1.5rem;
    }

    .footer-links a:hover::before {
        opacity: 1;
        margin-right: 0.5rem;
    }

    /* Enhanced Contact Info */
    .footer-contact {
        list-style: none;
        padding: 0;
    }

    .footer-contact li {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.2rem;
        padding: 0.8rem;
        border-radius: 8px;
        transition: all 0.3s ease;
        background: rgba(123, 76, 255, 0.05);
    }

    .footer-contact li:hover {
        background: rgba(123, 76, 255, 0.1);
        transform: translateX(5px);
    }

    .footer-contact i {
        color: #7B4CFF;
        font-size: 1.2rem;
        transition: all 0.3s ease;
    }

    .footer-contact li:hover i {
        transform: scale(1.2);
    }

    /* Enhanced Opening Hours */
    .footer-hours {
        list-style: none;
        padding: 0;
    }

    .footer-hours li {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1rem;
        padding: 0.8rem;
        border-radius: 8px;
        background: rgba(123, 76, 255, 0.05);
        transition: all 0.3s ease;
    }

    .footer-hours li:hover {
        background: rgba(123, 76, 255, 0.1);
        transform: translateX(5px);
    }

    .footer-hours span {
        color: #A8B2D1;
        transition: color 0.3s ease;
    }

    .footer-hours li:hover span {
        color: #fff;
    }

    /* Enhanced Footer Bottom */
    .footer-bottom {
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 1px solid rgba(123, 76, 255, 0.2);
        position: relative;
    }

    .footer-bottom::before {
        content: '';
        position: absolute;
        top: -1px;
        left: 50%;
        transform: translateX(-50%);
        width: 50%;
        height: 1px;
        background: linear-gradient(90deg, 
            transparent, 
            rgba(123, 76, 255, 0.5),
            transparent
        );
    }

    .copyright {
        color: #A8B2D1;
        font-size: 0.9rem;
    }

    .copyright i.fa-heart {
        color: #7B4CFF;
        transition: transform 0.3s ease;
    }

    .copyright:hover i.fa-heart {
        transform: scale(1.2);
    }

    .footer-bottom-links {
        display: flex;
        gap: 2rem;
        justify-content: flex-end;
    }

    .footer-bottom-links a {
        color: #A8B2D1;
        text-decoration: none;
        transition: all 0.3s ease;
        font-size: 0.9rem;
        position: relative;
    }

    .footer-bottom-links a::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 1px;
        background: #7B4CFF;
        transition: width 0.3s ease;
    }

    .footer-bottom-links a:hover {
        color: #7B4CFF;
    }

    .footer-bottom-links a:hover::after {
        width: 100%;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .footer-section {
            padding: 60px 0 20px;
        }

        .footer-bottom-links {
            justify-content: center;
            margin-top: 1rem;
            flex-wrap: wrap;
        }

        .copyright {
            text-align: center;
        }
    }

    /* Profile Modal Styling */
    .modal-content {
        background: linear-gradient(145deg, #1a1f2e 0%, #0d1117 100%);
        border: 1px solid rgba(123, 76, 255, 0.1);
        border-radius: 24px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    }

    .modal-header {
        border-bottom: 1px solid rgba(123, 76, 255, 0.1);
        padding: 1.5rem 2rem;
        background: rgba(123, 76, 255, 0.03);
        border-radius: 24px 24px 0 0;
    }

    .modal-title {
        font-size: 1.5rem;
        background: linear-gradient(135deg, #fff 0%, #e0e0e0 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .modal-title i {
        font-size: 1.8rem;
        color: #7B4CFF;
    }

    .btn-close {
        background: none;
        border: none;
        font-size: 1.5rem;
        color: #E0E0E0;
        opacity: 0.7;
        transition: all 0.3s ease;
    }

    .btn-close:hover {
        opacity: 1;
        transform: rotate(90deg);
    }

    .modal-body {
        padding: 2rem;
    }

    .profile-picture-container {
        position: relative;
        width: 150px;
        height: 150px;
        margin: 0 auto 2rem;
        border-radius: 50%;
        padding: 5px;
        background: linear-gradient(135deg, #fff 0%, #7B4CFF 100%);
    }

    .profile-picture-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #0d1117;
        transition: all 0.3s ease;
    }

    .camera-button {
        position: absolute;
        bottom: 5px;
        right: 5px;
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #7B4CFF 0%, #4C2EAA 100%);
        border: 3px solid #0d1117;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .camera-button:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 20px rgba(123, 76, 255, 0.3);
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        color: #fff;
        font-weight: 500;
        margin-bottom: 0.75rem;
        font-size: 0.95rem;
        display: block;
        letter-spacing: 0.5px;
    }

    .input-group {
        background: rgba(255, 255, 255, 0.03);
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .input-group:focus-within {
        box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.2);
    }

    .input-group-text {
        background: transparent;
        border: none;
        color: #fff;
        padding: 0.75rem 1rem;
    }

    .form-control {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #fff;
        padding: 0.75rem 1rem;
        font-size: 1rem;
    }

    .form-control:focus {
        background: rgba(255, 255, 255, 0.08);
        border-color: #7B4CFF;
        color: #fff;
    }

    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.5);
    }

    .modal-footer {
        border-top: 1px solid rgba(123, 76, 255, 0.1);
        padding: 1.5rem 2rem;
        background: rgba(123, 76, 255, 0.03);
        border-radius: 0 0 24px 24px;
    }

    .btn-cancel {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #fff;
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .btn-cancel:hover {
        background: rgba(255, 255, 255, 0.15);
        color: #fff;
    }

    .btn-save {
        background: linear-gradient(135deg, #7B4CFF 0%, #4C2EAA 100%);
        color: #fff;
        font-weight: 500;
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(123, 76, 255, 0.3);
    }

    /* Add this to your existing styles */
    .cosmic-toast-container {
        position: fixed;
        top: 100px; /* Below the navbar */
        right: 20px;
        z-index: 1060;
        pointer-events: none;
    }

    .cosmic-toast {
        background: rgba(13, 17, 23, 0.95);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(123, 76, 255, 0.2);
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 1rem;
        color: #E0E0E0;
        box-shadow: 0 4px 15px rgba(123, 76, 255, 0.2);
        opacity: 0;
        transform: translateX(100%);
        transition: all 0.3s ease;
        pointer-events: auto;
        max-width: 350px;
    }

    .cosmic-toast.show {
        opacity: 1;
        transform: translateX(0);
    }

    .cosmic-toast.success {
        border-left: 4px solid #7B4CFF;
    }

    .cosmic-toast.error {
        border-left: 4px solid #ff4d4d;
    }

    .cosmic-toast-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 0.5rem;
    }

    .cosmic-toast-title {
        font-family: 'Orbitron', sans-serif;
        font-size: 1rem;
        color: #7B4CFF;
        margin: 0;
    }

    .cosmic-toast-close {
        background: none;
        border: none;
        color: #A8B2D1;
        font-size: 1.2rem;
        padding: 0;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .cosmic-toast-close:hover {
        color: #E0E0E0;
        transform: rotate(90deg);
    }

    .cosmic-toast-body {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 0.9rem;
    }

    .cosmic-toast-icon {
        margin-right: 0.5rem;
        font-size: 1.2rem;
    }

    .cosmic-toast.success .cosmic-toast-icon {
        color: #7B4CFF;
    }

    .cosmic-toast.error .cosmic-toast-icon {
        color: #ff4d4d;
    }
    /* === LIGHT MODE BASE === */
body.light-mode {
    background-color: #f8f9fa;
    color: #212529;
}

/* Navbar */
body.light-mode .navbar {
    background-color: #ffffff !important;
    color: #212529 !important;
}
body.light-mode .navbar .nav-link,
body.light-mode .navbar-brand {
    color: #212529 !important;
}

/* Typography */
body.light-mode p,
body.light-mode h1,
body.light-mode h2,
body.light-mode h3,
body.light-mode h4,
body.light-mode h5,
body.light-mode h6,
body.light-mode span,
body.light-mode small,
body.light-mode label {
    color: #212529 !important;
}

/* Buttons */
body.light-mode .btn,
body.light-mode button {
    background-color: #ffffff;
    color: #212529;
    border: 1px solid #ced4da;
}
body.light-mode .btn:hover,
body.light-mode button:hover {
    background-color: #e2e6ea;
}

/* Primary button override */
body.light-mode .btn-primary {
    background-color: #6c63ff;
    border-color: #6c63ff;
    color: #fff;
}
body.light-mode .btn-primary:hover {
    background-color: #5a54cc;
}

/* Outline light button override */
body.light-mode .btn-outline-light {
    color: #212529 !important;
    border-color: #212529 !important;
}

/* Forms */
body.light-mode .form-control,
body.light-mode input,
body.light-mode textarea,
body.light-mode select {
    background-color: #ffffff !important;
    color: #212529 !important;
    border: 1px solid #ced4da;
}

/* Cards and Containers */
body.light-mode .card,
body.light-mode .content,
body.light-mode .container,
body.light-mode .main-content,
body.light-mode .section,
body.light-mode .box {
    background-color: #ffffff !important;
    color: #212529 !important;
    border: 1px solid #dee2e6;
}

/* Tables */
body.light-mode table {
    background-color: #ffffff;
    color: #212529;
}
body.light-mode table thead {
    background-color: #e9ecef;
}
body.light-mode th,
body.light-mode td {
    border-color: #dee2e6;
}

/* Modals */
body.light-mode .modal-content {
    background-color: #ffffff;
    color: #212529;
}

/* Dropdowns */
body.light-mode .dropdown-menu {
    background-color: #ffffff;
    color: #212529;
    border: 1px solid #ced4da;
}

/* Alerts / Toasts */
body.light-mode .alert,
body.light-mode .toast {
    background-color: #ffffff;
    color: #212529;
    border: 1px solid #ced4da;
}

/* Links */
body.light-mode a {
    color: #0d6efd;
}
body.light-mode a:hover {
    color: #0a58ca;
    text-decoration: underline;
}
body.light-mode .cosmic-title {
    color: #343a40 !important; /* Semi-dark gray */
}
    </style>
</head>
<body class="<?= (isset($_COOKIE['theme']) && $_COOKIE['theme'] === 'light') ? 'light-mode' : '' ?>">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top">
<div class="container">
        <a class="navbar-brand" href="#">
            <img src="<?= base_url('images/logo.png') ?>" alt="Brewverse Logo" class="navbar-logo">
            <span>Brewverse</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars" style="color: #7B4CFF"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item ms-3">
    <button id="themeToggle" class="btn btn-outline-light" title="Toggle Light/Dark Mode">
        <i id="themeIcon" class="fas fa-moon"></i>
    </button>
</li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('/') ?>#home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('menu') ?>">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('/') ?>#about">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('/') ?>#reviews">Reviews</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('/') ?>#footer">Contact</a>
                </li>
                
                <?php if (session()->has('username')): ?>
                    <li class="nav-item dropdown ms-3">
                        <a class="profile-button dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="profile-image-container">
                                <?php if (session()->has('profile_picture') && !empty(session('profile_picture'))): ?>
                                    <img src="data:image/jpeg;base64,<?= base64_encode(session('profile_picture')) ?>" 
                                         alt="Profile" 
                                         style="width: 100%; height: 100%; object-fit: cover;">
                                <?php else: ?>
                                    <div class="default-avatar">
                                        <?= strtoupper(substr(esc(session('username')), 0, 1)) ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <span><?= esc(session('username')) ?></span>
                            <i class="fas fa-chevron-down ms-2" style="font-size: 0.8rem;"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#profileModal">
                                    <i class="fas fa-user-circle me-2"></i>View Profile
                                </a>
                            </li>
                            <?php if (session()->get('is_admin') == 1): ?>
                                <li>
                                    <a class="dropdown-item" href="<?= site_url('admin/users') ?>">
                                        <i class="fas fa-users-cog me-2"></i>Manage Users
                                    </a>
                                </li>
                            <?php endif; ?>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="<?= site_url('auth/logout') ?>">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item ms-3">
                        <a class="profile-button" href="<?= site_url('auth/login') ?>">
                            <i class="fas fa-sign-in-alt me-2"></i>
                            Sign In
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Menu Section -->
<div class="menu-container">
<div class="container">
        <div class="menu-header">
            <h1 class="menu-title">Cosmic Menu</h1>
            <p class="menu-subtitle">Discover our interstellar selection of coffee and treats</p>
        </div>

    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= esc(session()->getFlashdata('message')) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= esc(session()->getFlashdata('error')) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div id="cartIconContainer">
        <a href="#" onclick="toggleCart()" class="cart-icon">
            <i class="fas fa-shopping-cart"></i>
        </a>
    </div>

    <main>
        <?php
            $groupedItems = [];
            foreach ($products as $item) {
                $groupedItems[$item['category']][] = $item;
            }
        ?>

            <?php foreach ($groupedItems as $category => $items): ?>
                <section class="mb-5">
                    <h2 class="category-title"><?= esc($category) ?></h2>
                    <div class="row g-4 justify-content-center">
                        <?php foreach ($items as $item): ?>
                            <div class="col-md-6 col-lg-4">
                                <div class="menu-card">
                                    <?php if (!empty($item['image'])): ?>
                                        <img src="<?= base_url('admin/image/' . $item['id']) ?>" 
                                             class="card-img-top" 
                                             alt="<?= esc($item['product_name']) ?>">
                                    <?php else: ?>
                                        <div class="card-img-top bg-dark d-flex align-items-center justify-content-center" style="height: 200px;">
                                            <span class="text-muted">No image available</span>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="position-absolute top-0 end-0 m-2">
                                        <span class="badge" style="background: linear-gradient(135deg, #7B4CFF 0%, #4C2EAA 100%);">
                                            <?= $item['rating'] ? number_format($item['rating'], 1) . ' ⭐' : 'N/A' ?>
                                        </span>
                                    </div>
                                    
                                    <div class="card-body">
                                        <h5 class="card-title"><?= esc($item['product_name']) ?></h5>
                                        <?php if (isset($item['description'])): ?>
                                            <p class="card-text"><?= esc($item['description']) ?></p>
                                        <?php endif; ?>
                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                            <span class="price">₱<?= number_format($item['price'], 2) ?></span>
                                            <?php if (session()->get('user_id')): ?>
                                                <button class="add-to-cart-btn" onclick="addToCart(this, <?= $item['id'] ?>)">
                                                    Add to Cart
                                                </button>
                                            <?php else: ?>
                                                <a href="<?= site_url('auth/login') ?>" class="add-to-cart-btn">
                                                    Login to Add
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endforeach; ?>
    </main>
        </div>
</div>

<!-- Cart Sidebar -->
<div class="cart-sidebar" id="cartSidebar">
    <div class="cart-header">
        <button class="close-btn" onclick="toggleCart()">
            ← Continue shopping
        </button>
        <h2>Your Order</h2>
    </div>

    <div class="cart-content">
        <?php if (!empty($cart)): ?>
            <ul class="list-unstyled">
                <?php foreach ($cart as $item): ?>
                    <li class="cart-item">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="mb-0"><?= esc($item['product_name']) ?></h6>
                                <div class="quantity-controls">
                                    <button onclick="updateQuantity(<?= array_search($item, $cart) ?>, 'decrease')" class="btn btn-sm btn-outline-secondary">-</button>
                                    <span class="mx-2"><?= esc($item['quantity']) ?></span>
                                    <button onclick="updateQuantity(<?= array_search($item, $cart) ?>, 'increase')" class="btn btn-sm btn-outline-secondary">+</button>
                                </div>
                            </div>
                            <div class="text-end">
                                <div class="price">₱<?= number_format($item['price'] * $item['quantity'], 2) ?></div>
                                <a href="<?= site_url('menu/removeItem/' . array_search($item, $cart)) ?>" class="text-danger small">Remove</a>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>

            <div class="cart-footer">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Total:</h5>
                    <h5 class="mb-0">₱<?= number_format(array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart)), 2) ?></h5>
                </div>
                <div class="d-grid gap-2">
                    <a href="<?= site_url('menu/viewing_cart') ?>" class="btn btn-primary">
                        View Cart
                    </a>
                    <button onclick="clearCart()" class="btn btn-outline-danger">
                        Clear Cart
                    </button>
                </div>
            </div>
        <?php else: ?>
            <p class="text-center text-muted my-5">Your cart is empty</p>
        <?php endif; ?>
    </div>
</div>

<!-- Footer -->
<footer id="footer" class="footer-section">
    <div class="container">
        <!-- Footer Main Content -->
        <div class="row g-4 pb-4">
            <!-- Brand Section -->
            <div class="col-lg-4 col-md-6">
                <div class="footer-brand">
                    <a href="#" class="footer-logo d-flex align-items-center gap-3 mb-3">
                        <img src="<?= base_url('images/logo.png') ?>" alt="Brewverse Logo" height="40">
                        <span class="gradient-text">Brewverse</span>
                    </a>
                    <p class="footer-about">Explore the cosmic confluence of coffee and space at Brewverse. Where every cup tells a story written in the stars.</p>
                    <div class="social-links mt-4">
                        <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6">
                <h5 class="footer-title">Navigation</h5>
                <ul class="footer-links">
                    <li><a href="<?= site_url('/') ?>#home">Home</a></li>
                    <li><a href="<?= site_url('menu') ?>">Menu</a></li>
                    <li><a href="<?= site_url('/') ?>#about">About Us</a></li>
                    <li><a href="<?= site_url('/') ?>#reviews">Reviews</a></li>
                    <?php if (session()->get('is_admin') == 1): ?>
                        <li><a href="<?= site_url('admin/users') ?>">Manage Users</a></li>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="col-lg-3 col-md-6">
                <h5 class="footer-title">Contact Us</h5>
                <ul class="footer-contact">
                    <li>
                        <i class="fas fa-phone-alt"></i>
                        <span>+63 912 345 6789</span>
                    </li>
                    <li>
                        <i class="fas fa-envelope"></i>
                        <span>contact@brewverse.com</span>
                    </li>
                    <li>
                        <i class="fas fa-map-marker-alt"></i>
                        <span>123 Cosmic Avenue, Metro Bulihan, Philippines</span>
                    </li>
                </ul>
            </div>

            <!-- Opening Hours -->
            <div class="col-lg-3 col-md-6">
                <h5 class="footer-title">Opening Hours</h5>
                <ul class="footer-hours">
                    <li>
                        <span>Monday - Friday</span>
                        <span>7:00 AM - 11:00 PM</span>
                    </li>
                    <li>
                        <span>Saturday - Sunday</span>
                        <span>8:00 AM - 12:00 AM</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="copyright mb-0">
                        © 2024 Brewverse. All rights reserved | Crafted with <i class="fas fa-heart text-danger"></i> in the cosmos
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="footer-bottom-links">
                        <a href="#">Privacy Policy</a>
                        <a href="#">Terms of Service</a>
                        <a href="#">Cookie Settings</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Profile Modal -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileModalLabel">
                    <i class="fas fa-user-astronaut"></i>
                    Cosmic Profile
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="profileForm" action="<?= site_url('user/updateProfile') ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    
                    <!-- Profile Picture Section -->
                    <div class="text-center">
                        <div class="profile-picture-container">
                            <img id="profileImage" 
                                 src="<?= session()->has('profile_picture') && !empty(session('profile_picture')) 
                                        ? 'data:image/jpeg;base64,' . base64_encode(session('profile_picture'))
                                        : base_url('assets/images/default-avatar.png') ?>" 
                                 alt="Profile Picture">
                            <button type="button" class="camera-button" onclick="document.getElementById('profilePictureInput').click()">
                                <i class="fas fa-camera"></i>
                            </button>
                        </div>
                        <input type="file" id="profilePictureInput" name="profile_picture" accept="image/*" style="display: none;" onchange="previewImage(this)">
                        <p class="text-muted small mt-2" style="color: #E0E0E0 !important;">Click the camera icon to update your profile picture</p>
                    </div>

                    <!-- Form Fields -->
                    <div class="form-group">
                        <label class="form-label" for="username">Username</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-user-astronaut"></i>
                            </span>
                            <input type="text" class="form-control" id="username" name="username" 
                                   value="<?= esc(session('username')) ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="email">Email</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input type="email" class="form-control" id="email" name="email" 
                                   value="<?= esc(session('email')) ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group mb-0">
                        <label class="form-label" for="address">Address</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-location-dot"></i>
                            </span>
                            <textarea class="form-control" id="address" name="address" rows="3" 
                                      placeholder="Enter your address"><?= esc(session('address')) ?></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Cancel
                </button>
                <button type="submit" form="profileForm" class="btn btn-save">
                    <i class="fas fa-save me-2"></i>Save Changes
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function toggleCart() {
        const cartSidebar = document.getElementById('cartSidebar');
        const cartIconContainer = document.getElementById('cartIconContainer');
        cartSidebar.classList.toggle('active');
        cartIconContainer.style.display = cartSidebar.classList.contains('active') ? 'none' : 'block';
    }

    function showMessage(message, isError = false) {
        // Create toast container if it doesn't exist
        let container = document.querySelector('.cosmic-toast-container');
        if (!container) {
            container = document.createElement('div');
            container.className = 'cosmic-toast-container';
            document.body.appendChild(container);
        }

        // Create toast element
        const toast = document.createElement('div');
        toast.className = `cosmic-toast ${isError ? 'error' : 'success'}`;
        
        // Set toast content
        toast.innerHTML = `
            <div class="cosmic-toast-header">
                <h6 class="cosmic-toast-title">
                    <i class="cosmic-toast-icon fas ${isError ? 'fa-meteor' : 'fa-rocket'}"></i>
                    ${isError ? 'Mission Failed' : 'Mission Success'}
                </h6>
                <button type="button" class="cosmic-toast-close" onclick="this.parentElement.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="cosmic-toast-body">
            ${message}
            </div>
        `;
        
        // Add toast to container
        container.appendChild(toast);

        // Trigger animation
        setTimeout(() => toast.classList.add('show'), 10);

        // Remove toast after delay
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }

    function updateCartDisplay(cartData) {
        const cartContent = document.querySelector('.cart-content');
        if (!cartContent) return;

        let cartHtml = '';

        if (Object.keys(cartData).length === 0) {
            cartHtml = '<p class="text-center text-muted my-5">Your cart is empty</p>';
        } else {
            cartHtml = `
                <ul class="list-unstyled">
                    ${Object.entries(cartData).map(([id, item]) => `
                        <li class="cart-item">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="mb-0">${item.product_name}</h6>
                                    <div class="quantity-controls">
                                        <button onclick="updateQuantity(${id}, 'decrease')" class="btn btn-sm btn-outline-secondary">-</button>
                                        <span class="mx-2">${item.quantity}</span>
                                        <button onclick="updateQuantity(${id}, 'increase')" class="btn btn-sm btn-outline-secondary">+</button>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <div class="price">₱${(item.price * item.quantity).toFixed(2)}</div>
                                    <a href="<?= site_url('menu/removeItem/') ?>${id}" class="text-danger small">Remove</a>
                                </div>
                            </div>
                        </li>
                    `).join('')}
                </ul>
                <div class="cart-footer">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Total:</h5>
                        <h5 class="mb-0">₱${Object.values(cartData)
                            .reduce((total, item) => total + (item.price * item.quantity), 0)
                            .toFixed(2)}</h5>
                    </div>
                    <div class="d-grid gap-2">
                        <a href="<?= site_url('menu/viewing_cart') ?>" class="btn btn-primary">
                            View Cart
                        </a>
                        <button onclick="clearCart()" class="btn btn-outline-danger">
                            Clear Cart
                        </button>
                    </div>
                </div>
            `;
        }

        cartContent.innerHTML = cartHtml;
    }

    function addToCart(button, productId) {
        button.disabled = true;
        
        fetch(`<?= site_url('menu/addToCart/') ?>${productId}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (!response.ok) {
                if (response.status === 401) {
                    window.location.href = '<?= site_url('auth/login') ?>';
                    throw new Error('Please login to add items to cart.');
                }
                throw new Error('Failed to add item to cart.');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                showMessage(data.message);
                if (data.cart) {
                    updateCartDisplay(data.cart);
                    
                    // Add animation to cart icon
                    const cartIcon = document.querySelector('.cart-icon');
                    cartIcon.style.transform = 'scale(1.2)';
                    setTimeout(() => {
                        cartIcon.style.transform = 'scale(1)';
                    }, 200);
                }
            } else {
                throw new Error(data.message || 'Error adding to cart');
            }
        })
        .catch(error => {
            showMessage(error.message, true);
        })
        .finally(() => {
            button.disabled = false;
        });
    }

    function clearCart() {
        if (confirm('Are you sure you want to clear your cart?')) {
            window.location.href = '<?= site_url('menu/clearCart') ?>';
        }
    }

    function updateQuantity(productId, action) {
        const endpoint = action === 'increase' 
            ? '<?= site_url('menu/increaseQuantity/') ?>' 
            : '<?= site_url('menu/decreaseQuantity/') ?>';
        
        fetch(`${endpoint}${productId}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (!response.ok) {
                if (response.status === 401) {
                    window.location.href = '<?= site_url('auth/login') ?>';
                    throw new Error('Please login to manage your cart.');
                }
                throw new Error('Failed to update quantity.');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                if (data.cart) {
                    updateCartDisplay(data.cart);
                }
            } else {
                throw new Error(data.message || 'Error updating quantity');
            }
        })
        .catch(error => {
            showMessage(error.message, true);
        });
    }

    // Add smooth scrolling for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Initialize any Bootstrap tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Add scroll event listener for navbar
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) {
            navbar.style.background = 'rgba(13, 17, 23, 0.98) !important';
            navbar.style.boxShadow = '0 2px 10px rgba(0,0,0,0.3)';
        } else {
            navbar.style.background = 'rgba(13, 17, 23, 0.95) !important';
            navbar.style.boxShadow = 'none';
        }
    });

    // Initialize all dropdowns
    document.addEventListener('DOMContentLoaded', function() {
        var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
        var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
            return new bootstrap.Dropdown(dropdownToggleEl);
        });
    });

    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profileImage').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Show confirmation before saving
    document.getElementById('profileForm').addEventListener('submit', function(e) {
        if (!confirm('Are you sure you want to save these changes?')) {
            e.preventDefault();
        }
    });

 
document.addEventListener("DOMContentLoaded", function () {
    const toggleBtn = document.getElementById('themeToggle');
    const icon = document.getElementById('themeIcon');
    const body = document.body;

    // Check cookie for saved theme preference
    if (document.cookie.includes('theme=light')) {
        body.classList.add('light-mode');
        icon.classList.remove('fa-moon');
        icon.classList.add('fa-sun');
    }

    toggleBtn.addEventListener('click', function () {
        body.classList.toggle('light-mode');

        const isLight = body.classList.contains('light-mode');
        icon.classList.toggle('fa-sun', isLight);
        icon.classList.toggle('fa-moon', !isLight);

        // Save preference in cookie (valid for 30 days)
        document.cookie = `theme=${isLight ? 'light' : 'dark'}; path=/; max-age=${60 * 60 * 24 * 30}`;
    });
});


</script>

</body>
</html>
