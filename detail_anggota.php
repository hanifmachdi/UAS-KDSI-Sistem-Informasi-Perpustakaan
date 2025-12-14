<?php
session_start();
include 'koneksi.php';

// hanya petugas yg bisa
if(!isset($_SESSION['role']) || $_SESSION['role']!='Petugas'){
    header("location:index.php");
    exit;
}

// $id = $_GET['id'];
$id = intval($_GET['id']);


// ambil data anggota
$anggota = mysqli_query($conn,"SELECT * FROM anggota WHERE id_anggota='$id'");
$data = mysqli_fetch_assoc($anggota);

// buku sedang dipinjam
$sql1 = "SELECT p.*, b.judul_buku
        FROM peminjaman p
        JOIN buku b ON p.id_buku=b.id_buku
        WHERE p.id_anggota='$id'
        AND p.status IN ('Booking','Dipinjam')
        ORDER BY p.tanggal_pinjam DESC";

$sedang = mysqli_query($conn,$sql1);

// riwayat selesai
$sql2 = "SELECT p.*, b.judul_buku
        FROM peminjaman p
        JOIN buku b ON p.id_buku=b.id_buku
        WHERE p.id_anggota='$id'
        AND p.status='Selesai'
        ORDER BY p.tanggal_pinjam DESC";

$riwayat = mysqli_query($conn,$sql2);

?>
<!DOCTYPE html>
<html>
<head>
<title>Detail Anggota</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<h3>Detail Anggota</h3>
<hr>

<h5><?= $data['nama_lengkap']?> 
    <small class="text-muted">
        (<?= $data['tipe_anggota']?> <?= $data['kelas']?>)
    </small>
</h5>
<br>

<h4>Sedang Dipinjam / Booking</h4>
<table class="table table-bordered">
<tr>
<th>Judul Buku</th>
<th>Tgl Pinjam</th>
<th>Jatuh Tempo</th>
<th>Status</th>
</tr>
<?php 
if(mysqli_num_rows($sedang)==0){
    echo "<tr><td colspan='4' class='text-center text-muted'>Tidak ada</td></tr>";
}
while($b=mysqli_fetch_assoc($sedang)){ ?>
<tr>
<td><?= $b['judul_buku']?></td>
<td><?= date('d-m-Y',strtotime($b['tanggal_pinjam']))?></td>
<td><?= date('d-m-Y',strtotime($b['tanggal_wajib_kembali']))?></td>
<td><?= $b['status']?></td>
</tr>
<?php } ?>
</table>

<br>

<h4>Riwayat Peminjaman</h4>
<table class="table table-bordered">
<tr>
<th>Judul Buku</th>
<th>Tgl Pinjam</th>
<th>Tgl Kembali</th>
<th>Denda</th>
</tr>
<?php 
if(mysqli_num_rows($riwayat)==0){
    echo "<tr><td colspan='4' class='text-center text-muted'>Belum ada riwayat</td></tr>";
}
while($r=mysqli_fetch_assoc($riwayat)){ ?>
<tr>
<td><?= $r['judul_buku']?></td>
<td><?= date('d-m-Y',strtotime($r['tanggal_pinjam']))?></td>
<td><?= date('d-m-Y',strtotime($r['tanggal_pengembalian']))?></td>
<td><?= number_format($r['denda'],0,',','.')?></td>
</tr>
<?php } ?>
</table>

<a href="Daftar_anggota.php" class="btn btn-secondary">Kembali</a>

</body>
</html>
