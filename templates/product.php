<!--PRODUCT PAGE-->
<?php
$page = "Products";

try {
    $conn = require_once "../includes/mysqli.inc.php";
    $query = "SELECT * FROM ProductsInfo";

    $result = $conn->query($query);
} catch (mysqli_sql_exception $e) {
    die("SQL Error: $e");
}
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>P3R | Product</title>
</head>

<body class="bg-[#121316] text-white min-h-screen flex flex-col justify-between font-sans">

    <!--NAVBAR LAYOUT-->
    <?php require_once $_SERVER["DOCUMENT_ROOT"] .
        "/IPT-Website/includes/navbar.php"; ?>

    <!--MAIN CONTENT-->
    <main class="w-full max-w-7xl mx-auto px-6 space-y-8 mb-16">

        <div class="relative rounded-xl overflow-hidden h-[160px] md:h-[180px] w-full">

            <img src="/IPT-Website/assets/product_bg_card.jpg" alt="Discover All PC Parts Background" class="absolute inset-0
            w-full h-full object-cover object-center brightness-[0.4]">

            <div class="relative h-full flex items-center px-12 md:px-16">
                <h1 class="text-3xl md:text-4xl font-black text-white">
                    Discover All PC Parts
                </h1>
            </div>

        </div>

        <!--PRODUCT CARD LAYOUT-->
        <div class="flex flex-col lg:flex-row gap-8 items-start w-full">

            <!--FILTER SIDEBAR CONTAINER-->
            <form class="w-full lg:w-[280px] shrink-0 bg-[#252A2E] border border-gray-800/60 rounded-xl p-6 space-y-6 text-white sticky top-4">

                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-bold tracking-wide text-gray-300">FILTER</h2>
                    <button type="reset" class="text-sm text-gray-400 hover:text-white">Clear all</button>
                </div>

                <!--SEARCH LAYOUT-->
                <div class="relative">
                    <input type="text" placeholder="Search here" class="w-full bg-[#121316] text-sm text-gray-300
                    placeholder-gray-500 border border-gray-700/60 rounded-lg px-3 py-2 focus:outline-none focus:border-gray-500">
                </div>

                <!--PC PARTS SELECTION-->
                <div class="space-y-3">

                    <h3 class="text-base font-extrabold text-gray-300">CATEGORY</h3>

                    <div class="space-y-2.5">
                        <label class="flex items-center gap-3 text-sm text-gray-200">
                            <input type="checkbox" name="category" value="cpu" class="w-3.5 h-3.5">
                            <span>CPU</span>
                        </label>
                        <label class="flex items-center gap-3 text-sm text-gray-200">
                            <input type="checkbox" name="category" value="ram" class="w-3.5 h-3.5">
                            <span>RAM</span>
                        </label>
                        <label class="flex items-center gap-3 text-sm text-gray-200">
                            <input type="checkbox" name="category" value="gpu" class="w-3.5 h-3.5">
                            <span>GPU</span>
                        </label>
                        <label class="flex items-center gap-3 text-sm text-gray-200">
                            <input type="checkbox" name="category" value="motherboard" class="w-3.5 h-3.5">
                            <span>Motherboard</span>
                        </label>
                        <label class="flex items-center gap-3 text-sm text-gray-200">
                            <input type="checkbox" name="category" value="psu" class="w-3.5 h-3.5">
                            <span>PSU</span>
                        </label>
                        <label class="flex items-center gap-3 text-sm text-gray-200">
                            <input type="checkbox" name="category" value="cooling" class="w-3.5 h-3.5">
                            <span>Cooling System</span>
                        </label>
                    </div>

                </div>

                <!--PRICE RANGE SELECTION-->
                <div class="space-y-3">

                    <h3 class="text-base font-extrabold text-gray-300">PRICE RANGE</h3>

                    <div class="space-y-2.5">
                        <label class="flex items-center gap-3 text-sm text-gray-200">
                            <input type="checkbox" name="price" value="0-1000" class="w-3.5 h-3.5">
                            <span>Free - ₱1 000</span>
                        </label>
                        <label class="flex items-center gap-3 text-sm text-gray-200">
                            <input type="checkbox" name="price" value="1000-3000" class="w-3.5 h-3.5">
                            <span>₱1 000 - ₱3 000</span>
                        </label>
                        <label class="flex items-center gap-3 text-sm text-gray-200">
                            <input type="checkbox" name="price" value="3000-5000" class="w-3.5 h-3.5">
                            <span>₱3 000 - ₱5 000</span>
                        </label>
                        <label class="flex items-center gap-3 text-sm text-gray-200">
                            <input type="checkbox" name="price" value="5000-7000" class="w-3.5 h-3.5">
                            <span>₱5 000 - ₱7 000</span>
                        </label>
                        <label class="flex items-center gap-3 text-sm text-gray-200">
                            <input type="checkbox" name="price" value="7000-9000" class="w-3.5 h-3.5">
                            <span>₱7 000 - ₱9 000</span>
                        </label>
                        <label class="flex items-center gap-3 text-sm text-gray-200">
                            <input type="checkbox" name="price" value="9000+" class="w-3.5 h-3.5">
                            <span>Over ₱9 000</span>
                        </label>
                    </div>

            </form>

        </div>

            <!--PRODUCTS-->
            <div class="flex-grow w-full grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-5"><!--Dont remove it-->

                <!--Here, similar din sa service php but I added 4 column instead of 1. Again, sa admin side maeedit
                    para hindi na sa code nito mageedit just like what sir revealed to us last 3 weeks ago.-->

                <?php if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $name = htmlspecialchars($row["Product_Name"]);
                        $desc = htmlspecialchars($row["Product_Desc"]);
                        $category = htmlspecialchars($row["Product_Category"]);
                        $price = htmlspecialchars($row["Product_Price"]);
                        $stock = htmlspecialchars($row["InStock"]);
                        $image = "../assets/" . htmlspecialchars($row["Image"]);

                        echo '<div class="bg-[#252A2E] rounded-xl aspect-[3/4] w-full p-4">';
                        echo "<img class=\"aspect-square\" src=\"$image\" alt=\"$name\">";
                        echo $name . "<br>";
                        echo $desc . "<br>";
                        echo "₱$price" . "<br>";
                        echo "Qty: $stock";
                        echo "</div>";
                    }
                } else {
                    echo "0 results";
                } ?>
            </div>

        </div>

    </main>

    <!--Hanggang dito lang may backend, di kasali footer-->

    <!--FOOTER LAYOUT-->
    <?php require_once $_SERVER["DOCUMENT_ROOT"] .
        "/IPT-Website/includes/footer.php"; ?>

</body>

</html>
