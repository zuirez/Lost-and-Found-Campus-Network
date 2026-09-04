<?php
$title = "Login - AIUB Lost & Found";
require_once APP_ROOT . '/app/views/layouts/header.php';
?>

<main class="auth-container">
    <!-- Background Shapes -->
    <div class="auth-bg-shapes">
        <div class="shape-1"></div>
        <div class="shape-2"></div>
    </div>

    <!-- Login Card -->
    <div class="auth-card">
        <?php flash('register_success'); ?>
        <div class="auth-header">
            <h1>Welcome Back</h1>
            <p>Log in to your AIUB account to continue</p>
        </div>

        <form action="<?= BASE_URL ?>/login" method="POST" class="auth-form">
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
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    <i class="ph ph-lock-key"></i>
                </div>
                <?php if(!empty($data['password_err'])) : ?>
                    <span class="invalid-feedback" style="color: var(--lost-color); font-size: 0.8rem;"><?= $data['password_err']; ?></span>
                <?php endif; ?>
            </div>

            <div class="auth-actions">
                <label class="remember-me">
                    <input type="checkbox" name="remember">
                    <span>Remember me</span>
                </label>
                <a href="<?= BASE_URL ?>/forgot-password" class="forgot-password">Forgot password?</a>
            </div>

            <button type="submit" class="btn btn-primary auth-btn">
                <span>Sign In</span>
                <i class="ph ph-sign-in"></i>
            </button>
        </form>

        <div class="auth-footer">
            <p>Don't have an account? <a href="<?= BASE_URL ?>/register">Create Account</a></p>
        </div>
    </div>
</main>

<?php require_once APP_ROOT . '/app/views/layouts/footer.php'; ?>
