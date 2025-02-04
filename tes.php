saya ingin tanya, kenapa pada project php saya ketika di run di browsher ngelag terus tapi ketika kode php saya hapus dan hanya saya sisakan html kenapa bisa di run dan juga tidak ngelag??<!-- php
<?php
// Koneksi ke database
include '../service/koneksi.php';
// query untuk mengambil data dari tabel film dan juga genre dengan cara di gabung
$stmt = $conn->prepare(
  "SELECT film.*, genre.Nama_genre FROM film INNER JOIN genre ON film.Id_genre = genre.Id_genre"
);
$stmt->execute();
$rowFilm = $stmt->get_result();

// query untuk mendapatkan data dari tabel genre di gunakan untuk combo box
$stmt = $conn->prepare("SELECT * FROM genre");
$stmt->execute();
$resultGenre = $stmt->get_result();

// Menangani form dengan method POST
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  // Validasi data form
  $genre = $_POST['genre'];
  $nama = $_POST['nama'];
  $rilis = $_POST['rilis'];
  $judul = $_POST['judul'];
  $sutradara = $_POST['sutradara'];
  $di_produksi = $_POST['di_produksi'];
  $di_tulis = $_POST['di_tulis'];
  $di_bintangi = $_POST['di_bintangi'];
  $durasi = $_POST['durasi'];
  $type = "full";

  // Validasi jika form kosong
  if (empty($genre) || empty($nama) || empty($rilis) || empty($judul) || empty($sutradara) || empty($di_produksi) || empty($di_tulis) || empty($di_bintangi) || empty($durasi)) {
    echo "<script>alert('Anda belum memasukan semua data, mohon untuk melengkapi data!'); window.location.href='film-admin.php';</script>";
  } else {


    // Validasi data file pada form gambar
    $fileName = $_FILES['gambar']['name'];
    $fileErr = $_FILES['gambar']['error'];
    $fileSize = $_FILES['gambar']['size'];
    $fileTmp = $_FILES['gambar']['tmp_name'];

    // Validasi dan cek jika data file kosong
    if ($fileErr == 4) {
      echo "<script>alert('Form gambar tidak anda isi, mohon masukkan gambar!'); window.location.href='film-admin.php';</script>";
    }

    // Membatasi ukuran file gambar yang dapat diupload
    if ($fileSize > 50000000) {
      echo "<script>alert('Ukuran gambar yang anda masukkan terlalu besar, mohon masukkan yang lebih kecil!'); window.location.href='film-admin.php';</script>";
    }

    // Mengatur jenis file yang dapat diupload hanya gambar
    $fileType = ['jpeg', 'png', 'jpg'];
    $extensiGambar = explode('.', $fileName);
    $extensiGambar = strtolower(end($extensiGambar));
    // Melakukan cek jika file yang diupload bukan gambar
    if (!in_array($extensiGambar, $fileType)) {
      echo "<script>alert('Yang anda upload bukanlah gambar, mohon masukkan gambar!'); window.location.href='film-admin.php';</script>";
    }

    // Jika data gambar ada, maka query untuk menambahkan data akan dijalankan
    $newName = uniqid();
    $direktori = '../cover/';
    $newFileName = $direktori . $newName . '.' . $extensiGambar;

    // Melakukan insert ke database jika file berhasil dipindahkan ke direktori
    if (move_uploaded_file($fileTmp, $newFileName)) {
      // Menyiapkan query untuk insert data ke database
      $stmt = $conn->prepare("INSERT INTO film(Id_genre, Nama, Rilis, Judul, Sutradara,  Di_produksi, Di_tulis, Di_bintangi, Durasi, Type, Gambar, Buat_data, Update_data) 
VALUES (?,?,?,?,?,?,?,?,?,?,?, NOW(), NOW())");

      // Bind parameter untuk data yang akan dimasukkan
      $stmt->bind_param("issssssssss", $genre, $nama, $rilis, $judul,$sutradara, $di_produksi, $di_tulis, $di_bintangi, $durasi, $type, $newFileName);
      // Eksekusi query
      $stmt->execute();
      $resultForm = $stmt->get_result();

      // Menampilkan pesan berhasil menambahkan data
      echo "<script>alert('Data berhasil ditambahkan'); window.location.href='film-admin.php';</script>";
    } else {
      // Menampilkan pesan jika gagal menambahkan data
      echo "<script>alert('Data gagal ditambahkan'); window.location.href='film-admin.php';</script>";
    }
  }
}
?> -->
<!doctype html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <style>
    body {
      background: linear-gradient(45deg, #1a1a1a, #2d2d2d);
      color: #fff;
      font-family: Arial, sans-serif;
      height: 500vh;
    }

    .sidebar {
      height: 500vh;
      background: linear-gradient(180deg, #212529, #000);
      padding: 20px;
      box-shadow: 5px 0 15px rgba(0, 0, 0, 0.3);
    }

    .sidebar a {
      color: #fff;
      text-decoration: none;
      display: block;
      padding: 10px;
      margin: 5px 0;
      transition: all 0.3s;
      border-left: 3px solid transparent;
    }

    .sidebar a:hover {
      background: #343a40;
      border-left: 3px solid #ffc107;
    }

    .content {
      height: 500vh;
      width: max;
    }

    .card {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      border: none;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
      width: max;
    }

    .table th,
    .table td {
      vertical-align: middle;
    }

    .btn-warning {
      color: #212529;
    }

    .modal-content {
      background: #343a40;
      color: #fff;
    }

    .modal-content .form-control {
      background: #212529;
      color: #fff;
      border: none;
    }
  </style>
</head>

<body>
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <div class="col-md-2 sidebar">
        <h3 class="text-warning">Menu Admin</h3>
        <a href="user-admin.html"><i class="bi bi-people-fill"></i> Kelola Film</a>
        <a href="histori-user-admin.html"><i class="bi bi-person-badge"></i> Kelola Dekripsi</a>
        <a href="dasboard-admin.html"><i class="bi bi-box-arrow-right"></i> Keluar</a>
      </div>

      <!-- Main Content -->
      <div class="col-md-10 content">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h2 class="text-warning">Manajemen Film</h2>
          <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#addFilmModal">
            <i class="bi bi-person-plus"></i> Tambah Data Baru
          </button>
        </div>

        <!-- User Table -->
        <div class="card">
          <div class="card-header bg-warning text-dark">
            <i class="bi bi-table me-2"></i> Daftar Film
          </div>
          <div class="card-body">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>#Id</th>
                  <th>Genre</th>
                  <th>Nama</th>
                  <th>Rilis</th>
                  <th>Deskripsi</th>
                  <th>Type</th>
                  <th>Gambar</th>
                  <th>Buat Data</th>
                  <th>Update Data</th>
                  <th class="text-end">aksi</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <!-- Data akan diisi oleh PHP -->
                <?php
                $no = 1;
                while ($row = $rowFilm->fetch_assoc()) { ?>
                  <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['Nama_genre']); ?></td>
                    <td><?= htmlspecialchars($row['Nama']); ?></td>
                    <td><?= htmlspecialchars($row['Rilis']); ?></td>
                    <td>
                      <a href="#?id=<?= $row['Id_film']; ?>" class="btn btn-light text-decoration-none text-dark fw-bold" data-bs-target="#showDesc" data-bs-toggle="modal">Lihat</a>
                    </td>
                    <td><?= htmlspecialchars($row['Type']); ?></td>
                    <td><img src="<?= htmlspecialchars($row['Gambar']); ?>" alt="Gambar" class="img-fluid" style="width:40px; border-radius:5px;"></td>
                    <td><?= htmlspecialchars($row['Buat_data']); ?></td>
                    <td><?= htmlspecialchars($row['Update_data']); ?></td>
                    <td>
                      <a href="../service/update/update-admin-film.php?id=<?= $row['Id_film']; ?>" class="btn btn-warning text-decoration-none text-light fw-bold">Edit</a>
                    </td>
                    <td>
                      <a href="../service/delete/delete-admin-film.php?id=<?= $row['Id_film']; ?>" class="btn btn-danger text-decoration-none text-light fw-bold">Hapus</a>
                    </td>
                  </tr>
                <?php }  ?>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Add film Modal -->
        <div class="modal fade" id="addFilmModal" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title text-warning">Tambah Data Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
                <form method="POST" enctype="multipart/form-data">
                  <div class="mb-3">
                    <label class="form-label">Genre</label>
                    <select name="genre" class="form-select" required>
                      <option value="">Pilih Genre</option>
                      <?php
                      while ($genre = $resultGenre->fetch_assoc()) {
                        echo "<option value='" . $genre['Id_genre'] . "'>" . htmlspecialchars($genre['Nama_genre']) . "</option>";
                      }
                      ?>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Rilis</label>
                    <input type="date" name="rilis" class="form-control">
                  </div>
                  <div class="mb-3">
                    <h6 class="fw-bold text-light">Masukan Deskripsi Film</h6>
                    <br>
                    <label class="form-label">Judul</label>
                    <input type="text" name="judul" class="form-control">
                    <label class="form-label">Sutradara</label>
                    <input type="text" name="sutradara" class="form-control">
                    <label class="form-label">Di Produksi</label>
                    <input type="text" name="di_produksi" class="form-control">
                    <label class="form-label">Di Tulis</label>
                    <input type="text" name="di_tulis" class="form-control">
                    <label class="form-label">Di Bintangi</label>
                    <input type="text" name="di_bintangi" class="form-control">
                    <label class="form-label">Durasi</label>
                    <input type="text" name="durasi" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Gambar</label>
                    <input type="file" class="form-control" name="gambar">
                  </div>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                  <button type="submit" class="btn btn-warning">Simpan</button>
              </div>
              </form>
            </div>
          </div>
        </div>
        <!-- show Desc -->
        <div class="modal fade" id="showDesc" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title text-warning">Deskripsi Film</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
              <?php while($rowDesc = $rowFilm) {?>
                <div class="d-flex gap-1">
                  <h6>Judul</h6>
                  <h6><? $rowDesc['Judul']; ?></h6>
              </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>