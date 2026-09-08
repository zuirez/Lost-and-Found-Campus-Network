<?php
/**
 * Admin Panel Layout Header
 * Replaces the main site header for all /admin pages.
 * Usage: require_once APP_ROOT . '/app/views/admin/layout_header.php';
 */

// Determine active sidebar item from $admin_page variable set by controller
$admin_page = $admin_page ?? 'dashboard';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title . ' — Admin' : 'Admin Panel — Lost & Found AIUB' ?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/jpeg" href="<?= BASE_URL ?>/public/img/icon.jpg">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/style.css?v=<?= time() ?>">
</head>
<body>

<div class="admin-wrapper">

    <!-- ======= Sidebar ======= -->
    <aside class="admin-sidebar" id="adminSidebar">

        <!-- Brand -->
        <a href="<?= BASE_URL ?>/admin" class="admin-sidebar-brand">
            <div class="brand-icon-wrap">
                <i class="ph-bold ph-shield-check"></i>
            </div>
            <div class="brand-text">
                <span>Lost &amp; Found</span>
                <span>Admin Panel</span>
            </div>
        </a>

        <!-- Navigation -->
        <nav class="admin-nav">
            <span class="admin-nav-label">Main</span>

            <a href="<?= BASE_URL ?>/admin"
               class="admin-nav-item <?= $admin_page === 'dashboard' ? 'active' : '' ?>"
               id="nav-dashboard">
                <i class="ph-bold ph-squares-four"></i>
                Dashboard
            </a>

            <a href="<?= BASE_URL ?>/admin/users"
               class="admin-nav-item <?= $admin_page === 'users' ? 'active' : '' ?>"
               id="nav-users">
                <i class="ph-bold ph-users"></i>
                Users
                <?php if (!empty($sidebar_counts['users'])): ?>
                    <span class="admin-nav-badge"><?= $sidebar_counts['users'] ?></span>
                <?php endif; ?>
            </a>

            <a href="<?= BASE_URL ?>/admin/posts"
               class="admin-nav-item <?= $admin_page === 'posts' ? 'active' : '' ?>"
               id="nav-posts">
                <i class="ph-bold ph-newspaper"></i>
                Posts
                <?php if (!empty($sidebar_counts['posts'])): ?>
                    <span class="admin-nav-badge"><?= $sidebar_counts['posts'] ?></span>
                <?php endif; ?>
            </a>

            <span class="admin-nav-label">System</span>

            <a href="<?= BASE_URL ?>/admin/settings"
               class="admin-nav-item <?= $admin_page === 'settings' ? 'active' : '' ?>"
               id="nav-settings">
                <i class="ph-bold ph-gear"></i>
                Settings
            </a>
        </nav>

        <!-- Bottom actions -->
        <div class="admin-sidebar-footer">
            <a href="<?= BASE_URL ?>/" class="back-home">
                <i class="ph-bold ph-arrow-left"></i>
                Back to Home
            </a>
            <a href="<?= BASE_URL ?>/logout" class="logout-link" id="admin-logout-btn">
                <i class="ph-bold ph-sign-out"></i>
                Logout
            </a>
        </div>
    </aside>

    <!-- ======= Main Area ======= -->
    <div class="admin-main">

        <!-- Top Bar -->
        <header class="admin-topbar">
            <div class="admin-topbar-left">
                <!-- Mobile toggle -->
                <button class="admin-mobile-toggle" id="adminToggle"
                        style="display:none; background:none; border:none; cursor:pointer; padding:0.25rem; color:var(--text-primary);">
                    <i class="ph-bold ph-list" style="font-size:1.4rem;"></i>
                </button>

                <div>
                    <h1><?= $title ?? 'Dashboard' ?></h1>
                    <div class="admin-breadcrumb">
                        <span>Admin</span>
                        <i class="ph ph-caret-right" style="font-size:0.65rem;"></i>
                        <span><?= $title ?? 'Dashboard' ?></span>
                    </div>
                </div>
            </div>

            <div class="admin-topbar-right">
                <a href="<?= BASE_URL ?>/profile" class="admin-topbar-user" title="View your profile">
                    <?php if (!empty($_SESSION['profile_picture'])): ?>
                        <img src="<?= BASE_URL . htmlspecialchars($_SESSION['profile_picture']) ?>"
                             alt="Avatar">
                    <?php else: ?>
                        <div class="user-avatar-icon">
                            <i class="ph-fill ph-user"></i>
                        </div>
                    <?php endif; ?>
                    <div class="user-info">
                        <span class="user-name"><?= htmlspecialchars($_SESSION['user_name']) ?></span>
                        <span class="user-role"><?= htmlspecialchars($_SESSION['user_role'] ?? 'admin') ?></span>
                    </div>
                </a>
            </div>
        </header>

        <!-- Page Content starts here (controller's view is included after this) -->
        <div class="admin-content">
