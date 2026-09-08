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

    <div class="filter-bar" style="display: flex; gap: 1rem; margin-bottom: 2rem; align-items: center;">
        <strong><i class="ph-bold ph-funnel"></i> Filter by Category:</strong>
        <select id="category-filter" style="padding: 8px 12px; background: rgba(255, 255, 255, 0.05); border: 1px solid var(--border-color); color: var(--text-light); border-radius: 6px;">
            <option value="all">All Categories</option>
            <option value="Electronics">Electronics / Gadgets</option>
            <option value="ID Card">ID Card / Documents</option>
            <option value="Wallet">Wallet / Bag</option>
            <option value="Study Materials">Study Materials / Books</option>
            <option value="Keys">Keys / Accessories</option>
            <option value="Others">Others</option>
        </select>
    </div>

    <div class="cards-grid" id="posts-grid">
        <?php if(empty($data['posts'])) : ?>
            <p style="color: var(--text-muted); grid-column: 1 / -1; text-align: center; padding: 3rem;">No items found in this category.</p>
        <?php else : ?>
            <?php foreach($data['posts'] as $post) : ?>
                <div class="item-card" data-category="<?= htmlspecialchars($post->category) ?>">
                    <a href="<?= BASE_URL ?>/posts/show/<?= $post->id ?>" class="card-img-wrap" style="display: block;">
                        <span class="badge badge-<?= strtolower($post->type) ?>" style="z-index: 10;"><?= $post->type ?></span>
                        
                        <?php if($post->image_path) : ?>
                            <img src="<?= BASE_URL . $post->image_path ?>" alt="Item Image" style="width: 100%; height: 100%; object-fit: cover; opacity: 0.8; transition: opacity 0.3s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.8'">
                        <?php else : ?>
                            <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
                                <i class="ph-thin ph-box card-img-placeholder" style="transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'"></i>
                            </div>
                        <?php endif; ?>
                    </a>
                    <div class="card-body">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.4rem;">
                            <div class="card-category"><?= htmlspecialchars($post->category) ?></div>
                            <span style="font-size: 0.75rem; background: rgba(255,255,255,0.1); padding: 2px 6px; border-radius: 4px; color: var(--text-muted);">
                                <?= htmlspecialchars($post->status) ?>
                            </span>
                        </div>
                        
                        <a href="<?= BASE_URL ?>/posts/show/<?= $post->id ?>" class="card-title"><?= htmlspecialchars($post->title) ?></a>
                        
                        <div style="font-size: 0.8rem; color: var(--text-muted); margin-bottom: 0.5rem;">
                            <i class="ph-fill ph-user"></i> <?= htmlspecialchars($post->name) ?>
                        </div>

                        <p class="card-desc"><?= htmlspecialchars(substr($post->description, 0, 80)) ?>...</p>
                        
                        <div class="card-meta">
                            <span class="card-meta-item"><i class="ph ph-map-pin"></i> <?= htmlspecialchars($post->location) ?></span>
                            <span class="card-meta-item"><i class="ph ph-clock"></i> <?= date('M j', strtotime($post->created_at)) ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filter = document.getElementById('category-filter');
    const cards = document.querySelectorAll('.item-card');

    if(filter) {
        filter.addEventListener('change', function() {
            const selected = this.value;
            let visibleCount = 0;

            cards.forEach(card => {
                if(selected === 'all' || card.getAttribute('data-category') === selected) {
                    card.style.display = 'flex';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }
});
</script>

<?php require_once APP_ROOT . '/app/views/layouts/footer.php'; ?>
