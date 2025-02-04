
<?php 
// Koneksi ke database
include './service/koneksi.php';

// Pastikan session dimulai
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    // Perbaikan query: pastikan pengejaan `FROM` benar
    $stmt = $conn->prepare("SELECT Id_user, Password, Role FROM user WHERE Username = ?");
    $stmt->bind_param("s", $username);

    // Menjalankan statement
    $stmt->execute();
    $result = $stmt->get_result();

    // Validasi apakah username ditemukan
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Validasi password
        if (password_verify($password, $row['Password'])) {
            // Menyimpan data ke session
            $_SESSION['user_id'] = $row['Id_user'];
            $_SESSION['user_role'] = $row['Role'];
            $_SESSION['is_login'] = true;
            // Redirect berdasarkan role user
            if ($row['Role'] === "admin") {
                header("location: admin/index-admin.php"); // Halaman admin
            } else {
                header("location: index.php"); // Halaman biasa (user)
            }
            exit(); // Pastikan script berhenti setelah redirect
        } else {
            // Password salah
            echo "<script>alert('Password yang Anda masukkan salah'); window.location.href='login.php';</script>";
        }
    } else {
        // Username tidak ditemukan
        echo "<script>alert('Username yang Anda masukkan tidak ditemukan'); window.location.href='login.php';</script>";
    }
}
?>










<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Nostalgia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/login.css">
    <!-- my font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Orbitron:wght@400..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Rubik+Wet+Paint&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&family=Unlock&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Orbitron:wght@400..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Rubik+Wet+Paint&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&family=Unlock&display=swap" rel="stylesheet">
    <!-- my font -->
    <!-- my aos  -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- my aos  -->
  </head>
  <body>
    <!-- login section -->
     <div class="login-section p-2 mt-5 p-5">
      <div class="login-item  mx-auto p-3">
        <div class="p-2 d-flex justify-content-center">
          <div class="login-image d-flex justify-content-start mt-4 shadow-lg" data-aos="zoom-out-right">
            <div class="login-image-item text-start ">
            <h1 class="text-warning p-2">DjadoelZne<br>
            Login
            </h1>
            <h1 class="text-light" style=""></h1>
              <div class="text text-start p-3">
                <p class="text-light">silahakan login <br>
                untuk menjadi bagian dari kami <br>
                dan temukan film klasikmu <br>
                hanya di platform streaming film kami
              </p>
              </div>
            </div>
          </div>
          <div class="login-text mt-4 shadow-lg" data-aos="zoom-out-left">
            <div class="login-text-tittle">
              <h3 class="text-light text-center fw-bold mt-3">L o g i n</h3>
              <div class="d-flex justify-content-center">
              <hr class="text-light" style="width: 20%;">
              </div>
            </div>
            <div class="form">
              <form action="" method="post">>
                <div class="form-item d-flex justify-content-center flex-column text-center p-5 ms-3">
                  <div class="username-input d-flex gap-3">
                    <h5 class="text-center text-warning p-2">Username:</h5>
                    <input class="usr-sty" type="text" name="username">
                  </div>
                  <div class="password-input d-flex mt-3 gap-3">
                    <h5 class="text-center text-warning p-2">password:</h5>
                    <input class="pw-sty" type="text" name="password">
                  </div>
                  <div class="button-submit text-end">
                   <button class="btn btn-warning mt-3 shadow-lg" type="submit" name="login">Login</button>
                   <div class="warning text-center mt-1">
                    <p class="text-light text-center d-inline">Belum punya akun?</p>
                    <a class="text-decoration-none text-warning text-center" href="register.php"><p class="d-inline">Register</p></a>
                   </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
     </div>
    <!-- login section -->
     <!-- my aos -->
     <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
     <script>
      AOS.init();
    </script>
     <!-- my aos -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>