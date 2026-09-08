<?php
$title = "My Profile - AIUB Lost & Found";
require_once APP_ROOT . '/app/views/layouts/header.php';
$activeTab = $data['active_tab'];
$user = $data['user'];
$posts = $data['posts'];
?>

<main class="main-content" style="padding: 2rem 1.5rem; min-height: 80vh;">

    <?php flash('profile_message'); ?>

    <!-- Profile Header -->
    <div style="max-width: 1200px; margin: 0 auto;">
        <div class="auth-card" style="padding: 2rem; margin-bottom: 2rem; display: flex; align-items: center; gap: 1.5rem; flex-wrap: wrap;">
            <?php if(!empty($user->profile_picture)) : ?>
                <img src="<?= BASE_URL . $user->profile_picture ?>" alt="Profile" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 3px solid var(--primary-color); flex-shrink: 0;">
            <?php else : ?>
                <div style="width: 80px; height: 80px; background: linear-gradient(135deg, var(--primary-color), var(--primary-light)); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.2rem; color: #fff; flex-shrink: 0;">
                    <i class="ph-fill ph-user"></i>
                </div>
            <?php endif; ?>
            <div style="flex: 1;">
                <h1 style="font-size: 1.6rem; margin: 0 0 0.2rem;"><?= htmlspecialchars($user->name) ?></h1>
                <p style="color: var(--text-muted); margin: 0 0 0.5rem; font-size: 0.9rem;">
                    <i class="ph ph-identification-card"></i> <?= htmlspecialchars($user->student_id) ?>
                    &nbsp;&bull;&nbsp;
                    <i class="ph ph-envelope"></i> <?= htmlspecialchars($user->email) ?>
                    &nbsp;&bull;&nbsp;
                    <span style="text-transform: capitalize; background: rgba(255,255,255,0.1); padding: 2px 8px; border-radius: 4px;">
                        <i class="ph ph-shield-check"></i> <?= htmlspecialchars($user->role) ?>
                    </span>
                </p>
                <div style="color: var(--text-muted); font-size: 0.82rem;">
                    <i class="ph ph-calendar-blank"></i> Member since <?= date('M Y', strtotime($user->created_at)) ?>
                </div>
            </div>
        </div>

        <!-- Tabs Navigation -->
        <div style="display: flex; gap: 0; margin-bottom: 2rem; border-bottom: 2px solid var(--border-color);">
            <a href="<?= BASE_URL ?>/profile?tab=posts" class="profile-tab <?= $activeTab === 'posts' ? 'active' : '' ?>">
                <i class="ph-bold ph-squares-four"></i> My Posts
                <span style="background: var(--primary-color); color: #fff; border-radius: 10px; padding: 1px 8px; font-size: 0.75rem; margin-left: 6px;"><?= count($posts) ?></span>
            </a>
            <a href="<?= BASE_URL ?>/profile?tab=info" class="profile-tab <?= $activeTab === 'info' ? 'active' : '' ?>">
                <i class="ph-bold ph-user-circle"></i> Account Info
            </a>
            <a href="<?= BASE_URL ?>/profile?tab=password" class="profile-tab <?= $activeTab === 'password' ? 'active' : '' ?>">
                <i class="ph-bold ph-lock-key"></i> Change Password
            </a>
        </div>

        <!-- Tab: My Posts -->
        <?php if($activeTab === 'posts') : ?>
            <?php if(empty($posts)) : ?>
                <div style="text-align: center; padding: 4rem 2rem; color: var(--text-muted);">
                    <i class="ph-thin ph-folder-open" style="font-size: 4rem; display: block; margin-bottom: 1rem;"></i>
                    <p style="font-size: 1.1rem;">You haven't posted anything yet.</p>
                    <a href="<?= BASE_URL ?>/posts/create" class="btn btn-primary" style="margin-top: 1rem;">
                        <i class="ph-bold ph-plus"></i> Create Your First Post
                    </a>
                </div>
            <?php else : ?>
                <div style="display: flex; flex-direction: column; gap: 1rem;">
                    <?php foreach($posts as $post) : ?>
                        <div class="auth-card" style="padding: 1.25rem 1.5rem; max-width: 100%; display: flex; align-items: center; gap: 1.5rem; flex-wrap: wrap;">
                            <!-- Image Thumb -->
                            <div style="width: 70px; height: 70px; border-radius: 8px; overflow: hidden; background: rgba(255,255,255,0.05); flex-shrink: 0; display: flex; align-items: center; justify-content: center;">
                                <?php if($post->image_path) : ?>
                                    <img src="<?= BASE_URL . $post->image_path ?>" alt="Post image" style="width: 100%; height: 100%; object-fit: cover;">
                                <?php else : ?>
                                    <i class="ph-thin ph-image" style="font-size: 2rem; color: var(--text-muted);"></i>
                                <?php endif; ?>
                            </div>
                            <!-- Info -->
                            <div style="flex: 1; min-width: 0;">
                                <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.3rem; flex-wrap: wrap;">
                                    <span class="badge badge-<?= strtolower($post->type) ?>" style="position: static;"><?= $post->type ?></span>
                                    <span style="font-size: 0.75rem; color: var(--text-muted); background: rgba(255,255,255,0.08); padding: 2px 7px; border-radius: 4px;"><?= htmlspecialchars($post->category) ?></span>
                                    <span style="font-size: 0.75rem; color: var(--text-muted);"><?= htmlspecialchars($post->status) ?></span>
                                </div>
                                <a href="<?= BASE_URL ?>/posts/show/<?= $post->id ?>" style="font-weight: 700; font-size: 1.05rem; color: var(--text-light); text-decoration: none;" onmouseover="this.style.color='var(--primary-light)'" onmouseout="this.style.color='var(--text-light)'"><?= htmlspecialchars($post->title) ?></a>
                                <div style="font-size: 0.8rem; color: var(--text-muted); margin-top: 0.3rem;">
                                    <i class="ph ph-map-pin"></i> <?= htmlspecialchars($post->location) ?>
                                    &nbsp;&bull;&nbsp;
                                    <i class="ph ph-clock"></i> <?= date('M j, Y', strtotime($post->created_at)) ?>
                                </div>
                            </div>
                            <!-- Actions -->
                            <div style="display: flex; gap: 0.5rem; flex-shrink: 0;">
                                <a href="<?= BASE_URL ?>/profile/edit_post/<?= $post->id ?>" class="btn btn-outline" style="padding: 7px 14px; font-size: 0.85rem; display: flex; align-items: center; gap: 0.4rem;">
                                    <i class="ph-bold ph-pencil-simple"></i> Edit
                                </a>
                                <button onclick="confirmDeletePost(<?= $post->id ?>, '<?= htmlspecialchars($post->title, ENT_QUOTES) ?>')" class="btn" style="padding: 7px 14px; font-size: 0.85rem; background: rgba(255,80,80,0.1); border: 1px solid var(--lost-color); color: var(--lost-color); border-radius: 8px; cursor: pointer; display: flex; align-items: center; gap: 0.4rem;">
                                    <i class="ph-bold ph-trash"></i> Delete
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        <!-- Tab: Account Info -->
        <?php elseif($activeTab === 'info') : ?>
            <!-- Photo upload form -->
            <div class="auth-card" style="max-width: 100%; padding: 2rem; margin-bottom: 1.5rem;">
                <h3 style="margin-bottom: 1.25rem; font-size: 1rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em;">Profile Photo</h3>
                <div style="display: flex; align-items: center; gap: 1.5rem; flex-wrap: wrap;">
                    <div style="position: relative; width: 90px; height: 90px; flex-shrink: 0;">
                        <?php if(!empty($user->profile_picture)) : ?>
                            <img src="<?= BASE_URL . $user->profile_picture ?>" id="profile-preview-img" alt="Profile" style="width: 90px; height: 90px; border-radius: 50%; object-fit: cover; border: 3px solid var(--primary-color);">
                        <?php else : ?>
                            <div id="profile-preview-placeholder" style="width: 90px; height: 90px; border-radius: 50%; background: linear-gradient(135deg, var(--primary-color), var(--primary-light)); display: flex; align-items: center; justify-content: center; font-size: 2.2rem; color: #fff;">
                                <i class="ph-fill ph-user"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                    <form action="<?= BASE_URL ?>/profile/update_photo" method="POST" enctype="multipart/form-data">
                        <input type="file" id="profile_picture_upload" name="profile_picture" accept="image/*" style="display:none;" onchange="previewProfilePhoto(this); this.form.submit();">
                        <label for="profile_picture_upload" class="btn btn-outline" style="cursor: pointer; display: inline-flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem;">
                            <i class="ph-bold ph-camera"></i> Change Photo
                        </label>
                        <p style="color: var(--text-muted); font-size: 0.8rem; margin: 0;">JPG, PNG, WEBP up to a few MB. Uploading immediately saves.</p>
                    </form>
                </div>
            </div>
            <div class="auth-card" style="max-width: 100%; padding: 2rem;">
                <h3 style="margin-bottom: 1.5rem; font-size: 1.1rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em;">Account Information</h3>
                <div class="profile-info-grid">
                    <div>
                        <div style="font-size: 0.8rem; text-transform: uppercase; color: var(--text-muted); margin-bottom: 0.3rem; letter-spacing: 0.05em;"><i class="ph ph-user"></i> Full Name</div>
                        <div style="font-size: 1.1rem; font-weight: 600; color: var(--text-light);"><?= htmlspecialchars($user->name) ?></div>
                    </div>
                    <div>
                        <div style="font-size: 0.8rem; text-transform: uppercase; color: var(--text-muted); margin-bottom: 0.3rem; letter-spacing: 0.05em;"><i class="ph ph-identification-card"></i> Student ID</div>
                        <div style="font-size: 1.1rem; font-weight: 600; color: var(--text-light);"><?= htmlspecialchars($user->student_id) ?></div>
                    </div>
                    <div>
                        <div style="font-size: 0.8rem; text-transform: uppercase; color: var(--text-muted); margin-bottom: 0.3rem; letter-spacing: 0.05em;"><i class="ph ph-envelope"></i> Email Address</div>
                        <div style="font-size: 1.1rem; font-weight: 600; color: var(--text-light);"><?= htmlspecialchars($user->email) ?></div>
                    </div>
                    <div>
                        <div style="font-size: 0.8rem; text-transform: uppercase; color: var(--text-muted); margin-bottom: 0.3rem; letter-spacing: 0.05em;"><i class="ph ph-shield-check"></i> Role</div>
                        <div style="font-size: 1.1rem; font-weight: 600; color: var(--text-light); text-transform: capitalize;"><?= htmlspecialchars($user->role) ?></div>
                    </div>
                    <div>
                        <div style="font-size: 0.8rem; text-transform: uppercase; color: var(--text-muted); margin-bottom: 0.3rem; letter-spacing: 0.05em;"><i class="ph ph-calendar"></i> Member Since</div>
                        <div style="font-size: 1.1rem; font-weight: 600; color: var(--text-light);"><?= date('F j, Y', strtotime($user->created_at)) ?></div>
                    </div>
                    <div>
                        <div style="font-size: 0.8rem; text-transform: uppercase; color: var(--text-muted); margin-bottom: 0.3rem; letter-spacing: 0.05em;"><i class="ph ph-article"></i> Total Posts</div>
                        <div style="font-size: 1.1rem; font-weight: 600; color: var(--primary-light);"><?= count($posts) ?></div>
                    </div>
                </div>
            </div>

        <!-- Tab: Change Password -->
        <?php elseif($activeTab === 'password') : ?>
            <div class="auth-card" style="max-width: 500px; padding: 2rem;">
                <h3 style="margin-bottom: 1.5rem; font-size: 1.1rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em;">Change Password</h3>
                <form action="<?= BASE_URL ?>/profile/change_password" method="POST" class="auth-form" id="change-password-form">
                    <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <div class="input-wrapper">
                            <input type="password" id="current_password" name="current_password" placeholder="Enter your current password" required>
                            <i class="ph ph-lock-key"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <div class="input-wrapper">
                            <input type="password" id="new_password" name="new_password" placeholder="At least 6 characters" required>
                            <i class="ph ph-lock-laminated"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm New Password</label>
                        <div class="input-wrapper">
                            <input type="password" id="confirm_password" name="confirm_password" placeholder="Repeat new password" required>
                            <i class="ph ph-check-circle"></i>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary auth-btn" style="margin-top: 0.5rem;">
                        <i class="ph-bold ph-key"></i> Update Password
                    </button>
                </form>
            </div>
        <?php endif; ?>
    </div>
