<!-- php -->
<?php
//  koneksi ke database
include '../koneksi.php';

// query untuk menangkap id user yang nantinya akan di masukan ke modal update data
$id_user = $_GET['id'] ?? NULL;
// mengambil data id dengan query jika id di temukan dan jika tidal akan di setel ke null
if($id_user){
    $stmt = $conn->prepare("SELECT *  FROM user WHERE Id_user = ?");
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $userId = $stmt->get_result()->fetch_assoc();
}


//   cek jika user di id user di temukan
if ($userId) {
    // validasi data user
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $nama_pengguna = htmlspecialchars($_POST['nama_pengguna']);
        $email = htmlspecialchars($_POST['email']);
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        $role = htmlspecialchars($_POST['role']);

        // jika password baru di inputkan
        if (!empty($password)) {
            $password = password_hash($password, PASSWORD_DEFAULT);
        } else {
            // jika password tidak di ganti
            $password = $userId['Password'];
        }

        // melakukan proses update dengan preparew statement
        $stmtUpdate = $conn->prepare("UPDATE user SET Nama_pengguna = ?, Email = ?, Username = ?, Password = ?, Role = ?, update_data = CURRENT_TIMESTAMP WHERE Id_user = ?");
        $stmtUpdate->bind_param("sssssi", $nama_pengguna, $email, $username, $password, $role, $id_user);

        // Memberikan validasi jika data berhasil di-update
        if ($stmtUpdate->execute()) {
            // mengarahkan ke halaman admin jika data berhasil di update
            echo "<script>alert('Berhasi Memperbarui Data, Sekarang Anda Akan Di Arahkan Ke Halaman Admin'); window.location.href='/nostalgia/admin/user-admin.php';</script>";
            exit;
        } else {
            echo "<script>alert('Gagal Memperbarui Data User');</script>";
        }
    }
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
            height: 110vh;
        }

        .modal-content {
            background-color: #343a40;
            height: 600px;
            width: 500px;
            border-radius: 20px;
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
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="modal-dialog">
            <div class="modal-content p-5 mt-2 shadow-lg" data-aos="fade-down">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-light">Edit Pengguna Baru</h5>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <input type="hidden" name="id_user" value="<?= $userId['Id_user']; ?>">
                        <div class="mb-3">
                            <label for="nama_pengguna" class="form-label text-light">Nama Pengguna</label>
                            <input type="text" class="form-control" id="nama_pengguna" name="nama_pengguna" value="<?= $userId['Nama_pengguna']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label text-light">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= $userId['Email']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label text-light">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?= $userId['Username']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label text-light">Password (Kosongkan jika tidak ingin diubah)</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label text-light">Role</label>
                            <select class="form-select" id="role" name="role">
                                <option value="user" <?= $userId['Role'] == 'user' ? 'selected' : '' ?>>User</option>
                                <option value="admin" <?= $userId['Role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                            </select>
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