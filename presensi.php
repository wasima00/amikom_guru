<?php
include "koneksi.php";
include "header.php";

// Get session ID from URL
$id_sesi = isset($_GET['id_sesi']) ? $_GET['id_sesi'] : 0;

// Fetch session details
$ambil_sesi = $koneksi->query("SELECT * FROM sesi WHERE id_sesi = '$id_sesi'");
$sesi = $ambil_sesi->fetch_assoc();

if (!$sesi) {
    echo "<div class='container py-5'><div class='alert alert-danger'>Sesi tidak ditemukan.</div></div>";
    include "footer.php";
    exit();
}

// Fetch class ID from session (assuming sesi has kode_kelas, we need to link to kelas table or just use kode_kelas if siswa has it)
// In setup_db.php I used id_kelas for siswa. But sesi table has kode_kelas. 
// I need to find id_kelas based on kode_kelas from sesi.
$kode_kelas = $sesi['kode_kelas'];
$ambil_kelas = $koneksi->query("SELECT * FROM kelas WHERE kode_kelas = '$kode_kelas'");
$kelas = $ambil_kelas->fetch_assoc();
$id_kelas = $kelas ? $kelas['ID_kelas'] : 0;

// Fetch all students in this class
$siswa_list = [];
$ambil_siswa = $koneksi->query("SELECT * FROM siswa WHERE id_kelas = '$id_kelas'");
while ($s = $ambil_siswa->fetch_assoc()) {
    $siswa_list[$s['id_siswa']] = $s;
}

// Fetch attendance for this session
$presensi_list = [];
$ambil_presensi = $koneksi->query("SELECT * FROM presensi WHERE id_sesi = '$id_sesi'");
while ($p = $ambil_presensi->fetch_assoc()) {
    $presensi_list[] = $p['id_siswa'];
}

// Filter absent students (those not in presensi_list)
$siswa_absen = [];
foreach ($siswa_list as $id_siswa => $siswa) {
    if (!in_array($id_siswa, $presensi_list)) {
        $siswa_absen[] = $siswa;
    }
}

?>

<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-4">
                <h3>Presensi: <?php echo $sesi['materi_sesi']; ?> (<?php echo $sesi['kode_kelas']; ?>)</h3>
            </div>
        </div>
        <div class="row">
            <!-- Left Column: QR Code -->
            <div class="col-md-6 text-center">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Scan QR Code</h5>
                    </div>
                    <div class="card-body letak_qrcode d-flex flex-column justify-content-center align-items-center">
                        
                        <p class="text-muted">Scan QR code ini untuk melakukan presensi.</p>
                        <small class="text-break"><?php echo $url_presensi; ?></small>
                    </div>
                </div>
            </div>

            <!-- Right Column: Absent Students Table -->
            <div class="col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-danger text-white">
                        <h5 class="mb-0">Belum Presensi (<?php echo count($siswa_absen); ?>)</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>NIS</th>
                                        <th>Nama Siswa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($siswa_absen)): ?>
                                        <tr>
                                            <td colspan="3" class="text-center py-3">Semua siswa sudah presensi!</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($siswa_absen as $key => $siswa): ?>
                                            <tr>
                                                <td><?php echo $key + 1; ?></td>
                                                <td><?php echo $siswa['nis']; ?></td>
                                                <td><?php echo $siswa['nama_siswa']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php 
include "footer.php";
?>

<script>
    $(document).ready(function() {
        presensi_qr();
    });

    function presensi_qr() {
        $.ajax({
            url: 'presensi_qr.php',
            type: 'GET',
            success: function(hasil_qr) {
                $('.letak_qrcode').prepend(hasil_qr);
            }
        });
    }
</script>
