<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Lost & Found - AIUB Campus Network' ?></title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/jpeg" href="<?= BASE_URL ?>/public/img/icon.jpg">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/style.css?v=<?= time() ?>">
</head>
<body>

    <nav class="navbar">
        <div class="navbar-container">
            <a href="<?= BASE_URL ?>/" class="navbar-brand">
                <img src="<?= BASE_URL ?>/public/img/logo.png" alt="Lost & Found AIUB" style="height: 80px; width: auto; display: block;">
            </a>

            <div class="navbar-menu" id="navbarMenu">
                <div class="navbar-nav">
                    <a href="<?= BASE_URL ?>/" class="nav-link active">Home</a>
                    <a href="<?= BASE_URL ?>/posts/lost" class="nav-link">Lost</a>
                    <a href="<?= BASE_URL ?>/posts/found" class="nav-link">Found</a>
                    <a href="<?= BASE_URL ?>/about" class="nav-link">About</a>
                    <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                    <a href="<?= BASE_URL ?>/admin" class="nav-link nav-link-admin">
                        <i class="ph-bold ph-shield-check"></i> Admin
                    </a>
                    <?php endif; ?>
                </div>

                <div class="navbar-actions">
                    <?php if(isset($_SESSION['user_id'])) : ?>
                        <a href="<?= BASE_URL ?>/posts/create" class="btn btn-primary">
                            <i class="ph-bold ph-plus"></i> Post Item
                        </a>
                        <div class="nav-user-dropdown">
                            <div class="nav-user-toggle">
                                <?php if(!empty($_SESSION['profile_picture'])) : ?>
                                    <img src="<?= BASE_URL . $_SESSION['profile_picture'] ?>" alt="Avatar" class="nav-user-avatar">
                                <?php else : ?>
                                    <i class="ph-fill ph-user-circle nav-user-icon"></i>
                                <?php endif; ?>
                                <span class="nav-user-name"><?= htmlspecialchars($_SESSION['user_name']); ?></span>
                                <i class="ph-bold ph-caret-down"></i>
                            </div>
                            <div class="nav-dropdown-menu">
                                <a href="<?= BASE_URL ?>/profile" class="dropdown-item">
                                    <i class="ph-bold ph-user"></i> My Profile
                                </a>
                                <a href="<?= BASE_URL ?>/logout" class="dropdown-item text-danger">
                                    <i class="ph-bold ph-sign-out"></i> Logout
                                </a>
                            </div>
                        </div>
                    <?php else : ?>
                        <a href="<?= BASE_URL ?>/login" class="btn btn-outline">
                            <i class="ph-bold ph-sign-in"></i> Login
                        </a>
                        <a href="<?= BASE_URL ?>/posts/create" class="btn btn-primary">
                            <i class="ph-bold ph-plus"></i> Post Item
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            
            <button class="mobile-toggle" id="mobileToggle" aria-label="Toggle Menu">
                <i class="ph-bold ph-list"></i>
            </button>
        </div>
    </nav>

    <script>
        const mobileToggle = document.getElementById('mobileToggle');
        const navbarMenu = document.getElementById('navbarMenu');
        
        mobileToggle.addEventListener('click', () => {
            navbarMenu.classList.toggle('menu-open');
            const icon = mobileToggle.querySelector('i');
            if(navbarMenu.classList.contains('menu-open')) {
                icon.classList.remove('ph-list');
                icon.classList.add('ph-x');
            } else {
                icon.classList.remove('ph-x');
                icon.classList.add('ph-list');
            }
        });
    </script>

    <main class="main-content">
