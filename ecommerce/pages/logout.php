<?php
session_start();

// Remove only user session variable
if (isset($_SESSION['user_id'])) {
    unset($_SESSION['user_id']);
}

// Optionally clear all session data
$_SESSION = array();
if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params['path'], $params['domain'],
        $params['secure'], $params['httponly']
    );
}
session_destroy();

// Redirect to the login page
header('Location: login.php');
exit();
?>