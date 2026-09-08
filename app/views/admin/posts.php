<?php
$title      = 'Posts';
$admin_page = 'posts';
require_once APP_ROOT . '/app/views/admin/layout_header.php';
?>

<?php echo flash('admin_message'); ?>

<div class="admin-page-header">
    <h2>Manage Posts</h2>
    <p>Review, update status, or remove posts from the campus network.</p>
</div>

<div class="admin-card">
    <div class="admin-card-header">
        <h3><i class="ph-bold ph-newspaper"></i> All Posts (<?= count($data['posts']) ?>)</h3>
    </div>
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Category</th>
                    <th>Posted By</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data['posts'])): ?>
                    <?php foreach ($data['posts'] as $i => $post): ?>
                    <tr>
                        <td style="color:var(--text-muted); font-size:0.78rem;"><?= $i + 1 ?></td>
                        <td>
                            <a href="<?= BASE_URL ?>/posts/show/<?= $post->id ?>"
                               style="color:var(--text-primary); font-weight:600; text-decoration:none;"
                               title="<?= htmlspecialchars($post->title) ?>"
                               target="_blank">
                                <?= htmlspecialchars(mb_strimwidth($post->title, 0, 32, '…')) ?>
                            </a>
                        </td>
                        <td>
                            <span class="admin-badge <?= strtolower($post->type) === 'lost' ? 'badge-lost' : 'badge-found' ?>">
                                <?= htmlspecialchars($post->type) ?>
                            </span>
                        </td>
                        <td style="font-size:0.8rem; color:var(--text-muted);">
                            <?= htmlspecialchars($post->category) ?>
                        </td>
                        <td style="font-size:0.82rem;">
                            <?= htmlspecialchars($post->name) ?>
                        </td>
                        <td>
                            <!-- Inline status update form -->
                            <form method="POST"
                                  action="<?= BASE_URL ?>/admin/update_status/<?= $post->id ?>"
                                  style="display:inline-flex;">
                                <select name="status"
                                        onchange="this.form.submit()"
                                        style="font-size:0.78rem; padding:0.25rem 0.5rem; border-radius:8px;
                                               border:1px solid var(--border-color); background:#fff;
                                               color:var(--text-primary); cursor:pointer;">
                                    <option value="active"   <?= $post->status === 'active'   ? 'selected' : '' ?>>Active</option>
                                    <option value="resolved" <?= $post->status === 'resolved' ? 'selected' : '' ?>>Resolved</option>
                                    <option value="closed"   <?= $post->status === 'closed'   ? 'selected' : '' ?>>Closed</option>
                                </select>
                            </form>
                        </td>
                        <td style="color:var(--text-muted); font-size:0.78rem;">
                            <?= date('M d, Y', strtotime($post->created_at)) ?>
                        </td>
                        <td>
                            <div class="admin-action-btns">
                                <a href="<?= BASE_URL ?>/posts/show/<?= $post->id ?>"
                                   class="admin-btn-icon"
                                   title="View post"
                                   target="_blank">
                                    <i class="ph-bold ph-eye"></i>
                                </a>
                                <a href="#"
                                   class="admin-btn-icon danger"
                                   title="Delete post"
                                   onclick="confirmDeletePost(<?= $post->id ?>, '<?= htmlspecialchars(addslashes($post->title)) ?>'); return false;">
                                    <i class="ph-bold ph-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8">
                            <div class="admin-empty">
                                <i class="ph ph-newspaper"></i>
                                <p>No posts found.</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function confirmDeletePost(id, title) {
    Swal.fire({
        title: 'Delete Post?',
        html: `Permanently delete <strong>"${title}"</strong>?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete',
        cancelButtonText: 'Cancel',
        confirmButtonColor: '#ef4444',
        cancelButtonColor: 'var(--primary-color)',
        background: '#fff',
        color: 'var(--text-primary)',
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '<?= BASE_URL ?>/admin/delete_post/' + id;
        }
    });
}
</script>

<?php require_once APP_ROOT . '/app/views/admin/layout_footer.php'; ?>
