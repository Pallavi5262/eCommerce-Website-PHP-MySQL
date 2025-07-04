<?php
session_start();
// Remove only admin session variable
if (isset($_SESSION['admin_id'])) {
    unset($_SESSION['admin_id']);
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
header('Location: login.php');
exit;
?>