<?php
include 'koneksi.php';

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nisn = trim($_POST['nisn']);
    $nama = trim($_POST['nama_lengkap']);
    $kelas = trim($_POST['kelas']);
    $keluhan = trim($_POST['keluhan']);
    $tanggal = $_POST['tanggal'];

    // Validasi
    if (!preg_match('/^\d{10}$/', $nisn)) {
        $errors[] = "NISN harus terdiri dari 10 digit angka.";
    }

    if (!preg_match('/^[a-zA-Z\s]+$/', $nama)) {
        $errors[] = "Nama hanya boleh berisi huruf dan spasi.";
    }

    if (!preg_match('/^[a-zA-Z0-9\s]+$/', $kelas)) {
        $errors[] = "Kelas hanya boleh berisi huruf, angka dan spasi.";
    }

    if (strlen($keluhan) < 5) {
        $errors[] = "Keluhan minimal harus 5 karakter.";
    }

    if (empty($errors)) {
        $query = "INSERT INTO siswa_uks (nisn, nama_lengkap, kelas, keluhan, tanggal) 
                  VALUES ('$nisn', '$nama', '$kelas', '$keluhan', '$tanggal')";
        if (mysqli_query($conn, $query)) {
            header("Location: index.php");
            exit;
        } else {
            $errors[] = "Gagal menambahkan data: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data - Siswa Care</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e6f7ff;
        }
        .card {
            background-color: #87CEEB;
        }
        label, .card-title {
            color: white;
        }
        textarea.form-control {
            min-height: 100px;
        }

        /* Responsif */
        @media (max-width: 576px) {
            .card-body {
                padding: 1rem;
            }

            .card-title {
                font-size: 1.25rem;
                text-align: center;
            }

            .btn {
                width: 100%;
                margin-top: 10px;
            }

            .d-flex.justify-content-between {
                flex-direction: column-reverse;
                gap: 0.5rem;
            }
        }
    </style>
</head>
<body style="background-color: #e6f7ff;">

<div class="container mt-5">
    <div class="card shadow" style="background-color: #87CEEB;">
        <div class="card-body">
            <h3 class="card-title text-white mb-4">Tambah Data Siswa UKS</h3>

            <?php if ($errors): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach ($errors as $error): ?>
                            <li><?= htmlspecialchars($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label text-white">NISN</label>
                    <input type="text" name="nisn" class="form-control" value="<?= $_POST['nisn'] ?? '' ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label text-white">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" value="<?= $_POST['nama_lengkap'] ?? '' ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label text-white">Kelas</label>
                    <select name="kelas" class="form-select" required>
                        <option value="">Pilih Kelas</option>
                        <?php
                        $kelas_standar = ['RPL', 'TITL', 'TEI', 'DPIB', 'TKJ', 'TKI', 'OTOMOTIF','TKR','TBSM','TPM',];
                        foreach ($kelas_standar as $kelas) {
                            $selected = (isset($_POST['kelas']) && $_POST['kelas'] == $kelas) ? 'selected' : '';
                            echo "<option value=\"$kelas\" $selected>$kelas</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label text-white">Keluhan</label>
                    <textarea name="keluhan" class="form-control" required><?= $_POST['keluhan'] ?? '' ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label text-white">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="<?= $_POST['tanggal'] ?? date('Y-m-d') ?>" required>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="index.php" class="btn btn-light">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
