<?php
session_start();
include 'koneksi.php'; // pastikan koneksi benar

// Jika sudah login, langsung arahkan sesuai role
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'Petugas') {
        header("Location: dashboard_petugas.php");
    } else {
        header("Location: dashboard_anggota.php");
    }
    exit;
}

// LOGIN
if (isset($_POST['login'])) {
    $id_user = $_POST['id_user'];
    $password = $_POST['password'];

    // CEK PETUGAS
    $cek_petugas = mysqli_query($conn, "SELECT * FROM petugas WHERE username='$id_user' AND password='$password'");
    if(mysqli_num_rows($cek_petugas) > 0){
        $data = mysqli_fetch_assoc($cek_petugas);
        $_SESSION['id_user'] = $data['id_petugas'];
        $_SESSION['nama'] = $data['nama_petugas'];
        $_SESSION['role'] = 'Petugas';
        header("Location: dashboard_petugas.php");
        exit;
    }

    // CEK ANGGOTA
    $cek_anggota = mysqli_query($conn, "SELECT * FROM anggota WHERE (id_anggota='$id_user' OR no_telepon='$id_user') AND password='$password'");
    if(mysqli_num_rows($cek_anggota) > 0){
        $data = mysqli_fetch_assoc($cek_anggota);
        if($data['status_akun'] != "Aktif"){
            $error = "Akun anda belum diaktifkan!";
        } else {
            $_SESSION['id_user'] = $data['id_anggota'];
            $_SESSION['nama'] = $data['nama_lengkap'];
            $_SESSION['role'] = 'Anggota';
            header("Location: dashboard_anggota.php");
            exit;
        }
    } else {
        $error = "ID atau Password salah!";
    }
}

