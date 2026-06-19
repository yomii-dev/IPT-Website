<?php
session_start();

if (!isset($_SESSION['user_email'])) {
    if (isset($_COOKIE['login']) && $_COOKIE['login'] !== '') {
        $_SESSION['user_email'] = $_COOKIE['login'];
    } else {
        header('Location: login.php');
        exit();
    }
}

$conn = require_once $_SERVER['DOCUMENT_ROOT'] . '/IPT-Website/includes/mysqli.inc.php';

if (!isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {
    $userStmt = $conn->prepare('SELECT Id FROM UserAccounts WHERE Email = ? LIMIT 1');
    $userStmt->bind_param('s', $_SESSION['user_email']);
    $userStmt->execute();
    $userResult = $userStmt->get_result();
    if ($userRow = $userResult->fetch_assoc()) {
        $_SESSION['user_id'] = (int) $userRow['Id'];
    }
    $userStmt->close();
}

if ((int) ($_SESSION['user_id'] ?? 0) !== 1) {
    header('Location: index.php');
    exit();
}

$page = 'Admin';
$status = $_GET['status'] ?? '';
$statusMessages = [
    'added' => 'Product added.',
    'updated' => 'Product updated.',
    'deleted' => 'Product deleted.',
    'invalid' => 'Fill in name, description, category, and price.',
];
$statusMessage = $statusMessages[$status] ?? '';
$editingProduct = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $productId = isset($_POST['product_id']) ? (int) $_POST['product_id'] : 0;
    $name = isset($_POST['product_name']) ? trim($_POST['product_name']) : '';
    $description = isset($_POST['product_desc']) ? trim($_POST['product_desc']) : '';
    $category = isset($_POST['product_category']) ? trim($_POST['product_category']) : '';
    $price = isset($_POST['product_price']) ? trim($_POST['product_price']) : '';
    $image = isset($_POST['product_image']) ? trim($_POST['product_image']) : '';
    $image = $image === '' ? null : $image;
    $inStock = isset($_POST['product_stock']) ? (int) $_POST['product_stock'] : 0;
    $onSale = isset($_POST['on_sale']) ? 1 : 0;

    if ($action === 'delete' && $productId > 0) {
        $deleteStmt = $conn->prepare('DELETE FROM ProductsInfo WHERE Product_Id = ?');
        $deleteStmt->bind_param('i', $productId);
        $deleteStmt->execute();
        $deleteStmt->close();
        header('Location: admin.php?status=deleted');
        exit();
    }

    if ($name === '' || $description === '' || $category === '' || !is_numeric($price)) {
        header('Location: admin.php?status=invalid');
        exit();
    }

    $price = (int) $price;

    if ($action === 'update' && $productId > 0) {
        $updateStmt = $conn->prepare(
            'UPDATE ProductsInfo SET Product_Name = ?, Product_Desc = ?, Product_Category = ?, Product_Price = ?, InStock = ?, OnSale = ?, Last_Edited = NOW(), Image = ? WHERE Product_Id = ?',
        );
        $updateStmt->bind_param(
            'sssiiisi',
            $name,
            $description,
            $category,
            $price,
            $inStock,
            $onSale,
            $image,
            $productId,
        );
        $updateStmt->execute();
        $updateStmt->close();
        header('Location: admin.php?status=updated');
        exit();
    }

    if ($action === 'add') {
        $addStmt = $conn->prepare(
            'INSERT INTO ProductsInfo (Product_Name, Product_Desc, Product_Category, Product_Price, InStock, OnSale, Date_Added, Last_Edited, Image) VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW(), ?)',
        );
        $addStmt->bind_param(
            'sssiiis',
            $name,
            $description,
            $category,
            $price,
            $inStock,
            $onSale,
            $image,
        );
        $addStmt->execute();
        $addStmt->close();
        header('Location: admin.php?status=added');
        exit();
    }
}

if (isset($_GET['edit'])) {
    $editId = (int) $_GET['edit'];
    if ($editId > 0) {
        $editStmt = $conn->prepare('SELECT * FROM ProductsInfo WHERE Product_Id = ? LIMIT 1');
        $editStmt->bind_param('i', $editId);
        $editStmt->execute();
        $editResult = $editStmt->get_result();
        $editingProduct = $editResult->fetch_assoc() ?: null;
        $editStmt->close();
    }
}

