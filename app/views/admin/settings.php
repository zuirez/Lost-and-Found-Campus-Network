<?php
$title      = 'Settings';
$admin_page = 'settings';
require_once APP_ROOT . '/app/views/admin/layout_header.php';
?>

<?php echo flash('admin_message'); ?>

<div class="admin-page-header">
    <h2>Settings</h2>
    <p>Platform configuration, stats overview, and maintenance tools.</p>
</div>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;">

    <!-- Platform Overview -->
    <div class="admin-card">
        <div class="admin-card-header">
            <h3><i class="ph-bold ph-chart-bar"></i> Platform Overview</h3>
        </div>
        <div class="admin-card-body">
            <table class="admin-table">
                <tbody>
                    <tr>
                        <td style="color:var(--text-muted); font-size:0.83rem;">Total Users</td>
                        <td style="font-weight:700; color:var(--text-primary);"><?= $data['stats']['total_users'] ?></td>
                    </tr>
                    <tr>
                        <td style="color:var(--text-muted); font-size:0.83rem;">Total Posts</td>
                        <td style="font-weight:700; color:var(--text-primary);"><?= $data['stats']['total_posts'] ?></td>
                    </tr>
                    <tr>
                        <td style="color:var(--text-muted); font-size:0.83rem;">
                            <span class="admin-badge badge-active" style="margin-right:0.4rem;">Active</span> Posts
                        </td>
                        <td style="font-weight:700; color:var(--found-color);"><?= $data['stats']['active_posts'] ?></td>
                    </tr>
                    <tr>
                        <td style="color:var(--text-muted); font-size:0.83rem;">
                            <span class="admin-badge badge-resolved" style="margin-right:0.4rem;">Resolved</span> Posts
                        </td>
                        <td style="font-weight:700; color:var(--primary-color);"><?= $data['stats']['resolved_posts'] ?></td>
                    </tr>
                    <tr>
                        <td style="color:var(--text-muted); font-size:0.83rem;">
                            <span class="admin-badge badge-closed" style="margin-right:0.4rem;">Closed</span> Posts
                        </td>
                        <td style="font-weight:700; color:var(--text-muted);"><?= $data['stats']['closed_posts'] ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Admin Account -->
    <div class="admin-card">
        <div class="admin-card-header">
            <h3><i class="ph-bold ph-user-gear"></i> Admin Account</h3>
        </div>
        <div class="admin-card-body">
            <div style="display:flex; align-items:center; gap:1rem; margin-bottom:1.25rem;">
                <?php if (!empty($data['admin']->profile_picture)): ?>
                    <img src="<?= BASE_URL . htmlspecialchars($data['admin']->profile_picture) ?>"
                         alt="Avatar"
                         style="width:56px; height:56px; border-radius:50%; object-fit:cover; border:3px solid var(--primary-color);">
                <?php else: ?>
                    <div style="width:56px; height:56px; border-radius:50%; background:linear-gradient(135deg,var(--primary-color),#6366f1); display:flex; align-items:center; justify-content:center; color:#fff; font-size:1.4rem; font-weight:700; flex-shrink:0;">
                        <?= strtoupper(substr($data['admin']->name, 0, 1)) ?>
                    </div>
                <?php endif; ?>
                <div>
                    <div style="font-weight:700; color:var(--text-primary); font-size:0.95rem;"><?= htmlspecialchars($data['admin']->name) ?></div>
                    <div style="font-size:0.78rem; color:var(--text-muted);"><?= htmlspecialchars($data['admin']->email) ?></div>
                    <span class="admin-badge badge-admin" style="margin-top:0.3rem;"><?= ucfirst($data['admin']->role) ?></span>
                </div>
            </div>

            <div style="display:flex; flex-direction:column; gap:0.5rem;">
                <a href="<?= BASE_URL ?>/profile?tab=info"
                   class="btn btn-outline"
                   style="justify-content:flex-start; gap:0.5rem; font-size:0.85rem; padding:0.55rem 1rem;">
                    <i class="ph-bold ph-camera"></i> Update Profile Photo
                </a>
                <a href="<?= BASE_URL ?>/profile?tab=password"
                   class="btn btn-outline"
                   style="justify-content:flex-start; gap:0.5rem; font-size:0.85rem; padding:0.55rem 1rem;">
                    <i class="ph-bold ph-lock-key"></i> Change Password
                </a>
                <a href="<?= BASE_URL ?>/profile"
                   class="btn btn-outline"
                   style="justify-content:flex-start; gap:0.5rem; font-size:0.85rem; padding:0.55rem 1rem;">
                    <i class="ph-bold ph-user"></i> View Full Profile
                </a>
            </div>
        </div>
    </div>

</div>

