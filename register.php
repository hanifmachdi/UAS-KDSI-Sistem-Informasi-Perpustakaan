<?php
include 'koneksi.php';

if(isset($_POST['daftar'])){
    $nama   = $_POST['nama'];
    $telp   = $_POST['telepon'];
    $kelas  = $_POST['kelas'];
    $password = $_POST['password'];
    $tipe   = $_POST['tipe_anggota'];

    $sql = "INSERT INTO anggota (nama_lengkap,no_telepon,password,kelas,status_akun,tipe_anggota)
            VALUES('$nama','$telp','$password','$kelas','Pending','$tipe')";
    mysqli_query($conn,$sql);

    echo "<script>alert('Registrasi berhasil, tunggu konfirmasi petugas');window.location='index.php'</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-primary d-flex align-items-center justify-content-center" style="height:100vh;">

<div class="card p-4 shadow-lg" style="width:400px; border-radius:15px;">
    <div class="text-center mb-3">
        <h4>Daftar Anggota</h4>
        <small class="text-muted">Isi data kamu</small>
    </div>

    <form method="post">
        <input name="nama" placeholder="Nama Lengkap" class="form-control mb-2" required>
        <input name="telepon" placeholder="No HP" class="form-control mb-2" required>
        <input name="kelas" placeholder="Kelas (opsional)" class="form-control mb-2">

        <select name="tipe_anggota" class="form-select mb-2" required>
            <option value="Siswa">Siswa</option>
            <option value="Guru">Guru</option>
            <option value="Staf">Staf</option>
        </select>

        <input name="password" type="password" placeholder="Password" class="form-control mb-3" required>

        <button name="daftar" class="btn btn-dark w-100">Daftar</button>
    </form>

    <div class="text-center mt-3">
        <a href="index.php" class="btn btn-outline-light btn-sm">Kembali</a>
    </div>
</div>

</body>
</html>
