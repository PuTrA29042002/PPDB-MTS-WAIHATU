<?php
session_start();
include('layout/header.php');
?>

<section class="foto">
    <img class="foto" src="assets/img/foto.jpg" alt="Penerimaan Siswa Baru">
</section>

<section class="daftar">
    <h2 class="font1">PENERIMAAN PESERTA DIDIK BARU</h2>
    <h2 class="font2">Selamat Datang</h2>
    <h2 class="font3">Calon Siswa Baru.</h2>
    <h2 class="font4">MTs AL-MUHAJIRIN Waihatu</h2>
    <a href="register.php">Daftar</a>
    <a class="login" href="login.php">Login</a>
</section>


<section id="profil" class="section">
    <div class="container">
        <h3>Profil Sekolah</h3>
        <p>Deskripsi singkat mengenai MTs AL-MUHAJIRIN.Deskripsi singkat mengenai MTs AL-MUHAJIRIN.Deskripsi singkat mengenai MTs AL-MUHAJIRIN.Deskripsi singkat mengenai MTs AL-MUHAJIRIN.Deskripsi singkat mengenai MTs AL-MUHAJIRIN.Deskripsi singkat mengenai MTs AL-MUHAJIRIN.Deskripsi singkat mengenai MTs AL-MUHAJIRIN.Deskripsi singkat mengenai MTs AL-MUHAJIRIN.</p>
        <!-- Gambaran atau kutipan singkat tentang sekolah -->
    </div>
</section>

<section id="akademik" class="section">
    <div class="container">
        <h3>Akademik</h3>
        <p>Informasi tentang program akademik, kurikulum, dan prestasi akademik sekolah.Deskripsi singkat mengenai MTs AL-MUHAJIRIN.Deskripsi singkat mengenai MTs AL-MUHAJIRIN.Deskripsi singkat mengenai MTs AL-MUHAJIRIN.Deskripsi singkat mengenai MTs AL-MUHAJIRIN.Deskripsi singkat mengenai MTs AL-MUHAJIRIN.Deskripsi singkat mengenai MTs AL-MUHAJIRIN.</p>
        <!-- Tabel atau grafik untuk prestasi akademik -->
    </div>
</section>


<section id="ekstrakurikuler" class="section">
    <div class="container"><br><br>
        <h3>Ekstrakurikuler</h3>
        <div class="row">
            <?php
            include 'koneksi/db.php';
            $result = $conn->query("SELECT * FROM ekstrakurikuler");

            while ($row = $result->fetch_assoc()) : ?>
                <div class="col-lg-4 col-md-6 col-sm-12 ekstra-item">
                    <div class="card">
                        <img src="assets/ekstrakurikuler/<?= $row['gambar'] ?>" class="card-img-top" alt="ekstrakurikuler">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($row['nama']) ?></h5>
                            <p class="card-text"><?= nl2br(htmlspecialchars($row['keterangan'])) ?></p>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>


<section id="lokasi" class="section">
    <div class="container">
        <h3>Lokasi</h3>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3983.26403157846!2d128.3304226737438!3d-3.284606341073041!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d6c69c8d73e9bb9%3A0x86fac56bc4a639e4!2sMts%20Almuhajirin%20Waihatu!5e0!3m2!1sen!2sid!4v1719583818436!5m2!1sen!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</section>

<!-- pengumuman -->
<section id="pengumuman" class="section">
    <div class="container"><br><br>
        <h3>Pengumuman</h3>
        <?php
        include('koneksi/db.php');

        $sql = "SELECT * FROM announcements ORDER BY created_at DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='announcement'>";
                echo "<h4>" . htmlspecialchars($row["title"]) . "</h4>";
                echo "<p class='content'>" . nl2br(htmlspecialchars($row["content"])) . "</p>";
                echo "<p><small>Diposting pada: " . $row["created_at"] . "</small></p>";
                echo "</div>";
                echo "<hr>";
            }
        } else {
            echo "Belum ada pengumuman.";
        }
        $conn->close();
        ?>
    </div>
</section>
<!-- end pengumuman -->

<?php include 'layout/footer.php';  // Memanggil footer 
?>