</main>

<style>
.profile-tab {
    padding: 0.75rem 1.25rem;
    font-weight: 600;
    font-size: 0.9rem;
    color: var(--text-muted);
    text-decoration: none;
    border-bottom: 3px solid transparent;
    margin-bottom: -2px;
    display: flex;
    align-items: center;
    gap: 0.4rem;
    transition: all 0.2s;
}
.profile-tab:hover { color: var(--text-light); }
.profile-tab.active {
    color: var(--primary-light);
    border-bottom-color: var(--primary-color);
}
.profile-info-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
}
@media (max-width: 600px) {
    .profile-tab { padding: 0.6rem 0.8rem; font-size: 0.8rem; }
    .profile-info-grid { grid-template-columns: 1fr; }
    .auth-card { padding: 1.25rem !important; }
}

<script>
function confirmDeletePost(id, title) {
    Swal.fire({
        title: 'Delete Post?',
        html: 'Are you sure you want to delete <strong>"' + title + '"</strong>? This cannot be undone.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: 'var(--lost-color)',
        cancelButtonColor: 'var(--text-muted)',
        background: 'var(--card-bg)',
        color: 'var(--text-light)',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '<?= BASE_URL ?>/profile/delete_post/' + id;
        }
    });
}

function previewProfilePhoto(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const existing = document.getElementById('profile-preview-img');
            const placeholder = document.getElementById('profile-preview-placeholder');
            if (existing) {
                existing.src = e.target.result;
            } else if (placeholder) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.id = 'profile-preview-img';
                img.style.cssText = 'width:90px;height:90px;border-radius:50%;object-fit:cover;border:3px solid var(--primary-color);';
                placeholder.replaceWith(img);
            }
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Client-side password match validation
document.getElementById('change-password-form')?.addEventListener('submit', function(e) {
    const newPw  = document.getElementById('new_password').value;
    const confPw = document.getElementById('confirm_password').value;
    if (newPw !== confPw) {
        e.preventDefault();
        Swal.fire({
            icon: 'error',
            title: 'Passwords do not match',
            text: 'Please make sure both password fields are identical.',
            background: 'var(--card-bg)',
            color: 'var(--text-light)',
            confirmButtonColor: 'var(--primary-color)'
        });
    }
});
</script>

<?php require_once APP_ROOT . '/app/views/layouts/footer.php'; ?>
