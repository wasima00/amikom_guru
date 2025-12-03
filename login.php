<?php
include "koneksi.php";
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Guru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body class="bg-light">
    <section class="py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-4 offset-md-4 bg-white p-5 shadow">
                    <div class="text-center">
                        <img src="/amikom_guru/image/logo-amikom.png" width="100" style="padding-bottom: 12px;">
                        <h6>Login Guru SMK Amikom</h6>
                    </div>
                    <form method="post">
                        <div class="mb-3">
                            <label>NIK</label>
                            <input type="text" name="nik" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <button class="btn btn-primary" name="login">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>

<?php
// jika ada tombol login
if (isset($_POST["login"])) {
    // dapatkan inputan nik
    $nik = $_POST['nik'];

    // dapatkan inputan password
    $password = $_POST['password'];

    // cekkan nik dan password tersebut ke tabel guru di db, klo ada, maka berhasil login, gak ada? maka gagal
    $ambil = $koneksi->query("SELECT * FROM guru WHERE nik_guru='$nik' AND password_guru='$password'");
    $cekguru = $ambil->fetch_assoc();

    // jk kosong. mk gagal
    if (empty($cekguru)) {
        echo "<script>alert('Gagal, akun tidak valid!')</script>";
        echo "<script>location='login.php'</script>";
        exit();
        
    } else {
        //kalo benar
        //program mengingat siapa yang login 
        $_SESSION['guru'] =$cekguru;
        echo "<script>alert('Berhasil, selamat datang!')</script>";
        echo "<script>location='index.php'</script>";
    }

}
?>
