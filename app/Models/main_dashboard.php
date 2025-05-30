<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Caffeine Coffee Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
  <style>
   body {
  font-family: 'Poppins', sans-serif;
    color: white;
   }
  .nav-link{
  color: whitesmoke;

}
.hero {
  position: relative;
  min-height: 94vh;
  color: #fff;
  overflow: hidden;
}

.bg-video {
  position: absolute;
  top: 50%;
  left: 50%;
  min-width: 100%;
  min-height: 95%;
  width: auto;
  height: auto;
  transform: translate(-50%, -50%);
  object-fit: cover;
  z-index: -2;
}

.video-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.4); 
  z-index: -1;
}

    .hero h1 {
      font-size: 3rem;
      font-weight: bold;
    }

    .hero p {
      font-size: 1.1rem;
      margin: 20px 0;
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
    .best-selling {
  background-color: #d5aa7b;
  padding: 50px 20px;
  max-width: 950vh;
  min-height: 100vh;
  gap: 5rem;
  
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

#about{
  background-color: #3c2a21;
  min-height: 100vh;
  text-align: center;
  
}
#reviews {
  background-color:rgb(155, 110, 61);
}

  </style>
</head>
<body>

<!-- Navbar -->
<!-- Updated Navigation Bar with Profile Modal -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
    <a class="navbar-brand" href="#">
        <i class="fas fa-mug-hot" style="color: brown;"></i>
        Cozy Brew Café
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="#menu">Menu</a></li>
            <li class="nav-item"><a class="nav-link" href="#about">About Us</a></li>
            <li class="nav-item"><a class="nav-link" href="#reviews">Reviews</a></li>
            <li class="nav-item"><a class="nav-link" href="#footer">Contact Us</a></li>
            <li class="nav-item d-flex align-items-center">
                <div class="vr mx-3"></div>
            </li>
            <?php if (session()->has('username')): ?>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#profileModal">
                        <?= esc(session('username')) ?>
                    </a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('auth/login') ?>">Sign In</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>

<!-- Profile Modal -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileModalLabel">User Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="profileForm" action="<?= site_url('user/updateProfile') ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    
                    <!-- Profile Picture Section -->
                    <div class="text-center mb-4">
                        <div class="position-relative d-inline-block">
                            <img id="profileImage" 
                                 src="<?= session()->has('profile_picture') && !empty(session('profile_picture')) 
                                        ? 'data:image/jpeg;base64,' . base64_encode(session('profile_picture'))
                                        : base_url('assets/images/default-avatar.png') ?>" 
                                 alt="Profile Picture" 
                                 class="rounded-circle border" 
                                 style="width: 120px; height: 120px; object-fit: cover;">
                            <button type="button" class="btn btn-sm btn-primary position-absolute bottom-0 end-0 rounded-circle p-1" onclick="triggerFileInput()">
                                <i class="fas fa-camera"></i>
                            </button>
                        </div>
                        <input type="file" id="profilePictureInput" name="profile_picture" accept="image/*" style="display: none;">
                        <small class="text-muted d-block mt-2">Click camera icon to change picture</small>
                    </div>

                    <!-- Username Field -->
                    <div class="mb-3">
                        <label for="username" class="text-muted d-block mt-2">Username</label>
                        <input type="text" class="form-control" id="username" name="username" 
                               value="<?= esc(session('username')) ?>" required>
                    </div>

                    <!-- Email Field -->
                    <div class="mb-3">
                        <label for="email" class="text-muted d-block mt-2">Email</label>
                        <input type="email" class="form-control" id="email" name="email" 
                               value="<?= esc(session('email')) ?>" required>
                    </div>

                    <!-- Address Field -->
                    <div class="mb-3">
                        <label for="address" class="text-muted d-block mt-2">Address</label>
                        <textarea class="form-control" id="address" name="address" rows="3" 
                                  placeholder="Enter your address"><?= esc(session('address')) ?></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" onclick="logout()">
                    <i class="fas fa-power-off"></i>
                    Logout
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times-circle"></i>
                    Cancel
                </button>
                <button type="submit" form="profileForm" class="btn btn-primary" onclick="return confirmSave()">
                    <i class="fas fa-check-circle"></i>
                    Save Changes
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Function to trigger file input
function triggerFileInput() {
    document.getElementById('profilePictureInput').click();
}



