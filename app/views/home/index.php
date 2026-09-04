<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-badge">
        <i class="ph-fill ph-sparkle"></i> AIUB Campus Lost & Found
    </div>
    <h1 class="hero-title">
        Lost something? Or <span>Found something?</span>
    </h1>
    <p class="hero-subtitle">
        A unified community platform for AIUB students and faculty to reconnect lost belongings with their owners swiftly and securely.
    </p>

    <!-- Search Bar -->
    <form action="" method="GET" class="search-wrapper">
        <input type="text" name="q" class="search-input" placeholder="Search by item name, location (e.g. Library, Annex 3), or category...">
        <button type="submit" class="search-btn">
            <i class="ph-bold ph-magnifying-glass"></i> Search
        </button>
    </form>

    <!-- Quick Stats / Filters -->
    <div class="quick-stats">
        <a href="#feed" class="stat-pill">
            <span class="stat-dot lost"></span> 12 Active Lost Items
        </a>
        <a href="#feed" class="stat-pill">
            <span class="stat-dot found"></span> 8 Active Found Items
        </a>
        <a href="/Lost-and-Found-Campus-Network/posts/create.php" class="stat-pill" style="border-color: var(--primary-color); color: var(--primary-color); font-weight: 600;">
            <i class="ph-bold ph-plus-circle"></i> Submit a Report
        </a>
    </div>
</section>

<!-- Feed Container -->
<div class="container" id="feed">
    <div class="section-header">
        <div>
            <h2 class="section-title">Recent Reports</h2>
            <p class="section-desc">Latest lost and found items submitted around AIUB campus</p>
        </div>
        <div>
            <a href="/Lost-and-Found-Campus-Network/posts/create.php" class="btn btn-primary">
                <i class="ph-bold ph-plus"></i> Report Item
            </a>
        </div>
    </div>

    <!-- Cards Grid -->
    <div class="cards-grid">
        <!-- Sample Item 1 (Lost) -->
        <div class="item-card">
            <div class="card-img-wrap">
                <span class="badge badge-lost">Lost</span>
                <i class="ph-thin ph-identification-card card-img-placeholder"></i>
            </div>
            <div class="card-body">
                <div class="card-category">Documents / ID</div>
                <a href="#" class="card-title">AIUB Student ID Card</a>
                <p class="card-desc">Lost blue lanyard student ID card with holder. ID starts with 22-*****-1. Might have dropped near Annex 2 cafeteria.</p>
                <div class="card-meta">
                    <span class="card-meta-item"><i class="ph ph-map-pin"></i> Annex 2 Cafeteria</span>
                    <span class="card-meta-item"><i class="ph ph-clock"></i> 2 hrs ago</span>
                </div>
            </div>
        </div>

        <!-- Sample Item 2 (Found) -->
        <div class="item-card">
            <div class="card-img-wrap">
                <span class="badge badge-found">Found</span>
                <i class="ph-thin ph-calculator card-img-placeholder"></i>
            </div>
            <div class="card-body">
                <div class="card-category">Electronics</div>
                <a href="#" class="card-title">Casio fx-991EX Calculator</a>
                <p class="card-desc">Found on desk 403, Lab Room 4. Black color with some stickers on the back cover. Safe with lab assistant.</p>
                <div class="card-meta">
                    <span class="card-meta-item"><i class="ph ph-map-pin"></i> Building D, Room 403</span>
                    <span class="card-meta-item"><i class="ph ph-clock"></i> Today, 11:30 AM</span>
                </div>
            </div>
        </div>

        <!-- Sample Item 3 (Lost) -->
        <div class="item-card">
            <div class="card-img-wrap">
                <span class="badge badge-lost">Lost</span>
                <i class="ph-thin ph-key card-img-placeholder"></i>
            </div>
            <div class="card-body">
                <div class="card-category">Accessories</div>
                <a href="#" class="card-title">Set of Bike Keys with Keychain</a>
                <p class="card-desc">Yamaha bike key with a red anime character keychain. Last seen near student parking lot B.</p>
                <div class="card-meta">
                    <span class="card-meta-item"><i class="ph ph-map-pin"></i> Parking Lot B</span>
                    <span class="card-meta-item"><i class="ph ph-clock"></i> Yesterday</span>
                </div>
            </div>
        </div>

        <!-- Sample Item 4 (Found) -->
        <div class="item-card">
            <div class="card-img-wrap">
                <span class="badge badge-found">Found</span>
                <i class="ph-thin ph-notebook card-img-placeholder"></i>
            </div>
            <div class="card-body">
                <div class="card-category">Study Materials</div>
                <a href="#" class="card-title">Spiral Notebook (Web Tech)</a>
                <p class="card-desc">Found in the AIUB Central Library 2nd floor reading zone. Contains class notes for Web Technologies.</p>
                <div class="card-meta">
                    <span class="card-meta-item"><i class="ph ph-map-pin"></i> Central Library</span>
                    <span class="card-meta-item"><i class="ph ph-clock"></i> Yesterday</span>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
