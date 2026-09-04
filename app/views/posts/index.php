<?php require_once APP_ROOT . '/app/views/layouts/header.php'; ?>

<?php if(isset($data['is_home']) && $data['is_home']): ?>
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

    <div class="quick-stats">
        <a href="<?= BASE_URL ?>/posts/create" class="stat-pill" style="border-color: var(--primary-color); color: var(--primary-color); font-weight: 600;">
            <i class="ph-bold ph-plus-circle"></i> Submit a Report
        </a>
    </div>
</section>
<?php endif; ?>

<div class="container" id="feed" style="margin-top: 2rem; min-height: 60vh;">
    <div class="section-header">
        <div>
            <h2 class="section-title"><?= htmlspecialchars($data['title']) ?></h2>
            <p class="section-desc">Latest lost and found items submitted around AIUB campus</p>
        </div>
        <div>
            <a href="<?= BASE_URL ?>/posts/create" class="btn btn-primary">
                <i class="ph-bold ph-plus"></i> Report Item
            </a>
        </div>
    </div>

    <div class="cards-grid">
        <?php if(empty($data['posts'])) : ?>
            <p style="color: var(--text-muted); grid-column: 1 / -1; text-align: center; padding: 3rem;">No items found in this category.</p>
        <?php else : ?>
            <?php foreach($data['posts'] as $post) : ?>
                <div class="item-card">
                    <div class="card-img-wrap">
                        <span class="badge badge-<?= strtolower($post->type) ?>"><?= $post->type ?></span>
                        
                        <?php if($post->image_path) : ?>
                            <img src="<?= BASE_URL . $post->image_path ?>" alt="Item Image" style="width: 100%; height: 100%; object-fit: cover; opacity: 0.8;">
                        <?php else : ?>
                            <i class="ph-thin ph-box card-img-placeholder"></i>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <div class="card-category"><?= htmlspecialchars($post->category) ?></div>
                        <a href="<?= BASE_URL ?>/posts/show/<?= $post->id ?>" class="card-title"><?= htmlspecialchars($post->title) ?></a>
                        <p class="card-desc"><?= htmlspecialchars(substr($post->description, 0, 80)) ?>...</p>
                        <div class="card-meta">
                            <span class="card-meta-item"><i class="ph ph-map-pin"></i> <?= htmlspecialchars($post->location) ?></span>
                            <span class="card-meta-item"><i class="ph ph-clock"></i> <?= date('M j, g:i a', strtotime($post->created_at)) ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php require_once APP_ROOT . '/app/views/layouts/footer.php'; ?>