// Confirm save function
function confirmSave() {
    return confirm("Are you sure you want to save these changes?");
}

// Logout function
function logout() {
    if (confirm('Are you sure you want to logout?')) {
        window.location.href = '<?= site_url('auth/logout') ?>';
    }
}

// Initialize event listeners when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Preview profile picture before upload
    const profilePictureInput = document.getElementById('profilePictureInput');
    const profilePicturePreview = document.getElementById('profileImage');

    if (profilePictureInput && profilePicturePreview) {
        profilePictureInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                // Check file size (2MB limit)
                if (this.files[0].size > 2097152) {
                    alert('File size too large. Maximum size is 2MB.');
                    this.value = '';
                    return;
                }

                // Check file type
                const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!allowedTypes.includes(this.files[0].type)) {
                    alert('Invalid file type. Please upload a JPEG, PNG, or GIF image.');
                    this.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    profilePicturePreview.src = e.target.result;
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    }
    
    // Load user profile data when modal opens
    const profileModal = document.getElementById('profileModal');
    if (profileModal) {
        profileModal.addEventListener('shown.bs.modal', function() {
            fetch('<?= site_url('user/getProfile') ?>')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('username').value = data.user.username || '';
                        document.getElementById('email').value = data.user.email || '';
                        document.getElementById('address').value = data.user.address || '';
                        
                        if (data.user.profile_picture) {
                            document.getElementById('profileImage').src = 'data:image/jpeg;base64,' + data.user.profile_picture;
                        } else {
                            document.getElementById('profileImage').src = '<?= base_url('assets/images/default-avatar.png') ?>';
                        }
                    }
                })
                .catch(error => console.error('Fetch error:', error));
        });
    }
});
</script>

<!-- Hero Section -->
<section class="hero position-relative overflow-hidden" id="home">
  <video autoplay muted loop playsinline class="bg-video">
    <source src="images/bgvid.mp4" type="video/mp4" />
    Your browser does not support the video tag.
  </video>
    <div class="video-overlay"></div>
  <div class="row align-items-center">
    <div class="col-md-6">
        <div class="center">
      <h1>Enjoy Your Coffee With Cozy Brew Café</h1>
      <p>Start your day with a cup that brings comfort and energy. Whether you crave a bold espresso or a smooth latte, we serve coffee that fits your mood. Every cup is brewed fresh, rich in flavor, and made with care — because you deserve a moment of happiness, every day.</p>
     <div class="d-flex justify-content-center align-items-center gap-3 mt-3">
<a href="<?= base_url('menu#menu') ?>" class="btn btn-light">Order Now</a>



  <a href="#about" class="btn btn-outline-light">Explore More</a>
</div>

      </div>
      <div class="row stats mt-5">
        <div class="col stat-box"><span>20+</span>Coffee Choices</div>
        <div class="col stat-box"><span>20+</span>Order Running</div>
        <div class="col stat-box"><span>5.0 
          ★★★★★</span> Rating</div>
      </div>
    </div>
   
  </div>
  <!-- Best selling section -->
