<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lost & Found - AIUB Campus Network</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/style.css?v=<?= time() ?>">
</head>
<body>

    <nav class="navbar">
        <div class="navbar-container">
            <a href="<?= BASE_URL ?>/" class="navbar-brand">
                <div class="brand-icon">
                    <i class="ph-bold ph-magnifying-glass"></i>
                </div>
                <div class="brand-text">
                    Lost<span>&</span>Found
                </div>
            </a>

            <div class="navbar-nav">
                <a href="<?= BASE_URL ?>/" class="nav-link active">Home</a>
                <a href="<?= BASE_URL ?>/posts/lost" class="nav-link">Lost Items</a>
                <a href="<?= BASE_URL ?>/posts/found" class="nav-link">Found Items</a>
                <a href="<?= BASE_URL ?>/about" class="nav-link">About</a>
            </div>

            <div class="navbar-actions">
                <a href="<?= BASE_URL ?>/login" class="btn btn-outline">
                    <i class="ph-bold ph-sign-in"></i> Login
                </a>
                <a href="<?= BASE_URL ?>/posts/create" class="btn btn-primary">
                    <i class="ph-bold ph-plus"></i> Post Item
                </a>
                
                <button class="mobile-toggle" aria-label="Toggle Menu">
                    <i class="ph-bold ph-list"></i>
                </button>
            </div>
        </div>
    </nav>

    <main class="main-content">
