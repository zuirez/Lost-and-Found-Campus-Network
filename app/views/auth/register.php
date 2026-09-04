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

        <form action="<?= BASE_URL ?>/register" method="POST" class="auth-form">
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

<?php require_once APP_ROOT . '/app/views/layouts/footer.php'; ?>
