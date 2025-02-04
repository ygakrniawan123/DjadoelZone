<?php
session_start();
// if (!isset($_SESSION['user_id'])) {
//   header("location: index.php");
//   exit();
// }
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DjadoelZone | Website</title>
  <!-- css -->
  <link rel="stylesheet" href="./assets/css/index.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- my font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Orbitron:wght@400..900&family=Rubik+Wet+Paint&family=Unlock&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Orbitron:wght@400..900&family=Rubik+Wet+Paint&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&family=Unlock&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Orbitron:wght@400..900&family=Rubik+Wet+Paint&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&family=Unlock&display=swap" rel="stylesheet">
  <!-- my font -->
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  <!-- aos css -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <!-- aos css -->
</head>

<body>
  <!-- navbar section -->
  <nav class="navbar navbar-expand-lg shadow-lg fixed-top">
    <div class="container">
      <a class="navbar-brand text-light" href="#">DjadoelZone</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link text-light" aria-current="page" href="#">Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="#">Film</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="#">Contact</a>
          </li>
          <?php if (isset($_SESSION['is_login']) && $_SESSION['is_login'] === true): ?>
            <li class="nav-item d-flex">
                <a class="nav-link text-light" href="Logout.php"><button class="btn btn-outline-warning text-center text-light fw-bold">Logout</button></a>
                <button class="btn btn-outline-warning text-light fw-bold" ><i class="fa-solid fa-user"></i></button>
            </li>
          <?php else: ?>
            <li class="nav-item">
               <a class="nav-link text-light" href="login.php"><button class="btn btn-warning text-light fw-bold">Login</button></a>
            </li>
            <li class="nav-item">
               <a class="nav-link text-light" href="register.php"><button class="btn btn-outline-warning text-light fw-bold">Register</button></a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>
  <!-- navbar section -->

  <!-- jumbotron section -->
  <div class="jumbotron p-4">
    <div class="jumbotron-item text-center mt-5 p-5 d-flex justify-content-center mx-auto flex-wrap">
      <div class="jumbo-card d-flex">
        <div class="iconImage mx-auto d-flex justify-content-center">
          <h1 class="mt-5 text-warning fw-bold text-jumbo">Djadoel Zone </h1>
          <img src="./assets/img/image-3d.png" alt="" class="position-absolute">
        </div>
      </div>
    </div>
    <div class="text-film-jumbo mx-auto mt-2">
      <h1 class="text-warning">Tonton Sekarang</h1>
      <p class="text-light ms-3 mt-2">Di website ini kita nyediain film film keren jaman dahulu yang pastinya legend banget bro,
        <br>Langsung klik tombol oi bawah .
      </p>
      <button class="btn btn-warning text-light fw-bold ms-3">Tonton</button>
    </div>
    <!-- <button class="btn btn-warning text-light fw-bold text-center mx-auto d-flex justify-content-center">Tonton Sekarang</button> -->
  </div>
  <!-- jumbotron section -->



  <!-- tentang-kami-section -->

  <div class="tentang-kami">
    <div class="tentang-kami-item p-2 mt-5">
      <div class="tentang-kami-tittle p-2 mt-5">
        <h1 class="text-center text-light">Tentang Kami</h1>
        <div class="d-flex justify-content-center">
          <hr class="text-light " style="width: 55%;">
        </div>
      </div>
      <div class="tentang-kami-sec d-flex justify-content-center mt-5 gap-5" data-aos="fade-down">
        <div class="article-tentang-kami text-light">
          <h1 class="text-warning">Djadoel Zone</h1>
          <hr class="text-light " style="width: 55%;">
          <p class="text-light">
            Selamat datang di Nostalgia, tempat streaming film jadul terbaik!
            <br>
            Kami hadir untuk membantu Anda menemukan kembali kenangan masa lalu
            <br>
            melalui koleksi film-film klasik yang melegenda.
            <br>
            Nikmati berbagai film lawas berkualitas dengan mudah dan nyaman,
            <br>
            hanya di platform streaming Nostalgia!
          </p>
        </div>

        <div class="tentang-kami-article-img">
          <div class="img-1 position-relative">
            <img src="assets/img/side-2.jpg" alt="" width="500" class="position-absolute">
          </div>
          <div class="img-2 position-relative">
            <img src="assets/img/side-bg.jpg" alt="" width="500" class="">
          </div>
        </div>
      </div>
      <div class="article-2 mt-5 ps-5 " data-aos="fade-up">
        <div class="article-2-item d-flex gap-5">
          <div class="article-image">
            <div class="article-image-item p-4 text-light">
              <h1><span class="text-warning">Temukan</span> Film Klasik
                <br>Kesukaan.
                <h1>Hanya <span class="text-warning"> Di Sini!</span></h1>
                <hr class="text-light" style="width: 20%;">
                <div class="button-article-2-image">
                  <button class="btn btn-warning">
                    <p class="text-light">tonton film</p>
                  </button>
                </div>
              </h1>
            </div>
          </div>
          <div class="article-2-text">
            <div class="article-2-text-item text-light">
              <H1 class="text-warning">Selera Lo</H1>
              <hr class="text-light " style="width: 65%;">
              <p class="" style="width: 50%;">
                Nawarin lo film-film jadul yang udah rare banget,
                nyari sendiri? Susah cuy!
                Cuma di sini lo bisa dapetin film-film klasik yang legit abis~
                Yuk gabung jadi bagian dari kita!
                Tinggal klik tombol di bawah, gampang kan?
              </p>
              <div class="button-sign gap-4">
                <button class="btn btn-warning text-light">Tonton Sekarang</button>
                <a href="register.html">
                  <button class="button-lgin btn btn-outline-warning text-light">Register</button>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
  <!-- tentang-kami-section -->

  <!-- menu film -->
  <div class="film-menu p-5">
    <div class="menu-film-header">
      <h1 class="text-light text-center">Menu Film</h1>
      <hr class="text-light" style="width: 100%;">
    </div>
    <div class="menu-film-field-2 mx-auto mt-5 p-5 d-flex justify-content-center gap-1" data-aos="zoom-in">
      <div class="text-field-2">
        <h1 class="text-light">DjadoelZone</h1>
        <hr class="text-light">
        <p class="text-light" style="max-width: 60%;"> Nyari film jadul yang udah susah banget ditemuin? Chill, di sini semuanya udah kita kumpulin buat lo!
          Dari film gelut gelut an yang epic banget dan legend, semua ada di sini.
          Tinggal duduk, santai, dan nikmatin nostalgia yang gak ada matinya.
        </p>
        <div>
        </div>
      </div>
      <div class="content-1 mt-3">
        <img src="./assets/img/side-2.jpg" alt="" width="300" style="border-radius: 10px;">
      </div>
    </div>
  </div>
  <!-- menu film -->

  <!-- katalog film -->
  <div class="katalog-film p-5">
    <div class="katalog-film-content mx-auto">
      <div class="katalog-field d-flex justify-content-evenly mx-auto p-5">
        <div class="katalog-field-1 p-2" data-aos="fade-right">>
          <div class="text-light text-katalog-field-1">
            <h5 class="fw-bold">Yuk</h5>
            <h5 class="fw-bold">Ketahui</h5>
            <h5 class="fw-bold">Selera Lo</h5>
            <p class="fw-bold">Ini Bukan tentang usia lo bro,
              <br>ini tentang selera lo.
            </p>
          </div>
        </div>
        <div class="katalog-field-2" data-aos="fade-left">>
          <div class="text-katalog-field-2 text-light p-2">
            <h5 class="fw-bold text-light">Pria</h5>
            <h5 class="text-light fw-bold">Ngerti</h5>
            <h5 class="fw-bold text-light">Kualitas</h5>
            <p class="text-light fw-bold">Dari era dulu, kita selalu bawa website keren ini ke lo, yang ngerti kualitas bro.</p>
          </div>
        </div>
      </div>

      <div class="genre-itm d-flex mx-auto justify-content-center gap-3">
        <div class="card-genre-1" data-aos="flip-up">
          <h5>Action</h5>
        </div>
        <div class="card-genre-2" data-aos="flip-down">
          <h5>Komedi</h5>
        </div>
        <div class="card-genre-3" data-aos="flip-up">
          <h5>Horor</h5>
        </div>
        <div class="card-genre-4" data-aos="flip-down">
          <h5>Romantis</h5>
        </div>
        <div class="card-genre-5" data-aos="flip-up">
          <h5>Drama</h5>
        </div>
        <div class="card-genre-6" data-aos="flip-down">
          <h5>Trending</h5>
        </div>
      </div>

      <div class="katalog-film-itm d-flex gap-2 p-5 flex-wrap mx-auto justify-content-center" data-aos="zoom-out">
        <div class="card-katalog-1">
          <img src="./assets/img/cover-4.jpg" alt="" width="200" style="border-radius: 5px;">
          <h5 class="text-light fw-bold text-center">Drunken Master</h5>
          <div class="d-flex justify-content-center gap-1">
            <a href="./tonton-film/fillm1.html" class="btn btn-outline-warning text-light"><i class="fa-solid fa-play"></i></a>
            <a href="./deskripsi/film-1.html" class="btn btn-outline-warning text-light"><i class="fa-solid fa-book"></i></a>
          </div>
        </div>
        <div class="card-katalog-2">
          <img src="./assets/img/cover-5.jpg" alt="" width="200" style="border-radius: 5px;">
          <h5 class="text-light fw-bold text-center">Mr Vampire</h5>
          <div class="d-flex justify-content-center gap-1">
            <a href="./tonton-film/fillm1.html" class="btn btn-outline-warning text-light"><i class="fa-solid fa-play"></i></a>
            <a href="./deskripsi/film-1.html" class="btn btn-outline-warning text-light"><i class="fa-solid fa-book"></i></a>
          </div>
        </div>
        <div class="card-katalog-3">
          <img src="./assets/img/cover-6.jpg" alt="" width="200" style="border-radius: 5px;">
          <h5 class="text-light fw-bold text-center">God Of Gamblers</h5>
          <div class="d-flex justify-content-center gap-1">
            <a href="./tonton-film/fillm1.html" class="btn btn-outline-warning text-light"><i class="fa-solid fa-play"></i></a>
            <a href="./deskripsi/film-1.html" class="btn btn-outline-warning text-light"><i class="fa-solid fa-book"></i></a>
          </div>
        </div>
        <div class="card-katalog-4">
          <img src="./assets/img/cover-7.jpg" alt="" width="200" style="border-radius: 5px;">
          <h5 class="text-light fw-bold text-center">Police Story 2</h5>
          <div class="d-flex justify-content-center gap-1">
            <a href="./tonton-film/fillm1.html" class="btn btn-outline-warning text-light"><i class="fa-solid fa-play"></i></a>
            <a href="./deskripsi/film-1.html" class="btn btn-outline-warning text-light"><i class="fa-solid fa-book"></i></a>
          </div>
        </div>
        <div class="card-katalog-5">
          <img src="./assets/img/cover-8.jpg" alt="" width="200" style="border-radius: 5px;">
          <h5 class="text-light fw-bold text-center">Police Story</h5>
          <div class="d-flex justify-content-center gap-1">
            <a href="./tonton-film/fillm1.html" class="btn btn-outline-warning text-light"><i class="fa-solid fa-play"></i></a>
            <a href="./deskripsi/film-1.html" class="btn btn-outline-warning text-light"><i class="fa-solid fa-book"></i></a>
          </div>
        </div>
        <div class="card-katalog-6">
          <img src="./assets/img/cover-9.jpg" alt="" width="200" style="border-radius: 5px;">
          <h5 class="text-light fw-bold text-center">Police Story</h5>
          <div class="d-flex justify-content-center gap-1">
            <a href="./tonton-film/fillm1.html" class="btn btn-outline-warning text-light"><i class="fa-solid fa-play"></i></a>
            <a href="./deskripsi/film-1.html" class="btn btn-outline-warning text-light"><i class="fa-solid fa-book"></i></a>
          </div>
        </div>
        <div class="card-katalog-7">
          <img src="./assets/img/cover-10.jpg" alt="" width="200" style="border-radius: 5px;">
          <h5 class="text-light fw-bold text-center">Police Story</h5>
          <div class="d-flex justify-content-center gap-1">
            <a href="./tonton-film/fillm1.html" class="btn btn-outline-warning text-light"><i class="fa-solid fa-play"></i></a>
            <a href="./deskripsi/film-1.html" class="btn btn-outline-warning text-light"><i class="fa-solid fa-book"></i></a>
          </div>
        </div>
        <div class="card-katalog-8">
          <img src="./assets/img/cover-11.jpg" alt="" width="200" style="border-radius: 5px;">
          <h5 class="text-light fw-bold text-center">Police Story</h5>
          <div class="d-flex justify-content-center gap-1">
            <a href="./tonton-film/fillm1.html" class="btn btn-outline-warning text-light"><i class="fa-solid fa-play"></i></a>
            <a href="./deskripsi/film-1.html" class="btn btn-outline-warning text-light"><i class="fa-solid fa-book"></i></a>
          </div>
        </div>
        <div class="card-katalog-9">
          <img src="./assets/img/cover-12.jpg" alt="" width="200" style="border-radius: 5px;">
          <h5 class="text-light fw-bold text-center">Police Story</h5>
          <div class="d-flex justify-content-center gap-1">
            <a href="./tonton-film/fillm1.html" class="btn btn-outline-warning text-light"><i class="fa-solid fa-play"></i></a>
            <a href="./deskripsi/film-1.html" class="btn btn-outline-warning text-light"><i class="fa-solid fa-book"></i></a>
          </div>
        </div>
        <div class="card-katalog-10">
          <img src="./assets/img/cover-13.jpg" alt="" width="200" style="border-radius: 5px;">
          <h5 class="text-light fw-bold text-center">Police Story</h5>
          <div class="d-flex justify-content-center gap-1">
            <a href="./tonton-film/fillm1.html" class="btn btn-outline-warning text-light"><i class="fa-solid fa-play"></i></a>
            <a href="./deskripsi/film-1.html" class="btn btn-outline-warning text-light"><i class="fa-solid fa-book"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- katalog film -->

  <!-- footer section -->
  <footer class="bg-dark text-light py-4">
    <div class="container">
      <div class="row">
        <div class="col-md-4 mb-3">
          <h5>Discalimer</h5>
          <p>Semua sumber film di website ini adalah bajakan,
            <br>dan semuanya murni hanya untuk tugas akhir magang saya.
            <br>
            <br>Website ini tidak bermaksud untuk menyalin, memplagiat, atau mencuri karya orang lain.
            <br>Sekali lagi, website ini hanya untuk keperluan tugas akhir magang saya.
          </p>
          <p>Terima kasih.</p>

        </div>
        <div class="col-md-4 mb-3">
          <h5>Halaman</h5>
          <ul class="list-unstyled">
            <li><a href="#" class="text-light text-decoration-none">Beranda</a></li>
            <li><a href="#" class="text-light text-decoration-none">Tentang Kami</a></li>
            <li><a href="#" class="text-light text-decoration-none">Menu Film</a></li>
            <li><a href="#" class="text-light text-decoration-none">Contact</a></li>
          </ul>
        </div>
        <div class="col-md-4 mb-3">
          <h5>Info Kontak</h5>
          <div class="social-links">
            <a href="#" class="text-light me-3"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="text-light me-3"><i class="fab fa-twitter"></i></a>
            <a href="#" class="text-light me-3"><i class="fab fa-instagram"></i></a>
            <a href="#" class="text-light"><i class="fab fa-youtube"></i></a>
          </div>
          <br>
          <div class="Contact-me">
            <p><i class="fa-solid fa-phone"></i> 0838-4708-0510</p>
            <p><i class="fa-solid fa-envelope"></i> ygagzx36@gmail.com</p>
            <p><i class="fa-solid fa-location-dot"></i> Boromulyo - Tuwiri Wetan - Merakurak - Tuban </p>

        </div>
      </div>
      <hr>
      <div class="text-center">
        <p class="mb-0">by YgaKrniawan_&copy; </p>
      </div>
    </div>
  </footer>
  <!-- footer section -->

   <!-- profile modal -->
    <div class="profil" table-index>

    </div>
   <!-- profile modal -->
  <!-- aos js -->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
  <!-- aos js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/77348c0c0c.js" crossorigin="anonymous"></script>
</body>

</html>