<!-- Quick Actions -->
<div class="admin-card" style="margin-top:1.25rem;">
    <div class="admin-card-header">
        <h3><i class="ph-bold ph-lightning"></i> Quick Actions</h3>
    </div>
    <div class="admin-card-body">
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(180px,1fr)); gap:1rem;">

            <a href="<?= BASE_URL ?>/admin/users"
               style="display:flex; flex-direction:column; align-items:center; gap:0.6rem; padding:1.25rem; border:1px solid var(--border-color); border-radius:12px; text-decoration:none; color:var(--text-primary); transition:all 0.2s ease;"
               onmouseover="this.style.borderColor='var(--primary-color)'; this.style.background='rgba(79,70,229,0.04)';"
               onmouseout="this.style.borderColor='var(--border-color)'; this.style.background='';">
                <i class="ph-bold ph-users" style="font-size:1.6rem; color:var(--primary-color);"></i>
                <span style="font-size:0.83rem; font-weight:600;">Manage Users</span>
            </a>

            <a href="<?= BASE_URL ?>/admin/posts"
               style="display:flex; flex-direction:column; align-items:center; gap:0.6rem; padding:1.25rem; border:1px solid var(--border-color); border-radius:12px; text-decoration:none; color:var(--text-primary); transition:all 0.2s ease;"
               onmouseover="this.style.borderColor='var(--primary-color)'; this.style.background='rgba(79,70,229,0.04)';"
               onmouseout="this.style.borderColor='var(--border-color)'; this.style.background='';">
                <i class="ph-bold ph-newspaper" style="font-size:1.6rem; color:var(--primary-color);"></i>
                <span style="font-size:0.83rem; font-weight:600;">Manage Posts</span>
            </a>

            <a href="<?= BASE_URL ?>/posts/create"
               style="display:flex; flex-direction:column; align-items:center; gap:0.6rem; padding:1.25rem; border:1px solid var(--border-color); border-radius:12px; text-decoration:none; color:var(--text-primary); transition:all 0.2s ease;"
               onmouseover="this.style.borderColor='var(--found-color)'; this.style.background='rgba(16,185,129,0.04)';"
               onmouseout="this.style.borderColor='var(--border-color)'; this.style.background='';">
                <i class="ph-bold ph-plus-circle" style="font-size:1.6rem; color:var(--found-color);"></i>
                <span style="font-size:0.83rem; font-weight:600;">Create Post</span>
            </a>

            <a href="<?= BASE_URL ?>/"
               style="display:flex; flex-direction:column; align-items:center; gap:0.6rem; padding:1.25rem; border:1px solid var(--border-color); border-radius:12px; text-decoration:none; color:var(--text-primary); transition:all 0.2s ease;"
               onmouseover="this.style.borderColor='#f59e0b'; this.style.background='rgba(245,158,11,0.04)';"
               onmouseout="this.style.borderColor='var(--border-color)'; this.style.background='';">
                <i class="ph-bold ph-house" style="font-size:1.6rem; color:#f59e0b;"></i>
                <span style="font-size:0.83rem; font-weight:600;">View Site</span>
            </a>

        </div>
    </div>
</div>

<!-- Danger Zone -->
<div class="admin-card" style="margin-top:1.25rem; border-color:rgba(239,68,68,0.3);">
    <div class="admin-card-header" style="border-bottom-color:rgba(239,68,68,0.15);">
        <h3 style="color:var(--lost-color);"><i class="ph-bold ph-warning-octagon"></i> Danger Zone</h3>
    </div>
    <div class="admin-card-body">
        <div style="display:flex; align-items:center; justify-content:space-between; gap:1rem; flex-wrap:wrap; padding:0.5rem 0;">
            <div>
                <div style="font-weight:600; color:var(--text-primary); margin-bottom:0.2rem;">
                    Purge All Closed Posts
                </div>
                <div style="font-size:0.82rem; color:var(--text-muted);">
                    Permanently delete all posts with status <strong>Closed</strong> and remove their uploaded images.
                    Currently <strong><?= $data['stats']['closed_posts'] ?></strong> closed post(s).
                </div>
            </div>
            <button onclick="confirmPurge()" 
                    style="flex-shrink:0; padding:0.55rem 1.1rem; background:rgba(239,68,68,0.08); border:1.5px solid var(--lost-color); color:var(--lost-color); border-radius:8px; font-size:0.85rem; font-weight:600; cursor:pointer; display:flex; align-items:center; gap:0.45rem; transition:all 0.2s ease;"
                    onmouseover="this.style.background='rgba(239,68,68,0.15)'"
                    onmouseout="this.style.background='rgba(239,68,68,0.08)'">
                <i class="ph-bold ph-trash"></i> Purge Closed Posts
            </button>
        </div>
    </div>
</div>

<script>
function confirmPurge() {
    Swal.fire({
        title: 'Purge Closed Posts?',
        html: 'This will permanently delete <strong>all closed posts</strong> and their images. This action cannot be undone.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, purge them',
        cancelButtonText: 'Cancel',
        confirmButtonColor: '#ef4444',
        cancelButtonColor: 'var(--primary-color)',
        background: '#fff',
        color: 'var(--text-primary)',
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '<?= BASE_URL ?>/admin/purge_closed';
        }
    });
}
</script>

<?php require_once APP_ROOT . '/app/views/admin/layout_footer.php'; ?>
