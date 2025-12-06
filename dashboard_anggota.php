<?php
session_start();
include 'koneksi.php';

// Cek keamanan: Hanya Anggota yang boleh masuk
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'Anggota') {
    header("Location: index.php");
    exit;
}

$id_anggota = $_SESSION['id_user'];
$nama_anggota = $_SESSION['nama'];

// --- PROSES BOOKING ---
if (isset($_GET['booking'])) {
    $id_buku = $_GET['booking'];
    $tgl_sekarang = date('Y-m-d');
    $tgl_wajib = date('Y-m-d', strtotime('+7 days'));

    // Cek Stok
    $cek = mysqli_query($conn, "SELECT jumlah_tersedia FROM buku WHERE id_buku = '$id_buku'");
    $buku = mysqli_fetch_assoc($cek);

    if ($buku['jumlah_tersedia'] > 0) {
        // Insert dengan status 'Booking'
        $sql = "INSERT INTO peminjaman (id_anggota, id_buku, tanggal_pinjam, tanggal_wajib_kembali, status) 
                VALUES ('$id_anggota', '$id_buku', '$tgl_sekarang', '$tgl_wajib', 'Booking')";
        
        if (mysqli_query($conn, $sql)) {
            // Kurangi stok
            mysqli_query($conn, "UPDATE buku SET jumlah_tersedia = jumlah_tersedia - 1 WHERE id_buku = '$id_buku'");
            echo "<script>alert('Berhasil Booking! Silakan ambil buku di perpus dalam 1x24 jam.'); window.location='dashboard_anggota.php';</script>";
        }
    } else {
        echo "<script>alert('Yah, stok buku habis!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Anggota - E-Perpus</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    
    <style>
        body { background-color: #f0f2f5; }
        .card { border: none; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-success mb-4 shadow">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">E-Perpus Anggota</a>
        <span class="navbar-text text-white">
            Halo, <?= $nama_anggota ?> | <a href="logout.php" class="text-white fw-bold" style="text-decoration:none;">Logout</a>
        </span>
    </div>
</nav>

<div class="container">
    
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Status Peminjaman & Booking Saya</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Judul Buku</th>
                            <th>Tanggal Pinjam/Booking</th>
                            <th>Wajib Kembali (Jatuh Tempo)</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Query mengambil status 'Booking' DAN 'Dipinjam'
                        $query_saya = "SELECT p.*, b.judul_buku 
                                       FROM peminjaman p 
                                       JOIN buku b ON p.id_buku = b.id_buku 
                                       WHERE p.id_anggota = '$id_anggota' 
                                       AND p.status IN ('Booking', 'Dipinjam')
                                       ORDER BY p.tanggal_pinjam DESC";
                        
                        $hasil_saya = mysqli_query($conn, $query_saya);
                        $no = 1;

                        if(mysqli_num_rows($hasil_saya) == 0) { 
                            echo "<tr><td colspan='5' class='text-center text-muted'>Tidak ada buku yang sedang dipinjam atau dibooking.</td></tr>"; 
                        }

                        while($row = mysqli_fetch_assoc($hasil_saya)) {
                            $tgl_tempo = date('d-m-Y', strtotime($row['tanggal_wajib_kembali']));
                            $status_tampil = "";
                            
                            // Logika Tampilan Status
                            if ($row['status'] == 'Booking') {
                                $status_tampil = "<span class='badge bg-warning text-dark'>Booking (Segera Ambil)</span>";
                            } 
                            elseif ($row['status'] == 'Dipinjam') {
                                // Cek Terlambat
                                if (date('Y-m-d') > $row['tanggal_wajib_kembali']) {
                                    $status_tampil = "<span class='badge bg-danger'>Terlambat! Kena Denda</span>";
                                } else {
                                    $status_tampil = "<span class='badge bg-success'>Sedang Dipinjam</span>";
                                }
                            }

                            echo "<tr>";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . $row['judul_buku'] . "</td>";
                            echo "<td>" . date('d-m-Y', strtotime($row['tanggal_pinjam'])) . "</td>";
                            echo "<td><strong>" . $tgl_tempo . "</strong></td>";
                            echo "<td>" . $status_tampil . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <small class="text-muted">* Harap kembalikan buku sebelum tanggal jatuh tempo untuk menghindari denda.</small>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-white">
            <h5 class="mb-0">Katalog Buku</h5>
        </div>
        <div class="card-body">
            <table id="tabelBuku" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Judul Buku</th>
                        <th>Penulis</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $buku = mysqli_query($conn, "SELECT b.*, k.nama_kategori FROM buku b JOIN kategori k ON b.id_kategori = k.id_kategori ORDER BY b.judul_buku ASC");
                    while ($b = mysqli_fetch_assoc($buku)) {
                        $btn = "";
                        if ($b['jumlah_tersedia'] > 0) {
                            $btn = "<a href='dashboard_anggota.php?booking=".$b['id_buku']."' class='btn btn-sm btn-primary' onclick='return confirm(\"Booking buku ini?\")'>Booking</a>";
                        } else {
                            $btn = "<button class='btn btn-sm btn-secondary' disabled>Habis</button>";
                        }
                        
                        echo "<tr>";
                        echo "<td><strong>" . $b['judul_buku'] . "</strong></td>";
                        echo "<td>" . $b['penulis'] . "</td>";
                        echo "<td>" . $b['nama_kategori'] . "</td>";
                        echo "<td>" . $b['jumlah_tersedia'] . "</td>";
                        echo "<td>" . $btn . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#tabelBuku').DataTable({
            "language": {
                "search": "Cari Buku:",
                "zeroRecords": "Buku tidak ditemukan"
            }
        });
    });
</script>

</body>
</html>
    