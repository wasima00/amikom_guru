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
    <div class="card">
        <div class="card-body">
            <h6>Kelas</h6>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode kelas</th>
                        <th>Nama mapel</th>
                        <th>NIK guru</th>
                        <th>Nama guru</th>
                        <th>Tahun ajaran</th>
                        <th>Semester</th>
                        <th>Opsi</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($kelas as $key => $value):
                         ?>

                        <tr>
                            <td><?php echo $key+1; ?></td>
                            <td><?php echo $value["kode_kelas"]; ?></td>
                            <td><?php echo $value["nama_mapel"]; ?></td>
                            <td><?php echo $value["nik_guru"]; ?></td>
                            <td><?php echo $value["nama_guru"]; ?></td>
                            <td><?php echo $value["tahun_ajaran"]; ?></td>
                            <td><?php echo $value["semester"]; ?></td>
                            <td>
                                <a href="" class = "btn btn-info btn-sm">Peserta</a>
                                 <a href="" class = "btn btn-success btn-sm">Rekap Presensi</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <a href="kelas_tambah.php" class="btn btn-primary">Buat baru</a>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>