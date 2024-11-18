<?php
include "service/database.php";
session_start();
$login_message = "";

// Periksa jika ada pesan logout
if (isset($_SESSION['logout_message'])) {
    $login_message = $_SESSION['logout_message'];
    unset($_SESSION['logout_message']); // Hapus pesan setelah ditampilkan
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hash_password = hash('sha256', $password);

    // Query login
    $stmt = $db->prepare("SELECT * FROM tbl_user WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $hash_password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $_SESSION["username"] = $data["username"];
        $_SESSION["role"] = $data["role"];
        $_SESSION["is_login"] = true;

        // Redirect berdasarkan role
        if ($data["role"] == 0) {
            // Redirect ke dashboard user
            header("Location: user_dashboard.php");
        } elseif ($data["role"] == 1) {
            // Redirect ke dashboard admin
            header("Location: admin_dashboard.php");
        }
        exit();
    } else {
        $login_message = "Username atau password salah!";
    }
    $stmt->close();
    $db->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/log.css">
</head>
<body>
    <div class="login-container">
        <h3>MASUK AKUN</h3>
        <p class="login-message"><?= htmlspecialchars($login_message) ?></p>
        <form action="login.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login" class="login-btn">Masuk Sekarang</button>
        </form>
        
        <!-- Tautan ke halaman registrasi -->
        <p class="register-link">Belum punya akun? <a href="register.php">Daftar di sini</a></p>
    </div>
</body>
</html>
