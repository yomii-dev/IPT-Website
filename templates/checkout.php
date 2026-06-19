<?php
session_start();
if (!isset($_SESSION['Email'])) {
    if (isset($_COOKIE['login']) && $_COOKIE['login'] !== '') {
        $_SESSION['Email'] = $_COOKIE['login'];
    } else {
        header('Location: login.php');
        exit();
    }
}
$page = 'Checkout';

// Date or some shit
date_default_timezone_set('Asia/Manila');
$order_date = date('Y-m-d');
$est_delivery = date('Y-m-d', strtotime('+3 days'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>P3R | Checkout</title>
</head>
<body class="bg-[#121316] text-white min-h-screen flex flex-col justify-between font-sans">

    <!-- Navbar -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/IPT-Website/includes/navbar.php'; ?>

    <main class="w-full max-w-3xl mx-auto px-6 py-8 mb-10">

    <!-- Payment details -->
    <form action="payment_details.php" method="POST" class="space-y-6">

        <div class="bg-[#252A2E] rounded-xl p-8 space-y-6 shadow-xl">
            <h1 class="text-3xl font-black text-white uppercase tracking-wide border-b border-gray-700 pb-4">
                Checkout Details
            </h1>

                <!--Shipping-->
                <div class="space-y-4">
                    <h2 class="text-sm font-bold text-gray-400 uppercase tracking-wider">Shipping Address</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-400 uppercase mb-1">Street</label>
                            <input type="text" name="street" required
                                class="w-full bg-[#121316] border border-gray-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-white transition">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-400 uppercase mb-1">Barangay</label>
                            <input type="text" name="barangay" required
                                class="w-full bg-[#121316] border border-gray-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-white transition">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-400 uppercase mb-1">City</label>
                            <input type="text" name="city" required
                                class="w-full bg-[#121316] border border-gray-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-white transition">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-400 uppercase mb-1">Province</label>
                            <select name="province" required
                                class="w-full bg-[#121316] border border-gray-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-white transition">
                                <option value="" disabled selected>Select Province</option>
                                <option value="Abra">Abra</option>
                                <option value="Agusan del Norte">Agusan del Norte</option>
                                <option value="Agusan del Sur">Agusan del Sur</option>
                                <option value="Aklan">Aklan</option>
                                <option value="Albay">Albay</option>
                                <option value="Antique">Antique</option>
                                <option value="Apayao">Apayao</option>
                                <option value="Aurora">Aurora</option>
                                <option value="Basilan">Basilan</option>
                                <option value="Bataan">Bataan</option>
                                <option value="Batanes">Batanes</option>
                                <option value="Batangas">Batangas</option>
                                <option value="Benguet">Benguet</option>
                                <option value="Biliran">Biliran</option>
                                <option value="Bohol">Bohol</option>
                                <option value="Bukidnon">Bukidnon</option>
                                <option value="Bulacan">Bulacan</option>
                                <option value="Cagayan">Cagayan</option>
                                <option value="Camarines Norte">Camarines Norte</option>
                                <option value="Camarines Sur">Camarines Sur</option>
                                <option value="Camiguin">Camiguin</option>
                                <option value="Capiz">Capiz</option>
                                <option value="Catanduanes">Catanduanes</option>
                                <option value="Cavite">Cavite</option>
                                <option value="Cebu">Cebu</option>
                                <option value="Cotabato">Cotabato</option>
                                <option value="Davao de Oro">Davao de Oro</option>
                                <option value="Davao del Norte">Davao del Norte</option>
                                <option value="Davao del Sur">Davao del Sur</option>
                                <option value="Davao Occidental">Davao Occidental</option>
                                <option value="Davao Oriental">Davao Oriental</option>
                                <option value="Dinagat Islands">Dinagat Islands</option>
                                <option value="Eastern Samar">Eastern Samar</option>
                                <option value="Eastern Samar">Epstein Island</option>
                                <option value="Guimaras">Guimaras</option>
                                <option value="Ifugao">Ifugao</option>
                                <option value="Ilocos Norte">Ilocos Norte</option>
                                <option value="Ilocos Sur">Ilocos Sur</option>
                                <option value="Iloilo">Iloilo</option>
                                <option value="Isabela">Isabela</option>
                                <option value="Kalinga">Kalinga</option>
                                <option value="La Union">La Union</option>
                                <option value="Laguna">Laguna</option>
                                <option value="Lanao del Norte">Lanao del Norte</option>
                                <option value="Lanao del Sur">Lanao del Sur</option>
                                <option value="Leyte">Leyte</option>
                                <option value="Maguindanao del Norte">Maguindanao del Norte</option>
                                <option value="Maguindanao del Sur">Maguindanao del Sur</option>
                                <option value="Marinduque">Marinduque</option>
                                <option value="Masbate">Masbate</option>
                                <option value="Metro Manila">Metro Manila</option>
                                <option value="Misamis Occidental">Misamis Occidental</option>
                                <option value="Misamis Oriental">Misamis Oriental</option>
                                <option value="Mountain Province">Mountain Province</option>
                                <option value="Negros Occidental">Negros Occidental</option>
                                <option value="Negros Oriental">Negros Oriental</option>
                                <option value="Northern Samar">Northern Samar</option>
                                <option value="Nueva Ecija">Nueva Ecija</option>
                                <option value="Nueva Vizcaya">Nueva Vizcaya</option>
                                <option value="Occidental Mindoro">Occidental Mindoro</option>
                                <option value="Oriental Mindoro">Oriental Mindoro</option>
                                <option value="Palawan">Palawan</option>
                                <option value="Pampanga">Pampanga</option>
                                <option value="Pangasinan">Pangasinan</option>
                                <option value="Quezon">Quezon</option>
                                <option value="Quirino">Quirino</option>
                                <option value="Rizal">Rizal</option>
                                <option value="Romblon">Romblon</option>
                                <option value="Samar">Samar</option>
                                <option value="Sarangani">Sarangani</option>
                                <option value="Siquijor">Siquijor</option>
                                <option value="Sorsogon">Sorsogon</option>
                                <option value="South Cotabato">South Cotabato</option>
                                <option value="Southern Leyte">Southern Leyte</option>
                                <option value="Sultan Kudarat">Sultan Kudarat</option>
                                <option value="Sulu">Sulu</option>
                                <option value="Surigao del Norte">Surigao del Norte</option>
                                <option value="Surigao del Sur">Surigao del Sur</option>
                                <option value="Tarlac">Tarlac</option>
                                <option value="Tawi-Tawi">Tawi-Tawi</option>
                                <option value="Zambales">Zambales</option>
                                <option value="Zamboanga del Norte">Zamboanga del Norte</option>
                                <option value="Zamboanga del Sur">Zamboanga del Sur</option>
                                <option value="Zamboanga Sibugay">Zamboanga Sibugay</option>
                            </select>
                        </div>
                    </div>
                </div>

                <hr class="border-gray-700">

                <!--Payment method-->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-semibold text-gray-400 uppercase mb-1">Payment Method</label>
                        <select name="payment_method"
                            class="w-full bg-[#121316] border border-gray-700 rounded-lg px-4 py-2.5 text-white focus:outline-none focus:border-white transition">
                            <option value="COD">Cash on Delivery (COD)</option>
                            <option value="GCash">GCash</option>
                            <option value="Paymaya">Paymaya</option>
                            <option value="Card">Credit / Debit Card</option>
                            <option value="PayPal">Paypal</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-400 uppercase mb-1">Payment Status</label>
                        <input type="hidden" name="payment_status" value="Pending">
                        <input type="text" value="Pending" disabled
                            class="w-full bg-[#121316]/50 border border-gray-800 text-gray-500 rounded-lg px-4 py-2.5 font-bold cursor-not-allowed">
                    </div>
                </div>

                <!-- Date -->
                <div class="bg-[#121316] border border-gray-700 rounded-xl p-4 grid grid-cols-2 gap-4 text-center">
                    <div>
                        <span class="block text-xs font-semibold text-gray-400 uppercase mb-1">Order Date</span>
                        <span class="text-lg font-mono font-bold text-white"><?php echo $order_date; ?></span>
                        <input type="hidden" name="order_date" value="<?php echo $order_date; ?>">
                    </div>
                    <div>
                        <span class="block text-xs font-semibold text-gray-400 uppercase mb-1">Estimated Delivery</span>
                        <span class="text-lg font-mono font-bold text-gray-300"><?php echo $est_delivery; ?></span>
                        <input type="hidden" name="estimated_delivery" value="<?php echo $est_delivery; ?>">
                    </div>
                </div>

                <!-- Just jarvis the arrow icon lmao -->
                <button type="submit"
                    class="w-full bg-transparent border border-gray-700 font-bold text-[14px] uppercase tracking-wider py-3.5 rounded-lg text-gray-300 hover:text-white hover:border-white transition cursor-pointer flex items-center justify-center gap-2 group">
                    <span>Proceed to Payment</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 transform transition-transform duration-200 group-hover:translate-x-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </button>

            </form>
        </div>

    </main>

    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/IPT-Website/includes/footer.php'; ?>

</body>
</html>
