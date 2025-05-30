<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title ?? 'Auth') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
 body {
    body {
    background:rgb(168, 0, 0);
}

.auth-container {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 30px;
}


.auth-img {
    width: 50%;
    background: url('https://images.unsplash.com/photo-1509042239860-f550ce710b93') center/cover no-repeat;
    position: relative;
}

.auth-img::after {
    content: '"Espres Yourself."';
    position: absolute;
    bottom: 20px;
    left: 20px;
    color: white;
    font-style: italic;
    font-weight: bold;
    font-size: 1.2rem;
    text-shadow: 1px 1px 5px rgba(0,0,0,0.5);
}

.auth-box {
    display: flex;
    width: 900px;
    max-width: 100%;
    min-height: 500px; /* fixed height */
    border-radius: 10px;
    overflow: hidden;
    background-color: white;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
}

.auth-form {
    width: 50%;
    padding: 50px;
    background-color: #fff;
    min-height: 450px; /* fixed */
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.form-container {
    max-width: 400px;
    width: 100%;
    margin-left: auto;
    margin-right: auto;
    height: 100%;
    overflow-y: auto;
}



    </style>
</head>
<body>

<div class="auth-container">
    <div class="auth-box">
        <div class="auth-img"></div>
        <div class="auth-form">
            <?= $this->renderSection('content') ?>
        </div>
    </div>
</div>

<!-- ✅ Bootstrap Bundle JS (for Toasts and other components) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- ✅ Render any section that contains extra scripts like toast -->
<?= $this->renderSection('scripts') ?>

</body>
</html>