// REGISTRASI
if(isset($_POST['daftar'])){
    $nama = $_POST['nama'];
    $telp = $_POST['telepon'];
    $kelas = $_POST['kelas'];
    $password = $_POST['password'];
    $tipe = $_POST['tipe_anggota'];

    $sql = "INSERT INTO anggota (nama_lengkap,no_telepon,password,kelas,status_akun,tipe_anggota)
            VALUES ('$nama','$telp','$password','$kelas','Pending','$tipe')";
            mysqli_query($conn,$sql);

        // echo "<script>alert('Registrasi berhasil, tunggu konfirmasi petugas');window.location='index.php?registrasi=sukses';</script>";
   
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>E-Perpus MAN 2</title>
</head>

<body class="bg-blue-50">

<!-- NAVBAR -->
<nav class="bg-white shadow-lg fixed top-0 left-0 w-full z-50">
  <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
    <h1 class="text-xl font-bold">📚 E-Perpus MAN 2</h1>

    <div class="space-x-6 hidden md:flex">
      <a href="#" class="hover:text-blue-600">About</a>
      <a href="#" class="hover:text-blue-600">Services</a>
      <a href="#" class="hover:text-blue-600">Contact</a>
    </div>

    <div class="space-x-3">
    <button id="navLoginBtn"
            onclick="showLogin()"
            class="px-4 py-2 border rounded-lg hover:bg-gray-100">
      Login
    </button>

    <button id="navSignupBtn"
            onclick="showRegister()"
            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
      Sign Up
    </button>
  </div>
</nav>

<!-- HERO SECTION -->
<section class="pt-24 w-full">
  <div class="max-w-7xl mx-auto px-6">
    <div class="relative w-full h-72 rounded-2xl overflow-hidden shadow-md">

      <!-- Gambar -->
      <img 
        src="https://images.unsplash.com/photo-1524995997946-a1c2e315a42f"
        class="w-full h-full object-cover"
      />

      <!-- Overlay hitam transparan -->
      <div class="absolute inset-0 bg-black/40"></div>

      <!-- Teks di tengah -->
      <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-4">
        <h1 class="text-white text-3xl font-bold drop-shadow-lg">
          Selamat Datang di Perpustakaan MAN 2 Samarinda
        </h1>
        <p class="text-white text-lg mt-2 max-w-2xl drop-shadow">
          Akses ilmu pengetahuan lebih mudah, cepat, dan terbuka untuk siapa saja.
        </p>
      </div>

    </div>
  </div>
</section>

<!-- CONTENT + LOGIN CARD -->
<section class="max-w-7xl mx-auto px-6 mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">

  <!-- INFORMASI AKADEMIK (2 KOLOM) -->
  <div class="md:col-span-2 space-y-6">

    <!-- About -->
    <div class="bg-white p-6 rounded-xl shadow">
      <h2 class="text-2xl font-bold mb-2">About</h2>
      <p class="text-gray-600">
        E-Perpus MAN 2 adalah platform perpustakaan digital yang membantu 
        siswa mengakses buku, informasi perpustakaan, dan layanan akademik.
      </p>
    </div>

    <!-- Services -->
    <div class="bg-white p-6 rounded-xl shadow">
      <h2 class="text-2xl font-bold mb-3">Services</h2>

      <div class="space-y-3">
        <div class="p-3 border rounded-lg bg-gray-50">Peminjaman Buku Digital</div>
        <div class="p-3 border rounded-lg bg-gray-50">Akses Katalog Perpustakaan</div>
        <div class="p-3 border rounded-lg bg-gray-50">Informasi Jadwal Perpustakaan</div>
      </div>
    </div>

    <!-- Contact -->
    <div class="bg-white p-6 rounded-xl shadow">
      <h2 class="text-2xl font-bold mb-2">Contact Us</h2>
      <p class="text-gray-600">
        Jika kamu membutuhkan bantuan lebih lanjut, silakan hubungi petugas perpustakaan.
      </p>
    </div>

  </div>

  <!-- CARD LOGIN DI SAMPING KANAN -->
<!-- LOGIN CARD -->
<div id="loginCard" class="bg-white p-6 rounded-xl shadow h-max">
  <h2 class="text-2xl font-bold mb-4 text-center">Login</h2>

  <form method="POST" action="">
    <input type="text" name="id_user" placeholder="Username" autocomplete="username"
           class="w-full mb-3 p-3 rounded-lg bg-blue-50 border" required />

    <input type="password" name="password" placeholder="Password" autocomplete="current-password"
           class="w-full mb-4 p-3 rounded-lg bg-blue-50 border" required />

    <button type="submit" name="login" 
            class="w-full bg-blue-600 text-white p-3 rounded-lg mb-3 hover:bg-blue-700">
      Login
    </button>
  </form>

  <button onclick="showRegister()" 
          class="w-full p-2 text-blue-600 underline hover:text-blue-800">
    Belum punya akun? Register
  </button>
</div>

<!-- REGISTER CARD -->
<div id="registerCard" class="bg-white p-6 rounded-xl shadow h-max hidden">
  <h2 class="text-2xl font-bold mb-4 text-center">Register</h2>

  <form method="POST" action="">
    <input type="text" name="nama" placeholder="Nama Lengkap" required
           class="w-full mb-3 p-3 rounded-lg bg-blue-50 border" />

    <input type="text" name="telepon" placeholder="No HP" required
           class="w-full mb-3 p-3 rounded-lg bg-blue-50 border" />

    <input type="text" name="kelas" placeholder="Kelas" required
           class="w-full mb-3 p-3 rounded-lg bg-blue-50 border" />

    <select name="tipe_anggota" required class="w-full mb-4 p-3 rounded-lg bg-blue-50 border">
      <option value="Siswa">Siswa</option>
      <option value="Guru">Guru</option>
      <option value="Staf">Staf</option>
    </select>

    <input type="password" name="password" placeholder="Password" autocomplete="new-password" required
           class="w-full mb-4 p-3 rounded-lg bg-blue-50 border" />

    <button type="submit" name="daftar" 
            class="w-full bg-blue-600 text-white p-3 rounded-lg hover:bg-blue-700 mb-3">
      Daftar
    </button>
  </form>

  <button onclick="showLogin()" 
          class="w-full p-2 text-blue-600 underline hover:text-blue-800">
    Sudah punya akun? Login
  </button>
</div>

<!-- FOOTER -->
<footer class="bg-blue-600 text-white w-full mt-16">
  <div class="w-full px-10 text-center flex items-center justify-center h-32">
    © 2024 E-Perpus MAN 2 Samarinda — All Rights Reserved.
  </div>
</footer>




<script>
function showRegister() {
  document.getElementById("loginCard").classList.add("hidden");
  document.getElementById("registerCard").classList.remove("hidden");
}

function showLogin() {
  document.getElementById("registerCard").classList.add("hidden");
  document.getElementById("loginCard").classList.remove("hidden");
}

<?php if(isset($_GET['registrasi']) && $_GET['registrasi'] == 'sukses'): ?>
  alert('Registrasi berhasil, tunggu konfirmasi admin!');
  // Tampilkan loginCard
  showLogin();
<?php endif; ?>

</script>

</body>
</html>