</section>
<section class="best-selling container py-5" id="menu">
  <div class="text-center mb-4">
    <h2 class="section-title">Cozy Best Selling Item</h2>
    <div class="filter-tabs mb-3 d-flex justify-content-center gap-2 flex-wrap">
      <button class="tab active" data-filter="all">All</button>
      <button class="tab" data-filter="black">Black</button>
      <button class="tab" data-filter="espresso">Espresso</button>
      <button class="tab" data-filter="doppio">Latte</button>
    </div>
  </div>

  <div class="d-flex justify-content-center align-items-center gap-3">
    <button class="arrow-btn" id="prevFilter">&#8592;</button>

    <div id="productScroll" class="d-flex flex-wrap justify-content-center gap-4">
      <!-- Product Cards -->
      <div class="product-card" data-category="black" style="width: 380px;">
        <img src="<?= base_url('images/capucinno.jpg') ?>" class="img-fluid" alt="Cappuccino">
<div class="mt-3 d-flex align-items-center justify-content-center gap-3" style="color:#3c2a21; font-size: 20px;">
  <p  class="m-0"> ★★★★★ 4.8</p>
  <p class="m-0"><span>Php 90</span></p>
</div>

        <h5 class="mt-2">Cappuccino</h5>
        <button class="btn btn-dark mt-2">Order Now</button>
      </div>

      <div class="product-card" data-category="espresso" style="width: 380px;">
        <img src="<?= base_url('images/americano.jpg') ?>" class="img-fluid" alt="Americano">
        <div class="mt-3 d-flex align-items-center justify-content-center gap-3" style="color:#3c2a21; font-size: 20px;">
  <p  class="m-0"> ★★★★★ 4.9</p>
  <p class="m-0"><span>Php 90</span></p>
</div>
        <h5 class="mt-2">Americano</h5>
        <button class="btn btn-dark mt-2">Order Now</button>
      </div>

      <div class="product-card" data-category="doppio" style="width: 380px;">
        <img src="<?= base_url('images/latte.jpg') ?>" class="img-fluid" alt="Espresso">
        <div class="mt-3 d-flex align-items-center justify-content-center gap-3" style="color:#3c2a21; font-size: 20px;">
  <p  class="m-0"> ★★★★★ 5.0</p>
  <p class="m-0"><span>Php 90</span></p>
</div>
        <h5 class="mt-2">Latte</h5>
        <button class="btn btn-dark mt-2">Order Now</button>
      </div>  
    </div>
    <button class="arrow-btn" id="nextFilter">&#8594;</button>
  </div>
</section>

  <!-- About Us Section-->
<section class="py-5" id="about">
  <div class="container">
    <div class="row align-items-center">
      

      <!-- Carousel for Images -->
      <div class="col-md-6 d-flex justify-content-center align-items-center">
        <div id="aboutCarousel" class="carousel slide shadow rounded" data-bs-ride="carousel" >
          <div class="carousel-inner" style="margin-top: 120px;">
            <div class="carousel-item active">
               <img src="<?= base_url('images/about.jpg') ?>" class="d-block w-100 rounded" alt="Coffee Shop 1">
            </div>
            <div class="carousel-item">
               <img src="<?= base_url('images/about1.jpg') ?>" class="d-block w-100 rounded" alt="Coffee Shop 2">
            </div>
            <div class="carousel-item">
              <img src="<?= base_url('images/about2.jpg') ?>" class="d-block w-100 rounded" alt="Coffee Shop 3">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#aboutCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#aboutCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
      

      <!-- About Us Text -->
      <div class="col-md-6 mt-4 mt-md-0 text-align-center">
        <h1 class="mb-3" style="font-weight: 3rem; font-size: 40px;">Cozy Brew Café</h1>
        <p style="font-weight: 2rem; font-size: 20px; text-align: center;"><strong>Cozy Brew Café</strong> is your local hub for high-quality coffee and a relaxing atmosphere. We blend passion and flavor into every cup we serve.</p>
        <p style="font-weight: 2rem; font-size: 20px; text-align: center;">Our shop isn't just about coffee — it's about community. From cozy mornings to peaceful evenings, we welcome everyone with warmth and flavor.</p>
        <a href="#menu" class="btn btn-dark mt-8" style="font-weight: 2rem; font-size: 20px;">Explore Our Menu</a>
      </div>

    </div>
  </div>
