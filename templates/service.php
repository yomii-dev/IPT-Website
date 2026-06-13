<!--SERVICE PAGE-->
<?php 
session_start();
if (!isset($_SESSION['user_email'])) {
    // fallback: accept cookie-based login for backward compatibility
    if (isset($_COOKIE['login']) && $_COOKIE['login'] !== '') {
        // set session from cookie
        $_SESSION['user_email'] = $_COOKIE['login'];
    } else {
        header('Location: login.php');
        exit();
    }
}
$page = 'Service';
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>P3R | Service</title>
</head>

<body class="bg-[#121316] text-white min-h-screen flex flex-col justify-between font-sans">

    <!--NAVBAR LAYOUT-->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] .
        '/IPT-Website/includes/navbar.php'; ?>


    <!--MAIN CONTAINER-->
    <main class="w-full max-w-7xl mx-auto px-6 space-y-12 mb-16">

        <div class="relative rounded-xl overflow-hidden h-[380px] md:h-[420px]">

            <img src="/IPT-Website/assets/service_bg_card.jpg" alt="BG Card from top view" class="absolute inset-0 w-full h-full object-cover object-center brightness-[0.3]">

            <div class="relative h-full flex flex-col justify-center px-10 px-16 max-w-xl space-y-4">
                <h1 class="text-4xl md:text-[44px] font-black">
                    Looking for PC<br>to rent?
                </h1>
                <p class="text-[16px] text-gray-400">
                    Browse our curated collection of elite gaming rigs and high-performance workstations.
                    Choose the exact specs you need, select a flexible rental timeline that fits your project,
                    and deploy your dream setup instantly without the heavy upfront purchase cost.
            </div>

        </div>

        <div class="pt-2">
            <h2 class="text-2xl text-3xl font-black text-white">
                Featured Rental Dream PCs
            </h2>
        </div>

        <!--Add the backend here, yung katulad nung pinakita satin ni sir na sa admin side ito maeedit
            imbes na dito mo ieedit, you can remove this or change anything here-->
        <div class="space-y-6">

            <div class="bg-[#252A2E] rounded-xl p-6 flex flex-col flex-row gap-8 items-center">

                <div class="w-full md:w-[320px] shrink-0 aspect-square rounded-xl overflow-hidden">
                    <img src="/IPT-Website/assets/samplepic.jpg" alt="Dream PC Setup" class="w-full h-full object-cover">
                </div>

                <div class="flex-grow space-y-3 w-full pl-14">

                    <h3 class="text-3xl font-black text-white">Lorem ipsum dolor sit amet</h3>

                    <ul class="text-[16px] text-gray-400 space-y-1.5 list-disc list-inside">
                        <li>Lorem ipsum dolor sit amet</li>
                        <li>consectetur adipiscing elit sed do</li>
                        <li>eiusmod tempor incididunt ut labore</li>
                        <li>et dolore magna aliqua.</li>
                        <li>Ut enim ad minim veniam, quis nostrud</li>
                        <li>exercitation ullamco laboris</li>
                        <li>nisi ut aliquip ex ea commodo consequat</li>
                    </ul>
                    <button class="bg-gray-200 text-black font-bold text-[14px] px-6 py-2 rounded-lg hover:bg-white shadow-sm">
                        Rent
                    </button>
                </div>
            </div>

        </div>
    </main>

    <!--Hanggang dito lang may backend, di kasali footer-->

    <!--FOOTER LAYOUT-->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] .
        '/IPT-Website/includes/footer.php'; ?>

</body>

</html>
