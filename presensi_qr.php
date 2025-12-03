<?php 

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\Data\QRMatrix;
use chillerlan\QRCode\Output\QRMarkupHTML;

require_once 'vendor/autoload.php';

$url = isset($_GET['url']) ? $_GET['url'] : 'YNTKTS';
$out = (new QRCode())->render($url);

?>
<img src="<?php echo $out; ?>" alt="QR Code Presensi" class="img-fluid mb-3" style="max-width: 300px;">