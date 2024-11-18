<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="css/admin_dashboard.css">
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Admin Dashboard</h2>
            </div>
            <nav>
                <ul>
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#">Users</a></li>
                    <li><a href="#">Orders</a></li>
                    <li><a href="#">Products</a></li>
                    <li><a href="#">Settings</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header>
                <h1>Welcome to the Admin Dashboard</h1>
                <div class="user-info">
                    <span>Admin</span>
                    <a href="#">Logout</a>
                </div>
            </header>

            <section class="stats">
                <div class="stat-box">
                    <h3>Total Users</h3>
                    <p>150</p>
                </div>
                <div class="stat-box">
                    <h3>Total Orders</h3>
                    <p>45</p>
                </div>
                <div class="stat-box">
                    <h3>Total Products</h3>
                    <p>120</p>
                </div>
            </section>

            <section class="recent-activities">
                <h2>Recent Activities</h2>
                <ul>
                    <li>User John Doe placed an order #1234</li>
                    <li>User Jane Smith updated profile</li>
                    <li>Product "Smartphone" added to inventory</li>
                </ul>
            </section>
        </main>
    </div>

    <script src="js/script.js"></script>
</body>
</html>
