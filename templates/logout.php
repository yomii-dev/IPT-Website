<?php
// Logout: destroy session and remove cookie
session_start();
// Unset all session variables
$_SESSION = array();
// Destroy session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
session_destroy();
// Remove login cookie
setcookie('login', '', time() - 3600, '/');
header('Location: login.php');
exit();
?>
