<!--SERVICE PAGE-->
<?php $page = 'Service'; ?>
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
    <footer class="bg-[#050608] w-full pt-16 pb-6 px-8 md:px-16 text-[13px] text-gray-400 font-normal">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-start gap-12 mb-16">

            <div class="space-y-6 max-w-sm">

                <div class="space-y-2">
                    <img src="/IPT-Website/assets/logo.svg" alt="P3R Logo" class="h-6 w-auto">
                    <p class="text-gray-200 font-medium">
                        Part Picker PC Rental<br>
                        A Rental Shop Platform
                    </p>
                </div>

                <p class="text-gray-400 text-[12px]">
                    74 Malvar Street Barangay<br>
                    Poblacion IV, Santo Tomas City,<br>
                    Batangas, Philippines
                </p>

                <div class="flex gap-12 pt-2">

                    <div class="space-y-1">
                        <p class="text-white font-bold text-[12px]">Phone Number:</p>
                        <p class="text-gray-400">#123 456 7890</p>
                    </div>

                    <div class="space-y-1">
                        <p class="text-white font-bold text-[12px]">Email:</p>
                        <p class="text-gray-400">p3rofficial@gmail.com</p>
                    </div>

                </div>

            </div>

            <div class="flex flex-col md:flex-row md:gap-24 items-start w-full md:w-auto">

                <div class="space-y-4 min-w-[100px]">
                    <h4 class="text-white font-bold text-[14px]">Quick links</h4>
                    <ol class="space-y-3 text-gray-400">
                        <li><a href="index.php" class="hover:text-white">Home</a></li>
                        <li><a href="product.php" class="hover:text-white">Product</a></li>
                        <li><a href="service.php" class="hover:text-white">Service</a></li>
                    </ol>
                </div>

                <div class="space-y-4 min-w-[100px]">
                    <h4 class="text-white font-bold text-[14px]">Platform</h4>
                    <ol class="space-y-3 text-gray-400">
                        <li><a href="#" class="hover:text-white">Facebook</a></li>
                        <li><a href="#" class="hover:text-white">LinkedIn</a></li>
                        <li><a href="#" class="hover:text-white">Github</a></li>
                    </ol>
                </div>

                <div class="space-y-4 min-w-[100px] flex flex-col justify-between">

                    <div class="space-y-4">
                        <h4 class="text-white font-bold text-[14px]">Legal</h4>
                        <ol class="space-y-3 text-gray-400">
                            <li><a href="#" class="hover:text-white">Privacy Policy</a></li>
                            <li><a href="#" class="hover:text-white">Terms of Service</a></li>
                            <li><a href="#" class="hover:text-white">Cookie Policy</a></li>
                        </ol>
                    </div>

                    <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
                            class="border border-gray-700 bg-transparent text-gray-300 hover:text-white hover:border-white
                            px-5 py-2.5 rounded-lg text-[13px] font-medium mt-12">
                        Back to top
                    </button>

                </div>

            </div>

        </div>

        <div class="w-full text-center text-[12px] text-gray-400 mt-4">
            @2026 P3R | All rights reserved
        </div>

    </footer>

</body>

</html>
