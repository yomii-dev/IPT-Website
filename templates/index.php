<!--HOME PAGE-->
<?php $page = 'Home'; ?>
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
    <?php require_once $_SERVER['DOCUMENT_ROOT'] .
        '/IPT-Website/includes/navbar.php'; ?>

    <!--MAIN CONTAINER-->
    <main class="w-full max-w-7xl mx-auto px-6 py-8 space-y-12 mb-10">

        <div class="relative rounded-xl h-[380px]">

            <img src="/IPT-Website/assets/home_bg_card.jpg" alt="BG Image" class="absolute inset-0 w-full h-full object-cover object-center brightness-[0.3]">

            <div class="relative h-full flex flex-col justify-center px-16 max-w-2xl space-y-4">
                <h1 class="text-4xl text-[44px] font-black text-white">
                    Your ultimate setup, piece<br>by piece, on your terms.
                </h1>
                <p class="text-[16px] text-gray-400 max-w-xl">
                    P3R gives you instant access to high-end custom setups. Pick your specs, rent your dream PC set, and conquer any game or workload without the heavy upfront cost.
                </p>

                <div class="flex flex-wrap gap-4 pt-2">
                    <a href="product.php" class="bg-transparent border border-gray-700 font-bold text-[14px]
                    px-6 py-2 rounded-lg text-gray-300 hover:text-white hover:border-white">
                        Shop Now
                    </a>
                    <a href="#" class="bg-transparent border border-gray-700 font-bold text-[14px]
                    px-6 py-2 rounded-lg text-gray-300 hover:text-white hover:border-white">
                        Learn more
                    </a>
                </div>

            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-[#252A2E] flex-row rounded-xl p-6 flex gap-8 items-center">

                <div class="w-[320px] shrink-0 aspect-square rounded-xl overflow-hidden">
                    <img src="/IPT-Website/assets/samplepic.jpg" alt="What P3R offers picture" class="w-full h-full object-cover">
                </div>

                <div class="flex-grow space-y-3 w-full pl-14 text-left">
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
    <?php require_once $_SERVER['DOCUMENT_ROOT'] .
        '/IPT-Website/includes/footer.php'; ?>

</body>

</html>
