<?php include 'koneksi.php'; ?>
<?php include 'header.php'; ?>
<?php
//jika blom login tidak ada jejak login
if (!isset($_SESSION['guru']) or empty($_SESSION['guru'])) {
    echo "<script>alert('Anda Harus Login!')</script>";
    echo "<script>location='login.php'</script>";
    exit();
}


$nik = $_SESSION['guru']['nik_guru'];

$kelas = array();
$ambil = $koneksi->query("SELECT * FROM kelas WHERE nik_guru = '$nik'");
while ($tiap = $ambil->fetch_assoc()) {
    $kelas[] = $tiap;
}

?>


<section class="py-5">
    <div class="container">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6>Tambah Sesi Presensi</h6>
                <form method="post" class="mb-3">
                    <div class="mb-3">
                        <label for="kode_kelas" class="form-label">Kelas</label>
                        <select id="kode_kelas" class="form-control form-select" name="kode_kelas">
                            <option value="">Pilih</option>
                            <?php foreach($kelas as $key => $value): ?>
                                <option value="<?php echo $value['kode_kelas'] ?>">
                                    <?php echo $value['nama_mapel'] ?>
                                </option>
                            <?php endforeach; ?> </select>
                    </div>
                    <div class="mb-3">
                        <label>Sesi Ke</label>
                        <input type="number" min="1" max="30" name="ke_sesi" class="form-control"> </div>
                    <div class="mb-3">
                        <label>Materi</label>
                        <input type="text" name="materi_sesi" class="form-control"> </div>
                    <div class="mb-3">
                        <label>Bahasan</label>
                        <textarea class="form-control" name="bahasan_sesi"></textarea> </div>
                    <button class="btn btn-primary" name="kirim">Kirim</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
// ... Asumsi kode koneksi dan fungsi generateRandomString() berada di atas ...

if (isset($_POST["kirim"])) {
    // 1. Mengambil data dari form
    $kode_kelas = $_POST['kode_kelas'];
    $ke_sesi = $_POST['ke_sesi'];
    $materi_sesi = $_POST['materi_sesi'];
    $bahasan_sesi = $_POST['bahasan_sesi'];
    
    // 2. Membuat kode unik untuk sesi
    $kode_sesi = generateRandomString(5); // Menggunakan fungsi yang telah didefinisikan sebelumnya

    // Simpan sesi
    $koneksi->query("INSERT INTO sesi (kode_kelas, materi_sesi, bahasan_sesi, kode_sesi, ke_sesi)
        VALUES ('$kode_kelas', '$materi_sesi', '$bahasan_sesi', '$kode_sesi', '$ke_sesi')");
    
    // Dapatkan id sesi barusan
    $id_sesi = $koneksi->insert_id;
    
    // Redirect ke halaman presensi
    echo "<script>alert('silahkan presensi')</script>";
    echo "<script>location='presensi.php?id_sesi=$id_sesi'</script>";
}

// ... HTML form dan penutup PHP/footer.php berada di bawah ...
?>

<?php include 'footer.php'; ?>