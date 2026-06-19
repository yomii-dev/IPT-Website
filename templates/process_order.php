<?php
session_start();
$conn = require_once '../includes/mysqli.inc.php';

date_default_timezone_set('Asia/Manila');

// Ensure user and cart are active
if (!isset($_SESSION['User_Id'])) {
   header("Location: /IPT-Website/templates/checkout-status.php?error=not_logged_in");
  die();
}
if (empty($_SESSION['cart'])) {
    header("Location: /IPT-Website/templates/checkout-status.php?error=empty_cart");
    die();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn->begin_transaction();

    try {
        // 1. Insert into Orders table
        $stmtOrder = $conn->prepare("INSERT INTO Orders (User_Id, Street, Barangay, City, Province, Payment_Method, Payment_Status, Order_Date, Estimated_Delivery, Delivery_Date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NULL)");

        $userId = intval($_SESSION['User_Id']);
        $street = $_POST['street'];
        $barangay = $_POST['barangay'];
        $city = $_POST['city'];
        $province = $_POST['province'];
        $paymentMethod = $_POST['payment_method'];
        $paymentStatus = $_POST['payment_status'];
        $orderDate = $_POST['order_date'];
        $estDelivery = $_POST['estimated_delivery'];

        $stmtOrder->bind_param("issssssss", $userId, $street, $barangay, $city, $province, $paymentMethod, $paymentStatus, $orderDate, $estDelivery);
        $stmtOrder->execute();

        // Grab generated auto_increment primary key
        $orderId = $conn->insert_id;

        // 2. Insert items into OrderItems table
        // ponytail: Reuse statement inside loop for fast execution
        $stmtItem = $conn->prepare("INSERT INTO OrderItems (Order_Id, Product_Id, Quantity, Price_At_Purchase) VALUES (?, ?, ?, ?)");

        foreach ($_SESSION['cart'] as $item) {
            // Note: If you lack Product_Id in cart arrays, match it out by looking up item['name'] or add a product ID parameter into cart generation logic.
            // ponytail: Defaulting fallback mock matching logic or using item['product_id'] if available.
            $productId = isset($item['id']) ? intval($item['id']) : 1;
            $qty = intval($item['qty']);
            $price = floatval($item['price']);

            $stmtItem->bind_param("iiid", $orderId, $productId, $qty, $price);
            $stmtItem->execute();
        }

        $conn->commit();

        // Clear runtime checkout cart state
        unset($_SESSION['cart']);

        header("Location: /IPT-Website/templates/checkout-status.php?status=success");
        die();

    } catch (Exception $e) {
        $conn->rollback();
        die("Checkout failure: " . $e->getMessage());
    }
}
