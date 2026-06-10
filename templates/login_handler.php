<?php
// Simple login handler: set session and cookie then redirect to homepage
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // In real app validate credentials against DB. Here accept any input.
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    // Create session user identifier
    if ($email !== '') {
        $_SESSION['user_email'] = $email;
        // optional cookie for backward compatibility
        setcookie('login', $email, time() + 60 * 60 * 24, '/');
        header('Location: index.php');
        exit();
    }
}

// If reached here, redirect back to login
header('Location: login.php');
exit();

?>
