<!-- use require_once($_SERVER['DOCUMENT_ROOT'] . '/IPT-Website/includes/footer.php'); ->

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
                    <li><a href="/IPT-Website/templates/index.php" class="hover:text-white">Home</a></li>
                    <li><a href="/IPT-Website/templates/product.php" class="hover:text-white">Product</a></li>
                    <li><a href="/IPT-Website/templates/service.php" class="hover:text-white">Service</a></li>
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
