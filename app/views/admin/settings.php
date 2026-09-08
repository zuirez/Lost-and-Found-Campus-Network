<?php
$title      = 'Settings';
$admin_page = 'settings';
require_once APP_ROOT . '/app/views/admin/layout_header.php';
?>

<?php echo flash('admin_message'); ?>

<div class="admin-page-header">
    <h2>Settings</h2>
    <p>Platform configuration and preferences.</p>
</div>

<div class="admin-card">
    <div class="admin-card-header">
        <h3><i class="ph-bold ph-gear"></i> General Settings</h3>
    </div>
    <div class="admin-card-body">
        <div class="admin-empty" style="padding: 3rem 1rem;">
            <i class="ph ph-gear" style="font-size:3rem; opacity:0.25;"></i>
            <p style="font-size:0.95rem; margin-top:0.5rem; color:var(--text-muted);">
                Settings panel coming soon.
            </p>
        </div>
    </div>
</div>

<?php require_once APP_ROOT . '/app/views/admin/layout_footer.php'; ?>
