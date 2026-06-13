<!--PRODUCT PAGE-->
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
$page = 'Products';
$categories = isset($_GET['categories']) && is_array($_GET['categories'])
    ? $_GET['categories']
    : [];
$lowestPrice = isset($_GET['lowest_price']) && $_GET['lowest_price'] !== ''
    ? (float) $_GET['lowest_price']
    : null;
$highestPrice = isset($_GET['highest_price']) && $_GET['highest_price'] !== ''
    ? (float) $_GET['highest_price']
    : null;

if ($lowestPrice !== null && $highestPrice !== null && $lowestPrice > $highestPrice) {
    [$lowestPrice, $highestPrice] = [$highestPrice, $lowestPrice];
}

// ensure cart exists
if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// get product info from db
try {
    $conn = require_once '../includes/mysqli.inc.php';

    $query = 'SELECT * FROM ProductsInfo WHERE 1=1';
    $params = [];
    $types = '';

    if (!empty($categories)) {
        $placeholders = implode(',', array_fill(0, count($categories), '?'));
        $query .= " AND Product_Category IN ($placeholders)";
        $types .= str_repeat('s', count($categories));
        $params = array_merge($params, $categories);
    }

    if ($lowestPrice !== null && $highestPrice !== null) {
        $query .= ' AND Product_Price BETWEEN ? AND ?';
        $types .= 'dd';
        $params[] = $lowestPrice;
        $params[] = $highestPrice;
    } elseif ($lowestPrice !== null) {
        $query .= ' AND Product_Price >= ?';
        $types .= 'd';
        $params[] = $lowestPrice;
    } elseif ($highestPrice !== null) {
        $query .= ' AND Product_Price <= ?';
        $types .= 'd';
        $params[] = $highestPrice;
    }

    if (empty($params)) {
        $result = $conn->query('SELECT * FROM ProductsInfo');
    } else {
        $stmt = $conn->prepare($query);
        $bindParams = [$types];
        foreach ($params as $index => $value) {
            $bindParams[] = &$params[$index];
        }
        call_user_func_array([$stmt, 'bind_param'], $bindParams);
        $stmt->execute();
        $result = $stmt->get_result();
    }
} catch (mysqli_sql_exception $e) {
    die("SQL Error: $e");
}

// add products to cart
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['cart'])) {
        // sanitize / cast inputs
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $qty = isset($_POST['qty']) ? (int) $_POST['qty'] : 0;
        $price = isset($_POST['price']) ? (float) $_POST['price'] : 0.0;

        if ($qty > 0 && $name !== '') {
            $found = false;
            // iterate by key, not by reference
            foreach ($_SESSION['cart'] as $key => $item) {
                if (isset($item['name']) && $item['name'] === $name) {
                    // update qty in-place using the key
                    $_SESSION['cart'][$key]['qty'] =
                        (int) $_SESSION['cart'][$key]['qty'] + $qty;
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $_SESSION['cart'][] = [
                    'name' => $name,
                    'price' => $price,
                    'qty' => $qty,
                ];
            }
        }
    } elseif (isset($_POST['remove'])) {
        // Remove by name (submitted from the single-row form below)
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        if ($name !== '') {
            foreach ($_SESSION['cart'] as $key => $item) {
                if (isset($item['name']) && $item['name'] === $name) {
                    unset($_SESSION['cart'][$key]);
                    // reindex to keep array numeric keys contiguous (optional)
                    $_SESSION['cart'] = array_values($_SESSION['cart']);
                    break;
                }
            }
        }
    } elseif (isset($_POST['checkout'])) {
        // Clear cart on successful checkout
        $_SESSION['cart'] = [];
        $user = isset($_SESSION['user_name'])
            ? urlencode($_SESSION['user_name'])
            : 'Guest';
        header('Location: product.php?success=1&user=' . $user);
        die();
    }
}

$cart_items = $_SESSION['cart'];
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>P3R | Product</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('success') == '1') {
                const username = urlParams.get('user') || 'Customer';
                alert('Thank you for your purchase ' + decodeURIComponent(username));
                window.history.replaceState({}, document.title, window.location.pathname);
            }
        });
    </script>
