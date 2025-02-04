<?php
include '../koneksi.php';


$Id_user = $_GET['id'] ?? NULL;// mendapatkan id user dan di setting defult null jika id tidak di temukan
// melakukan query jika id film berhasil di temukan
if($Id_user){
    $stmt = $conn->prepare("SELECT * FROM user WHERE Id_user = ?");
    $stmt->bind_param("i", $Id_user);
    $stmt->execute();
    $resultIduser = $stmt->get_result();
    $user_id = $resultIduser->fetch_assoc();
}
// melakukan query untuk delete film dengan prepare statemnt
$deleteUser = $conn->prepare("DELETE FROM user WHERE Id_user = ?");
$deleteUser->bind_param("i", $Id_user);

// melakukan validasi jika data film berhasil di hapus
if($deleteUser->execute()){
    echo "<script>
            setTimeout(function() {
                window.location.href = '/nostalgia/admin/user-admin.php';
            }, 1000); // Redirect setelah 1 detik
          </script>";}



?>

<!doctype html>
<html lang="en">
<!-- font -->
<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Orbitron:wght@400..900&family=Rubik+Wet+Paint&family=Unlock&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Orbitron:wght@400..900&family=Rubik+Wet+Paint&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&family=Unlock&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Orbitron:wght@400..900&family=Rubik+Wet+Paint&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&family=Unlock&display=swap" rel="stylesheet">
    <style>
/* HTML: <div class="loader"></div> */
body {
    background-image: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.9)), url(../../assets/img/side-2.jpg);
    background-repeat: no-repeat;
    background-size: cover;
}
.proses {
    font-family: orbitron;
}
.loader {
  width: 20%;
  aspect-ratio: 1;
  --_c:no-repeat linear-gradient(orange 0 0) 50%; 
  background: 
    var(--_c)/100% 50%,
    var(--_c)/50% 100%;
  border-radius: 50%;
  animation: l29 2s infinite linear;
}
@keyframes l29 {
  100% {transform: rotate(1turn)}
}
    </style>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="loader justify-content-center mx-auto mt-5 p-5"></div>
    <div>
        <h1 class="proses text-warning text-center ">Mohon Tunggu . . . </h1>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
