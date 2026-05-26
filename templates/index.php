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

            <div class="flex items-center pr-2">
                <img src="/IPT-Website/assets/user_profile.svg" alt="Your Profile" class="h-7 w-auto select-none">
            </div>

        </nav>
    </div>
   
</body>

</html>