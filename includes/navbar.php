<!-- use require_once($_SERVER['DOCUMENT_ROOT'] . '/IPT-Website/includes/navbar.php') ->
<!-- you will need to set a $page variable in the page to be able to highlight it c: -->

<!--NAVBAR LAYOUT-->
<?php
$highlighted = 'bg-[#D9D9D9] text-black';
$unhighlighted = 'bg-[#262930] text-gray-300 hover:bg-gray-700';
?>
<div class="p-4">
    <nav class="bg-[#252A2E] rounded-xl px-6 py-3 flex items-center justify-between">

        <div class="flex items-center">
            <img src="/IPT-Website/assets/logo.svg" alt="P3R Logo" class="h-5">
        </div>

        <div class="flex items-center gap-2">
            <a href="index.php"
                class="<?= $page == 'Home' ? $highlighted : $unhighlighted ?>
                text-black font-medium px-4 py-1.5 rounded-lg text-xs">Home</a>
            <a href="product.php"
                class="<?= $page == 'Products' ? $highlighted : $unhighlighted ?>
                font-medium px-4 py-1.5 rounded-lg text-xs">Products</a>
            <a href="service.php"
                class="<?= $page == 'Service' ? $highlighted : $unhighlighted ?>
                font-medium px-4 py-1.5 rounded-lg text-xs">Service</a>
        </div>
        <!--Chore: In this part, dapat lalabas yung logout tas didirect siya sa login page-->
        <div class="flex items-center pr-2">
            <img src="/IPT-Website/assets/user_profile.svg" alt="Your Profile" class="h-7 w-auto select-none">
        </div>

        <!--Chore: if-else for when user is logged-in or not-->
        <!--<div class="flex items-center gap-4 text-xs font-medium text-gray-400">
            <a href="login.php" class="text-white">Login</a>
            <a href="signup.php" class="hover:text-white">Sign Up</a>
        </div>-->
    </nav>
</div>