$productsResult = $conn->query('SELECT * FROM ProductsInfo ORDER BY Product_Id DESC');
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>P3R | Admin</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-[#121316] text-white min-h-screen flex flex-col justify-between font-sans">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/IPT-Website/includes/navbar.php'; ?>

    <main class="w-full max-w-7xl mx-auto px-6 py-8 space-y-8 mb-10">
        <div class="flex items-center justify-between gap-4 flex-wrap">
            <div>
                <h1 class="text-3xl font-black">Admin Panel</h1>
            </div>
            <?php if ($statusMessage !== ''): ?>
                <div class="rounded-lg border border-gray-700 bg-[#252A2E] px-4 py-2 text-sm text-gray-200">
                    <?php echo htmlspecialchars($statusMessage); ?>
                </div>
            <?php endif; ?>
        </div>

        <section class="grid grid-cols-1 xl:grid-cols-[380px_1fr] gap-6 items-start">
            <form method="POST" class="bg-[#252A2E] border border-gray-800 rounded-xl p-6 space-y-4 sticky top-4">
                <div>
                    <h2 class="text-xl font-bold"><?php echo $editingProduct ? 'Edit Product' : 'Add Product'; ?></h2>
                    <p class="text-sm text-gray-400">One form for add and update.</p>
                </div>

                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars((string) ($editingProduct['Product_Id'] ?? '')); ?>">

                <label class="block space-y-1">
                    <span class="text-sm text-gray-300">Name</span>
                    <input type="text" name="product_name" value="<?php echo htmlspecialchars($editingProduct['Product_Name'] ?? ''); ?>" class="w-full rounded-lg bg-[#121316] border border-gray-700 px-3 py-2 text-sm">
                </label>

                <label class="block space-y-1">
                    <span class="text-sm text-gray-300">Description</span>
                    <textarea name="product_desc" rows="4" class="w-full rounded-lg bg-[#121316] border border-gray-700 px-3 py-2 text-sm"><?php echo htmlspecialchars($editingProduct['Product_Desc'] ?? ''); ?></textarea>
                </label>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <label class="block space-y-1">
                        <span class="text-sm text-gray-300">Category</span>
                        <input type="text" name="product_category" value="<?php echo htmlspecialchars($editingProduct['Product_Category'] ?? ''); ?>" class="w-full rounded-lg bg-[#121316] border border-gray-700 px-3 py-2 text-sm">
                    </label>
                    <label class="block space-y-1">
                        <span class="text-sm text-gray-300">Price</span>
                        <input type="number" name="product_price" min="0" step="1" value="<?php echo htmlspecialchars((string) ($editingProduct['Product_Price'] ?? '')); ?>" class="w-full rounded-lg bg-[#121316] border border-gray-700 px-3 py-2 text-sm">
                    </label>
                </div>

                <label class="block space-y-1">
                    <span class="text-sm text-gray-300">Image filename</span>
                    <input type="text" name="product_image" value="<?php echo htmlspecialchars($editingProduct['Image'] ?? ''); ?>" class="w-full rounded-lg bg-[#121316] border border-gray-700 px-3 py-2 text-sm" placeholder="example.jpg">
                </label>

                <div class="flex flex-wrap gap-4 text-sm text-gray-200">
                    <label class="block space-y-1">
                        <span class="text-sm text-gray-300">Stock</span>
                        <input type="number" name="product_stock" min="0" step="1" value="<?php echo htmlspecialchars((string) ($editingProduct['InStock'] ?? '')); ?>" class="w-full rounded-lg bg-[#121316] border border-gray-700 px-3 py-2 text-sm">
                    </label>

                    <label class="flex items-end gap-2 pb-3">
                        <input type="checkbox" name="on_sale" <?php echo !empty($editingProduct) && (int) $editingProduct['OnSale'] === 1 ? 'checked' : ''; ?>>
                        On sale
                    </label>
                </div>

                <div class="flex gap-3">
                    <button type="submit" name="action" value="<?php echo $editingProduct ? 'update' : 'add'; ?>" class="flex-1 rounded-lg bg-white text-black font-semibold px-4 py-2 text-sm">
                        <?php echo $editingProduct ? 'Save changes' : 'Add product'; ?>
                    </button>
                    <?php if ($editingProduct): ?>
                        <a href="admin.php" class="rounded-lg border border-gray-700 px-4 py-2 text-sm text-gray-300">Cancel</a>
                    <?php endif; ?>
                </div>
            </form>

            <div class="bg-[#252A2E] border border-gray-800 rounded-xl p-6 overflow-x-auto">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-bold">Products</h2>
                    <span class="text-sm text-gray-400"><?php echo $productsResult ? $productsResult->num_rows : 0; ?> total</span>
                </div>

                <table class="w-full text-sm text-left">
                    <thead class="text-gray-400 uppercase text-xs border-b border-gray-700">
                        <tr>
                            <th class="py-3 pr-4">ID</th>
                            <th class="py-3 pr-4">Name</th>
                            <th class="py-3 pr-4">Category</th>
                            <th class="py-3 pr-4">Price</th>
                            <th class="py-3 pr-4">Stock</th>
                            <th class="py-3 pr-4">Sale</th>
                            <th class="py-3 pr-4">Image</th>
                            <th class="py-3 pr-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($productsResult && $productsResult->num_rows > 0): ?>
                            <?php while ($product = $productsResult->fetch_assoc()): ?>
                                <tr class="border-b border-gray-800/70 align-top">
                                    <td class="py-3 pr-4"><?php echo htmlspecialchars((string) $product['Product_Id']); ?></td>
                                    <td class="py-3 pr-4 font-medium"><?php echo htmlspecialchars($product['Product_Name']); ?></td>
                                    <td class="py-3 pr-4"><?php echo htmlspecialchars($product['Product_Category']); ?></td>
                                    <td class="py-3 pr-4">₱<?php echo htmlspecialchars((string) $product['Product_Price']); ?></td>
                                    <td class="py-3 pr-4"><?php echo (int) $product['InStock'] > 0 ? (int) $product['InStock'] : 'Out of Stock'; ?></td>
                                    <td class="py-3 pr-4"><?php echo (int) $product['OnSale'] === 1 ? 'Yes' : 'No'; ?></td>
                                    <td class="py-3 pr-4"><?php echo htmlspecialchars((string) $product['Image']); ?></td>
                                    <td class="py-3 pr-4">
                                        <div class="flex flex-wrap gap-2">
                                            <a href="admin.php?edit=<?php echo (int) $product['Product_Id']; ?>" class="rounded-md bg-gray-200 text-black px-3 py-1.5 text-xs font-semibold">Edit</a>
                                            <form method="POST" onsubmit="return confirm('Delete this product?');">
                                                <input type="hidden" name="product_id" value="<?php echo (int) $product['Product_Id']; ?>">
                                                <button type="submit" name="action" value="delete" class="rounded-md bg-red-600 text-white px-3 py-1.5 text-xs font-semibold">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="py-6 text-center text-gray-400">No products yet.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>

</html>