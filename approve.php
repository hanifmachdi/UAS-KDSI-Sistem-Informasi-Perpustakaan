<?php
include 'koneksi.php';
$id = $_GET['id'];

mysqli_query($conn,"UPDATE anggota SET status_akun='Aktif' WHERE id_anggota='$id'");
echo "<script>alert('Anggota disetujui');window.location='dashboard_petugas.php'</script>";
