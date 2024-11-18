<?php
include "service/database.php";
session_start();
$register_message = "";

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validasi sederhana
    if ($password !== $confirm_password) {
        $register_message = "Password tidak cocok!";
    } else {
        // Hash password
        $hash_password = hash('sha256', $password);

        // Periksa apakah username sudah ada
        $stmt = $db->prepare("SELECT * FROM tbl_user WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $register_message = "Username sudah digunakan!";
        } else {
            // Masukkan data ke database
            $stmt = $db->prepare("INSERT INTO tbl_user (username, password, role) VALUES (?, ?, ?)");
            $role = "user"; // Default role untuk pengguna baru
            $stmt->bind_param("sss", $username, $hash_password, $role);

            if ($stmt->execute()) {
                // Registrasi berhasil, simpan pesan sukses di sesi
                $_SESSION["register_success"] = "Registrasi berhasil! Silakan login menggunakan akun Anda.";
                header("Location: login.php"); // Arahkan ke halaman login
                exit();
            } else {
                $register_message = "Terjadi kesalahan, coba lagi!";
            }
        }
        $stmt->close();
    }
    $db->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link rel="stylesheet" href="css/register.css">
</head>
<body>
    <div class="register-container">
        <h3>Registrasi Akun</h3>
        <p class="register-message"><?= htmlspecialchars($register_message) ?></p>
        <form action="register.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Konfirmasi Password" required>
            <button type="submit" name="register" class="register-btn">Daftar</button>
        </form>
        
        <!-- Tautan ke halaman login -->
        <p class="login-link">Sudah punya akun? <a href="login.php">Masuk di sini</a></p>
    </div>
</body>
</html>
