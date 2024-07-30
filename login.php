<?php
// login.php
session_start();
include('koneksi/db.php');
include('layout/header.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk memeriksa pengguna
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['users_id'] = $row['id'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['data_filled'] = $row['data_filled'];

            // Periksa apakah peran pengguna adalah siswa dan data belum diisi
            if ($row['role'] == 'siswa' && $row['data_filled'] == 0) {
                header("Location: form_data_siswa.php?users_id=" . $row['id']);
                exit;
            } else {
                // Redirect sesuai peran (role)
                if ($row['role'] == 'admin') {
                    header("Location: admin/index.php");
                    exit;
                } elseif ($row['role'] == 'siswa') {
                    header("Location: siswa/index.php");
                    exit;
                } else {
                    echo "Peran pengguna tidak valid!";
                }
            }
        } else {
            echo "Password salah!";
        }
    } else {
        echo "Username tidak ditemukan!";
    }
}
?>

<!-- menghiangkan tombol navbar -->
<style>
    header nav {
        display: none;
    }

    a {
        pointer-events: none;
        color: #999;
        /* Mengubah warna teks agar terlihat disabled */
        text-decoration: none;
        /* Optional: menghilangkan garis bawah */
        cursor: default;
        /* Optional: mengubah kursor saat diarahkan */
    }
</style>
<!-- end menghiangkan tombol navbar -->

<div class="container-L">
    <h2>Login</h2><br>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</div>