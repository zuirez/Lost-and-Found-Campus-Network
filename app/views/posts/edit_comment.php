<?php
$title = "Edit Comment - AIUB Lost & Found";
require_once APP_ROOT . '/app/views/layouts/header.php';
?>

<main class="main-content" style="padding: 2rem 5%; min-height: 80vh;">
    <div class="auth-card" style="max-width: 600px; margin: 2rem auto;">
        <div class="auth-header">
            <h2>Edit Comment</h2>
            <p>Update your response below.</p>
        </div>

        <form action="<?= BASE_URL ?>/posts/edit_comment/<?= $data['id'] ?>" method="POST" class="auth-form">
            <div class="form-group" style="margin-bottom: 0;">
                <label for="body">Comment</label>
                <div class="input-wrapper" style="height: auto;">
                    <textarea id="body" name="body" rows="4" required style="width: 100%; padding: 12px 15px 12px 40px; background: rgba(255, 255, 255, 0.03); border: none; color: var(--text-light); outline: none; resize: vertical;"><?= htmlspecialchars($data['body']) ?></textarea>
                    <i class="ph ph-chat-text" style="top: 15px;"></i>
                </div>
                <?php if(!empty($data['body_err'])) : ?>
                    <span class="invalid-feedback" style="color: var(--lost-color); font-size: 0.8rem; display: block; margin-top: 5px;"><?= $data['body_err']; ?></span>
                <?php endif; ?>
            </div>

            <div style="display: flex; gap: 1rem; margin-top: 1.5rem;">
                <button type="submit" class="btn btn-primary" style="flex: 1; justify-content: center;">
                    <i class="ph-bold ph-check"></i> Save Changes
                </button>
                <a href="<?= BASE_URL ?>/posts/show/<?= $data['post_id'] ?>" class="btn btn-outline" style="flex: 1; justify-content: center; text-align: center;">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</main>

<?php require_once APP_ROOT . '/app/views/layouts/footer.php'; ?>
