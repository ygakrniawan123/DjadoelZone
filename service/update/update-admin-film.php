<!-- php -->
<?php
// Koneksi ke database
include "../../service/koneksi.php";

// Ambil ID film dari parameter URL
$Id_film = $_GET['id'] ?? NULL;
$filmId = [];

if ($Id_film) {
    // Query untuk mengambil data film berdasarkan ID
    $stmt = $conn->prepare("SELECT * FROM film WHERE Id_film = ?");
    $stmt->bind_param("i", $Id_film);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $filmId = $result->fetch_assoc();
    }
    $stmt->close();
}

// Menangani update form
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Validasi data yang diinputkan
    $nama = htmlspecialchars($_POST['nama']);
    $rilis = htmlspecialchars($_POST['rilis']);
    $judul = htmlspecialchars($_POST['judul']);
    $sutradara = htmlspecialchars($_POST['sutradara']);
    $di_produksi = htmlspecialchars($_POST['di_produksi']);
    $di_tulis = htmlspecialchars($_POST['di_tulis']);
    $di_bintangi = htmlspecialchars($_POST['di_bintangi']);
    $durasi = htmlspecialchars($_POST['durasi']);
    $type = "full";

    // Menangani file gambar
    $uploadDir = "../../cover/";
    $fileNew = $filmId['Gambar'] ?? ''; // Default ke gambar lama

    if (!empty($_FILES['gambar']['name'])) {
        $fileName = $_FILES['gambar']['name'];
        $fileTmp = $_FILES['gambar']['tmp_name'];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowFile = ['jpeg', 'png', 'jpg'];

        if (in_array($fileExt, $allowFile)) {
            $fileNameNew = uniqid() . "." . $fileExt;
            $filePath = $uploadDir . $fileNameNew;

            if (!empty($filmId['Gambar']) && file_exists($uploadDir . $filmId['Gambar'])) {
                unlink($uploadDir . $filmId['Gambar']);
            }

            if (move_uploaded_file($fileTmp, $filePath)) {
                $fileNew = $fileNameNew;
            }
        }
    }

    // Query update data
    $stmtUpdate = $conn->prepare("UPDATE film SET Nama = ?, Rilis = ?, Type = ?, Judul = ?, Sutradara = ?, Di_produksi = ?, Di_tulis = ?, Di_bintangi = ?, Durasi = ?, Gambar = ? WHERE Id_film = ?");
    $stmtUpdate->bind_param("ssssssssssi", $nama, $rilis, $type, $judul, $sutradara, $di_produksi, $di_tulis, $di_bintangi, $durasi, $fileNew, $Id_film);

    if ($stmtUpdate->execute()) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location.href = '/nostalgia/admin/film-admin.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data.');</script>";
    }

    $stmtUpdate->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        body {
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.9)), url(side-2.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            height: 180vh;
        }

        .modal-content {
            background-color: #343a40;
            height: 1120px;
            width: 500px;
            border-radius: 20px;
            margin-top: 200px;
        }

        .form-control {
            width: 400px;
        }

        .form-select {
            width: 400px;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center p-1 mt-1">
        <div class="modal-dialog mt-5">
            <div class="modal-content p-5 mt-1 shadow-lg" data-aos="fade-down">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-light">Edit Pengguna Baru</h5>
                </div>
                <div class="modal-body">
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_film" value="<?= $Id_film; ?>">
        <div class="mb-3">
            <label class="fw-bold text-light">Genre</label>
            <select name="genre" class="form-select">
                <option value="">Pilih Genre</option>
                <option value="action" <?= $filmId['Genre'] == 'action' ? 'selected' : ''; ?>>Action</option>
                <option value="drama" <?= $filmId['Genre'] == 'drama' ? 'selected' : ''; ?>>Drama</option>
                <option value="komedy" <?= $filmId['Genre'] == 'komedy' ? 'selected' : ''; ?>>Comedy</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="fw-bold text-light">Nama</label>
            <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($filmId['Nama'] ?? ''); ?>">
        </div>
        <div class="mb-3">
            <label class="fw-bold text-light">Tahun Rilis</label>
            <input type="number" name="rilis" class="form-control" value="<?= htmlspecialchars($filmId['Rilis'] ?? ''); ?>">
        </div>
        <div class="mb-3">
            <label class="fw-bold text-light">Judul</label>
            <input type="text" name="judul" class="form-control" value="<?= htmlspecialchars($filmId['Judul'] ?? ''); ?>">
        </div>
        <div class="mb-3">
            <label class="fw-bold text-light">Sutradara</label>
            <input type="text" name="sutradara" class="form-control" value="<?= htmlspecialchars($filmId['Sutradara'] ?? ''); ?>">
        </div>
        <div class="mb-3">
            <label class="fw-bold text-light">Di Produksi</label>
            <input type="text" name="di_produksi" class="form-control" value="<?= htmlspecialchars($filmId['Di_produksi'] ?? ''); ?>">
        </div>
        <div class="mb-3">
            <label class="fw-bold text-light">Di Tulis</label>
            <input type="text" name="di_tulis" class="form-control" value="<?= htmlspecialchars($filmId['Di_tulis'] ?? ''); ?>">
        </div>
        <div class="mb-3">
            <label class="fw-bold text-light">Di Bintangi</label>
            <input type="text" name="di_bintangi" class="form-control" value="<?= htmlspecialchars($filmId['Di_bintangi'] ?? ''); ?>">
        </div>
        <div class="mb-3">
            <label class="fw-bold text-light">Durasi</label>
            <input type="text" name="durasi" class="form-control" value="<?= htmlspecialchars($filmId['Durasi'] ?? ''); ?>">
        </div>
        <div class="mb-3">
            <label class="fw-bold text-light">Gambar</label>
            <?php if (!empty($filmId['Gambar'])): ?>
                <p class="text-light mt-2"><br><img src="../../cover/<?= $filmId['Gambar']; ?>" alt="Gambar film" width="50" style="border-radius: 5px;"></p>
            <?php endif; ?>
            <input type="file" name="gambar" class="form-control">
        </div>
        <button type="submit" class="btn btn-warning fw-bold text-light">Simpan Perubahan</button>
    </form>
</div>

            </div>
        </div>
    </div>
</body>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>

</html>
