<!--LOGIN HANDLER-->
<?php
session_start();

function returnLogin($errorcode)
{
    header("Location: login.php?error=$errorcode");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit();
}

$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$pass = isset($_POST['password']) ? $_POST['password'] : '';

if ($email === '' || $pass === '') {
    returnLogin(1);
}

$conn = require_once $_SERVER['DOCUMENT_ROOT'] .
    '/IPT-Website/includes/mysqli.inc.php';

$stmt = $conn->prepare(
    'SELECT Id, Username, Email, User_Pass, Is_Banned FROM UserAccounts WHERE Email = ? LIMIT 1',
);
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

if (!$user) {
    returnLogin(2);
}

if ((int) $user['Is_Banned'] === 1) {
    returnLogin(3);
}

if (password_verify($pass, $user['User_Pass'])) {
    $updateStmt = $conn->prepare(
        'UPDATE UserAccounts SET Last_Login = NOW() WHERE Id = ?',
    );
    $updateStmt->bind_param('i', $user['Id']);
    $updateStmt->execute();
    $updateStmt->close();

    $_SESSION['user_id'] = $user['Id'];
    $_SESSION['user_email'] = $user['Email'];
    $_SESSION['user_name'] = $user['Username'];
    setcookie('login', $user['Email'], time() + 60 * 60 * 24, '/');
    header('Location: index.php');
    exit();
}

returnLogin(4);


?>
