<?php 
session_start();
  include "../../lib/koneksi.php";
  $session_admin = $_SESSION['admin']; 
  if(isset($_SESSION['admin']))
  {
    include "../template/header.php";
?>
      <main class="main">
        <!-- Breadcrumb-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../dashboard">Home</a></li>
          <li class="breadcrumb-item active">Laporan</li>
          <!-- Breadcrumb Menu-->
        </ol>
        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row justify-content-center">
              <div class="col-md-6">
                <div class="card">
                  <div class="card-header">
                    <i class="fa icon-doc"></i> Laporan Diterima
                  </div>
                  <div class="card-body">
                    <div class="list-group">
                      <a class="list-group-item list-group-item-action list-group-item-info" href="laporan_diterima.php">Laporan Semua Yang Diterima
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card">
                  <div class="card-header">
                    <i class="fa icon-doc"></i> Laporan Pendaftar
                  </div>
                  <div class="card-body">
                    <div class="list-group">
                      <a class="list-group-item list-group-item-action list-group-item-info" href="laporan_pendaftar.php">Semua Laporan Pendaftar</a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.col-->
            </div>
            <!-- /.row-->
          </div>
        </div>
      </main>
<?php
    include "../template/footer.php";
  }
  else
  {
    header("location: ../login/");
  } 
?>