<?php
include "../koneksi.php";
// Dapatkan ID film dari parameter GET
$Id_film = $_GET['id_desc'] ?? null;
if ($Id_film) {
    // Query untuk mendapatkan deskripsi film berdasarkan ID film
    $stmt = $conn->prepare("SELECT * FROM film WHERE Id_film = ?");
    $stmt->bind_param("i", $Id_film);
    $stmt->execute();
    $resultDesc = $stmt->get_result();

    // Tutup statement
    $stmt->close();
} else {
    $resultDesc = null;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>deskripsi-film</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
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
    <style>
        body {
            background-image: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)), url(side-2.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            height: 110vh;
            background-position: fixed;
        }

        .showDesc {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .judul {
            font-family: orbitron;
        }

        .judul h6 {
            font-size: 35px;
        }

        .loader {
            --s: 40px;
            height: calc(var(--s)*0.9);
            width: calc(var(--s)*5);
            --v1: transparent, #000 0.5deg 108deg, #0000 109deg;
            --v2: transparent, #000 0.5deg 36deg, #0000 37deg;
            -webkit-mask:
                conic-gradient(from 54deg at calc(var(--s)*0.68) calc(var(--s)*0.57), var(--v1)),
                conic-gradient(from 90deg at calc(var(--s)*0.02) calc(var(--s)*0.35), var(--v2)),
                conic-gradient(from 126deg at calc(var(--s)*0.5) calc(var(--s)*0.7), var(--v1)),
                conic-gradient(from 162deg at calc(var(--s)*0.5) 0, var(--v2));
            -webkit-mask-size: var(--s) var(--s);
            -webkit-mask-composite: xor, destination-over;
            mask-composite: exclude, add;
            -webkit-mask-repeat: repeat-x;
            background: linear-gradient(#ffb940 0 0) left/0% 100% #ddd no-repeat;
            animation: l20 2s infinite linear;
        }

        @keyframes l20 {

            90%,
            100% {
                background-size: 100% 100%
            }
        }

        .desc-content {
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.9)), url(side-2.jpg);
            border-radius: 8px;
        }

        .desc-body {
            width: 500px;
            height: 500px;
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.9)), url(side-2.jpg);
            border-radius: 10px;
            cursor: pointer;
            transform: scale(0.9);
            transition: 0.3s;
        }

        .desc-body:hover {
            transform: scale(1);
            transition: 0.5s;
        }


        .desc-header {
            font-family: orbitron;
        }

        .desc-field {
            font-family: orbitron;
            text-align: start;
        }

        .actor-title {
            font-family: orbitron;

        }

        .field-actor {
            font-family: orbitron;
            max-width: 85px;
            gap: 5px;
            white-space: wrap;
            text-overflow: ellipsis;
        }

        .close {
            font-family: orbitron;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="desc-dialog">
            <div class="desc-content p-5 mt-2 shadow-lg" data-aos="fade-down">
                <div class="desc-header">
                    <h5 class="desc-title fw-bold text-warning text-center">- Deskripsi Film -</h5>
                </div>
                <div class="desc-body text-light p-5 justify-content-center">
                    <?php while ($rowDesc = $resultDesc->fetch_assoc()) { ?>
                        <div class="showDesc text-center mx-auto text-warning">
                            <div class="judul d-flex">
                                <h6 class="text-warning"><?= htmlspecialchars($rowDesc['Judul']); ?></h6>
                            </div>
                            <div class="desc-field d-flex gap-1">
                                <h6>Sutradara:</h6>
                                <h6><?= htmlspecialchars($rowDesc['Sutradara']); ?></h6>
                            </div>
                            <div class="desc-field d-flex gap-1">
                                <h6>Di Produksi:</h6>
                                <h6><?= htmlspecialchars($rowDesc['Di_produksi']); ?></h6>
                            </div>
                            <div class="desc-field d-flex gap-1">
                                <h6>Di Tulis:</h6>
                                <h6><?= htmlspecialchars($rowDesc['Di_tulis']); ?></h6>
                            </div>
                            <div class="actor-field d-flex gap-1">
                                <div class="actor-title">
                                    <h6>Di Bintangi:</h6>
                                </div>
                                <div class="field-actor">
                                    <h6><?= htmlspecialchars($rowDesc['Di_bintangi']); ?></h6>
                                </div>
                            </div>
                            <div class="desc-field d-flex gap-1">
                                <h6>Durasi:</h6>
                                <h6><?= htmlspecialchars($rowDesc['Durasi']); ?></h6>
                            </div>
                            <div class="loader"></div>
                        </div>
                        <div class="btn-close-desc mx-auto text-center mt-3">
                            <a href="../../admin/film-admin.php">
                            <button class="close btn btn-outline-warning fw-bold text-light">Kembali</button>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
