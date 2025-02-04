<?php
// koneksi ke database
include '../service/koneksi.php';




// menangani searching data 
$searchQuery = "";
if (isset($_GET['cari-data'])) { // mengecek apakah tombol cari di klik
  $keyword = $_GET['cari-data']; // mendapatkan data dari keyword(kata yang di ketik)
  $stmt = $conn->prepare("SELECT * FROM user WHERE Nama_pengguna LIKE ? OR Username LIKE ?");
  $keyWord = "%$keyword%"; // membuat variable untuk menampung inputan dari tombol seraching beserta isinya
  $stmt->bind_param("ss", $keyWord, $keyWord);
  $stmt->execute();
  $searchQuery = $stmt->get_result();
} else {
  $stmt = $conn->prepare("SELECT * FROM user ORDER BY Id_user DESC");
  $stmt->execute();
  $searchQuery = $stmt->get_result();
}
// query untuk menambahkan data pada database dengan prepare statement
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $nama_pengguna = htmlspecialchars($_POST['nama_pengguna']);
  $email = htmlspecialchars($_POST['email']);
  $username = htmlspecialchars($_POST['username']);
  $password = htmlspecialchars($_POST['password']);
  $role = htmlspecialchars($_POST['role']);

  // proses hash pw
  $HashPassword = password_hash($password, PASSWORD_DEFAULT);

  // mengecek jika form yang di isi kosong
  if (empty($nama_pengguna) || empty($email) || empty($username) || empty($password) || empty($role)) {
    echo "<script>alert('Anda belum memasukan semua data, mohon untuk melengkapi data!');</script>";
  } else {
    // melakukan pengecekan jika username dan email sudah ada pada database
    $stmt = $conn->prepare("SELECT Id_user FROM user WHERE username = ? OR Nama_pengguna = ?");
    $stmt->bind_param("ss", $username, $nama_pengguna);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      echo "<script>alert('Username/Nama Pengguna Yang Anda Masukan Sudah Ada, Mohon Untuk Mengganti Dengan Yang Lain');</script>";
    } else {
      // jika data ada
      $stmt = $conn->prepare("INSERT INTO user(Nama_pengguna,Email,Username,Password,Role,Buat_data,Update_data) VALUES (?,?,?,?,?, NOW(), NOW())");
      $stmt->bind_param("sssss", $nama_pengguna, $email, $username, $HashPassword, $role);
      // melakukan validasi jika data berhasil di tambahkan/gagal
      if ($stmt->execute()) {
        echo "<script>alert('Data Berhasil Di Tambahkan'); window.location.href='/nostalgia/admin/user-admin.php';</script>";
      } else {
        echo "<script>alert('Data Gagal Di Tambahkan');</script>";
      }
    }
  }
}

// query untuk menampikan data dari database dengan prepare statement
$stmt = $conn->prepare("SELECT * FROM user ORDER BY Id_user DESC");
$stmt->execute();
$resultData = $stmt->get_result();
?>

<!doctype html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Manajemen User - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <style>
    body {
      background: linear-gradient(45deg, #1a1a1a, #2d2d2d);
      color: #fff;
      font-family: Arial, sans-serif;
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
      height: 100vh;
    }

    .card {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      border: none;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
      width: max-content;
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
      <div class="col-md-10 content p-2">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h2 class="text-warning">Manajemen User</h2>
          <div class="d-flex gap-2">
            <!-- tombol untuk searching data -->
            <form action="" method="GET">
              <input type="text" name="cari-data" class="btn btn-outline-warning text-light" size="15">
              <button class="btn btn-warning  text-light" type="submit">Cari</button>
            </form>
            <div>
              <!-- tombol  untuk menambahhkan data -->
              <button type="button" class="btn btn-warning text-light" data-bs-toggle="modal" data-bs-target="#addUserModal">
                <i class="bi bi-person-plus"></i> Tambah Data Baru
              </button>
            </div>
          </div>
        </div>

        <!-- User Table -->
        <div class="card">
          <div class="card-header bg-warning text-dark">
            <i class="bi bi-table me-2"></i> Daftar User
          </div>
          <div class="card-body">
            <table class="table table-hover 3" style="">
              <thead>
                <tr>
                  <th>#Id</th>
                  <th>Nama Pengguna</th>
                  <th>Email Pengguna</th>
                  <th>Username</th>
                  <th>Role</th>
                  <th>Dibuat</th>
                  <th>Diperbarui</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <!-- data dari database akan di tamppilkan di sini -->
                <?php
                $id = 1;
                while ($row = mysqli_fetch_assoc($searchQuery)) {
                ?>
                  <tr>
                    <td><?= $id++ ?></td>
                    <td><?= $row['Nama_pengguna']; ?></td>
                    <td><?= $row['Email']; ?></td>
                    <td><?= $row['Username']; ?></td>
                    <td><?= $row['Role']; ?></td>
                    <td><?= $row['Buat_data']; ?></td>
                    <td><?= $row['Update_data']; ?></td>
                    <td>
                      <a href="../service/update/update-admin-user.php?id=<?= $row['Id_user']; ?>" class="btn btn-warning text-decoration-none text-light fw-bold">Edit</a>
                      <a href="../service/delete/delete-admin-user.php?id=<?= $row['Id_user']; ?>" class="btn btn-danger text-decoration-none text-light fw-bold">Hapus</a>
                    </td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Add User Modal -->
        <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Tambah Pengguna Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="" method="post">
                  <div class="mb-3">
                    <label for="nama_pengguna" class="form-label">Nama Pengguna</label>
                    <input type="text" class="form-control" id="nama_pengguna" name="nama_pengguna">
                  </div>
                  <div class="mb-3">
                    <label for="nama_pengguna" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                  </div>
                  <div class="mb-3">
                    <label for="email" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username">
                  </div>
                  <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Minimal 8 Huruf">
                  </div>
                  <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select" id="role" name="role">
                      <option value="user">User</option>
                      <option value="admin">Admin</option>
                    </select>
                  </div>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                  <button type="submit" class="btn btn-warning">Tambah Pengguna</button>
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