<?php
$title = "Edit Post - AIUB Lost & Found";
require_once APP_ROOT . '/app/views/layouts/header.php';
?>

<main class="main-content" style="padding: 2rem 5%; min-height: 80vh;">
    <div class="auth-card" style="max-width: 700px; margin: 0 auto;">
        <div class="auth-header">
            <h1>Edit Post</h1>
            <p>Update the details of your report below.</p>
        </div>

        <form action="<?= BASE_URL ?>/profile/edit_post/<?= $data['id'] ?>" method="POST" enctype="multipart/form-data" class="auth-form">

            <!-- Report Type -->
            <div class="form-group" style="margin-bottom: 1.5rem;">
                <label>Report Type</label>
                <div style="display: flex; gap: 1rem; margin-top: 0.5rem;">
                    <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                        <input type="radio" name="type" value="Lost" <?= ($data['type'] == 'Lost') ? 'checked' : '' ?> required>
                        <span class="badge badge-lost" style="position: static; margin: 0;"><i class="ph-bold ph-warning-circle"></i> I Lost Something</span>
                    </label>
                    <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                        <input type="radio" name="type" value="Found" <?= ($data['type'] == 'Found') ? 'checked' : '' ?> required>
                        <span class="badge badge-found" style="position: static; margin: 0;"><i class="ph-bold ph-check-circle"></i> I Found Something</span>
                    </label>
                </div>
            </div>

            <!-- Grid Fields -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">

                <div class="form-group" style="margin-bottom: 0;">
                    <label for="title">Title</label>
                    <div class="input-wrapper">
                        <input type="text" id="title" name="title" placeholder="e.g. Black Wallet" value="<?= htmlspecialchars($data['title']) ?>" required>
                        <i class="ph ph-text-t"></i>
                    </div>
                    <?php if(!empty($data['title_err'])) : ?>
                        <span style="color: var(--lost-color); font-size: 0.8rem;"><?= $data['title_err'] ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group" style="margin-bottom: 0;">
                    <label for="category">Category</label>
                    <div class="input-wrapper">
                        <select id="category" name="category" required style="width: 100%; padding: 12px 15px 12px 40px; background: rgba(255,255,255,0.03); border: 1px solid var(--border-color); color: var(--text-light); border-radius: 8px; appearance: none;">
                            <option value="Electronics"     <?= ($data['category'] == 'Electronics')     ? 'selected' : '' ?>>Electronics / Gadgets</option>
                            <option value="ID Card"         <?= ($data['category'] == 'ID Card')         ? 'selected' : '' ?>>ID Card / Documents</option>
                            <option value="Wallet"          <?= ($data['category'] == 'Wallet')          ? 'selected' : '' ?>>Wallet / Bag</option>
                            <option value="Study Materials" <?= ($data['category'] == 'Study Materials') ? 'selected' : '' ?>>Study Materials / Books</option>
                            <option value="Keys"            <?= ($data['category'] == 'Keys')            ? 'selected' : '' ?>>Keys / Accessories</option>
                            <option value="Others"          <?= ($data['category'] == 'Others')          ? 'selected' : '' ?>>Others</option>
                        </select>
                        <i class="ph ph-tag"></i>
                    </div>
                </div>

                <div class="form-group" style="margin-bottom: 0; grid-column: 1 / -1;">
                    <label for="location">Location</label>
                    <div class="input-wrapper">
                        <input type="text" id="location" name="location" placeholder="Where was it lost/found?" value="<?= htmlspecialchars($data['location']) ?>" required>
                        <i class="ph ph-map-pin"></i>
                    </div>
                    <?php if(!empty($data['location_err'])) : ?>
                        <span style="color: var(--lost-color); font-size: 0.8rem;"><?= $data['location_err'] ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group" style="margin-bottom: 0; grid-column: 1 / -1;">
                    <label for="description">Description</label>
                    <div class="input-wrapper" style="height: auto;">
                        <textarea id="description" name="description" rows="4" placeholder="Describe the item..." required style="width: 100%; padding: 12px 15px 12px 40px; background: rgba(255,255,255,0.03); border: none; color: var(--text-light); outline: none; resize: vertical;"><?= htmlspecialchars($data['description']) ?></textarea>
                        <i class="ph ph-align-left" style="top: 15px;"></i>
                    </div>
                    <?php if(!empty($data['description_err'])) : ?>
                        <span style="color: var(--lost-color); font-size: 0.8rem;"><?= $data['description_err'] ?></span>
                    <?php endif; ?>
                </div>

                <!-- Current image preview -->
                <?php if(!empty($data['image_path'])) : ?>
                    <div class="form-group" style="margin-bottom: 0; grid-column: 1 / -1;">
                        <label>Current Image</label>
                        <img src="<?= BASE_URL . $data['image_path'] ?>" alt="Current post image" style="width: 100%; max-height: 200px; object-fit: cover; border-radius: 8px; border: 1px solid var(--border-color); margin-top: 0.5rem;">
                    </div>
                <?php endif; ?>

                <div class="form-group" style="margin-bottom: 0; grid-column: 1 / -1;">
                    <label for="image">Replace Image (Optional)</label>
                    <div class="input-wrapper">
                        <input type="file" id="image" name="image" accept="image/png, image/jpeg, image/webp" style="width: 100%; padding: 10px 10px 10px 40px; background: rgba(255,255,255,0.03); color: var(--text-light); border-radius: 8px; border: 1px dashed var(--border-color);">
                        <i class="ph ph-image"></i>
                    </div>
                </div>

            </div>

            <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                <button type="submit" class="btn btn-primary" style="flex: 1; justify-content: center;">
                    <i class="ph-bold ph-floppy-disk"></i> Save Changes
                </button>
                <a href="<?= BASE_URL ?>/profile?tab=posts" class="btn btn-outline" style="flex: 1; text-align: center; justify-content: center;">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</main>

<style>
@media (max-width: 600px) {
    .auth-form > div[style*="grid-template-columns"] {
        grid-template-columns: 1fr !important;
    }
}
</style>

<?php require_once APP_ROOT . '/app/views/layouts/footer.php'; ?>
