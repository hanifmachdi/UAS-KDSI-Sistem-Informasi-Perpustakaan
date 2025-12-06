<?php
session_start();
include 'koneksi.php';

// Jika sudah login, langsung arahkan sesuai role
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'Petugas') {
        header("Location: dashboard_petugas.php");
    } else {
        header("Location: dashboard_anggota.php");
    }
    exit;
}

if (isset($_POST['login'])) {
    $id_user = $_POST['id_user']; // Bisa ID Petugas (Username) atau ID Anggota
    $password = $_POST['password'];

    // 1. CEK KE TABEL PETUGAS DULU
    $cek_petugas = mysqli_query($conn, "SELECT * FROM petugas WHERE username = '$id_user' AND password = '$password'");
    if (mysqli_num_rows($cek_petugas) > 0) {
        $data = mysqli_fetch_assoc($cek_petugas);
        $_SESSION['id_user'] = $data['id_petugas'];
        $_SESSION['nama'] = $data['nama_petugas'];
        $_SESSION['role'] = 'Petugas';
        header("Location: dashboard_petugas.php");
        exit;
    }

    // 2. JIKA BUKAN PETUGAS, CEK TABEL ANGGOTA
    // Asumsi: ID Anggota adalah id_anggota (angka) atau No Telepon
    $cek_anggota = mysqli_query($conn, "SELECT * FROM anggota WHERE (id_anggota = '$id_user' OR no_telepon = '$id_user') AND password = '$password'");
    if (mysqli_num_rows($cek_anggota) > 0) {
        $data = mysqli_fetch_assoc($cek_anggota);
        $_SESSION['id_user'] = $data['id_anggota'];
        $_SESSION['nama'] = $data['nama_lengkap'];
        $_SESSION['role'] = 'Anggota';
        header("Location: dashboard_anggota.php");
        exit;
    }

    $error = "ID atau Password Salah!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - E-Perpus MAN 2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-primary d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="card p-4 shadow-lg" style="width: 400px; border-radius: 15px;">
        <div class="text-center mb-4">
            <h4>E-Perpus MAN 2</h4>
            <small class="text-muted">Silakan Login</small>
        </div>

        <?php if(isset($error)): ?>
            <div class="alert alert-danger py-2 text-center"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label>ID Pengguna</label>
                <input type="text" name="id_user" class="form-control" required placeholder="Username Petugas / ID Anggota">
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required placeholder="Password">
            </div>
            <button type="submit" name="login" class="btn btn-dark w-100">Masuk</button>
        </form>
        <div class="text-center mt-3">
            <small class="text-muted">Untuk Anggota: ID gunakan ID Anggota / No HP.<br>Password Default: 12345</small>
        </div>
    </div>
</body>
</html>