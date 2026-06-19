<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Error</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/x-icon" href="assets/img/logo.png">
  </head>
  <body class="bg-gray-100 flex items-center justify-center min-h-screen p-6">

    <?php if (isset($_GET['status']) != 'success'): ?>
    <div class="bg-white p-10 max-w-md w-full rounded-xl shadow-lg text-center">
      <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-6">
        <svg class="h-10 w-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
        </svg>
      </div>

      <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Oops!</h1>
      <p class="text-gray-600 mb-6">Something went wrong during checkout.</p>

      <div class="bg-red-50 text-red-800 text-sm font-medium px-4 py-3 rounded-lg mb-8 border border-red-200">
        <?php
        $error = isset($_GET['error']) ? $_GET['error'] : '';

        switch ($error) {
          case 'empty_cart':
            echo 'Your shopping cart is empty. Add items before checking out.';
            $btn_url = 'index.php';
            $btn_text = 'Go to Shop';
            break;
          case 'not_logged_in':
            echo 'You must be logged in to complete your purchase.';
            $btn_url = 'login.php';
            $btn_text = 'Go to Login';
            break;
          default:
            echo 'An unexpected error occurred. Please try again.';
            $btn_url = 'cart.php';
            $btn_text = 'Return to Cart';
            break;
        }
        ?>
      </div>

      <a href="index.php" class="inline-block w-full bg-gray-800 hover:bg-gray-900 text-white font-medium py-3 px-4 rounded-lg transition duration-200 shadow-md">
        <?php echo $btn_text; ?>
      </a>
    </div>
    <?php else: ?>
    <div class="bg-white p-10 max-w-md w-full rounded-xl shadow-lg text-center">
      <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-6">
        <svg class="h-10 w-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>
      </div>

      <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Thank You!</h1>
      <p class="text-gray-600 mb-6">Your order has been placed successfully.</p>

      <p class="text-sm text-gray-500 mb-8">We are processing your honkers right now.</p>

      <a href="index.php" class="inline-block w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-lg transition duration-200 shadow-md hover:shadow-lg">
        Continue Shopping
      </a>
    </div>
    <?php endif; ?>

  </body>
</html>
