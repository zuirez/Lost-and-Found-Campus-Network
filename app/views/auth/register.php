<?php
$title = "Register - AIUB Lost & Found";
require_once APP_ROOT . '/app/views/layouts/header.php';
?>

<main class="auth-container">
    <!-- Background Shapes -->
    <div class="auth-bg-shapes">
        <div class="shape-1"></div>
        <div class="shape-2"></div>
    </div>

    <!-- Register Card -->
    <div class="auth-card">
        <div class="auth-header">
            <h1>Create Account</h1>
            <p>Join the AIUB Lost & Found network</p>
        </div>

        <form action="<?= BASE_URL ?>/register" method="POST" enctype="multipart/form-data" class="auth-form">
            <div class="form-group">
                <label for="name">Full Name</label>
                <div class="input-wrapper">
                    <input type="text" id="name" name="name" placeholder="e.g. Rijoan Maruf" value="<?= htmlspecialchars($data['name'] ?? ''); ?>" required>
                    <i class="ph ph-user"></i>
                </div>
                <?php if(!empty($data['name_err'])) : ?>
                    <span class="invalid-feedback" style="color: var(--lost-color); font-size: 0.8rem;"><?= $data['name_err']; ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="student_id">Student ID</label>
                <div class="input-wrapper">
                    <input type="text" id="student_id" name="student_id" placeholder="e.g. xx-xxxxx-x" value="<?= htmlspecialchars($data['student_id'] ?? ''); ?>" required>
                    <i class="ph ph-identification-card"></i>
                </div>
                <?php if(!empty($data['student_id_err'])) : ?>
                    <span class="invalid-feedback" style="color: var(--lost-color); font-size: 0.8rem;"><?= $data['student_id_err']; ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="email">University Email</label>
                <div class="input-wrapper">
                    <input type="email" id="email" name="email" placeholder="e.g. xx-xxxxx-x@student.aiub.edu" value="<?= htmlspecialchars($data['email'] ?? ''); ?>" required>
                    <i class="ph ph-envelope-simple"></i>
                </div>
                <?php if(!empty($data['email_err'])) : ?>
                    <span class="invalid-feedback" style="color: var(--lost-color); font-size: 0.8rem;"><?= $data['email_err']; ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-wrapper">
                    <input type="password" id="password" name="password" placeholder="Create a strong password" required>
                    <i class="ph ph-lock-key"></i>
                </div>
                <?php if(!empty($data['password_err'])) : ?>
                    <span class="invalid-feedback" style="color: var(--lost-color); font-size: 0.8rem;"><?= $data['password_err']; ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <div class="input-wrapper">
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Repeat your password" required>
                    <i class="ph ph-lock-key"></i>
                </div>
                <?php if(!empty($data['confirm_password_err'])) : ?>
                    <span class="invalid-feedback" style="color: var(--lost-color); font-size: 0.8rem;"><?= $data['confirm_password_err']; ?></span>
                <?php endif; ?>
            </div>

            <!-- Optional profile picture -->
            <div class="form-group" style="text-align: center; margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.75rem; text-align: left;">Profile Photo <span style="color: var(--text-muted); font-size: 0.8rem;">(Optional)</span></label>
                <div id="avatar-preview" style="width: 90px; height: 90px; border-radius: 50%; background: rgba(255,255,255,0.08); border: 2px dashed var(--border-color); display: flex; align-items: center; justify-content: center; margin: 0 auto 0.75rem; overflow: hidden; cursor: pointer;" onclick="document.getElementById('profile_picture').click()">
                    <i class="ph-bold ph-camera" id="avatar-icon" style="font-size: 1.8rem; color: var(--text-muted);"></i>
                    <img id="avatar-img" src="" style="display:none; width:100%; height:100%; object-fit:cover;">
                </div>
                <input type="file" id="profile_picture" name="profile_picture" accept="image/*" style="display:none;" onchange="previewAvatar(this)">
                <label for="profile_picture" style="cursor: pointer; font-size: 0.85rem; color: var(--primary-light);"><i class="ph ph-upload-simple"></i> Click to upload photo</label>
            </div>

            <button type="submit" class="btn btn-primary auth-btn">
                <span>Create Account</span>
                <i class="ph ph-user-plus"></i>
            </button>
        </form>

        <div class="auth-footer">
            <p>Already have an account? <a href="<?= BASE_URL ?>/login">Sign In</a></p>
        </div>
    </div>
</main>

<script>
function previewAvatar(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('avatar-img').src = e.target.result;
            document.getElementById('avatar-img').style.display = 'block';
            document.getElementById('avatar-icon').style.display = 'none';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

<?php require_once APP_ROOT . '/app/views/layouts/footer.php'; ?>
