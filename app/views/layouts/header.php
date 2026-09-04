<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lost & Found - AIUB Campus Network</title>
    
    <!-- Premium Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Phosphor Icons for modern minimalist icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/Lost-and-Found-Campus-Network/public/css/style.css">
</head>
<body>

    <!-- Main Navigation Bar -->
    <nav class="navbar">
        <div class="navbar-container">
            <!-- Brand Logo & Name -->
            <a href="/Lost-and-Found-Campus-Network/index.php" class="navbar-brand">
                <div class="brand-icon">
                    <i class="ph-bold ph-magnifying-glass"></i>
                </div>
                <div class="brand-text">
                    Lost<span>&</span>Found
                </div>
            </a>

            <!-- Navigation Links -->
            <div class="navbar-nav">
                <a href="/Lost-and-Found-Campus-Network/index.php" class="nav-link active">Home</a>
                <a href="/Lost-and-Found-Campus-Network/posts/lost" class="nav-link">Lost Items</a>
                <a href="/Lost-and-Found-Campus-Network/posts/found" class="nav-link">Found Items</a>
                <a href="/Lost-and-Found-Campus-Network/about" class="nav-link">About</a>
            </div>

            <!-- Actions (Login / Post Item) -->
            <div class="navbar-actions">
                <a href="/Lost-and-Found-Campus-Network/login.php" class="btn btn-outline">
                    <i class="ph-bold ph-sign-in"></i> Login
                </a>
                <a href="/Lost-and-Found-Campus-Network/posts/create.php" class="btn btn-primary">
                    <i class="ph-bold ph-plus"></i> Post Item
                </a>
                
                <!-- Mobile Menu Toggle Button -->
                <button class="mobile-toggle" aria-label="Toggle Menu">
                    <i class="ph-bold ph-list"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Main Content Wrapper -->
    <main class="main-content">
