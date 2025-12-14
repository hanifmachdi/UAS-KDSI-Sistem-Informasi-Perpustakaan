<?php
session_start();
// 1. CEK KEAMANAN: Hanya Petugas yang boleh masuk
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'Petugas') {
    header("Location: index.php");
    exit;
}

include 'koneksi.php';

// daftar anggota pending
$pending = mysqli_query($conn,"SELECT * FROM anggota WHERE status_akun='Pending'");

// --- A. PROSES PEMINJAMAN MANUAL (INPUT BARU) ---
if (isset($_POST['pinjam'])) {
    $id_anggota = $_POST['id_anggota'];
    $id_buku    = $_POST['id_buku'];
    $id_petugas = $_SESSION['id_user']; 
    
    $tgl_pinjam = date('Y-m-d');
    $tgl_kembali = date('Y-m-d', strtotime('+7 days'));

    // Cek Stok Buku
    $cek_stok = mysqli_query($conn, "SELECT jumlah_tersedia FROM buku WHERE id_buku = '$id_buku'");
    $data_buku = mysqli_fetch_assoc($cek_stok);

    if ($data_buku && $data_buku['jumlah_tersedia'] > 0) {
        $query_pinjam = "INSERT INTO peminjaman (id_anggota, id_buku, id_petugas, tanggal_pinjam, tanggal_wajib_kembali, status) 
                         VALUES ('$id_anggota', '$id_buku', '$id_petugas', '$tgl_pinjam', '$tgl_kembali', 'Dipinjam')";
        
        if (mysqli_query($conn, $query_pinjam)) {
            // Kurangi Stok Buku
            mysqli_query($conn, "UPDATE buku SET jumlah_tersedia = jumlah_tersedia - 1 WHERE id_buku = '$id_buku'");
            echo "<script>alert('Peminjaman Berhasil!'); window.location='dashboard_petugas.php';</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "<script>alert('Gagal: Stok buku habis!');</script>";
    }
}

// --- B. PROSES VERIFIKASI BOOKING (PENGAMBILAN BUKU) ---
if (isset($_GET['aksi']) && $_GET['aksi'] == 'ambil') {
    $id_peminjaman = $_GET['id'];
    $id_petugas_sekarang = $_SESSION['id_user']; // Siapa petugas yang melayani saat ini

    // Update status jadi 'Dipinjam' dan catat ID Petugas yang memverifikasi
    $query_ambil = "UPDATE peminjaman SET 
                    status = 'Dipinjam', 
                    id_petugas = '$id_petugas_sekarang' 
                    WHERE id_peminjaman = '$id_peminjaman'";

    if (mysqli_query($conn, $query_ambil)) {
        echo "<script>alert('Buku berhasil diserahkan. Status berubah menjadi Dipinjam.'); window.location='dashboard_petugas.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// --- C. PROSES PENGEMBALIAN BUKU ---
if (isset($_GET['aksi']) && $_GET['aksi'] == 'kembali') {
    $id_peminjaman = $_GET['id'];
    $id_buku       = $_GET['id_buku'];
    $tgl_wajib     = $_GET['tgl_wajib'];
    
    $tgl_hari_ini  = date('Y-m-d');
    $denda = 0;

    // Hitung Denda
    if ($tgl_hari_ini > $tgl_wajib) {
        $tgl1 = new DateTime($tgl_wajib);
        $tgl2 = new DateTime($tgl_hari_ini);
        $selisih = $tgl2->diff($tgl1);
        $hari_telat = $selisih->days;
        $denda = $hari_telat * 1000; 
    }

    // Update Data Peminjaman
    $query_kembali = "UPDATE peminjaman SET 
                      status = 'Selesai', 
                      tanggal_pengembalian = '$tgl_hari_ini',
                      denda = '$denda'
                      WHERE id_peminjaman = '$id_peminjaman'";

    if (mysqli_query($conn, $query_kembali)) {
        // Kembalikan Stok Buku
        mysqli_query($conn, "UPDATE buku SET jumlah_tersedia = jumlah_tersedia + 1 WHERE id_buku = '$id_buku'");
        
        $pesan = "Buku berhasil dikembalikan.";
        if ($denda > 0) {
            $pesan .= " Denda: Rp " . number_format($denda,0,',','.');
        }
        
        echo "<script>alert('$pesan'); window.location='dashboard_petugas.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Petugas - MAN 2 Samarinda</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-success mb-4 shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="dashboard_petugas.php">Admin Perpus</a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="daftar_anggota.php">Daftar Anggota</a>
                </li>
            </ul>

            <div class="d-flex align-items-center">
                <span class="text-white me-3">
                    Halo, <?= $_SESSION['nama'] ?? 'Petugas' ?>
                </span>
                <a href="logout.php" class="btn btn-danger btn-sm"
                   onclick="return confirm('Yakin ingin logout?')">Logout</a>
            </div>
        </div>
    </div>
</nav>


<div class="container">
    <h2 class="text-center mb-4">Sistem Informasi Perpustakaan MAN 2 Samarinda</h2>

    <div class="card mt-4">
    <div class="card-header bg-warning">
        <strong>Menunggu Persetujuan</strong>
    </div>

    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>No HP</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
            <?php 
            $no = 1;
            while ($row = mysqli_fetch_assoc($pending)) { ?>
                <tr>
                    <td><?= $no++ ?></td>

                    <td>
                        <?= $row['nama_lengkap'] ?><br>
                        <small><?= $row['kelas'] ?></small>
                    </td>

                    <td><?= $row['no_telepon'] ?></td>

                    <td>
                        <a href="approve.php?id=<?= $row['id_anggota'] ?>"
                           class="btn btn-success btn-sm"
                           onclick="return confirm('Yakin setujui anggota ini?')">
                            Setujui
                        </a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>



    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Form Peminjaman Baru (Di Tempat)</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Anggota (Siswa/Guru):</label>
                        <select name="id_anggota" class="form-select select2-search" required>
                            <option value="">-- Cari Nama Anggota --</option>
                            <?php
                            $anggota = mysqli_query($conn, "SELECT * FROM anggota ORDER BY nama_lengkap ASC");
                            while ($a = mysqli_fetch_assoc($anggota)) {
                                $ket = $a['tipe_anggota'];
                                if($a['kelas']) { $ket .= " - " . $a['kelas']; }
                                echo "<option value='".$a['id_anggota']."'>".$a['nama_lengkap']." ($ket)</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Judul Buku:</label>
                        <select name="id_buku" class="form-select select2-search" required>
                            <option value="">-- Cari Judul Buku --</option>
                            <?php
                            $buku = mysqli_query($conn, "SELECT * FROM buku WHERE jumlah_tersedia > 0 ORDER BY judul_buku ASC");
                            while ($b = mysqli_fetch_assoc($buku)) {
                                echo "<option value='".$b['id_buku']."'>".$b['judul_buku']." (Sisa: ".$b['jumlah_tersedia'].")</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <button type="submit" name="pinjam" class="btn btn-success w-100">Proses Peminjaman Manual</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">Daftar Transaksi (Booking & Pinjam)</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tabelPeminjaman" class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Peminjam</th>
                            <th>Judul Buku</th>
                            <th>Tgl Pinjam/Booking</th>
                            <th>Tgl Kembali (Aktual)</th>
                            <th>Jatuh Tempo</th>
                            <th>Status & Denda</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT p.*, a.nama_lengkap, a.kelas, a.tipe_anggota, b.judul_buku 
                                  FROM peminjaman p
                                  JOIN anggota a ON p.id_anggota = a.id_anggota
                                  JOIN buku b ON p.id_buku = b.id_buku
                                  ORDER BY p.status ASC, p.tanggal_wajib_kembali ASC";
                        
                        $result = mysqli_query($conn, $query);
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $today = date('Y-m-d');
                            $status_label = '';
                            $tombol_aksi = '';
                            $info_denda = '';
                            
                            $tgl_kembali_show = '-';
                            if($row['tanggal_pengembalian']) {
                                $tgl_kembali_show = date('d-m-Y', strtotime($row['tanggal_pengembalian']));
                            }

                            // --- LOGIKA STATUS & TOMBOL ---

                            if ($row['status'] == 'Booking') {
                                // Status Booking
                                $status_label = "<span class='badge bg-info text-dark'>Booking (Menunggu)</span>";
                                
                                // TOMBOL VERIFIKASI (BARU)
                                $tombol_aksi = "<a href='dashboard_petugas.php?aksi=ambil&id=".$row['id_peminjaman']."' 
                                                class='btn btn-success btn-sm' 
                                                onclick='return confirm(\"Konfirmasi: Siswa sudah mengambil buku?\")'>
                                                Konfirmasi Ambil</a>";

                            } elseif ($row['status'] == 'Dipinjam') {
                                // Status Dipinjam
                                if ($today > $row['tanggal_wajib_kembali']) {
                                    $status_label = "<span class='badge bg-danger'>Terlambat</span>";
                                } else {
                                    $status_label = "<span class='badge bg-warning text-dark'>Dipinjam</span>";
                                }
                                
                                // Tombol Kembalikan
                                $tombol_aksi = "<a href='dashboard_petugas.php?aksi=kembali&id=".$row['id_peminjaman']."&id_buku=".$row['id_buku']."&tgl_wajib=".$row['tanggal_wajib_kembali']."' 
                                                class='btn btn-primary btn-sm' 
                                                onclick='return confirm(\"Proses pengembalian buku ini?\")'>
                                                Kembalikan</a>";

                            } else {
                                // Status Selesai
                                $status_label = "<span class='badge bg-success'>Selesai</span>";
                                if($row['denda'] > 0){
                                    $info_denda = "<br><small class='text-danger fw-bold'>Denda: Rp ".number_format($row['denda'],0,',','.')."</small>";
                                }
                                $tombol_aksi = "<button class='btn btn-secondary btn-sm' disabled>Sudah Kembali</button>";
                            }

                            echo "<tr>";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . $row['nama_lengkap'] . "<br><small class='text-muted'>".$row['kelas']."</small></td>";
                            echo "<td>" . $row['judul_buku'] . "</td>";
                            echo "<td>" . date('d-m-Y', strtotime($row['tanggal_pinjam'])) . "</td>";
                            echo "<td>" . $tgl_kembali_show . "</td>";
                            echo "<td>" . date('d-m-Y', strtotime($row['tanggal_wajib_kembali'])) . "</td>";
                            echo "<td>" . $status_label . $info_denda . "</td>";
                            echo "<td>" . $tombol_aksi . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script src="script.js"></script>

</body>
</html>