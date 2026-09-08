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

            <div class="navbar-nav">
                <a href="<?= BASE_URL ?>/" class="nav-link active">Home</a>
                <a href="<?= BASE_URL ?>/posts/lost" class="nav-link">Lost</a>
                <a href="<?= BASE_URL ?>/posts/found" class="nav-link">Found</a>
                <a href="<?= BASE_URL ?>/about" class="nav-link">About</a>
            </div>

            <div class="navbar-actions">
                <?php if(isset($_SESSION['user_id'])) : ?>
                    <a href="<?= BASE_URL ?>/posts/create" class="btn btn-primary">
                        <i class="ph-bold ph-plus"></i> Post Item
                    </a>
                    <a href="<?= BASE_URL ?>/profile" style="margin-left: 12px; font-weight: 600; color: var(--text-light); text-decoration: none; display: flex; align-items: center; gap: 0.4rem; transition: color 0.2s;" onmouseover="this.style.color='var(--primary-light)'" onmouseout="this.style.color='var(--text-light)'">
                        <?php if(!empty($_SESSION['profile_picture'])) : ?>
                            <img src="<?= BASE_URL . $_SESSION['profile_picture'] ?>" alt="Avatar" style="width: 30px; height: 30px; border-radius: 50%; object-fit: cover; border: 2px solid var(--primary-color);">
                        <?php else : ?>
                            <i class="ph-fill ph-user-circle" style="font-size: 1.3rem;"></i>
                        <?php endif; ?>
                        <?= htmlspecialchars($_SESSION['user_name']); ?>
                    </a>
                    <a href="<?= BASE_URL ?>/logout" class="btn btn-outline" style="margin-left: 10px;">
                        <i class="ph-bold ph-sign-out"></i> Logout
                    </a>
                <?php else : ?>
                    <a href="<?= BASE_URL ?>/login" class="btn btn-outline">
                        <i class="ph-bold ph-sign-in"></i> Login
                    </a>
                    <a href="<?= BASE_URL ?>/posts/create" class="btn btn-primary">
                        <i class="ph-bold ph-plus"></i> Post Item
                    </a>
                <?php endif; ?>
                
                <button class="mobile-toggle" aria-label="Toggle Menu">
                    <i class="ph-bold ph-list"></i>
                </button>
            </div>
        </div>
    </nav>

    <main class="main-content">
