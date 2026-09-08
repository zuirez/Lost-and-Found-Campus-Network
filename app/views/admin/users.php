<?php
$title      = 'Users';
$admin_page = 'users';
require_once APP_ROOT . '/app/views/admin/layout_header.php';
?>

<?php echo flash('admin_message'); ?>

<div class="admin-page-header">
    <h2>Manage Users</h2>
    <p>View, assign roles, or remove registered users.</p>
</div>

<div class="admin-card">
    <div class="admin-card-header">
        <h3><i class="ph-bold ph-users"></i> All Users (<?= count($data['users']) ?>)</h3>
    </div>
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Student ID</th>
                    <th>Role</th>
                    <th>Joined</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data['users'])): ?>
                    <?php foreach ($data['users'] as $i => $user): ?>
                    <tr>
                        <td style="color:var(--text-muted); font-size:0.78rem;"><?= $i + 1 ?></td>
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
                                    <div class="cell-name"><?= htmlspecialchars($user->name) ?></div>
                                    <div class="cell-email"><?= htmlspecialchars($user->email) ?></div>
                                </div>
                            </div>
                        </td>
                        <td style="font-family:monospace; font-size:0.82rem; color:var(--text-muted);">
                            <?= htmlspecialchars($user->student_id) ?>
                        </td>
                        <td>
                            <!-- Inline role update form -->
                            <form method="POST"
                                  action="<?= BASE_URL ?>/admin/update_role/<?= $user->id ?>"
                                  style="display:inline-flex; align-items:center; gap:0.4rem;">
                                <select name="role"
                                        onchange="this.form.submit()"
                                        style="font-size:0.78rem; padding:0.25rem 0.5rem; border-radius:8px;
                                               border:1px solid var(--border-color); background:#fff;
                                               color:var(--text-primary); cursor:pointer;"
                                        <?= $user->id == $_SESSION['user_id'] ? 'disabled' : '' ?>>
                                    <option value="student"  <?= $user->role === 'student'  ? 'selected' : '' ?>>Student</option>
                                    <option value="admin"    <?= $user->role === 'admin'    ? 'selected' : '' ?>>Admin</option>
                                    <option value="security" <?= $user->role === 'security' ? 'selected' : '' ?>>Security</option>
                                </select>
                            </form>
                        </td>
                        <td style="color:var(--text-muted); font-size:0.78rem;">
                            <?= date('M d, Y', strtotime($user->created_at)) ?>
                        </td>
                        <td>
                            <div class="admin-action-btns">
                                <?php if ($user->id != $_SESSION['user_id']): ?>
                                <a href="#"
                                   class="admin-btn-icon danger"
                                   title="Delete user"
                                   onclick="confirmDeleteUser(<?= $user->id ?>, '<?= htmlspecialchars(addslashes($user->name)) ?>'); return false;">
                                    <i class="ph-bold ph-trash"></i>
                                </a>
                                <?php else: ?>
                                <span style="font-size:0.72rem; color:var(--text-muted);">You</span>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">
                            <div class="admin-empty">
                                <i class="ph ph-users"></i>
                                <p>No users registered yet.</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function confirmDeleteUser(id, name) {
    Swal.fire({
        title: 'Delete User?',
        html: `Remove <strong>${name}</strong> and all their data permanently?`,
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
            window.location.href = '<?= BASE_URL ?>/admin/delete_user/' + id;
        }
    });
}
</script>

<?php require_once APP_ROOT . '/app/views/admin/layout_footer.php'; ?>
