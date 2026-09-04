    </main> <!-- End Main Content Wrapper -->

    <!-- Global App Footer -->
    <footer class="app-footer">
        <div class="container" style="padding: 0;">
            <ul class="footer-links">
                <li><a href="/Lost-and-Found-Campus-Network/index.php">Home</a></li>
                <li><a href="/Lost-and-Found-Campus-Network/posts/lost">Lost Items</a></li>
                <li><a href="/Lost-and-Found-Campus-Network/posts/found">Found Items</a></li>
                <li><a href="/Lost-and-Found-Campus-Network/login.php">Login</a></li>
            </ul>
            <p><strong>Lost & Found Campus Network</strong> &bull; American International University-Bangladesh (AIUB)</p>
            <p style="margin-top: 0.5rem; font-size: 0.8rem;">Developed with HTML5, CSS3, JavaScript, PHP & MySQL (MVC Architecture)</p>
        </div>
    </footer>
    
    <script>
        // Script for mobile toggle
        const mobileToggle = document.querySelector('.mobile-toggle');
        if (mobileToggle) {
            mobileToggle.addEventListener('click', function() {
                const nav = document.querySelector('.navbar-nav');
                const actions = document.querySelector('.navbar-actions .btn-outline');
                
                if (nav.style.display === 'flex') {
                    nav.style.display = 'none';
                    if(actions) actions.style.display = 'none';
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
                    
                    if(actions) {
                        actions.style.display = 'inline-flex';
                        actions.style.margin = '1rem auto';
                    }
                }
            });
        }
    </script>
</body>
</html>
