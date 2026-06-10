<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: signup.php');
    exit();
}

$firstName = isset($_POST['First_Name']) ? trim($_POST['First_Name']) : '';
$lastName = isset($_POST['Last_Name']) ? trim($_POST['Last_Name']) : '';
$username = isset($_POST['Username']) ? trim($_POST['Username']) : '';
$email = isset($_POST['Email']) ? trim($_POST['Email']) : '';
$password = isset($_POST['User_Pass']) ? $_POST['User_Pass'] : '';

if ($firstName === '' || $lastName === '' || $username === '' || $email === '' || $password === '') {
    header('Location: signup.php');
    exit();
}

$conn = require_once $_SERVER['DOCUMENT_ROOT'] . '/IPT-Website/includes/mysqli.inc.php';

$checkStmt = $conn->prepare('SELECT Id FROM UserAccounts WHERE Username = ? OR Email = ? LIMIT 1');
$checkStmt->bind_param('ss', $username, $email);
$checkStmt->execute();
$checkResult = $checkStmt->get_result();

if ($checkResult->num_rows > 0) {
    $checkStmt->close();
    header('Location: signup.php');
    exit();
}

$checkStmt->close();

$idResult = $conn->query('SELECT COALESCE(MAX(Id), 0) + 1 AS NextId FROM UserAccounts');
$nextIdRow = $idResult ? $idResult->fetch_assoc() : null;
$nextId = $nextIdRow ? (int)$nextIdRow['NextId'] : 1;

$stmt = $conn->prepare('INSERT INTO UserAccounts (Id, Email, User_Pass, Username, First_Name, Last_Name, Date_Created, Last_Login, Is_Banned) VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW(), 0)');
$stmt->bind_param('isssss', $nextId, $email, $password, $username, $firstName, $lastName);

if ($stmt->execute()) {
    $stmt->close();
    header('Location: login.php');
    exit();
}

$stmt->close();
header('Location: signup.php');
exit();

?>
