<!--SERVICE PAGE-->

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
    <div class="p-4">
        <nav class="bg-[#252A2E] rounded-xl px-6 py-3 flex items-center justify-between">
            
            <div class="flex items-center">
                <img src="/IPT-Website/assets/logo.svg" alt="P3R Logo" class="h-5">
            </div>

            <div class="flex items-center gap-2">
                <a href="index.php" class="bg-[#262930] text-gray-300 font-medium px-4 py-1.5 rounded-lg text-xs hover:bg-gray-700">Home</a>
                <a href="product.php" class="bg-[#262930] text-gray-300 font-medium px-4 py-1.5 rounded-lg text-xs hover:bg-gray-700">Product</a>
                <a href="service.php" class="bg-[#D9D9D9] text-black font-medium px-4 py-1.5 rounded-lg text-xs">Service</a>
            </div>

            <div class="flex items-center pr-2">
                <img src="/IPT-Website/assets/user_profile.svg" alt="Your Profile" class="h-7 w-auto select-none">
            </div>

        </nav>
    </div>

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
                        <li><a href="#" class="hover:text-white transition">Home</a></li>
                        <li><a href="#" class="hover:text-white transition">Product</a></li>
                        <li><a href="#" class="hover:text-white transition">Service</a></li>
                    </ol>
                </div>

                <div class="space-y-4 min-w-[100px]">
                    <h4 class="text-white font-bold text-[14px]">Platform</h4>
                    <ol class="space-y-3 text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Facebook</a></li>
                        <li><a href="#" class="hover:text-white transition">LinkedIn</a></li>
                        <li><a href="#" class="hover:text-white transition">Github</a></li>
                    </ol>
                </div>

                <div class="space-y-4 min-w-[100px] flex flex-col justify-between">

                    <div class="space-y-4">
                        <h4 class="text-white font-bold text-[14px]">Legal</h4>
                        <ol class="space-y-3 text-gray-400">
                            <li><a href="#" class="hover:text-white transition">Privacy Policy</a></li>
                            <li><a href="#" class="hover:text-white transition">Terms of Service</a></li>
                            <li><a href="#" class="hover:text-white transition">Cookie Policy</a></li>
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