</section>

   <!-- Review Section -->
<section class="customer-reviews py-5" id="reviews">
  <div class="container text-center">
    <h2 class="mb-5">Customer's Reviews</h2>

    <div class="row justify-content-center">
      <!-- Review Card -->
      <div class="col-md-4 mb-4">
        <div class="p-4 border rounded bg-dark position-relative">
          <div style="font-size: 60px; color: #ccc; position: absolute; top: -20px; left: 20px;">“</div>
          <p class="mt-4">The coffee here is top-notch. Always fresh and flavorful!</p>
          <div class="text-warning mb-2">
            ★★★★★
          </div>
          <h6 class="mb-0">- Anna D.</h6>
        </div>
      </div>

      <!-- Review Card -->
      <div class="col-md-4 mb-4">
        <div class="p-4 border rounded bg-dark position-relative">
          <div style="font-size: 60px; color: #ccc; position: absolute; top: -20px; left: 20px;">“</div>
          <p class="mt-4">Cozy ambiance and great service. My favorite spot in town!</p>
          <div class="text-warning mb-2">
            ★★★★★
          </div>
          <h6 class="mb-0">- Mark T.</h6>
        </div>
      </div>

      <!-- Review Card -->
      <div class="col-md-4 mb-4">
        <div class="p-4 border rounded bg-dark position-relative">
          <div style="font-size: 60px; color: #ccc; position: absolute; top: -20px; left: 20px;">“</div>
          <p class="mt-4">Tried the espresso and it was bold and smooth. Highly recommend!</p>
          <div class="text-warning mb-2">
            ★★★★★
          </div>
          <h6 class="mb-0">- Carla M.</h6>
        </div>
      </div>
    </div>
  </div>
</section>



<footer id="footer" class="bg-dark text-white pt-4" >
  <div class="container">
    <div class="row">
      <!-- About -->
      <div class="col-md-4 mb-3">
        <h5  style="color:#d5aa7b">Cozy Brew Café</h5>
        <p>Your daily dose of handcrafted coffee, made with love and care. Visit us for a warm experience.</p>
      </div>

      <!-- Quick Links -->
      <div class="col-md-4 mb-3">
        <h5 style="color:#d5aa7b">Quick Links</h5>
        <ul class="list-unstyled" >
          <li><a href="#about" class="text-white text-decoration-none">About Us</a></li>
          <li><a href="#menu" class="text-white text-decoration-none">Menu</a></li>
          <li><a href="#contact" class="text-white text-decoration-none">Contact</a></li>
        </ul>
      </div>

      <!-- Contact Info -->
      <div class="col-md-4 mb-3">
        <h5 style="color:#d5aa7b">Contact Us</h5>
        <p><i class="bi bi-telephone-fill"></i> +63 912 345 6789</p>
        <p><i class="bi bi-envelope-fill"></i> info@cozybrew.com</p>
        <p><i class="bi bi-geo-alt-fill"></i> Metro Bulihan, Philippines</p>
      </div>
    </div>

    <hr class="bg-white">
    <div class="text-center pb-3">
      &copy; 2025 Cozy Brew Café. All rights reserved.
    </div>
  </div>
</footer>


<script>
   document.addEventListener("DOMContentLoaded", function () {
    const tabs = document.querySelectorAll(".tab");
    const productCards = document.querySelectorAll(".product-card");
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
        card.style.display = (filter === "all" || filter === category) ? "block" : "none";
      });

      // Update currentTabIndex
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

    // Next and previous button logic with wrap-around
    document.getElementById("nextFilter").addEventListener("click", () => {
      let nextIndex = (currentTabIndex + 1) % tabs.length;
      activateTab(nextIndex);
    });

    document.getElementById("prevFilter").addEventListener("click", () => {
      let prevIndex = (currentTabIndex - 1 + tabs.length) % tabs.length;
      activateTab(prevIndex);
    });
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>