<?php
session_start();

// Flash message helper
// EXAMPLE - flash('register_success', 'You are now registered and can log in', 'success');
// DISPLAY IN VIEW - echo flash('register_success');
function flash($name = '', $message = '', $type = 'success') {
    if (!empty($name)) {
        if (!empty($message) && empty($_SESSION[$name])) {
            if (!empty($_SESSION[$name])) {
                unset($_SESSION[$name]);
            }
            if (!empty($_SESSION[$name . '_type'])) {
                unset($_SESSION[$name . '_type']);
            }
            
            $_SESSION[$name] = $message;
            $_SESSION[$name . '_type'] = $type;
        } elseif (empty($message) && !empty($_SESSION[$name])) {
            $type = !empty($_SESSION[$name . '_type']) ? $_SESSION[$name . '_type'] : 'success';
            $msg = addslashes($_SESSION[$name]);
            
            echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "' . $type . '",
                        title: "Notice",
                        text: "' . $msg . '",
                        confirmButtonColor: "var(--primary-color)",
                        background: "var(--card-bg)",
                        color: "var(--text-light)",
                        backdrop: "rgba(0,0,0,0.6)"
                    });
                });
            </script>';
            
            unset($_SESSION[$name]);
            unset($_SESSION[$name . '_type']);
        }
    }
}

// Ensure user is logged in
function requireAuth() {
    if (!isset($_SESSION['user_id'])) {
        echo '<!DOCTYPE html><html><head><script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script></head><body>';
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "warning",
                    title: "Authentication Required",
                    text: "You must be logged in to access this page.",
                    confirmButtonText: "Log In",
                    confirmButtonColor: "var(--primary-color, #4361ee)",
                    background: "var(--card-bg, #1e1e1e)",
                    color: "var(--text-light, #f8f9fa)",
                    backdrop: "rgba(0,0,0,0.6)",
                    allowOutsideClick: false
                }).then((result) => {
                    window.location.href = "' . BASE_URL . '/login";
                });
            });
        </script>';
        echo '</body></html>';
        exit();
    }
}
