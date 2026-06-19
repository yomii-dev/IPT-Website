<?php
session_start();
$page = 'Rental';
$conn = require_once '../includes/mysqli.inc.php';

date_default_timezone_set('Asia/Manila');

// Handle Actions (Toggle / Update Hours)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = intval($_POST['id']);

  if (isset($_POST['toggle_active'])) {
    $stmt = $conn->prepare(
      'UPDATE Rental SET Is_Active = !Is_Active WHERE Rental_Id = ?',
    );
    $stmt->bind_param('i', $id);
    $stmt->execute();
  } elseif (isset($_POST['set_hours'])) {
    $hours = intval($_POST['hours']);
    $now = date('Y-m-d H:i:s');
    $due = date('Y-m-d H:i:s', strtotime("+$hours hours"));

    $stmt = $conn->prepare(
      'UPDATE Rental SET Rental_Date = ?, Rental_Due = ?, Is_Active = 1 WHERE Rental_Id = ?',
    );
    $stmt->bind_param('ssi', $now, $due, $id);
    $stmt->execute();
  }
  header('Location: ' . $_SERVER['PHP_SELF']);
  die();
}

$result = $conn->query('SELECT * FROM Rental');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>P3R | Rental</title>
  </head>
  <body class="bg-[#121316] text-gray-300 min-h-screen flex flex-col justify-between font-sans">

    <?php require_once $_SERVER['DOCUMENT_ROOT'] .
      '/IPT-Website/includes/navbar.php'; ?>

    <main class="flex-grow p-8 max-w-7xl mx-auto w-full">
      <h1 class="text-2xl font-bold mb-6 text-white">PC Rental Management</h1>

      <div class="overflow-x-auto bg-[#252A2E] rounded-xl border border-gray-700">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="border-b border-gray-700 bg-[#262930]">
              <th class="p-4 text-xs font-semibold uppercase tracking-wider text-gray-400">PC ID</th>
              <th class="p-4 text-xs font-semibold uppercase tracking-wider text-gray-400">Status</th>
              <th class="p-4 text-xs font-semibold uppercase tracking-wider text-gray-400">Rental Date</th>
              <th class="p-4 text-xs font-semibold uppercase tracking-wider text-gray-400">Rental Due</th>
              <th class="p-4 text-xs font-semibold uppercase tracking-wider text-gray-400">Time Left</th>
              <th class="p-4 text-xs font-semibold uppercase tracking-wider text-gray-400 text-right">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr class="border-b border-gray-700 hover:bg-gray-800/30 transition">
              <td class="p-4 font-mono text-sm text-white">PC-<?= $row[
                'Rental_Id'
              ] ?></td>
              <td class="p-4">
                <span class="px-2.5 py-1 rounded-md text-xs font-medium <?= $row[
                  'Is_Active'
                ]
                  ? 'bg-green-500/20 text-green-400'
                  : 'bg-red-500/20 text-red-400' ?>">
                    <?= $row['Is_Active'] ? 'Active' : 'Inactive' ?>
                  </span>
              </td>
              <td class="p-4 font-mono text-xs text-gray-400"><?= $row[
                'Rental_Date'
              ]
                ? date('Y-m-d H:i:s', strtotime($row['Rental_Date']))
                : '-' ?></td>
              <td class="p-4 font-mono text-xs text-gray-400"><?= $row[
                'Rental_Due'
              ]
                ? date('Y-m-d H:i:s', strtotime($row['Rental_Due']))
                : '-' ?></td>
              <td class="p-4 font-mono text-xs text-yellow-400 data-countdown" data-due="<?= $row[
                'Rental_Due'
              ]
                ? strtotime($row['Rental_Due']) * 1000
                : 0 ?>" data-active="<?= $row['Is_Active'] ?>">
                  --:--:--
                </td>
                <td class="p-4">
                  <div class="flex items-center justify-end gap-3">
                    <form method="POST" class="inline">
                      <input type="hidden" name="id" value="<?= $row[
                        'Rental_Id'
                      ] ?>">
                      <button type="submit" name="toggle_active" class="text-xs px-3 py-1.5 rounded-lg bg-[#262930] hover:bg-gray-700 text-gray-200 cursor-pointer transition">
                        Toggle Status
                      </button>
                    </form>

                    <form method="POST" class="flex items-center gap-2">
                      <input type="hidden" name="id" value="<?= $row[
                        'Rental_Id'
                      ] ?>">
                      <input type="number" name="hours" min="1" max="24" required placeholder="Hrs" class="w-16 px-2 py-1 bg-[#121316] border border-gray-600 rounded-lg text-xs text-white focus:outline-none focus:border-gray-400">
                      <button type="submit" name="set_hours" class="text-xs px-3 py-1.5 rounded-lg bg-[#D9D9D9] hover:bg-white text-black font-medium cursor-pointer transition">
                        Set
                      </button>
                    </form>
                  </div>
                </td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </main>

    <?php require_once $_SERVER['DOCUMENT_ROOT'] .
      '/IPT-Website/includes/footer.php'; ?>

    <script>
    function updateTimers() {
      const now = new Date().getTime();
      document.querySelectorAll('.data-countdown').forEach(el => {
        const due = parseInt(el.getAttribute('data-due'));
        const isActive = el.getAttribute('data-active') === '1';

        if (!isActive || !due) {
          el.textContent = 'Disabled';
          el.className = 'p-4 font-mono text-xs text-gray-500';
          return;
        }

        const diff = due - now;
        if (diff <= 0) {
          el.textContent = 'Expired';
          el.className = 'p-4 font-mono text-xs text-red-400 font-bold';
          return;
        }

        const hrs = Math.floor(diff / 3600000).toString().padStart(2, '0');
        const mins = Math.floor((diff % 3600000) / 60000).toString().padStart(2, '0');
        const secs = Math.floor((diff % 60000) / 1000).toString().padStart(2, '0');

        el.textContent = `${hrs}:${mins}:${secs}`;
      });
    }
    setInterval(updateTimers, 1000);
    updateTimers();
    </script>
  </body>
</html>
