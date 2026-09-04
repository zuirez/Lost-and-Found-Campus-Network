<?php
$title = "Post an Item - AIUB Lost & Found";
require_once APP_ROOT . '/app/views/layouts/header.php';
?>

<main class="main-content" style="padding: 2rem 5%; min-height: 80vh;">
    <div class="auth-card" style="max-width: 700px; margin: 0 auto;">
        <div class="auth-header">
            <h1>Report an Item</h1>
            <p>Help the community by reporting what you found or lost.</p>
        </div>

        <form action="<?= BASE_URL ?>/posts/create" method="POST" enctype="multipart/form-data" class="auth-form">
            <div class="form-group" style="margin-bottom: 1.5rem;">
                <label>Report Type</label>
                <div style="display: flex; gap: 1rem; margin-top: 0.5rem;">
                    <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                        <input type="radio" name="type" value="Lost" <?= (isset($data['type']) && $data['type'] == 'Lost') ? 'checked' : '' ?> required>
                        <span class="badge badge-lost" style="position: static; margin: 0;"><i class="ph-bold ph-warning-circle"></i> I Lost Something</span>
                    </label>
                    <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                        <input type="radio" name="type" value="Found" <?= (isset($data['type']) && $data['type'] == 'Found') ? 'checked' : '' ?> required>
                        <span class="badge badge-found" style="position: static; margin: 0;"><i class="ph-bold ph-check-circle"></i> I Found Something</span>
                    </label>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div class="form-group" style="margin-bottom: 0;">
                    <label for="title">Title</label>
                    <div class="input-wrapper">
                        <input type="text" id="title" name="title" placeholder="e.g. Black Wallet" value="<?= htmlspecialchars($data['title'] ?? '') ?>" required>
                        <i class="ph ph-text-t"></i>
                    </div>
                    <?php if(!empty($data['title_err'])) : ?>
                        <span class="invalid-feedback" style="color: var(--lost-color); font-size: 0.8rem; display: block; margin-top: 5px;"><?= $data['title_err']; ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group" style="margin-bottom: 0;">
                    <label for="category">Category</label>
                    <div class="input-wrapper">
                        <select id="category" name="category" required style="width: 100%; padding: 12px 15px 12px 40px; background: rgba(255, 255, 255, 0.03); border: 1px solid var(--border-color); color: var(--text-light); border-radius: 8px; appearance: none;">
                            <option value="Electronics" <?= (isset($data['category']) && $data['category'] == 'Electronics') ? 'selected' : '' ?>>Electronics / Gadgets</option>
                            <option value="ID Card" <?= (isset($data['category']) && $data['category'] == 'ID Card') ? 'selected' : '' ?>>ID Card / Documents</option>
                            <option value="Wallet" <?= (isset($data['category']) && $data['category'] == 'Wallet') ? 'selected' : '' ?>>Wallet / Bag</option>
                            <option value="Study Materials" <?= (isset($data['category']) && $data['category'] == 'Study Materials') ? 'selected' : '' ?>>Study Materials / Books</option>
                            <option value="Keys" <?= (isset($data['category']) && $data['category'] == 'Keys') ? 'selected' : '' ?>>Keys / Accessories</option>
                            <option value="Others" <?= (isset($data['category']) && $data['category'] == 'Others') ? 'selected' : '' ?>>Others</option>
                        </select>
                        <i class="ph ph-tag"></i>
                    </div>
                </div>

                <div class="form-group" style="margin-bottom: 0; grid-column: 1 / -1;">
                    <label for="location">Location</label>
                    <div class="input-wrapper">
                        <input type="text" id="location" name="location" placeholder="Where was it lost/found? (e.g., Annex 3, Library)" value="<?= htmlspecialchars($data['location'] ?? '') ?>" required>
                        <i class="ph ph-map-pin"></i>
                    </div>
                    <?php if(!empty($data['location_err'])) : ?>
                        <span class="invalid-feedback" style="color: var(--lost-color); font-size: 0.8rem; display: block; margin-top: 5px;"><?= $data['location_err']; ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group" style="margin-bottom: 0; grid-column: 1 / -1;">
                    <label for="description">Detailed Description</label>
                    <div class="input-wrapper" style="height: auto;">
                        <textarea id="description" name="description" rows="4" placeholder="Describe the item, color, specific details..." required style="width: 100%; padding: 12px 15px 12px 40px; background: rgba(255, 255, 255, 0.03); border: none; color: var(--text-light); outline: none; resize: vertical;"><?= htmlspecialchars($data['description'] ?? '') ?></textarea>
                        <i class="ph ph-align-left" style="top: 15px;"></i>
                    </div>
                    <?php if(!empty($data['description_err'])) : ?>
                        <span class="invalid-feedback" style="color: var(--lost-color); font-size: 0.8rem; display: block; margin-top: 5px;"><?= $data['description_err']; ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group" style="margin-bottom: 0; grid-column: 1 / -1;">
                    <label for="image">Upload Image (Optional)</label>
                    <div class="input-wrapper">
                        <input type="file" id="image" name="image" accept="image/png, image/jpeg, image/webp" style="width: 100%; padding: 10px 10px 10px 40px; background: rgba(255,255,255,0.03); color: var(--text-light); border-radius: 8px; border: 1px dashed var(--border-color);">
                        <i class="ph ph-image"></i>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary auth-btn" style="margin-top: 2rem; width: 100%; display: flex; justify-content: center; gap: 0.5rem; align-items: center;">
                <i class="ph-bold ph-paper-plane-right"></i> Post Report
            </button>
        </form>
    </div>
</main>

<style>
@media (max-width: 600px) {
    .auth-form > div[style*="grid-template-columns"] {
        grid-template-columns: 1fr !important;
    }
    .auth-form > div[style*="grid-template-columns"] > div {
        grid-column: 1 / -1 !important;
    }
}
</style>

<?php require_once APP_ROOT . '/app/views/layouts/footer.php'; ?>
