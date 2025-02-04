<!-- php -->
<?php
// keneksi ke database
include './service/koneksi.php';

// Mendapatkan data dari form yang methodnya adalah post
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $nama_pengguna = htmlspecialchars($_POST['nama_pengguna']);
  $email_pengguna = htmlspecialchars($_POST['email_pengguna']);
  $username = htmlspecialchars($_POST['username']);
  $password = htmlspecialchars($_POST['password']);

  // melakukan pengecekan jika data tidak di isi dengan lemgkap
  if (empty($nama_pengguna) || empty($email_pengguna) || empty($username) || empty($password)) {
    echo "<script>alert('Data Yang Anda Masukan Tidak Lengkap,Mohon Untuk Mengisi Semua Data'); window.location.href='register.php';</script>";
  } else {
      // hash password
      $has_pw = password_hash($password, PASSWORD_DEFAULT);
      // menyiapkan query dengan prepare statent
      $stmt = $conn->prepare("SELECT Id_user FROM user WHERE Email=? OR Username=?");
      $stmt->bind_param("ss", $email_pengguna, $username);
      $stmt->execute();
      $result = $stmt->get_result();
      // melakukan cek jika username dan email sudah ada di database
      if ($result->num_rows > 0) {
        echo "<script>alert('Email Atau Username Sudah Ada, Mohon Masukan Yang Lain'); window.location.href='register.php';</script>";
      } else {
        // jika username belum ada
        $stmt = $conn->prepare("INSERT INTO user(Nama_pengguna,Email,Username,Password) VALUES(?,?,?,?)");
        $stmt->bind_param("ssss", $nama_pengguna, $email_pengguna, $username, $has_pw);
        // melakukan validasi jika user berhasil register
        if ($stmt->execute()) {
          echo "<script>alert('Berhasil Register, Sekarang Anda Akan Di Arahkan Ke Halaman Login'); window.location.href='login.php';</script>";
        } else {
          echo "<script>alert('Gagal Register, Mohon Coba Lagi'); window.location.href='register.php';</script>";
        }
      }
    }
  }

?>










<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register - Nostalgia</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/register.css">
  <!-- my font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Orbitron:wght@400..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Rubik+Wet+Paint&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&family=Unlock&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Orbitron:wght@400..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Rubik+Wet+Paint&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&family=Unlock&display=swap" rel="stylesheet">
  <!-- my font -->
  <!-- my aos -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <!-- my aos -->
</head>

<body>
  <!-- login section -->
  <div class="login-section p-2 mt-5 p-5">
    <div class="login-item  mx-auto p-3">
      <div class="p-2 d-flex justify-content-center">
        <div class="login-text mt-4 shadow-lg" data-aos="zoom-out-right">
          <div class="login-text-tittle">
            <h3 class="text-light text-center fw-bold mt-3">R e g i s t e r</h3>
            <div class="d-flex justify-content-center">
              <hr class="text-light" style="width: 20%;">
            </div>
          </div>
          <div class="form">
            <!-- form untuk register -->
            <form action="" method="POST">
              <div class="form-item d-flex justify-content-center flex-column text-center p-5 ms-3">
                <!-- Nama Pengguna -->
                <div class="name-input d-flex gap-3">
                  <h5 class="text-center text-warning p-2">Nama Pengguna:</h5>
                  <input class="name-sty text-light" type="text" name="nama_pengguna">
                </div>
                <!-- Email -->
                <div class="name-input d-flex gap-3">
                  <h5 class="text-center text-warning p-2">Email Pengguna:</h5>
                  <input class="name-sty text-light" type="text" name="email_pengguna">
                </div>
                <!-- username -->
                <div class="username-input d-flex gap-3">
                  <h5 class="text-center text-warning p-2">Username:</h5>
                  <input class="usr-sty text-light" type="text" name="username">
                </div>
                <!-- password -->
                <div class="password-input d-flex mt-3 gap-3">
                  <h5 class="text-center text-warning p-2">password:</h5>
                  <input class="pw-sty text-light" type="password" name="password">
                </div>
                <div class="button-submit text-end">
                  <button class="btn btn-warning mt-3 shadow-lg text-light fw-bold" type="submit" name="register">Register</button>
                  <div class="warning text-end mt-1">
                    <p class="text-light text-end d-inline">Sudah punya akun?</p>
                    <a class="text-decoration-none text-warning text-end" href="login.php">
                      <p class="d-inline">Login</p>
                    </a>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="login-image d-flex justify-content-start mt-4 shadow-lg" data-aos="zoom-out-left">
          <div class="login-image-item text-start ">
            <h1 class="text-warning p-2">DjadoelZne <br>
              Register
            </h1>
            <h1 class="text-light" style=""></h1>
            <div class="text text-start p-3">
              <p class="text-light">silahakan register <br>
                untuk menjadi bagian dari kami <br>
                dan temukan film klasikmu <br>
                hanya di platform streaming film kami
              </p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  <!-- login section -->
  <!-- my aos  -->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
  <!-- my aos  -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>