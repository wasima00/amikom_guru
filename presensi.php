<?php
include "koneksi.php";
include "header.php";
$id_sesi = $_GET["id_sesi"];
?>

<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-4">
                <h3>Presensi</h3>
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
    function presensi_qr() {
        $.ajax({
            url: 'presensi_qr.php?id_sesi=<?php echo $id_sesi; ?>',
            type: 'GET',
            success: function(hasil_qr) {
                $('.letak_qrcode').html(hasil_qr);
            }
        });
    }

    presensi_qr();

    setInterval(function() {
        presensi_qr();
    }, 5000);
</script>