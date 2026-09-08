        </div>
    </div>
</div>

<script>
    const toggleBtn  = document.getElementById('adminToggle');
    const sidebar    = document.getElementById('adminSidebar');
    const overlay    = document.getElementById('adminOverlay');

    function showToggle() {
        if (window.innerWidth <= 900) {
            if (toggleBtn) toggleBtn.style.display = 'flex';
        } else {
            if (toggleBtn) toggleBtn.style.display = 'none';
            sidebar.classList.remove('open');
            if (overlay) overlay.style.display = 'none';
        }
    }

    window.addEventListener('resize', showToggle);
    showToggle();

    if (toggleBtn) {
        toggleBtn.addEventListener('click', function () {
            sidebar.classList.toggle('open');
            if (overlay) overlay.style.display = sidebar.classList.contains('open') ? 'block' : 'none';
        });
    }

    if (overlay) {
        overlay.addEventListener('click', function () {
            sidebar.classList.remove('open');
            overlay.style.display = 'none';
        });
    }

    // Logout confirmation
    const logoutBtn = document.getElementById('admin-logout-btn');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', function (e) {
            e.preventDefault();
            const href = this.href;
            Swal.fire({
                title: 'Log out?',
                text: 'You will be returned to the login page.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, log out',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#ef4444',
                cancelButtonColor: 'var(--primary-color)',
                background: '#fff',
                color: 'var(--text-primary)',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            });
        });
    }
</script>

<!-- Mobile overlay -->
<div id="adminOverlay"
     style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.45); z-index:99; backdrop-filter:blur(2px);"></div>

</body>
</html>
