<?php
include 'koneksi.php';
//logout itu menghapus siapa yg login
session_destroy();
echo "<script>alert('Anda Telah Logout!')</script>";
echo "<script>location='login.php'</script>";
?>