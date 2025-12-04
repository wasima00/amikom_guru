<?php

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\Data\QRMatrix;
use chillerlan\QRCode\Output\QRMarkupHTML;

require_once 'vendor/autoload.php';
include "koneksi.php";

$kode = generateRandomString(5);
$out = (new QRCode())->render($kode);

$id_sesi = $_GET["id_sesi"];
$koneksi->query("UPDATE sesi SET kode_sesi = '$kode' WHERE id_sesi = '$id_sesi'");

?>
<img src="<?php echo $out; ?>" alt="QR Code Presensi" class="img-fluid mb-3" style="max-width: 300px;">
<h5><?php echo $kode; ?></h5>