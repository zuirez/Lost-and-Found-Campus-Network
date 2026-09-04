    </main> <!-- End Main Content Wrapper -->
    
    <script>
        // Simple script for mobile toggle if needed later
        document.querySelector('.mobile-toggle').addEventListener('click', function() {
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
    </script>
</body>
</html>
