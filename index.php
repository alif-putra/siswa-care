<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Siswa Care</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Navbar brand putih */
        .navbar-brand {
            color: white !important;
        }
        /* Navbar toggler putih */
        .navbar-toggler-icon {
            filter: invert(1);
        }
        /* Kolom aksi tetap cukup lebar */
        th:last-child, td:last-child {
            min-width: 140px;
            white-space: nowrap;
        }
        /* Tombol aksi stacked di layar kecil */
        @media (max-width: 576px) {
            .aksi-buttons {
                display: flex;
                flex-direction: column;
                gap: 0.4rem;
                align-items: center;
            }
            .aksi-buttons a {
                min-width: 100px;
                padding: 0.4rem 0.75rem;
                font-size: 0.9rem;
                text-align: center;
            }
        }
        .aksi-buttons a {
            margin: 0 0.15rem;
            min-width: 80px;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg" style="background-color: #87CEEB;">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">Siswa Care</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <a href="tambah.php" class="btn btn-light">Tambah Data</a>
        </div>
    </div>
</nav>

<!-- Container Penjelasan -->
<div class="container mt-4">
    <div class="p-4 rounded" style="background-color: #87CEEB;">
        <h4 class="text-white">Selamat datang di Siswa Care</h4>
        <p class="text-white mb-0">Sistem pencatatan siswa masuk UKS untuk memudahkan dokumentasi keluhan dan kunjungan siswa.</p>
    </div>
</div>

<!-- Form Pencarian -->
<div class="container mt-4">
    <form method="GET" class="row g-2">
        <div class="col-12 col-md-5">
            <input type="text" name="nama" class="form-control" placeholder="Cari berdasarkan nama" value="<?= $_GET['nama'] ?? '' ?>">
        </div>
        <div class="col-12 col-md-5">
            <select name="kelas" class="form-select">
                <option value="">Pilih Kelas</option>
                <?php
                $kelas_result = mysqli_query($conn, "SELECT DISTINCT kelas FROM siswa_uks ORDER BY kelas ASC");
                while ($kelas_row = mysqli_fetch_assoc($kelas_result)):
                    $kelas_option = $kelas_row['kelas'];
                    $selected = (isset($_GET['kelas']) && $_GET['kelas'] == $kelas_option) ? 'selected' : '';
                    echo "<option value=\"$kelas_option\" $selected>$kelas_option</option>";
                endwhile;
                ?>
            </select>
        </div>
        <div class="col-12 col-md-2">
            <button type="submit" class="btn btn-primary w-100">Cari</button>
        </div>
    </form>
</div>

<!-- Tabel Data -->
<div class="container mt-4">
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-primary text-center">
                <tr>
                    <th>NISN</th>
                    <th>Nama Lengkap</th>
                    <th>Kelas</th>
                    <th>Keluhan</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM siswa_uks WHERE 1=1";
                if (!empty($_GET['nama'])) {
                    $nama = mysqli_real_escape_string($conn, $_GET['nama']);
                    $query .= " AND nama_lengkap LIKE '%$nama%'";
                }
                if (!empty($_GET['kelas'])) {
                    $kelas = mysqli_real_escape_string($conn, $_GET['kelas']);
                    $query .= " AND kelas LIKE '%$kelas%'";
                }

                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0):
                    while ($row = mysqli_fetch_assoc($result)):
                ?>
                <tr>
                    <td><?= htmlspecialchars($row['nisn']) ?></td>
                    <td><?= htmlspecialchars($row['nama_lengkap']) ?></td>
                    <td><?= htmlspecialchars($row['kelas']) ?></td>
                    <td><?= htmlspecialchars($row['keluhan']) ?></td>
                    <td><?= htmlspecialchars($row['tanggal']) ?></td>
                    <td class="text-center">
                        <div class="aksi-buttons d-inline-flex">
                            <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                        </div>
                    </td>
                </tr>
                <?php
                    endwhile;
                else:
                ?>
                <tr><td colspan="6" class="text-center">Data tidak ditemukan.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
