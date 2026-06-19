<?php
session_start();
$page = 'Rental';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>P3R | Rental</title>
</head>

<body class="bg-[#121316] text-white min-h-screen flex flex-col justify-between font-sans">

    <!--NAVBAR LAYOUT-->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] .
        '/IPT-Website/includes/navbar.php'; ?>


    <!--MAIN CONTAINER-->



    <!--FOOTER LAYOUT-->

    <?php require_once $_SERVER['DOCUMENT_ROOT'] .
        '/IPT-Website/includes/footer.php'; ?>
</body>
