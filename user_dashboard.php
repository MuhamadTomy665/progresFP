<?php
session_start();
if (!isset($_SESSION["is_login"]) || $_SESSION["role"] != 0) {
    header("location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User - Pemesanan Tiket</title>
    <link rel="stylesheet" href="css/user_dashboard.css">
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Dashboard User</h2>
            </div>
            <nav>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="dashboard.php">Pesan Tiket</a></li>
                    <li><a href="my_tickets.php">Tiket Saya</a></li>
                    <li><a href="profile.php">Profil</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header>
                <h1>Selamat Datang, <?= htmlspecialchars($_SESSION["username"]); ?> (User)</h1>
                <div class="user-info">
                    <span>Username: <?= htmlspecialchars($_SESSION["username"]); ?></span>
                    <form method="post" action="logout.php">
                        <button type="submit" name="logout">Logout</button>
                    </form>
                </div>
            </header>

            <section class="ticket-booking">
                <h2>Pemesanan Tiket</h2>
                <form method="post" action="process_ticket.php">
                    <label for="destination">Tujuan:</label>
                    <input type="text" id="destination" name="destination" placeholder="Masukkan tujuan" required>
                    
                    <label for="date">Tanggal Perjalanan:</label>
                    <input type="date" id="date" name="date" required>
                    
                    <label for="ticket-quantity">Jumlah Tiket:</label>
                    <input type="number" id="ticket-quantity" name="ticket-quantity" min="1" required>
                    
                    <button type="submit" name="book_ticket">Pesan Tiket</button>
                </form>
            </section>

            <section class="my-tickets">
                <h2>Tiket Saya</h2>
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tujuan</th>
                            <th>Tanggal Perjalanan</th>
                            <th>Jumlah Tiket</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Contoh data tiket, ganti dengan query database
                        $tickets = [
                            ['id' => 1, 'destination' => 'Jakarta - Bali', 'date' => '2024-12-01', 'quantity' => 2, 'status' => 'Sudah Dibayar'],
                            ['id' => 2, 'destination' => 'Bandung - Surabaya', 'date' => '2024-12-15', 'quantity' => 1, 'status' => 'Menunggu Pembayaran'],
                        ];

                        foreach ($tickets as $index => $ticket) {
                            echo "<tr>
                                    <td>" . ($index + 1) . "</td>
                                    <td>" . htmlspecialchars($ticket['destination']) . "</td>
                                    <td>" . htmlspecialchars($ticket['date']) . "</td>
                                    <td>" . htmlspecialchars($ticket['quantity']) . "</td>
                                    <td>" . htmlspecialchars($ticket['status']) . "</td>
                                  </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
</body>
</html>
