<?php
include 'koneksi.php';

$id = $_GET['id'] ?? null;
if ($id) {
    $id = intval($id);
    $hapus = "DELETE FROM siswa_uks WHERE id = $id";
    if (mysqli_query($conn, $hapus)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal menghapus data: " . mysqli_error($conn);
    }
} else {
    header("Location: index.php");
    exit;
}
?>
