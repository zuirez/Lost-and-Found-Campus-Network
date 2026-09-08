<?php
$title = 'About — AIUB Lost & Found Campus Network';
require_once APP_ROOT . '/app/views/layouts/header.php';
?>

<div class="container">

    <!-- Hero -->
    <div style="text-align:center; padding: 3rem 0 2.5rem;">
        <div style="display:inline-flex; align-items:center; justify-content:center; width:72px; height:72px; border-radius:20px; background:linear-gradient(135deg, var(--primary-color), #8b5cf6); margin-bottom:1.25rem; box-shadow: 0 8px 24px rgba(79,70,229,0.3);">
            <i class="ph-bold ph-magnifying-glass" style="font-size:2rem; color:#fff;"></i>
        </div>
        <h1 style="font-size:2.25rem; font-weight:800; color:var(--text-primary); margin-bottom:0.75rem;">
            About <span style="color:var(--primary-color);">Lost &amp; Found</span>
        </h1>
        <p style="font-size:1.05rem; color:var(--text-muted); max-width:580px; margin:0 auto; line-height:1.75;">
            An unofficial community platform for the <strong>American International University–Bangladesh (AIUB)</strong>
            community — helping students and faculty reconnect with their lost belongings quickly and safely.
        </p>
    </div>

    <!-- Cards row -->
    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(260px,1fr)); gap:1.5rem; margin-bottom:2.5rem;">

        <div style="background:#fff; border:1px solid var(--border-color); border-radius:16px; padding:1.75rem; transition:box-shadow 0.2s, transform 0.2s;"
             onmouseover="this.style.boxShadow='var(--shadow-lg)'; this.style.transform='translateY(-3px)'"
             onmouseout="this.style.boxShadow=''; this.style.transform=''">
            <div style="width:48px; height:48px; border-radius:12px; background:rgba(79,70,229,0.1); display:flex; align-items:center; justify-content:center; margin-bottom:1rem;">
                <i class="ph-bold ph-target" style="font-size:1.4rem; color:var(--primary-color);"></i>
            </div>
            <h3 style="font-size:1rem; font-weight:700; color:var(--text-primary); margin-bottom:0.5rem;">Our Mission</h3>
            <p style="font-size:0.88rem; color:var(--text-muted); line-height:1.7;">
                To provide a fast, centralized hub where AIUB community members can report lost items, claim found ones, and coordinate directly — reducing the stress of losing personal belongings on campus.
            </p>
        </div>

        <div style="background:#fff; border:1px solid var(--border-color); border-radius:16px; padding:1.75rem; transition:box-shadow 0.2s, transform 0.2s;"
             onmouseover="this.style.boxShadow='var(--shadow-lg)'; this.style.transform='translateY(-3px)'"
             onmouseout="this.style.boxShadow=''; this.style.transform=''">
            <div style="width:48px; height:48px; border-radius:12px; background:rgba(16,185,129,0.1); display:flex; align-items:center; justify-content:center; margin-bottom:1rem;">
                <i class="ph-bold ph-users" style="font-size:1.4rem; color:var(--found-color);"></i>
            </div>
            <h3 style="font-size:1rem; font-weight:700; color:var(--text-primary); margin-bottom:0.5rem;">Community-Driven</h3>
            <p style="font-size:0.88rem; color:var(--text-muted); line-height:1.7;">
                Built by students, for students. Anyone with an AIUB email can register, post reports, and comment — fostering a culture of trust and mutual help across the campus.
            </p>
        </div>

        <div style="background:#fff; border:1px solid var(--border-color); border-radius:16px; padding:1.75rem; transition:box-shadow 0.2s, transform 0.2s;"
             onmouseover="this.style.boxShadow='var(--shadow-lg)'; this.style.transform='translateY(-3px)'"
             onmouseout="this.style.boxShadow=''; this.style.transform=''">
            <div style="width:48px; height:48px; border-radius:12px; background:rgba(245,158,11,0.1); display:flex; align-items:center; justify-content:center; margin-bottom:1rem;">
                <i class="ph-bold ph-shield-check" style="font-size:1.4rem; color:#f59e0b;"></i>
            </div>
            <h3 style="font-size:1rem; font-weight:700; color:var(--text-primary); margin-bottom:0.5rem;">Safe &amp; Secure</h3>
            <p style="font-size:0.88rem; color:var(--text-muted); line-height:1.7;">
                All actions are session-protected. Role-based access (Student, Security, Admin) ensures the platform stays organized and abuse-free with admin oversight.
            </p>
        </div>

    </div>

    <!-- How it works -->
    <div style="background:#fff; border:1px solid var(--border-color); border-radius:16px; padding:2rem; margin-bottom:2.5rem;">
        <h2 style="font-size:1.2rem; font-weight:800; color:var(--text-primary); margin-bottom:1.75rem; text-align:center;">
            How It Works
        </h2>
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(200px,1fr)); gap:1.5rem; text-align:center;">

            <?php
            $steps = [
                ['ph-user-plus',    '#4f46e5', '1', 'Register',      'Sign up with your name, student ID, and university email.'],
                ['ph-pencil-simple','#f59e0b', '2', 'Post a Report', 'Report a lost or found item with details, category, and an optional photo.'],
                ['ph-chat-circle',  '#10b981', '3', 'Comment',       'Comment on posts to coordinate pickup or ask for more details.'],
                ['ph-hand-heart',   '#ec4899', '4', 'Reunite',       'Mark your post as Resolved once the item is returned to its owner.'],
            ];
            foreach ($steps as [$icon, $color, $num, $label, $desc]):
            ?>
            <div>
                <div style="width:56px; height:56px; border-radius:50%; background:linear-gradient(135deg, <?= $color ?>, <?= $color ?>99); display:flex; align-items:center; justify-content:center; margin:0 auto 0.75rem; box-shadow:0 4px 12px <?= $color ?>44;">
                    <i class="ph-bold <?= $icon ?>" style="font-size:1.5rem; color:#fff;"></i>
                </div>
                <div style="font-size:0.7rem; font-weight:700; letter-spacing:0.08em; text-transform:uppercase; color:var(--text-muted); margin-bottom:0.3rem;">Step <?= $num ?></div>
                <div style="font-weight:700; color:var(--text-primary); margin-bottom:0.4rem;"><?= $label ?></div>
                <div style="font-size:0.82rem; color:var(--text-muted); line-height:1.6;"><?= $desc ?></div>
            </div>
            <?php endforeach; ?>

        </div>
    </div>

    <!-- Contact -->
    <div style="margin-bottom:3rem;">
        <div style="background:#fff; border:1px solid var(--border-color); border-radius:16px; padding:1.75rem; display:flex; flex-direction:column; justify-content:space-between; align-items:center; text-align:center;">
            <div>
                <h3 style="font-size:1.1rem; font-weight:800; color:var(--text-primary); margin-bottom:0.5rem;">
                    <i class="ph-bold ph-envelope" style="color:var(--primary-color);"></i> Contact &amp; Feedback
                </h3>
                <p style="font-size:0.95rem; color:var(--text-muted); line-height:1.7; margin-bottom:1.25rem; max-width: 600px;">
                    Have a suggestion, found a bug, or want to contribute? Reach out directly. We'd love to hear from you!
                </p>
                <a href="mailto:rijoanmaruf@gmail.com"
                   style="display:inline-flex; align-items:center; gap:0.5rem; font-size:1rem; font-weight:600; color:var(--primary-color); text-decoration:none; margin-bottom:1.5rem; padding:0.5rem 1rem; background:rgba(79,70,229,0.1); border-radius:8px;">
                    <i class="ph-bold ph-envelope-simple"></i> rijoanmaruf@gmail.com
                </a>
            </div>
            <div style="display:flex; gap:0.75rem; flex-wrap:wrap; justify-content:center;">
                <a href="<?= BASE_URL ?>/" class="btn btn-primary" style="font-size:0.9rem; padding:0.6rem 1.25rem;">
                    <i class="ph-bold ph-house"></i> Browse Posts
                </a>
                <a href="<?= BASE_URL ?>/register" class="btn btn-outline" style="font-size:0.9rem; padding:0.6rem 1.25rem;">
                    <i class="ph-bold ph-user-plus"></i> Register
                </a>
            </div>
        </div>
    </div>

</div>

<?php require_once APP_ROOT . '/app/views/layouts/footer.php'; ?>
