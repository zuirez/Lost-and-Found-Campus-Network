    </main>

    <footer class="app-footer">
        <div class="footer-container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <a href="/Lost-and-Found-Campus-Network/index.php" class="footer-logo">
                        <div class="brand-icon">
                            <i class="ph-bold ph-magnifying-glass"></i>
                        </div>
                        <div class="footer-brand-text">
                            Lost<span>&</span>Found
                        </div>
                    </a>
                    <p class="footer-tagline">
                        An unofficial community-driven lost and found network for American International University-Bangladesh (AIUB). Helping students and faculty recover lost belongings safely and quickly.
                    </p>
                    <div class="footer-campus-badge">
                        <i class="ph-fill ph-map-pin"></i> 408/1, Kuratoli, Khilkhet, Dhaka 1229
                    </div>
                </div>

                <div class="footer-col">
                    <h4 class="footer-col-title">Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="/Lost-and-Found-Campus-Network/index.php"><i class="ph ph-caret-right"></i> Home Feed</a></li>
                        <li><a href="/Lost-and-Found-Campus-Network/posts/lost"><i class="ph ph-caret-right"></i> Lost Items</a></li>
                        <li><a href="/Lost-and-Found-Campus-Network/posts/found"><i class="ph ph-caret-right"></i> Found Items</a></li>
                        <li><a href="/Lost-and-Found-Campus-Network/posts/create.php"><i class="ph ph-caret-right"></i> Post a Report</a></li>
                        <li><a href="/Lost-and-Found-Campus-Network/login.php"><i class="ph ph-caret-right"></i> Student / Faculty Login</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4 class="footer-col-title">Contact & Support</h4>
                    <div class="footer-card">
                        <div class="footer-card-title">
                            <i class="ph-fill ph-envelope"></i> Questions or Reports?
                        </div>
                        <p>
                            For inquiries, feedback, or assistance regarding lost and found items on campus, feel free to reach out directly.
                        </p>
                        <a href="mailto:rijoanmaruf@gmail.com" class="footer-card-link">
                            <i class="ph-bold ph-envelope-simple"></i> rijoanmaruf@gmail.com
                        </a>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> <strong>Lost & Found Campus Network</strong> (Unofficial). AIUB Community. All rights reserved.</p>
                <ul class="footer-bottom-links">
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Community Guidelines</a></li>
                    <li><a href="#">Help Desk</a></li>
                </ul>
            </div>
        </div>
    </footer>
    
    <script>
        const mobileToggle = document.querySelector('.mobile-toggle');
        if (mobileToggle) {
            mobileToggle.addEventListener('click', function() {
                const nav = document.querySelector('.navbar-nav');
                const actions = document.querySelector('.navbar-actions .btn-outline');
                
                if (nav.style.display === 'flex') {
                    nav.style.display = 'none';
                    if (actions) actions.style.display = 'none';
                } else {
                    nav.style.display = 'flex';
                    nav.style.flexDirection = 'column';
                    nav.style.position = 'absolute';
                    nav.style.top = '70px';
                    nav.style.left = '0';
                    nav.style.width = '100%';
                    nav.style.background = 'var(--nav-bg)';
                    nav.style.backdropFilter = 'blur(12px)';
                    nav.style.padding = '1rem 0';
                    nav.style.borderBottom = '1px solid var(--border-color)';
                    
                    if (actions) {
                        actions.style.display = 'inline-flex';
                        actions.style.margin = '1rem auto';
                    }
                }
            });
        }
    </script>
</body>
</html>
