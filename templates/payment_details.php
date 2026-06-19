<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    if (isset($_COOKIE['login']) && $_COOKIE['login'] !== '') {
        $_SESSION['user_email'] = $_COOKIE['login'];
    } else {
        header('Location: login.php');
        exit();
    }
}
$page = 'Payment Details';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: checkout.php');
    exit();
}

$street = isset($_POST['street']) ? htmlspecialchars($_POST['street']) : '';
$barangay = isset($_POST['barangay']) ? htmlspecialchars($_POST['barangay']) : '';
$city = isset($_POST['city']) ? htmlspecialchars($_POST['city']) : '';
$province = isset($_POST['province']) ? htmlspecialchars($_POST['province']) : '';
$payment_method = isset($_POST['payment_method']) ? htmlspecialchars($_POST['payment_method']) : 'COD';
$payment_status = isset($_POST['payment_status']) ? htmlspecialchars($_POST['payment_status']) : 'Pending';
$order_date = isset($_POST['order_date']) ? htmlspecialchars($_POST['order_date']) : date('Y-m-d');
$est_delivery = isset($_POST['estimated_delivery']) ? htmlspecialchars($_POST['estimated_delivery']) : date('Y-m-d', strtotime('+3 days'));

$total_price = 0;
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        if (!empty($item['name'])) {
            $total_price += (float)$item['price'] * (int)$item['qty'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>P3R | Payment Details</title>
</head>
<body class="bg-[#121316] text-white min-h-screen flex flex-col justify-between font-sans">

    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/IPT-Website/includes/navbar.php'; ?>

    <main class="w-full max-w-3xl mx-auto px-6 py-8 mb-10 flex flex-col gap-6">
        
        <div class="bg-[#252A2E] rounded-xl p-6 shadow-xl border border-gray-800/40 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Amount Due</h2>
                <p class="text-3xl font-black text-emerald-400 font-mono mt-1">₱<?php echo number_format($total_price, 2); ?></p>
            </div>
            <div class="text-left md:text-right">
                <h2 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Selected Method</h2>
                <span class="inline-block bg-[#121316] border border-gray-700 px-3 py-1 rounded-md text-sm font-bold text-white mt-1 uppercase tracking-wide">
                    <?php echo $payment_method; ?>
                </span>
            </div>
        </div>

        <div class="bg-[#252A2E] rounded-xl p-8 space-y-6 shadow-xl border border-gray-800/40">
            <h1 class="text-3xl font-black text-white uppercase tracking-wide border-b border-gray-700 pb-4">
                Complete Payment
            </h1>

            <form action="process_order.php" method="POST" class="space-y-6">
                
                <input type="hidden" name="street" value="<?php echo $street; ?>">
                <input type="hidden" name="barangay" value="<?php echo $barangay; ?>">
                <input type="hidden" name="city" value="<?php echo $city; ?>">
                <input type="hidden" name="province" value="<?php echo $province; ?>">
                <input type="hidden" name="payment_method" value="<?php echo $payment_method; ?>">
                <input type="hidden" name="payment_status" value="<?php echo $payment_status; ?>">
                <input type="hidden" name="order_date" value="<?php echo $order_date; ?>">
                <input type="hidden" name="estimated_delivery" value="<?php echo $est_delivery; ?>">
                <input type="hidden" name="total_amount" value="<?php echo $total_price; ?>">

                <?php if ($payment_method === 'GCash' || $payment_method === 'Paymaya' || $payment_method === 'PayPal'): ?>
                    <div class="space-y-4">
                        <div class="bg-[#121316] border border-gray-700 rounded-xl p-4 text-center space-y-2">
                            <p class="text-sm text-gray-400 font-medium">Scan to pay using your mobile wallet app</p>
                            <div class="w-40 h-40 bg-white mx-auto rounded-lg flex items-center justify-center p-2">
                                
                                <img src="../assets/clueless.png" 
                                    alt="Payment QR Code" 
                                    class="w-full h-full object-contain">
                                    
                            </div>
                            <p class="text-xs text-gray-500 italic">Merchant Reference: P3R-<?php echo time(); ?></p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-gray-400 uppercase mb-1">Account Number / Phone</label>
                                <input type="text" name="account_number" placeholder="09XXXXXXXXX" required 
                                    class="w-full bg-[#121316] border border-gray-700 rounded-lg px-4 py-2.5 text-white placeholder-gray-600 focus:outline-none focus:border-white transition font-mono">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-400 uppercase mb-1">Transaction Reference ID</label>
                                <input type="text" name="reference_id" placeholder="13-Digit Ref No." required 
                                    class="w-full bg-[#121316] border border-gray-700 rounded-lg px-4 py-2.5 text-white placeholder-gray-600 focus:outline-none focus:border-white transition font-mono">
                            </div>
                        </div>
                    </div>

                <?php elseif ($payment_method === 'Card'): ?>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-400 uppercase mb-1">Cardholder Name</label>
                            <input type="text" name="card_name" required 
                                class="w-full bg-[#121316] border border-gray-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-white transition">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-400 uppercase mb-1">Card Number</label>
                            <input type="text" name="card_number" placeholder="•••• •••• •••• ••••" required 
                                class="w-full bg-[#121316] border border-gray-700 rounded-lg px-4 py-2.5 text-white placeholder-gray-600 focus:outline-none focus:border-white transition font-mono tracking-widest">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-gray-400 uppercase mb-1">Expiry Date</label>
                                <input type="text" name="card_expiry" placeholder="MM/YY" required 
                                    class="w-full bg-[#121316] border border-gray-700 rounded-lg px-4 py-2.5 text-white placeholder-gray-600 focus:outline-none focus:border-white transition font-mono">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-400 uppercase mb-1">Security Code (CVV)</label>
                                <input type="password" name="card_cvv" placeholder="•••" maxlength="4" required 
                                    class="w-full bg-[#121316] border border-gray-700 rounded-lg px-4 py-2.5 text-white placeholder-gray-600 focus:outline-none focus:border-white transition font-mono">
                            </div>
                        </div>
                    </div>

                <?php else: ?>
                    <div class="bg-[#121316] border border-gray-700 rounded-xl p-6 text-center space-y-3">
                        <div class="w-12 h-12 rounded-full bg-emerald-500/10 text-emerald-400 mx-auto flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="space-y-1">
                            <h3 class="font-bold text-lg text-white">No advance payment required</h3>
                            <p class="text-sm text-gray-400 max-w-md mx-auto">Please prepare exactly <span class="text-emerald-400 font-bold font-mono">₱<?php echo number_format($total_price, 2); ?></span> to hand over to the rider when your rig handles arrive at your shipping destination.</p>
                        </div>
                    </div>
                <?php endif; ?>

                <hr class="border-gray-700">

                <div class="text-sm space-y-2 text-gray-400 bg-[#121316] border border-gray-800 p-4 rounded-xl">
                    <p class="flex justify-between"><span class="font-semibold text-gray-500">Deliver To:</span> <span class="text-gray-300"><?php echo "$street, $barangay, $city, $province"; ?></span></p>
                    <p class="flex justify-between"><span class="font-semibold text-gray-500">Est. Arrival:</span> <span class="text-gray-300 font-mono"><?php echo $est_delivery; ?></span></p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <a href="checkout.php" 
                        class="w-full bg-transparent border border-gray-700 font-bold text-[14px] uppercase tracking-wider py-3.5 rounded-lg text-gray-400 hover:text-white hover:border-white transition cursor-pointer flex items-center justify-center gap-2 group text-center order-2 sm:order-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 transform transition-transform duration-200 group-hover:-translate-x-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                        </svg>
                        <span>Go Back</span>
                    </a>

                    <button type="submit" 
                        class="w-full bg-transparent border border-emerald-500 text-emerald-400 hover:bg-emerald-500 hover:text-[#121316] font-bold text-[14px] uppercase tracking-wider py-3.5 rounded-lg transition cursor-pointer flex items-center justify-center gap-2 group order-1 sm:order-2">
                        <span>Confirm Order</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 transform transition-transform duration-200 group-hover:translate-x-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </button>
                </div>

            </form>
        </div>

    </main>

    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/IPT-Website/includes/footer.php'; ?>

</body>
</html>