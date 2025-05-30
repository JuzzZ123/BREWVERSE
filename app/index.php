<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Caffeine Coffee Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
   body {
    font-family: 'Space Grotesk', sans-serif;  /* Modern space-themed font */
    color: #E0E0E0;
    background-color: #0A0F1C;
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




  /* Navbar Styling */
  .navbar {
    background: rgba(13, 17, 23, 0.95) !important;
    backdrop-filter: blur(10px);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    padding: 1rem 2rem;
    transition: all 0.3s ease;
  }

  .navbar-brand {
    font-size: 1.5rem;
    font-weight: 700;
    color: #7B4CFF !important;  /* Purple accent color */
    display: flex;
    align-items: center;
    gap: 0.8rem;
  }

  .navbar-logo {
    height: 35px;  /* Adjust this value to match your desired logo size */
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

  /* Profile Button Styling */
  .profile-button {
    background: linear-gradient(135deg, #7B4CFF 0%, #4C2EAA 100%);
    border: none;
    border-radius: 50px;
    padding: 0.5rem 1.5rem;
    color: white;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
  }

  .profile-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(123, 76, 255, 0.3);
  }

  /* Profile Image Container */
  .profile-image-container {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    overflow: hidden;
    border: 2px solid #7B4CFF;
  }

  /* Dropdown Menu Styling */
  .dropdown-menu {
    background: rgba(13, 17, 23, 0.95);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 12px;
    margin-top: 1rem;
  }

  .dropdown-item {
    color: #E0E0E0;
    transition: all 0.3s ease;
    padding: 0.75rem 1.5rem;
  }

  .dropdown-item:hover {
    background: rgba(123, 76, 255, 0.1);
    color: #7B4CFF;
  }

  .dropdown-divider {
    border-color: rgba(255, 255, 255, 0.1);
  }

  /* Responsive Adjustments */
  @media (max-width: 991px) {
    .navbar-collapse {
      background: rgba(13, 17, 23, 0.98);
      padding: 1rem;
      border-radius: 12px;
      margin-top: 1rem;
    }

    .nav-link::after {
      display: none;
    }

    .nav-link:hover {
      background: rgba(123, 76, 255, 0.1);
      border-radius: 8px;
    }
  }

.hero {
  position: relative;
    min-height: 100vh;
    height: 100vh;
    margin-top: -10px;
    padding-top: 76px;
  color: #fff;
  overflow: hidden;
    display: flex;
    align-items: center;
    box-sizing: border-box;
  }

  .hero-background {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
    object-fit: cover;
  z-index: -1;
}

  .hero-content {
    position: relative;
    z-index: 1;
    width: 100%;
    padding: 0 5%;
    margin-top: -10px;
  }

  .hero-text {
    text-align: left;
    max-width: 600px;
    padding: 2rem;
    background-color: transparent;
  }

    .hero h1 {
    font-size: 3.5rem;
      font-weight: bold;
    font-family: 'Orbitron', sans-serif;
    margin-bottom: 1rem;
    background: linear-gradient(135deg, #fff 0%, #7B4CFF 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    }

    .hero p {
    font-size: 1.2rem;
      margin: 20px 0;
    font-family: 'Space Grotesk', sans-serif;
    color: rgba(255, 255, 255, 0.9);
    }

  .video-overlay {
    display: none; /* Hide the overlay completely */
  }

    .center{
        text-align: center;
       margin-top: 130px;
    }

    .btn-outline-light {
      text-align: center;
      border-color: #fff;
      color: #fff;
    }

    .btn-outline-light:hover {
      background-color: #fff;
      color: #000;
    }

    .coffee-img {
      max-width: 100%;
      height: auto;
    }

    .stats {
      margin-top: 50px;
      font-size: 1.2rem;
      font-weight: 600;
    }

    .stat-box {
      text-align: center;
    }

    .stat-box span {
      font-size: 1.5rem;
      display: block;
      font-weight: bold;
    }


.section-title {
  font-family: 'Poppins', sans-serif;
  font-size: 2.5rem;
  font-weight: bold;
  color: #3c2a21;
}
h5{
   color: #3c2a21; 
}

.filter-tabs {
  margin-top: 10px;
}

.filter-tabs .tab {
  background: none;
  border: none;
  font-size: 1.1rem;
  margin: 0 10px;
  cursor: pointer;
  color: #555;
  position: relative;
}

.filter-tabs .tab.active::after {
  content: "";
  display: block;
  height: 2px;
  background-color: #000;
  width: 100%;
  position: absolute;
  bottom: -5px;
  left: 0;
}

.product-card {
  background-color: #f3dbb7;
  border: 2px solid #000;
  text-align: center;
  padding: 20px;
  width: 800px;
  gap: 10rem;
}

.product-card img {
  height: 250px;
  object-fit: cover;
  border: 4px solid #2a1d1d;
  margin-bottom: 10px;
}

.product-card h5 {
  font-family: 'Poppins', sans-serif;
  font-size: 1.5rem;
  font-weight: 700;
  margin-bottom: 10px;
}

.order-btn {
  background-color: transparent;
  border: 1px solid #000;
  padding: 8px 16px;
  font-weight: 500;
  cursor: pointer;
}

.order-btn:hover {
  background-color: #000;
  color: #fff;
}

.arrow-btn {
  background: none;
  border: 2px solid #000;
  font-size: 1.5rem;
  width: 40px;
  height: 40px;
  cursor: pointer;
}
.scroll-container {
  display: flex;
  justify-content: center; 
  gap: 5rem; 
   padding: 3rem;
   white-space: nowrap;
  overflow-x: auto;
  scroll-behavior: smooth;
}

.product-card {
   display: inline-block;
  width: 250px;
  background-color: #f3dbb7;
  border: 2px solid #000;
  text-align: center;
  padding: 20px;
  border-radius: 10px;
  gap: 10rem;
  margin-top: 30px;
}

.scroll-container::-webkit-scrollbar {
  height: 8px;
}

.scroll-container::-webkit-scrollbar-thumb {
  background-color: #888;
  border-radius: 10px;
}

.scroll-container::-webkit-scrollbar-track {
  background-color: #e0c9a6;
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

  /* Help Text */
  .text-muted {
    color: #a8b2d1 !important;
  }

  /* Read-only Input */
  .form-control[readonly] {
    background: rgba(255, 255, 255, 0.02);
    color: #a8b2d1;
    border-color: rgba(255, 255, 255, 0.05);
  }

  /* Small helper text */
  .small {
    color: #a8b2d1;
  }

  /* Footer Styles */


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

  /* Best Selling Section Styles */


  /* Cosmic Title */
  .cosmic-title {
    font-family: 'Orbitron', sans-serif;
    color: #fff;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 2rem;
    text-transform: uppercase;
    letter-spacing: 2px;
    background: linear-gradient(135deg, #fff 0%, #7B4CFF 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  /* Filter Tabs */
  .cosmic-tab {
    background: rgba(123, 76, 255, 0.1);
    border: 1px solid rgba(123, 76, 255, 0.3);
    color: #fff;
    padding: 0.75rem 1.5rem;
    border-radius: 50px;
    font-family: 'Space Grotesk', sans-serif;
    font-weight: 500;
    transition: all 0.3s ease;
    cursor: pointer;
  }

  .cosmic-tab:hover, .cosmic-tab.active {
    background: linear-gradient(135deg, #7B4CFF 0%, #4C2EAA 100%);
    border-color: transparent;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(123, 76, 255, 0.3);
  }

  /* Product Container */
  .product-container {
    display: flex;
    gap: 2rem;
    overflow-x: auto;
    padding: 2rem 0;
    scroll-behavior: smooth;
    -ms-overflow-style: none;
    scrollbar-width: none;
  }

  .product-container::-webkit-scrollbar {
    display: none;
  }

  /* Cosmic Card */
  .cosmic-card {
    flex: 0 0 auto;
    width: 300px;
    perspective: 1000px;
  }

  .cosmic-card-inner {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(123, 76, 255, 0.2);
    border-radius: 24px;
    padding: 1.5rem;
    transition: all 0.3s ease;
    transform-style: preserve-3d;
  }

  .cosmic-card:hover .cosmic-card-inner {
    transform: translateY(-10px) rotateY(10deg);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    border-color: rgba(123, 76, 255, 0.4);
  }

  .cosmic-img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 16px;
    margin-bottom: 1rem;
    border: 2px solid rgba(123, 76, 255, 0.3);
  }

  /* Rating Stars */
  .cosmic-rating {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    margin: 1rem 0;
  }

  .stars {
    color: #7B4CFF;
    letter-spacing: 2px;
  }

  .rating-text {
    color: #fff;
    font-weight: 500;
  }

  /* Price */
  .cosmic-price {
    color: #7B4CFF;
    font-size: 1.2rem;
    font-weight: 700;
    margin: 0.5rem 0;
  }

  /* Navigation Buttons */
  .cosmic-nav-btn {
    background: rgba(123, 76, 255, 0.1);
    border: 1px solid rgba(123, 76, 255, 0.3);
    color: #fff;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
  }

  .cosmic-nav-btn:hover {
    background: linear-gradient(135deg, #7B4CFF 0%, #4C2EAA 100%);
    transform: scale(1.1);
    box-shadow: 0 4px 15px rgba(123, 76, 255, 0.3);
  }

  /* Cosmic Button */
  .cosmic-btn {
    background: linear-gradient(135deg, #7B4CFF 0%, #4C2EAA 100%);
    color: #fff;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 50px;
    font-family: 'Space Grotesk', sans-serif;
    font-weight: 500;
    width: 100%;
    transition: all 0.3s ease;
    cursor: pointer;
  }

  .cosmic-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(123, 76, 255, 0.3);
  }



  .cosmic-about::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
      radial-gradient(circle at 20% 20%, rgba(123, 76, 255, 0.1) 0%, transparent 25%),
      radial-gradient(circle at 80% 80%, rgba(123, 76, 255, 0.1) 0%, transparent 25%);
    pointer-events: none;
  }

  .cosmic-carousel {
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 0 30px rgba(123, 76, 255, 0.2);
  }

  .cosmic-image-container {
    position: relative;
    border-radius: 24px;
    overflow: hidden;
    border: 2px solid rgba(123, 76, 255, 0.3);
  }

  .cosmic-image-container img {
    border-radius: 24px;
    transition: transform 0.5s ease;
  }

  .cosmic-image-container:hover img {
    transform: scale(1.05);
  }

  .cosmic-control {
    width: 50px;
    height: 50px;
    background: rgba(123, 76, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    transition: all 0.3s ease;
  }

  .cosmic-control:hover {
    background: rgba(123, 76, 255, 0.4);
    transform: scale(1.1);
  }

  .cosmic-content {
    padding: 2rem;
    background: rgba(255, 255, 255, 0.02);
    border-radius: 24px;
    border: 1px solid rgba(123, 76, 255, 0.2);
    backdrop-filter: blur(10px);
  }

  .cosmic-title {
    font-family: 'Orbitron', sans-serif;
    margin-bottom: 1.5rem;
  }

  .cosmic-title .subtitle {
    display: block;
    font-size: 1.2rem;
    color: #7B4CFF;
    margin-top: 0.5rem;
  }

  .cosmic-description {
    color: #E0E0E0;
    font-family: 'Space Grotesk', sans-serif;
    line-height: 1.8;
  }

  .cosmic-description p {
    margin-bottom: 1.5rem;
  }



  .cosmic-reviews::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
      radial-gradient(circle at 30% 30%, rgba(123, 76, 255, 0.1) 0%, transparent 30%),
      radial-gradient(circle at 70% 70%, rgba(123, 76, 255, 0.1) 0%, transparent 30%);
    pointer-events: none;
  }

  .cosmic-review-card {
    background: rgba(255, 255, 255, 0.02);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(123, 76, 255, 0.2);
    border-radius: 24px;
    padding: 2rem;
    position: relative;
    transition: all 0.3s ease;
    height: 100%;
  }

  .cosmic-review-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    border-color: rgba(123, 76, 255, 0.4);
  }

  .quote-icon {
    position: absolute;
    top: -15px;
    left: 20px;
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #7B4CFF 0%, #4C2EAA 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
  }

  .review-content {
    position: relative;
    z-index: 1;
  }

  .review-text {
    color: #E0E0E0;
    font-size: 1.1rem;
    line-height: 1.8;
    margin-bottom: 1.5rem;
    font-family: 'Space Grotesk', sans-serif;
  }

  .cosmic-stars {
    color: #7B4CFF;
    margin-bottom: 1rem;
  }

  .cosmic-stars i {
    margin-right: 5px;
  }

  .reviewer {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-top: 1.5rem;
  }

  .reviewer-avatar {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #7B4CFF 0%, #4C2EAA 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
  }

  .reviewer-name {
    color: #E0E0E0;
    margin: 0;
    font-family: 'Space Grotesk', sans-serif;
    font-weight: 600;
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
                    <a class="nav-link" href="<?= site_url('menu') ?>">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#reviews">Reviews</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#footer">Contact</a>
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
                                <div class="d-flex align-items-center justify-content-center h-100"
                                     style="background: #4C2EAA; color: white; font-weight: bold;">
                    <?= strtoupper(substr(esc(session('username')), 0, 1)) ?>
                </div>
            <?php endif; ?>
                        </div>
            <span><?= esc(session('username')) ?></span>
        </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#profileModal">
                            <i class="fas fa-user-circle me-2"></i>View Profile
                        </a></li>
                        <li><a class="dropdown-item" href="<?= site_url('user/orders') ?>">
                            <i class="fas fa-shopping-bag me-2"></i>View Orders
                        </a></li>
                        <?php if (session()->get('is_admin') == 1): ?>
                        <li><a class="dropdown-item" href="<?= site_url('admin/users') ?>">
                            <i class="fas fa-users-cog me-2"></i>Manage Users
                        </a></li>
                        <?php endif; ?>
            <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?= site_url('auth/logout') ?>">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </a></li>
        </ul>
    </li>
<?php else: ?>
                <li class="nav-item ms-3">
                    <a class="profile-button" href="<?= site_url('auth/login') ?>">
                        <i class="fas fa-sign-in-alt"></i>
                        Sign In
                    </a>
    </li>
<?php endif; ?>
        </ul>
        </div>
    </div>
</nav>

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

<!-- Hero Section -->
<div class="hero">
  <video autoplay muted loop id="heroVideo" class="hero-background">
    <source src="<?= base_url('images/bg.mp4') ?>" type="video/mp4">
    Your browser does not support the video tag.
  </video>
  <div class="hero-content">
    <div class="hero-text">
      <h1>Cosmic Brews Await</h1>
      <p style="color: white !important;">
  Where every cup is a journey through the galaxies. Our artisanal coffee beans are carefully selected from stellar farms and roasted to astronomical perfection. Launch your day with flavors that are out of this world!
</p>

      <a href="<?= site_url('menu') ?>" class="btn btn-outline-light btn-lg">Begin Your Journey</a>
</div>
      </div>
    </div>
   
  <!-- Best selling section -->
<section class="best-selling py-5" id="menu">
  <div class="text-center mb-4">
    <h2 class="section-title cosmic-title">Stellar Best Sellers</h2>
    <div class="filter-tabs mb-3 d-flex justify-content-center gap-2 flex-wrap">
      <button class="cosmic-tab active" data-filter="all">All Brews</button>
      <button class="cosmic-tab" data-filter="black">Black Hole</button>
      <button class="cosmic-tab" data-filter="espresso">Nebula</button>
      <button class="cosmic-tab" data-filter="doppio">Galaxy</button>
    </div>
  </div>

  <div class="d-flex justify-content-center align-items-center gap-3">
    <button class="cosmic-nav-btn" id="prevFilter">
      <i class="fas fa-chevron-left"></i>
    </button>

    <div id="productScroll" class="product-container">
      <!-- Product Cards -->
      <div class="cosmic-card" data-category="black">
        <div class="cosmic-card-inner">
          <img src="<?= base_url('images/capucinno.jpg') ?>" class="cosmic-img" alt="Cappuccino">
          <div class="cosmic-rating">
            <span class="stars">★★★★★</span>
            <span class="rating-text">4.8</span>
</div>
          <h5 class="cosmic-title">Cappuccino Nova</h5>
          <p class="cosmic-price">Php 90</p>
          <button class="cosmic-btn">Begin Journey</button>
        </div>
      </div>

      <div class="cosmic-card" data-category="espresso">
        <div class="cosmic-card-inner">
          <img src="<?= base_url('images/americano.jpg') ?>" class="cosmic-img" alt="Americano">
          <div class="cosmic-rating">
            <span class="stars">★★★★★</span>
            <span class="rating-text">4.9</span>
</div>
          <h5 class="cosmic-title">Nebula Americano</h5>
          <p class="cosmic-price">Php 90</p>
          <button class="cosmic-btn">Begin Journey</button>
        </div>
      </div>

      <div class="cosmic-card" data-category="doppio">
        <div class="cosmic-card-inner">
          <img src="<?= base_url('images/latte.jpg') ?>" class="cosmic-img" alt="Latte">
          <div class="cosmic-rating">
            <span class="stars">★★★★★</span>
            <span class="rating-text">5.0</span>
</div>
          <h5 class="cosmic-title">Galaxy Latte</h5>
          <p class="cosmic-price">Php 90</p>
          <button class="cosmic-btn">Begin Journey</button>
      </div>  
    </div>
    </div>

    <button class="cosmic-nav-btn" id="nextFilter">
      <i class="fas fa-chevron-right"></i>
    </button>
  </div>
</section>

  <!-- About Us Section-->
<section class="cosmic-about py-5" id="about">
  <div class="container">
    <div class="row align-items-center">
      <!-- Carousel for Images -->
      <div class="col-md-6 d-flex justify-content-center align-items-center">
        <div id="aboutCarousel" class="carousel slide cosmic-carousel" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="cosmic-image-container">
                <img src="<?= base_url('images/about.jpg') ?>" class="d-block w-100" alt="Coffee Shop 1">
              </div>
            </div>
            <div class="carousel-item">
              <div class="cosmic-image-container">
                <img src="<?= base_url('images/about1.jpg') ?>" class="d-block w-100" alt="Coffee Shop 2">
              </div>
            </div>
            <div class="carousel-item">
              <div class="cosmic-image-container">
                <img src="<?= base_url('images/about2.jpg') ?>" class="d-block w-100" alt="Coffee Shop 3">
            </div>
          </div>
          </div>
          <button class="carousel-control-prev cosmic-control" type="button" data-bs-target="#aboutCarousel" data-bs-slide="prev">
            <i class="fas fa-chevron-left"></i>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next cosmic-control" type="button" data-bs-target="#aboutCarousel" data-bs-slide="next">
            <i class="fas fa-chevron-right"></i>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>

      <!-- About Us Text -->
      <div class="col-md-6 mt-4 mt-md-0">
        <div class="cosmic-content">
          <h1 class="cosmic-title mb-4">
            <span class="gradient-text">Brewverse</span>
            <span class="subtitle">Where Coffee Meets Cosmos</span>
          </h1>
          <div class="cosmic-description">
            <p>Welcome to Brewverse, where every cup tells a story written in the stars. Our cosmic café transcends the ordinary, creating an interstellar experience for coffee enthusiasts and space dreamers alike.</p>
            <p>From our nebula-inspired brewing techniques to our constellation of flavors, we've crafted a unique space where coffee culture meets astronomical wonder.</p>
      </div>
          <a href="#menu" class="cosmic-btn mt-4">Explore Our Stellar Menu</a>
        </div>
      </div>
    </div>
  </div>
</section>

   <!-- Review Section -->
<section class="cosmic-reviews py-5" id="reviews">
  <div class="container">
    <h2 class="text-center cosmic-title mb-5">Stellar Reviews</h2>

    <div class="row justify-content-center">
      <!-- Review Card -->
      <div class="col-md-4 mb-4">
        <div class="cosmic-review-card">
          <div class="quote-icon">
            <i class="fas fa-quote-right"></i>
          </div>
          <div class="review-content">
            <p class="review-text">The coffee here transcends earthly expectations. Each sip feels like a journey through the cosmos!</p>
            <div class="cosmic-stars">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <div class="reviewer">
              <div class="reviewer-avatar">
                <i class="fas fa-user-astronaut"></i>
              </div>
              <h6 class="reviewer-name">Anna D.</h6>
            </div>
          </div>
        </div>
      </div>

      <!-- Review Card -->
      <div class="col-md-4 mb-4">
        <div class="cosmic-review-card">
          <div class="quote-icon">
            <i class="fas fa-quote-right"></i>
          </div>
          <div class="review-content">
            <p class="review-text">The ambiance is out of this world! Perfect blend of cozy and cosmic. A truly unique experience.</p>
            <div class="cosmic-stars">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <div class="reviewer">
              <div class="reviewer-avatar">
                <i class="fas fa-user-astronaut"></i>
              </div>
              <h6 class="reviewer-name">Mark T.</h6>
            </div>
          </div>
        </div>
      </div>

      <!-- Review Card -->
      <div class="col-md-4 mb-4">
        <div class="cosmic-review-card">
          <div class="quote-icon">
            <i class="fas fa-quote-right"></i>
          </div>
          <div class="review-content">
            <p class="review-text">Their Galaxy Latte is a masterpiece! The baristas here are like cosmic artists crafting perfection.</p>
            <div class="cosmic-stars">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
        </div>
            <div class="reviewer">
              <div class="reviewer-avatar">
                <i class="fas fa-user-astronaut"></i>
              </div>
              <h6 class="reviewer-name">Carla M.</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<footer id="footer" class="footer-section">
    <div class="stars"></div> <!-- For animated stars background -->
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
                    <li><a href="#home">Home</a></li>
                    <li><a href="#menu">Menu</a></li>
                    <li><a href="#about">About Us</a></li>
                    <li><a href="#reviews">Reviews</a></li>
                    <?php if (session()->get('is_admin') == 1): ?>
                        <li><a class="dropdown-item" href="<?= site_url('admin/users') ?>">
                            <i class=""></i>Manage Users
                        </a></li>
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

<!-- Success Modal -->
<div class="modal fade" id="loginSuccessModal" tabindex="-1" aria-labelledby="loginSuccessModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center">
            <div class="modal-header border-0">
                <h5 class="modal-title w-100" id="loginSuccessModalLabel">Login Successful</h5>
            </div>
            <div class="modal-body">
                <div class="spinner-border text-primary mb-3" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p>Redirecting to dashboard...</p>
            </div>
        </div>
    </div>
</div>

<?php if(session()->getFlashdata('login_success')): ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var successModal = new bootstrap.Modal(document.getElementById('loginSuccessModal'));
        successModal.show();

        // Redirect after 2 seconds
        setTimeout(function () {
            window.location.href = "<?= base_url('/admin/users') ?>";
        }, 2000);
    });
</script>
<?php endif; ?>

<?php if(session()->getFlashdata('error')): ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var toastEl = document.getElementById('loginToast');
        var toast = new bootstrap.Toast(toastEl);
        toast.show();
    });
</script>
<?php endif; ?>
<script>
   document.addEventListener("DOMContentLoaded", function () {
  const tabs = document.querySelectorAll(".cosmic-tab");
  const productCards = document.querySelectorAll(".cosmic-card");
  const productContainer = document.getElementById("productScroll");
    let currentTabIndex = 0;

    function activateTab(index) {
      // Update active tab visually
      tabs.forEach((tab, i) => {
        tab.classList.toggle("active", i === index);
      });

      // Get the category to filter
      const filter = tabs[index].getAttribute("data-filter");

      // Show/hide product cards based on category
      productCards.forEach(card => {
        const category = card.getAttribute("data-category");
      if (filter === "all" || filter === category) {
        card.style.display = "block";
        card.style.opacity = "1";
        card.style.transform = "scale(1)";
      } else {
        card.style.display = "none";
        card.style.opacity = "0";
        card.style.transform = "scale(0.8)";
      }
    });

      currentTabIndex = index;
    }

    // Initial activation
    activateTab(currentTabIndex);

    // Tab click event
    tabs.forEach((tab, index) => {
      tab.addEventListener("click", () => {
        activateTab(index);
      });
    });

  // Smooth scrolling navigation
    document.getElementById("nextFilter").addEventListener("click", () => {
    productContainer.scrollBy({
      left: 300,
      behavior: "smooth"
    });
    });

    document.getElementById("prevFilter").addEventListener("click", () => {
    productContainer.scrollBy({
      left: -300,
      behavior: "smooth"
    });
  });

  // Add hover effect to cards
  productCards.forEach(card => {
    card.addEventListener("mouseenter", () => {
      card.style.transform = "translateY(-10px)";
    });

    card.addEventListener("mouseleave", () => {
      card.style.transform = "translateY(0)";
    });
    });
  });
</script>

<script>
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
</script>

<script>
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



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>