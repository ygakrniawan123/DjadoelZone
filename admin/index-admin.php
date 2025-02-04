<?php
include "../service/koneksi.php";
session_start();
// Mengecek apakah pengguna sudah login sebagai admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
  header('Location: ../login.php'); // Arahkan ke halaman login jika bukan admin
  exit;
}


?>






<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - page</title>
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

          <h3 class="text-warning mb-4">Admin Panel</h3>
          <a href="index-admin.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
          <a href="user-admin.php"><i class="bi bi-people-fill"></i> Kelola User</a>
          <a href="film-admin.php"><i class="bi bi-film"></i> Kelola film</a>
          <a href="../login.php"><i class="bi bi-box-arrow-right"></i> Keluar</a>
        </div>
        
        <!-- Main Content -->
        <div class="col-md-10 content">
          <h2 class="mb-4 text-warning text-center">Halaman Admin</h2>
          
          <!-- Stats Cards -->
          <div class="row d-flex justify-content-center mx-auto mt-5">
            <div class="col-md-3 mb-4">
              <div class="card">
                <div class="card-body text-center">
                  <i class="bi bi-people-fill mb-3" style="font-size: 2rem;"></i>
                  <h5 class="card-title">Total User</h5>
                  <h2 class="card-text">1,234</h2>
                </div>
              </div>
            </div>
            
            <div class="col-md-3 mb-4">
              <div class="card">
                <div class="card-body text-center">
                  <i class="bi bi-film mb-3" style="font-size: 2rem;"></i>
                  <h5 class="card-title">Total Film</h5>
                  <h2 class="card-text">567</h2>
                </div>
              </div>
            </div>
            
            <div class="col-md-3 mb-4">
              <div class="card">
                <div class="card-body text-center">
                  <i class="bi bi-person-check-fill mb-3" style="font-size: 2rem;"></i>
                  <h5 class="card-title">User Baru</h5>
                  <h2 class="card-text">890</h2>
                </div>
              </div>
            </div>          
          <!--Cta at Dashboard -->
          <div class="Cta">
            <div class="cta-item">
              <div class="card-cta bg-light" style="width: 400px; width: 500px;">

              </div>
            </div>
          </div>
          <!--Cta at Dashboard -->
        

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>














