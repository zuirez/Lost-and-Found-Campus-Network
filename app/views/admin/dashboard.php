<?php
$title      = 'Dashboard';
$admin_page = 'dashboard';
require_once APP_ROOT . '/app/views/admin/layout_header.php';
?>

<!-- Flash messages -->
<?php echo flash('admin_message'); ?>

<!-- Page Header -->
<div class="admin-page-header">
    <h2>Welcome back, <span style="color: var(--primary-color);"><?= htmlspecialchars($_SESSION['user_name']) ?></span></h2>
    <p>Here's what's happening on the campus network today.</p>
</div>

<!-- Stat Cards -->
<div class="admin-stats-grid">

    <div class="admin-stat-card stat-primary">
        <div class="admin-stat-icon">
            <i class="ph-bold ph-newspaper"></i>
        </div>
        <div class="admin-stat-info">
            <div class="stat-value"><?= $data['stats']['total_posts'] ?? 0 ?></div>
            <div class="stat-label">Total Posts</div>
        </div>
    </div>

    <div class="admin-stat-card stat-lost">
        <div class="admin-stat-icon">
            <i class="ph-bold ph-magnifying-glass"></i>
        </div>
        <div class="admin-stat-info">
            <div class="stat-value"><?= $data['stats']['lost_posts'] ?? 0 ?></div>
            <div class="stat-label">Lost Reports</div>
        </div>
    </div>

    <div class="admin-stat-card stat-found">
        <div class="admin-stat-icon">
            <i class="ph-bold ph-hand-heart"></i>
        </div>
        <div class="admin-stat-info">
            <div class="stat-value"><?= $data['stats']['found_posts'] ?? 0 ?></div>
            <div class="stat-label">Found Reports</div>
        </div>
    </div>

    <div class="admin-stat-card stat-users">
        <div class="admin-stat-icon">
            <i class="ph-bold ph-users"></i>
        </div>
        <div class="admin-stat-info">
            <div class="stat-value"><?= $data['stats']['total_users'] ?? 0 ?></div>
            <div class="stat-label">Registered Users</div>
        </div>
    </div>

</div>

<!-- Recent Posts + Recent Users -->
<div class="admin-two-cols">

    <!-- Recent Posts -->
    <div class="admin-card">
        <div class="admin-card-header">
            <h3><i class="ph-bold ph-newspaper"></i> Recent Posts</h3>
            <a href="<?= BASE_URL ?>/admin/posts" class="btn btn-outline" style="font-size:0.78rem; padding:0.35rem 0.85rem;">
                View All
            </a>
        </div>
        <div class="admin-table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($data['recent_posts'])): ?>
                        <?php foreach ($data['recent_posts'] as $post): ?>
                        <tr>
                            <td>
                                <a href="<?= BASE_URL ?>/posts/show/<?= $post->id ?>"
                                   style="color:var(--text-primary); font-weight:600; text-decoration:none;"
                                   title="<?= htmlspecialchars($post->title) ?>">
                                    <?= htmlspecialchars(mb_strimwidth($post->title, 0, 28, '…')) ?>
                                </a>
                            </td>
                            <td>
                                <span class="admin-badge <?= strtolower($post->type) === 'lost' ? 'badge-lost' : 'badge-found' ?>">
                                    <i class="ph-fill ph-<?= strtolower($post->type) === 'lost' ? 'magnifying-glass' : 'hand-heart' ?>"></i>
                                    <?= htmlspecialchars($post->type) ?>
                                </span>
                            </td>
                            <td>
                                <span class="admin-badge badge-<?= htmlspecialchars($post->status) ?>">
                                    <?= ucfirst(htmlspecialchars($post->status)) ?>
                                </span>
                            </td>
                            <td style="color:var(--text-muted); font-size:0.78rem;">
                                <?= date('M d', strtotime($post->created_at)) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">
                                <div class="admin-empty">
                                    <i class="ph ph-newspaper"></i>
                                    <p>No posts yet.</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Recent Users -->
    <div class="admin-card">
        <div class="admin-card-header">
            <h3><i class="ph-bold ph-users"></i> Recent Users</h3>
            <a href="<?= BASE_URL ?>/admin/users" class="btn btn-outline" style="font-size:0.78rem; padding:0.35rem 0.85rem;">
                View All
            </a>
        </div>
        <div class="admin-table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Role</th>
                        <th>Joined</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($data['recent_users'])): ?>
                        <?php foreach ($data['recent_users'] as $user): ?>
                        <tr>
                            <td>
                                <div class="user-cell">
                                    <?php if (!empty($user->profile_picture)): ?>
                                        <img src="<?= BASE_URL . htmlspecialchars($user->profile_picture) ?>" alt="Avatar">
                                    <?php else: ?>
                                        <div class="cell-avatar">
                                            <?= strtoupper(substr($user->name, 0, 1)) ?>
                                        </div>
                                    <?php endif; ?>
                                    <div>
                                        <div class="cell-name"><?= htmlspecialchars(mb_strimwidth($user->name, 0, 20, '…')) ?></div>
                                        <div class="cell-email"><?= htmlspecialchars($user->student_id) ?></div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="admin-badge badge-<?= htmlspecialchars($user->role) ?>">
                                    <?= ucfirst(htmlspecialchars($user->role)) ?>
                                </span>
                            </td>
                            <td style="color:var(--text-muted); font-size:0.78rem;">
                                <?= date('M d, Y', strtotime($user->created_at)) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3">
                                <div class="admin-empty">
                                    <i class="ph ph-users"></i>
                                    <p>No users yet.</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php require_once APP_ROOT . '/app/views/admin/layout_footer.php'; ?>
