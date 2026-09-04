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
