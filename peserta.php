<?php
include "koneksi.php";
$id_kelas = $_GET["id_kelas"];
include "vendor/autoload.php";
include "header.php";
?>

<div class="container my-5">
    <div class="card">
        <div class="card-body">
            <h3>Daftar Peserta</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIM</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $ambil = $koneksi->query("SELECT * FROM peserta 
                        JOIN siswa ON peserta.nis = siswa.nis 
                        WHERE peserta.id_kelas = '$id_kelas'");
                    foreach ($ambil as $key => $value):
                    ?>
                        <tr>
                            <td><?php echo $key + 1; ?></td>
                            <td><?php echo $value["nama_siswa"]; ?></td>
                            <td><?php echo $value["nis"]; ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="card">
        <div class="card-body">
            <h3>Import Peserta</h3>
            <form action="" method="post" enctype="multipart/form-data" class="form-control">
                <div class="mb-3">
                    <label for="file" class="form-label">File Excel Peserta</label>
                    <input type="file" class="form-control" id="file" name="file">
                </div>
                <button class="btn btn-primary" name="kirim">Import</button>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_POST["kirim"])) {
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($_FILES["file"]["tmp_name"]);
    $sheet = $spreadsheet->getSheet($spreadsheet->getFirstSheetIndex());
    $data = $sheet->toArray();
    $berhasil = 0;
    $gagal = 0;
    foreach ($data as $key => $value) {
        $nis = $value[0];
        $nama = $value[1];

        $ambil = $koneksi->query("SELECT * FROM siswa WHERE nis = '$nis'");
        $ceksiswa = $ambil->fetch_assoc();

        if (empty($ceksiswa)) {
            $simpan_siswa = $koneksi->query("INSERT INTO siswa (nis, nama_siswa) VALUES ('$nis', '$nama')");
            if (!$simpan_siswa) {
                $gagal++;
                continue;
            }
        }

        $ambil = $koneksi->query("SELECT * FROM peserta WHERE nis = '$nis' AND id_kelas = '$id_kelas'");
        $cekpeserta = $ambil->fetch_assoc();

        if (empty($cekpeserta)) {
            $simpan_peserta = $koneksi->query("INSERT INTO peserta (id_kelas, nis) VALUES ('$id_kelas', '$nis')");
            if ($simpan_peserta) {
                $berhasil++;
            } else {
                $gagal++;
            }
        }
    }

    if ($berhasil > 0) {
        echo "<script>alert('Berhasil import $berhasil data');</script>";
    }
    if ($gagal > 0) {
        echo "<script>alert('Gagal import $gagal data');</script>";
    }
    echo "<script>location='peserta.php?id_kelas=$id_kelas';</script>";
}

?>