<?php
$title = '404 — Page Not Found';
require_once APP_ROOT . '/app/views/layouts/header.php';
?>

<div class="not-found-wrapper">
    <div class="not-found-content">

        <!-- Animated 404 number -->
        <div class="not-found-code">
            <span class="nf-four">4</span>
            <span class="nf-zero">
                <i class="ph-bold ph-magnifying-glass"></i>
            </span>
            <span class="nf-four">4</span>
        </div>

        <h1 class="not-found-title">Page Not Found</h1>
        <p class="not-found-desc">
            Oops! The page you're looking for seems to have gone missing —<br>
            just like a lost item on campus.
        </p>

        <div class="not-found-actions">
            <a href="<?= BASE_URL ?>/" class="btn btn-primary">
                <i class="ph-bold ph-house"></i> Back to Home
            </a>
            <a href="<?= BASE_URL ?>/posts/lost" class="btn btn-outline">
                <i class="ph-bold ph-magnifying-glass"></i> Browse Lost Items
            </a>
        </div>

        <!-- Decorative links -->
        <div class="not-found-links">
            <span>Or try:</span>
            <a href="<?= BASE_URL ?>/posts/found">Found Items</a>
            <span>&bull;</span>
            <a href="<?= BASE_URL ?>/posts/create">Post a Report</a>
            <span>&bull;</span>
            <a href="<?= BASE_URL ?>/login">Login</a>
        </div>

    </div>

    <!-- Floating background blobs -->
    <div class="nf-blob nf-blob-1"></div>
    <div class="nf-blob nf-blob-2"></div>
</div>

<style>
.not-found-wrapper {
    min-height: calc(100vh - 70px);
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 2rem 1.5rem;
    position: relative;
    overflow: hidden;
}

.not-found-content {
    position: relative;
    z-index: 2;
    max-width: 560px;
}

/* ── 404 Number ── */
.not-found-code {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.25rem;
    margin-bottom: 1.5rem;
    line-height: 1;
}

.nf-four {
    font-size: 8rem;
    font-weight: 900;
    background: linear-gradient(135deg, var(--primary-color), #6366f1);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: nfFloat 3s ease-in-out infinite;
}

.nf-zero {
    width: 7.5rem;
    height: 7.5rem;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary-color), #8b5cf6);
    display: flex;
    align-items: center;
    justify-content: center;
    animation: nfSpin 8s linear infinite;
    box-shadow: 0 0 40px rgba(79, 70, 229, 0.3);
}

.nf-zero i {
    font-size: 3rem;
    color: #fff;
}

.nf-four:last-child {
    animation-delay: 0.4s;
}

/* ── Text ── */
.not-found-title {
    font-size: 2rem;
    font-weight: 800;
    color: var(--text-primary);
    margin-bottom: 0.75rem;
}

.not-found-desc {
    font-size: 1rem;
    color: var(--text-muted);
    line-height: 1.7;
    margin-bottom: 2rem;
}

/* ── Buttons ── */
.not-found-actions {
    display: flex;
    gap: 0.75rem;
    justify-content: center;
    flex-wrap: wrap;
    margin-bottom: 1.5rem;
}

/* ── Quick links ── */
.not-found-links {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    font-size: 0.85rem;
    flex-wrap: wrap;
    color: var(--text-muted);
}

.not-found-links a {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 500;
    transition: opacity 0.2s;
}

.not-found-links a:hover {
    opacity: 0.75;
    text-decoration: underline;
}

/* ── Decorative blobs ── */
.nf-blob {
    position: absolute;
    border-radius: 50%;
    filter: blur(80px);
    opacity: 0.12;
    pointer-events: none;
    animation: nfFloat 6s ease-in-out infinite;
}

.nf-blob-1 {
    width: 400px;
    height: 400px;
    background: var(--primary-color);
    top: -80px;
    left: -100px;
}

.nf-blob-2 {
    width: 350px;
    height: 350px;
    background: #ec4899;
    bottom: -60px;
    right: -80px;
    animation-delay: 1.5s;
}

/* ── Animations ── */
@keyframes nfFloat {
    0%, 100% { transform: translateY(0); }
    50%       { transform: translateY(-12px); }
}

@keyframes nfSpin {
    from { transform: rotate(0deg); }
    to   { transform: rotate(360deg); }
}
</style>

<?php require_once APP_ROOT . '/app/views/layouts/footer.php'; ?>
