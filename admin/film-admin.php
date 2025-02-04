<!-- php -->
<?php
include "../service/koneksi.php"; // koneksi ke database
// mengambil data tabel genre 
$stmt = $conn->prepare("SELECT * FROM genre");
$stmt->execute();
$resultGenre = $stmt->get_result();

// query untuk menggabungkan tabel genre dan film 
$stmt = $conn->prepare("SELECT film.*, genre.Nama_genre FROM film INNER JOIN genre ON film.Id_genre = genre.Id_genre ORDER BY film.Id_film DESC");
$stmt->execute();
$resultFilm = $stmt->get_result();



// menangani searching data 
$searchQuery = "";
if (isset($_GET['cari-data'])) { // mengecek apakah tombol cari di klik
  $keyword = $_GET['cari-data']; // mendapatkan data dari keyword(kata yang di ketik)
  $stmt = $conn->prepare("SELECT * FROM film WHERE Nama LIKE ? OR Judul LIKE ?");
  $keyWord = "%$keyword%"; // membuat variable untuk menampung inputan dari tombol seraching beserta isinya
  $stmt->bind_param("ss", $keyWord, $keyWord);
  $stmt->execute();
  $searchQuery = $stmt->get_result();
} else {
  $stmt = $conn->prepare("SELECT * FROM film ORDER BY Id_film DESC");
  $stmt->execute();
  $searchQuery = $stmt->get_result();
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $genre = htmlspecialchars($_POST['genre']);
  $nama = htmlspecialchars($_POST['nama']);
  $rilis = htmlspecialchars($_POST['rilis']);
  $judul = htmlspecialchars($_POST['judul']);
  $sutradara = htmlspecialchars($_POST['sutradara']);
  $di_produksi = htmlspecialchars($_POST['di_produksi']);
  $di_tulis = htmlspecialchars($_POST['di_tulis']);
  $di_bintangi = htmlspecialchars($_POST['di_bintangi']);
  $durasi = htmlspecialchars($_POST['durasi']);
  $type = "full";

  // melakukan validasi jika form kosong 
  if (empty($genre) || empty($nama) || empty($rilis) || empty($judul) || empty($sutradara) || empty($di_produksi) || empty($di_tulis) || empty($di_bintangi) || empty($durasi)) {
    echo "<script>alert('Data yang anda masukan tidak lengkap, mohon masukan kembali dengan lengkap.');</script>"; // memberikan alert karena data tidak di isi dengan lengkap
  } else {

    if (!ctype_digit($rilis)) {
      echo "<script>alert('Tahun rilis yang Anda masukan bukan angka, mohon masukan angka.');</script>";
    } elseif (strlen($rilis) != 4) { // Panjang karakter harus 4
      echo "<script>alert('Tahun rilis harus terdiri dari 4 angka.');</script>";
    } else {

      // melakukan validasi data file pada form untuk tambah data
      $fileName = $_FILES['gambar']['name'];
      $fileErr = $_FILES['gambar']['error'];
      $fileSize = $_FILES['gambar']['size'];
      $fileTmp = $_FILES['gambar']['tmp_name'];

      // melakukan pengecekan jika file tidak ada yang di upload pada form / kosong
      if ($fileErr == 4) {
        echo "<script>alert(Anda belum memasukan file gambar pada form, Mohon masukan terlebih dahulu.');</script>"; // memberikan alert karena data tidak di isi dengan lengkap
      }


      // melakukan pengecekan dan membatasii ukuran file gamnbar yang di upload


      // menentukan jenis file gambar yang dapat di upload
      $fileType = ['png', 'jpeg', 'jpg'];
      $extensiGambar = explode('.', $fileName);
      $extensiGambar = strtolower(end($extensiGambar));

      // melakukan pengecekan jika file yanh doi upload bukanlah tipe data file gambar
      if (!in_array($extensiGambar, $fileType)) {
        echo "<script>alert(File yang anda masukan bukanlah gambar, Mohon ganti dengan file gambar.');</script>"; // memberikan alert karena data tidak di isi dengan lengkap
      }


      // menentukan direktori gambar
      $newName = uniqid();
      $direktori = "../cover/";
      $newFileName = $direktori . $newName . '.' . $extensiGambar;

      // melakukan query insert data ke database jika gambar berhasil di pindhkan ke direktori
      if (move_uploaded_file($fileTmp, $newFileName)) {
        // Menyiapkan query untuk insert data ke database
        $stmt = $conn->prepare("INSERT INTO film(Id_genre, Nama, Rilis, Judul, Sutradara,  Di_produksi, Di_tulis, Di_bintangi, Durasi, Type, Gambar, Buat_data, Update_data) 
      VALUES (?,?,?,?,?,?,?,?,?,?,?, NOW(), NOW())");
        // melakukan pengecekan jika input rilis tidak int
        // Bind parameter untuk data yang akan dimasukkan
        $stmt->bind_param("issssssssss", $genre, $nama, $rilis, $judul, $sutradara, $di_produksi, $di_tulis, $di_bintangi, $durasi, $type, $newFileName);
        // Eksekusi query
        $stmt->execute();
        $resultForm = $stmt->get_result();
        // Menampilkan pesan berhasil menambahkan data
        echo '<div class="alert alert-warning" role="alert">Data berhasil disimpan!</div>';
        echo "<script>
            setTimeout(function() {
                window.location.href = '/nostalgia/admin/film-admin.php';
            }, 1000); // Redirect setelah 1 detik
          </script>";
      } else {
        // Menampilkan pesan jika gagal menambahkan data

      }
    }
  }
}



?>


<!doctype html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <link rel="stylesheet" href="iziToast.min.css">
  <style>
    body {
      background: linear-gradient(45deg, #1a1a1a, #2d2d2d);
      color: #fff;
      font-family: Arial, sans-serif;
      height: 500vh;
    }

    .alert {
      transition: 3s;
    }

    .sidebar {
        height: 100vh;
        background: linear-gradient(180deg, #212529, #000000);
        padding: 20px;
        box-shadow: 5px 0 15px rgba(0,0,0,0.3);
      }
      .sidebar a {
        color: #fff;
        text-decoration: none;
        display: flex;
        align-items: center;
        padding: 12px;
        margin: 8px 0;
        transition: all 0.3s ease;
        border-left: 3px solid transparent;
      }
      .sidebar a i {
        margin-right: 10px;
        font-size: 1.2em;
      }
      .sidebar a:hover {
        background: linear-gradient(90deg, #343a40, #212529);
        border-left: 3px solid #ffc107;
        transform: translateX(5px);
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
      <!-- Sidebar -->
      <div class="col-md-2 sidebar">

        <h3 class="text-warning mb-4">Admin Panel</h3>
        <a href="index-admin.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
        <a href="user-admin.php"><i class="bi bi-people-fill"></i> Kelola User</a>
        <a href="film-admin.php"><i class="bi bi-film"></i> Kelola film</a>
        <a href="../login.php"><i class="bi bi-box-arrow-right"></i> Keluar</a>
      </div>


      <!-- Main Content -->
      <div class="col-md-10 content">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h2 class="text-warning">Manajemen Film</h2>
          <div class="d-flex gap-3">
            <!-- tombol untuk searching -->
            <form action="" method="GET">
              <input type="text" name="cari-data" class="btn btn-outline-warning text-light" size="15">
              <button class="btn btn-warning  text-light" type="submit">Cari</button>
            </form>
            <!-- tombol untuk menambahkan data -->
            <button class="btn btn-warning text-light fw-bold" data-bs-toggle="modal" data-bs-target="#addFilmModal">
              <i class="bi bi-person-plus text-light fw-bold"></i>
            </button>
          </div>
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
                  <th>Tahun Rilis</th>
                  <th>Deskripsi</th>
                  <th>Type</th>
                  <th>Gambar</th>
                  <th>Buat Data</th>
                  <th>Update Data</th>
                  <th class="text-end">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <!-- Data akan diisi oleh PHP -->
                <?php
                $no = 1;
                while ($row = $resultFilm->fetch_assoc()) { ?>
                  <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['Nama_genre']); ?></td>
                    <td><?= htmlspecialchars($row['Nama']); ?></td>
                    <td><?= date("Y", strtotime($row['Rilis'])); ?></td>
                    <td>
                      <form action="../service/show-desc/show.php" method="GET">
                        <input type="hidden" name="id_desc" value="<?= $row['Id_film']; ?>">
                        <input type="submit" value="lihat" class="btn btn-outline-warning text-dark fw-bold">
                      </form>
                    </td>
                    <td><?= htmlspecialchars($row['Type']); ?></td>
                    <td><img src="../cover/<?= htmlspecialchars($row['Gambar']); ?>" alt="Gambar" class="img-fluid" style="width:40px; border-radius:5px;"></td>
                    <td><?= htmlspecialchars($row['Buat_data']); ?></td>
                    <td><?= htmlspecialchars($row['Update_data']); ?></td>
                    <td>
                      <a href="../service/update/update-admin-film.php?id=<?= $row['Id_film']; ?>" class="btn btn-warning text-decoration-none text-light fw-bold">Edit</a>
                      <a href="../service/delete/delete-admin-film.php?id=<?= $row['Id_film']; ?>" class="btn btn-danger text-decoration-none text-light fw-bold">Hapus</a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Add Film Modal -->
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
                    <label class="form-label">Rilis (Hanya Tahun Saja)</label>
                    <input type="number" name="rilis" class="form-control" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" name="judul" class="form-control" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Sutradara</label>
                    <input type="text" name="sutradara" class="form-control" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Di produksi</label>
                    <input type="text" name="di_produksi" class="form-control" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">DI tulis</label>
                    <input type="text" name="di_tulis" class="form-control" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Di bintangi</label>
                    <input type="di_bintangi" name="di_bintangi" class="form-control" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Durasi</label>
                    <input type="text" name="durasi" class="form-control" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Gambar</label>
                    <input type="file" class="form-control" name="gambar">
                  </div>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                  <button type="submit" class="btn btn-warning">Simpan</button>
                </form>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>