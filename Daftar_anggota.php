<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['role']) || $_SESSION['role']!='Petugas'){
    header("location:index.php");
    exit;
}

$tipe  = $_GET['tipe']  ?? '';
$kelas = $_GET['kelas'] ?? '';

$sql = "SELECT * FROM anggota WHERE 1";
$params = [];
$types  = "";

if($tipe != ''){
    $sql .= " AND tipe_anggota = ?";
    $params[] = $tipe;
    $types .= "s";
}

if($tipe == 'Siswa' && $kelas != ''){
    $sql .= " AND kelas = ?";
    $params[] = $kelas;
    $types .= "s";
}

$sql .= " ORDER BY nama_lengkap";

$stmt = $conn->prepare($sql);
if(!empty($params)){
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$query = $stmt->get_result();
$total = $query->num_rows;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<nav class="navbar navbar-expand-lg navbar-dark bg-success mb-4 shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="dashboard_petugas.php">Admin Perpus</a>
        <div class="d-flex align-items-center">
            <span class="text-white me-3">
                Halo, <?= $_SESSION['nama'] ?>
            </span>
            <a href="logout.php" class="btn btn-danger btn-sm"
               onclick="return confirm('Yakin ingin logout?')">Logout</a>
        </div>
    </div>
</nav>

<h3>Daftar Anggota</h3>
<hr>

<form method="GET" class="row g-2 align-items-center mb-3">

    <div class="col-md-3">
        <select name="tipe" class="form-select" onchange="this.form.submit()">
            <option value="">-- Semua Anggota --</option>
            <option value="Guru"  <?= $tipe=='Guru'?'selected':'' ?>>Guru</option>
            <option value="Staf"  <?= $tipe=='Staf'?'selected':'' ?>>Staf</option>
            <option value="Siswa" <?= $tipe=='Siswa'?'selected':'' ?>>Siswa</option>
        </select>
    </div>

    <?php if($tipe=='Siswa'){ ?>
    <div class="col-md-3">
        <input type="text" name="kelas" class="form-control"
               placeholder="Kelas (misal X IPA 1)"
               value="<?= htmlspecialchars($kelas) ?>">
    </div>
    <?php } ?>

    <div class="col-auto">
        <button class="btn btn-success">Filter</button>
        <a href="daftar_anggota.php" class="btn btn-secondary">Reset</a>
    </div>
    <div class="col-auto ms-auto">
        <a href="dashboard_petugas.php" class="btn btn-secondary">Kembali</a>
    </div>

</form>


<table class="table table-bordered table-striped">
<thead class="table-success">
<tr>
    <th>No</th>
    <th>Nama</th>
    <th>Tipe</th>
    <th>Kelas</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>
</thead>

<tbody>
<?php
if($total == 0){
    echo "<tr>
            <td colspan='6' class='text-center text-muted'>
                Data anggota tidak ditemukan
            </td>
          </tr>";
}

$no = 1;
while($a = $query->fetch_assoc()){
?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $a['nama_lengkap'] ?></td>
    <td><?= $a['tipe_anggota'] ?></td>
    <td><?= $a['kelas'] ?: '-' ?></td>
    <td><?= $a['status_akun'] ?></td>
    <td>
        <a href="detail_anggota.php?id=<?= $a['id_anggota'] ?>"
           class="btn btn-sm btn-primary">
           Detail
        </a>
    </td>
</tr>
<?php } ?>
</tbody>
</table>
</body>
</html>
