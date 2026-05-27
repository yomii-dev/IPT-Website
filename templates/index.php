<!--HOME PAGE-->
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>P3R | Home</title>
</head>

<body class="bg-[#121316] text-white min-h-screen flex flex-col justify-between font-sans">

    <!--NAVBAR LAYOUT-->
    <div class="p-4">
        <nav class="bg-[#252A2E] rounded-xl px-6 py-3 flex items-center justify-between">
            
            <div class="flex items-center">
                <img src="/IPT-Website/assets/logo.svg" alt="P3R Logo" class="h-5">
            </div>

            <div class="flex items-center gap-2">
                <a href="index.php" class="bg-[#D9D9D9] text-black font-medium px-4 py-1.5 rounded-lg text-xs">Home</a>
                <a href="product.php" class="bg-[#262930] text-gray-300 font-medium px-4 py-1.5 rounded-lg text-xs hover:bg-gray-700">Product</a>
                <a href="service.php" class="bg-[#262930] text-gray-300 font-medium px-4 py-1.5 rounded-lg text-xs hover:bg-gray-700">Service</a>
            </div>
            <!--In this part, dapat lalabas yung logout tas didirect siya sa login page-->
            <div class="flex items-center pr-2">
                <img src="/IPT-Website/assets/user_profile.svg" alt="Your Profile" class="h-7 w-auto select-none">
            </div>

        </nav>
    </div>
    
    <!--MAIN CONTAINER-->
    <main class="w-full max-w-7xl mx-auto px-6 py-8 space-y-12 mb-10">

        <div class="relative rounded-xl h-[380px]">

            <img src="/IPT-Website/assets/home_bg_card.jpg" alt="BG Image" class="absolute inset-0 w-full h-full object-cover object-center brightness-[0.3]">

            <div class="relative h-full flex flex-col justify-center px-10 px-16 max-w-2xl space-y-4">
                <h1 class="text-4xl text-[44px] font-black text-white">
                    Your ultimate setup, piece<br>by piece, on your terms.
                </h1>
                <p class="text-[16px] text-gray-400 max-w-xl">
                    P3R gives you instant access to high-end custom setups. Pick your specs, rent your dream PC set, and conquer any game or workload without the heavy upfront cost.
                </p>

                <div class="flex flex-wrap gap-4 pt-2">
                    <a href="product.php" class="bg-transparent text-white border border-gray-700 font-bold text-[14px] 
                    px-6 py-2 rounded-lg text-gray-300 hover:text-white hover:border-white">
                        Shop Now
                    </a>
                    <a href="#" class="bg-transparent text-white border border-gray-700 font-bold text-[14px] 
                    px-6 py-2 rounded-lg text-gray-300 hover:text-white hover:border-white">
                        Learn more
                    </a>
                </div>
                
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-[#252A2E] flex-row rounded-xl p-6 flex flex-col gap-8 items-center">
                
                <div class="w-[320px] shrink-0 aspect-square rounded-xl overflow-hidden">
                    <img src="/IPT-Website/assets/samplepic.jpg" alt="What P3R offers picture" class="w-full h-full object-cover">
                </div>

                <div class="flex-grow space-y-3 w-full pl-14 text-center text-left">
                    <h2 class="text-3xl font-black text-white">What does P3R offer?</h2>
                    <p class="text-xs text-[18px] text-gray-400">
                        P3R lets consumers buy PCs / PC parts and rent PCs based on their needs and preferences for work, 
                        gaming, or creative tasks. It helps users choose components, build their preferred setup, and access 
                        performant computers without full purchase cost.
                    </p>
                </div>

            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <div class="bg-[#252A2E] rounded-xl p-6 flex flex-col items-center text-center space-y-3">
                <div class="w-16 h-16 flex items-center justify-center">
                    <img src="/IPT-Website/assets/test.png" alt="Test Approved Icon" class="w-full h-full object-contain">
                </div>
                <h3 class="text-2xl font-black text-white uppercase">
                    Rigorous<br>Testing
                </h3>
                <p class="text-[16px] text-gray-400">
                    Every component is stress-tested before dispatch for guaranteed stability.
                </p>
            </div>

            <div class="bg-[#252A2E] rounded-xl p-6 flex flex-col items-center text-center space-y-3">
                <div class="w-16 h-16 flex items-center justify-center">
                    <img src="/IPT-Website/assets/custom.png" alt="Custom Build Icon" class="w-full h-full object-contain">
                </div>
                <h3 class="text-2xl font-black text-white uppercase">
                    Custom<br>Builder
                </h3>
                <p class="text-[16px] text-gray-400">
                    Select each individual component piece-by-piece for ultimate control over your setup.
                </p>
            </div>

            <div class="bg-[#252A2E] rounded-xl p-6 flex flex-col items-center text-center space-y-3">
                <div class="w-16 h-16 flex items-center justify-center">
                    <img src="/IPT-Website/assets/cost.png" alt="Cost-To-Performance Icon" class="w-full h-full object-contain">
                </div>
                <h3 class="text-2xl font-black text-white uppercase">
                    Cost-To-<br>Performance
                </h3>
                <p class="text-[16px] text-gray-400">
                    Compare side-by-side technical specs against real-time pricing to find the best hardware value.
                </p>
            </div>

            <div class="bg-[#252A2E] rounded-xl p-6 flex flex-col items-center text-center space-y-3">
                <div class="w-16 h-16 flex items-center justify-center">
                    <img src="/IPT-Website/assets/time.png" alt="Maximum Flexibility Icon" class="w-full h-full object-contain">
                </div>
                <h3 class="text-2xl font-black text-white uppercase">
                    Maximum<br>Flexibility
                </h3>
                <p class="text-[16px] text-gray-400">
                    Rent by day, week, or month on your own terms.
                </p>
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