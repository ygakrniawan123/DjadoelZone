<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modal Berlapis dengan Bootstrap</title>
    <!-- Link ke Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Tombol untuk membuka modal pertama -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal1">
  Buka Modal Pertama
</button>

<!-- Modal Pertama -->
<div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="modal1Label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal1Label">Modal Pertama</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Ini adalah modal pertama.
        <br>
        <!-- Tombol untuk membuka modal kedua -->
        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modal2">
          Buka Modal Kedua
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Kedua -->
<div class="modal fade" id="modal2" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal2Label">Modal Kedua</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Ini adalah modal kedua.
        <br>
        <!-- Tombol untuk membuka modal ketiga -->
        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modal3">
          Buka Modal Ketiga
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Ketiga -->
<div class="modal fade" id="modal3" tabindex="-1" aria-labelledby="modal3Label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal3Label">Modal Ketiga</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Ini adalah modal ketiga.
      </div>
    </div>
  </div>
</div>

<!-- Script untuk Bootstrap JS (jQuery dan Bootstrap JS) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
