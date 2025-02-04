<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manajemen Histori User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
      body {
        background: linear-gradient(45deg, #1a1a1a, #2d2d2d);
        color: #fff;
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
        padding: 20px;
      }
      .card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        transition: transform 0.3s ease;
      }
      .card:hover {
        transform: translateY(-5px);
      }
      .card-title {
        color: #ffc107;
      }
      .card-text {
        color: #fff;
      }
      .table {
        color: #fff;
      }
      .table thead {
        background: rgba(255, 255, 255, 0.1);
      }
      .table tbody tr {
        transition: all 0.3s ease;
      }
      .table tbody tr:hover {
        background: rgba(255, 255, 255, 0.1);
      }
    </style>
  </head>
  <body>
    <div class="container-fluid">
      <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar">
          <h3 class="text-warning mb-4">Menu Admin</h3>
          <a href="user-admin.html"><i class="bi bi-people-fill"></i> Kelola User</a>
          <a href="histori-user-admin.html"><i class="bi bi-person-badge"></i> Kelola HIstori User</a>
          <a href="dasboard-admin.html"><i class="bi bi-box-arrow-right"></i> Keluar</a>
        </div>
        
        <!-- Main Content -->
        <div class="col-md-10 content">
          <div class="d-flex justify-content-betwee
          n align-items-center mb-4">
            <h2 class="text-warning">Manajemen Histori User</h2>
            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#addUserModal">
              <i class="bi bi-person-plus"></i> Tambah Data Baru
            </button>
          </div>
          
          
          <!-- User Stats -->
          <div class="row">
          
          
          <!-- User Table -->
          <div class="card mt-4">
            <div class="card-header bg-warning text-dark">
              <i class="bi bi-table me-2"></i>Daftar Histori
            </div>
            <div class="card-body">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th><i class="bi bi-person me-2"></i>Id</th>
                    <th><i class="bi bi-envelope me-2"></i>Id User</th>
                    <th><i class="bi bi-shield me-2"></i>Id Film</th>
                    <th><i class="bi bi-circle me-2"></i>Durasi Nonton</th>
                    <th><i class="bi bi-circle me-2"></i>Di Tonton Pada</th>
                    <th><i class="bi bi-calendar me-2"></i>Buat Data</th>
                    <th><i class="bi bi-calendar me-2"></i>Update Data</th>
                    <th><i class="bi bi-gear me-2"></i>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td><div class="d-flex gap-1">
                      <button class="btn btn-warning">Edit</button>
                      <button class="btn btn-danger">Hapus</button>
                    </div></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content bg-dark">
          <div class="modal-header">
            <h5 class="modal-title text-warning">Tambah Data Baru</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <form>
              <div class="mb-3">
                <label class="form-label">Id User</label>
                <input type="integer" class="form-control bg-dark text-light">
              </div>
              <div class="mb-3">
                <label class="form-label">Id FIlm</label>
                <input type="integer" class="form-control bg-dark text-light">
              </div>
              <div class="mb-3">
                <label class="form-label">Durasi Nonton</label>
                <input type="Integer" class="form-control bg-dark text-light">
              </div> 
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="button" class="btn btn-warning">Tambah Pengguna</button>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