</head>

<body class="bg-[#121316] text-white min-h-screen flex flex-col justify-between font-sans">

    <!--NAVBAR LAYOUT-->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] .
        '/IPT-Website/includes/navbar.php'; ?>

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

            <!--FILTER SIDEBAR CONTif (!isset($_SESSION['user_email'])) {
    // fallback: accept cookie-based login for backward compatibility
    if (isset($_COOKIE['login']) && $_COOKIE['login'] !== '') {
        // set session from cookie
        $_SESSION['user_email'] = $_COOKIE['login'];
    } else {
        header('Location: login.php');
        exit();
    }
}
AINER-->
            <div class="w-full lg:w-[280px] shrink-0 bg-[#252A2E] border border-gray-800/60 rounded-xl p-6 space-y-6 text-white sticky top-4 max-h-dvh overflow-y-auto">

                <form action="product.php" method="GET" class="space-y-6">
                     <div class="flex items-center justify-between">
                        <h2 class="text-lg font-bold tracking-wide text-gray-300">FILTER</h2>
                        <a class="text-sm text-gray-400 hover:text-white" href="product.php">Clear all</a>
                    </div>

                    <!--SEARCH LAYOUT-->
                    <div class="relative">
                        <input type="text" placeholder="Search here" class="w-full bg-[#121316] text-sm text-gray-300
                        placeholder-gray-500 border border-gray-700/60 rounded-lg px-3 py-2 focus:outline-none focus:border-gray-500">
                    </div>

                    <!--PC PARTS SELECTION-->
                    <details class="space-y-3 cursor-pointer select-none" open>

                        <summary class="text-base font-extrabold text-gray-300">CATEGORY</summary>

                        <div class="space-y-2.5">
                            <label class="flex items-center gap-3 text-sm text-gray-200">
                                <input type="checkbox" name="categories[]" value="cpu" class="w-3.5 h-3.5"
                                    <?= in_array('cpu', $categories) ? 'checked' : '' ?>>
                                <span>CPU</span>
                            </label>
                            <label class="flex items-center gap-3 text-sm text-gray-200">
                                <input type="checkbox" name="categories[]" value="ram" class="w-3.5 h-3.5"
                                    <?= in_array('ram', $categories) ? 'checked' : '' ?>>
                                <span>RAM</span>
                            </label>
                            <label class="flex items-center gap-3 text-sm text-gray-200">
                                <input type="checkbox" name="categories[]" value="gpu" class="w-3.5 h-3.5"
                                    <?= in_array('gpu', $categories) ? 'checked' : '' ?>>
                                <span>GPU</span>
                            </label>
                            <label class="flex items-center gap-3 text-sm text-gray-200">
                                <input type="checkbox" name="categories[]" value="motherboard" class="w-3.5 h-3.5"
                                    <?= in_array('motherboard', $categories) ? 'checked' : '' ?>>
                                <span>Motherboard</span>
                            </label>
                            <label class="flex items-center gap-3 text-sm text-gray-200">
                                <input type="checkbox" name="categories[]" value="psu" class="w-3.5 h-3.5"
                                    <?= in_array('psu', $categories) ? 'checked' : '' ?>>
                                <span>PSU</span>
                            </label>
                            <label class="flex items-center gap-3 text-sm text-gray-200">
                                <input type="checkbox" name="categories[]" value="cooling" class="w-3.5 h-3.5"
                                    <?= in_array('cooling', $categories) ? 'checked' : '' ?>>
                                <span>Cooling System</span>
                            </label>
                            <label class="flex items-center gap-3 text-sm text-gray-200">
                                <input type="checkbox" name="categories[]" value="peripherals" class="w-3.5 h-3.5"
                                    <?= in_array('peripherals', $categories) ? 'checked' : '' ?>>
                                <span>Peripherals</span>
                            </label>
                            <label class="flex items-center gap-3 text-sm text-gray-200">
                                <input type="checkbox" name="categories[]" value="thermal paste" class="w-3.5 h-3.5"
                                    <?= in_array('thermal paste', $categories) ? 'checked' : '' ?>>
                                <span>Thermal Paste</span>
                            </label>
                            <label class="flex items-center gap-3 text-sm text-gray-200">
                                <input type="checkbox" name="categories[]" value="bundle" class="w-3.5 h-3.5"
                                    <?= in_array('bundle', $categories) ? 'checked' : '' ?>>
                                <span>Bundle</span>
                            </label>
                        </div>

                    </details>

                    <!--PRICE RANGE SELECTION-->
                    <details class="space-y-3 cursor-pointer select-none">

                        <summary class="text-base font-extrabold text-gray-300">PRICE RANGE</summary>

                        <div class="space-y-3">
                            <label class="block">
                                <span class="mb-1.5 block text-sm text-gray-300">Lowest price</span>
                                <input
                                    type="number"
                                    name="lowest_price"
                                    min="0"
                                    step="0.01"
                                    value="<?= htmlspecialchars((string) ($lowestPrice ?? '')) ?>"
                                    placeholder="Min price"
                                    class="w-full bg-[#121316] text-sm text-gray-300 placeholder-gray-500 border border-gray-700/60 rounded-lg px-3 py-2 focus:outline-none focus:border-gray-500"
                                >
                            </label>
                            <label class="block">
                                <span class="mb-1.5 block text-sm text-gray-300">Highest price</span>
                                <input
                                    type="number"
                                    name="highest_price"
                                    min="0"
                                    step="0.01"
                                    value="<?= htmlspecialchars((string) ($highestPrice ?? '')) ?>"
                                    placeholder="Max price"
                                    class="w-full bg-[#121316] text-sm text-gray-300 placeholder-gray-500 border border-gray-700/60 rounded-lg px-3 py-2 focus:outline-none focus:border-gray-500"
                                >
                            </label>
                        </div>

                    </details>

                    <!--Chore: make this prettier lmaoaoa-->
                    <button type="submit" class="w-full relative group overflow-hidden rounded-lg p-[1px] focus:outline-none cursor-pointer font-mono font-bold">
                        <span class="absolute inset-0 bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-600 rounded-lg uppercase tracking-wider font-semibold opacity-70 group-hover:opacity-100 transition duration-300"></span>
                        <span class="relative block px-4 py-2.5 rounded-[7px] bg-[#121316] text-sm text-gray-200 font-bold tracking-wider uppercase text-center transition dynamic-gradient group-hover:bg-transparent group-hover:text-white duration-300">
                            Apply Filters
                        </span>
                    </button>
                </form>

                <!--Cart Header + no. of items-->
                <div class="bg-[#252A2E] border border-gray-800/60 rounded-xl p-1.5 space-y-6 text-white">
                    <div class="flex items-center justify-between border-b border-gray-700 pb-2">
                        <h2 class="text-lg font-bold tracking-wide text-gray-300">Cart</h2>
                        <span class="text-xs bg-[#121316] px-2 py-1 rounded-full text-gray-400">
                            <?php echo empty($cart_items)
                                ? 'Empty'
                                : count($cart_items) . ' items'; ?>
                        </span>
                    </div>
                </div>

                <!--Cart Items-->
                <div class="space-y-3 text-sm text-gray-400">
                    <?php if (!empty($cart_items)): ?>
                        <?php
                        $total_price = 0;
                        foreach ($cart_items as $item) {
                            if (!empty($item['name'])) {
                                $total_price +=
                                    (float) $item['price'] * (int) $item['qty'];
                            }
                        }
                        ?>
                        <!--Total Price-->
                        <div class="flex justify-between items-center pb-2 border-b border-gray-700 text-white font-bold">
                            <span>Total Price:</span>
                            <span class="text-emerald-400">₱<?php echo number_format(
                                $total_price,
                                2,
                            ); ?></span>
                        </div>

                        <div class="space-y-3 max-h-48 overflow-y-auto pr-1">
                            <?php foreach ($cart_items as $key => $item): ?>
                                <?php if (empty($item['name'])) {
                                    continue;
                                } ?>
                                <form method="POST" action="product.php" class="flex justify-between items-center bg-[#121316] p-2 rounded-lg text-white">
                                    <div>
                                        <p class="font-semibold">
                                            <?php echo htmlspecialchars(
                                                $item['name'],
                                            ); ?>
                                        </p>
                                        <p class="text-xs text-gray-400">
                                            ₱<?php echo htmlspecialchars(
                                                $item['price'],
                                            ); ?>
                                            x <?php echo htmlspecialchars(
                                                $item['qty'],
                                            ); ?>
                                        </p>
                                    </div>
                                    <input
                                        type="hidden"
                                        name="name"
                                        value="<?php echo htmlspecialchars(
                                            $item['name'],
                                        ); ?>"
                                    >
                                        <!--Remove button-->
                                    <input type="submit" name="remove" class="text-red-500 hover:text-red-400 text-xs cursor-pointer" value="Remove">
                                </form>
                            <?php endforeach; ?>
                        </div>

                        <!--CHECKOUT BUTTON-->
                        <!--Chore: add functionality-->
                         <div class="pt-2 border-t border-gray-700/50">
                            <form method="POST" action="product.php">
                                <button type="submit" name="checkout" class="w-full relative group overflow-hidden bg-transparent border-emerald-500 
                                text-emerald-400 font-mono font-bold py-2.5 px-4 rounded-lg text-center tracking-widest uppercase transition duration-300 cursor-pointer text-sm shadow-gray-500 hover:shadow-gray-700">
                                    <span class="absolute inset-0 w-full h-full bg-emerald-500 -translate-x-full group-hover:translate-x-0 transition-transform duration-300 ease-out -z-10"></span>
                                    <span class="relative group-hover:text-[#121316] flex items-center justify-center gap-2">
                                        Checkout
                                    </span>
                                </button>
                            </form>
                         </div>
                    <?php else: ?>
                         <p class="text-center py-2 italic text-gray-500">No items in cart</p>
                    <?php endif; ?>

                </div>

            </div>

            <!--PRODUCTS-->
            <div class="flex-grow w-full grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-5"><!--Dont remove it-->

                <!--Here, similar din sa service php but I added 4 column instead of 1. Again, sa admin side maeedit
                para hindi na sa code nito mageedit just like what sir revealed to us last 3 weeks ago.-->
                <?php if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {

                        $name = htmlspecialchars($row['Product_Name']);
                        $desc = htmlspecialchars($row['Product_Desc']);
                        $category = htmlspecialchars($row['Product_Category']);
                        $price = htmlspecialchars($row['Product_Price']);
                        $stock = htmlspecialchars($row['InStock']);
                        $image = '../assets/' . htmlspecialchars($row['Image']);
                        ?>
                                    <form method="POST" class="bg-[#252A2E] rounded-xl aspect-[3/4] w-full p-4 flex flex-col justify-between">
                                        <img class="aspect-square object-cover rounded-lg" src="<?= $image ?>" alt="<?= $name ?>">
                                        <div class="mt-2">
                                            <p class="font-bold"><?= $name ?></p>
                                            <p class="text-emerald-400 font-semibold">₱<?= $price ?></p>
                                            <p class="text-xs text-gray-400">Stock: <?= $stock ?></p>
                                        </div>
                                        <div class="mt-4 space-y-2">
                                            <input
                                                type="number"
                                                name="qty"
                                                value="1"
                                                min="1"
                                                max="<?= $stock ?>"
                                                class="w-full bg-[#121316] text-white border border-gray-700 rounded p-1 text-center"
                                            >
                                            <input type="hidden" name="name" value="<?= $name ?>">
                                            <input type="hidden" name="price" value="<?= $price ?>">
                                            <input
                                                type="submit"
                                                name="cart"
                                                value="Add to Cart"
                                                class="w-full bg-blue-600 hover:bg-blue-500 text-white font-medium py-1.5 px-3 rounded text-sm cursor-pointer transition"
                                            >
                                        </div>
                                    </form>
                            <?php
                    }
                } else {
                    echo "<p class='text-gray-500 italic col-span-full text-center'>0 results</p>";
                } ?>

            </div>

        </div>

    </main>

    <!--Hanggang dito lang may backend, di kasali footer-->

    <!--FOOTER LAYOUT-->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] .
        '/IPT-Website/includes/footer.php'; ?>

</body>

</html>
