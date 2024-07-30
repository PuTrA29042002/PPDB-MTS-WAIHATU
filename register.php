<?php
// register.php
include('koneksi/db.php');
include('layout/header.php');

// Variabel untuk menyimpan pesan error
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 'siswa'; // Mengatur peran secara otomatis sebagai siswa

    // Periksa ketersediaan username
    $sql_check_username = "SELECT * FROM users WHERE username = '$username'";
    $result_check_username = $conn->query($sql_check_username);

    if ($result_check_username->num_rows > 0) {
        // Jika username sudah ada, atur pesan error
        $error_message = "Username sudah digunakan. Silakan pilih username lain.";
    } else {
        // Simpan data pengguna karena username belum digunakan
        $sql_insert_users = "INSERT INTO users (username, password, role, data_filled) VALUES ('$username', '$password', '$role', 0)";

        if ($conn->query($sql_insert_users) === TRUE) {
            $users_id = $conn->insert_id;

            // Redirect untuk mengisi data diri dan data orang tua
            header("Location: form_data_siswa.php?users_id=$users_id");
            exit;
        } else {
            echo "Error: " . $sql_insert_users . "<br>" . $conn->error;
        }
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
    <h2>Registrasi</h2><br>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Daftar</button>
    </form>
</div>

<!-- menapikan informasi bila username sudah digunakan -->
<script>
    // JavaScript untuk menampilkan pesan error sebagai pop-up
    window.onload = function() {
        <?php if (!empty($error_message)) : ?>
            alert("<?php echo $error_message; ?>");
        <?php endif; ?>
    }
</script>
<!-- end menapikan informasi bila username sudah digunakan -->