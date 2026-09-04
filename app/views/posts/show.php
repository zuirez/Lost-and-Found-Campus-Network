<?php
$title = htmlspecialchars($data['post']->title) . " - AIUB Lost & Found";
require_once APP_ROOT . '/app/views/layouts/header.php';
?>

<main class="main-content" style="padding: 2rem 5%; min-height: 80vh;">
    
    <?php flash('post_message'); ?>
    
    <div style="max-width: 800px; margin: 0 auto; display: flex; flex-direction: column; gap: 2rem;">
        
        <!-- Post Details Card -->
        <div class="auth-card" style="padding: 0; overflow: hidden; max-width: 100%;">
            
            <?php if($data['post']->image_path) : ?>
                <div style="width: 100%; height: 350px; background: #000;">
                    <img src="<?= BASE_URL . $data['post']->image_path ?>" alt="Item Image" style="width: 100%; height: 100%; object-fit: contain;">
                </div>
            <?php endif; ?>
            
            <div style="padding: 2rem;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem;">
                    <div>
                        <span class="badge badge-<?= strtolower($data['post']->type) ?>" style="margin-bottom: 0.5rem; display: inline-block;"><?= $data['post']->type ?></span>
                        <div class="card-category" style="margin-bottom: 0.5rem;"><?= htmlspecialchars($data['post']->category) ?></div>
                        <h1 style="font-size: 1.8rem; margin: 0; color: var(--text-light);"><?= htmlspecialchars($data['post']->title) ?></h1>
                    </div>
                    <div style="text-align: right; color: var(--text-muted); font-size: 0.9rem;">
                        <div>Posted by <strong><?= htmlspecialchars($data['post']->name) ?></strong></div>
                        <div style="margin-top: 0.2rem;"><?= date('F j, Y, g:i a', strtotime($data['post']->created_at)) ?></div>
                    </div>
                </div>

                <div class="card-meta" style="margin-bottom: 1.5rem; font-size: 1rem;">
                    <span class="card-meta-item"><i class="ph-bold ph-map-pin"></i> <?= htmlspecialchars($data['post']->location) ?></span>
                </div>

                <div style="line-height: 1.7; color: var(--text-light); white-space: pre-wrap;"><?= htmlspecialchars($data['post']->description) ?></div>
            </div>
        </div>

        <!-- Comments Section -->
        <div class="auth-card" style="max-width: 100%; padding: 2rem;">
            <h2 style="font-size: 1.4rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                <i class="ph-bold ph-chats"></i> Comments (<?= count($data['comments']) ?>)
            </h2>

            <div style="display: flex; flex-direction: column; gap: 1.5rem; margin-bottom: 2rem;">
                <?php if(empty($data['comments'])) : ?>
                    <p style="color: var(--text-muted);">No comments yet. Be the first to comment!</p>
                <?php else : ?>
                    <?php foreach($data['comments'] as $comment) : ?>
                        <div style="background: rgba(255,255,255,0.03); border: 1px solid var(--border-color); padding: 1rem 1.5rem; border-radius: 8px;">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem; align-items: center;">
                                <div>
                                    <strong style="color: var(--primary-light);"><?= htmlspecialchars($comment->name) ?></strong>
                                    <span style="color: var(--text-muted); font-size: 0.8rem; margin-left: 0.5rem;"><?= date('M j, g:i a', strtotime($comment->created_at)) ?></span>
                                </div>
                                <?php if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $comment->user_id) : ?>
                                    <div style="display: flex; gap: 0.5rem;">
                                        <a href="<?= BASE_URL ?>/posts/edit_comment/<?= $comment->id ?>" style="color: var(--text-muted); font-size: 0.85rem;"><i class="ph-bold ph-pencil-simple"></i> Edit</a>
                                        <a href="<?= BASE_URL ?>/posts/delete_comment/<?= $comment->id ?>" onclick="return confirm('Are you sure you want to delete this comment?');" style="color: var(--lost-color); font-size: 0.85rem;"><i class="ph-bold ph-trash"></i> Delete</a>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div style="color: var(--text-light); line-height: 1.5;">
                                <?= htmlspecialchars($comment->body) ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- Add Comment Form -->
            <form action="<?= BASE_URL ?>/posts/comment/<?= $data['post']->id ?>" method="POST">
                <div class="form-group" style="margin-bottom: 1rem;">
                    <label for="body">Add a Comment</label>
                    <div class="input-wrapper" style="height: auto;">
                        <textarea id="body" name="body" rows="3" placeholder="Type your comment here..." required style="width: 100%; padding: 12px 15px; background: rgba(255, 255, 255, 0.03); border: none; color: var(--text-light); outline: none; resize: vertical;"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="ph-bold ph-paper-plane-right"></i> Post Comment
                </button>
            </form>
        </div>

    </div>
</main>

<?php require_once APP_ROOT . '/app/views/layouts/footer.php'; ?>
