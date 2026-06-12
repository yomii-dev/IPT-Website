<!--LOGIN PAGE-->
<?php
session_start();

$errorcode = $_GET['error'] ?? null;

switch ($errorcode) {
    case 1:
        $error = 'Incomplete Fields';
        break;
    case 2:
        $error = 'Account has not signed up yet';
        break;
    case 3:
        $error = 'This account has been banned!(for some reason)';
        break;
    case 4:
        $error = 'Incorrect Password';
        break;
    default:
        break;
}
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>P3R | Login</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-[#121316] text-white min-h-screen flex flex-col justify-between font-sans">

    <!--NAVBAR LAYOUT-->
    <div class="p-4">
        <nav class="bg-[#252A2E] rounded-xl px-6 py-3 flex items-center justify-between">

            <div class="flex items-center">
                <img src="/IPT-Website/assets/logo.svg" alt="P3R Logo" class="h-5">
            </div>

            <div class="flex items-center ml-13 gap-2">
                <a href="#" class="bg-[#D9D9D9] text-black font-medium px-4 py-1.5 rounded-lg text-xs">Home</a>
                <a href="#" class="bg-[#262930] text-gray-300 font-medium px-4 py-1.5 rounded-lg text-xs hover:bg-gray-700">Product</a>
                <a href="#" class="bg-[#262930] text-gray-300 font-medium px-4 py-1.5 rounded-lg text-xs hover:bg-gray-700">Service</a>
            </div>

            <div class="flex items-center gap-4 text-xs font-medium text-gray-400">
                <a href="login.php" class="text-white">Login</a>
                <a href="signup.php" class="hover:text-white">Sign Up</a>
            </div>

        </nav>
    </div>

    <!--MAIN CONTAINER-->

    <!--In this part, eto yung unang page ng P3R bago magdirect sa homepage to verify user first-->
    <main class="flex-grow flex items-center justify-center px-6 pb-12">

        <div class="bg-[#252A2E] rounded-xl p-6 w-full max-w-4xl flex gap-8 items-center">

            <div class="w-1/2 relative aspect-square rounded-2xl overflow-hidden hidden md:block">
                <img src="/IPT-Website/assets/login.jpg" alt="Login BG" class="w-full h-full object-cover">
                <img src="/IPT-Website/assets/logo.svg" alt="P3R Logo" class="absolute bottom-4 left-4 h-5">
            </div>

            <div class="w-full md:w-1/2 px-4">

                <h1 class="text-2xl font-black tracking-tight mb-2 flex items-center gap-2 flex-wrap">
                    Welcome to <img src="/IPT-Website/assets/logo.svg" alt="P3R Logo" class="h-4.5 inline-block">
                </h1>

                <p class="text-xs text-gray-400 mb-6">
                    Sign in to view your dream PC parts or rent PCs of your choice at [P3R] Part Picker PC Rental.
                </p>

                <!--This is where the data input by user matches to the save user-data in database, if not create new one-->
                <form action="login_handler.php" method="POST" class="space-y-4">

                    <input
                        type="email"
                        name="email"
                        placeholder="Email"
                        required
                        class="w-full bg-[#22252a] border border-gray-700 rounded-lg px-4 py-2.5 text-sm text-white placeholder-gray-500 focus:outline-none focus:border-gray-500"
                    >

                    <input
                        type="password"
                        name="password"
                        placeholder="Password"
                        required
                        class="w-full bg-[#22252a] border border-gray-700 rounded-lg px-4 py-2.5 text-sm text-white placeholder-gray-500 focus:outline-none focus:border-gray-500 m-0"
                    >
                    <p class="text-sm text-red-600 my-2">
                        <?= isset($error) ? $error : '' ?>
                    </p>


                    <button type="submit" name="login" class="w-full bg-[#D9D9D9] text-black font-bold text-sm py-2.5 rounded-lg hover:bg-gray-200 transition">
                        Login
                    </button> <!--If login clicks, it should show user name at profile icon in homepage, no need a profile pic-->

                </form>

                <p class="text-center text-xs text-gray-500 mt-4">
                    Don't have an account? <a href="signup.php" class="text-white font-bold hover:underline">Sign up</a>
                </p>

            </div>

        </div>

    </main>

</body>

</html>
