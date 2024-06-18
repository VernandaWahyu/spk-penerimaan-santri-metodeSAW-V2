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
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-6 col-lg-3">
                <div class="card">
                  <div class="card-body p-0 d-flex align-items-center">
                    <i class="fa fa-users bg-primary p-4 font-2xl mr-3"></i>
                    <div>
                      <div class="text-value-sm text-primary">
                        <?php 
                          $result = mysqli_query($mysqli, "SELECT count(*) as total from santri");
                          $data = mysqli_fetch_assoc($result);
                          echo $data['total'];
                        ?>
                      </div>
                      <div class="text-muted text-uppercase font-weight-bold small">santri</div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.col-->
              <div class="col-6 col-lg-3">
                <div class="card">
                  <div class="card-body p-0 d-flex align-items-center">
                    <i class="fa fa-graduation-cap bg-info p-4 font-2xl mr-3"></i>
                    <div>
                      <div class="text-value-sm text-info">
                        <?php 
                          $result = mysqli_query($mysqli, "SELECT count(*) as total from kuota");
                          $data = mysqli_fetch_assoc($result);
                          echo $data['total'];
                        ?> 
                      </div>
                      <div class="text-muted text-uppercase font-weight-bold small">Kuota</div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.col-->
              <div class="col-6 col-lg-3">
                <div class="card">
                  <div class="card-body p-0 d-flex align-items-center">
                    <i class="fa fa-list-ul bg-warning p-4 font-2xl mr-3"></i>
                    <div>
                      <div class="text-value-sm text-warning">
                        <?php 
                          $result = mysqli_query($mysqli, "SELECT count(*) as total from kriteria");
                          $data = mysqli_fetch_assoc($result);
                          echo $data['total'];
                        ?>
                      </div>
                      <div class="text-muted text-uppercase font-weight-bold small">Kriteria</div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.col-->
              <div class="col-6 col-lg-3">
                <div class="card">
                  <div class="card-body p-0 d-flex align-items-center">
                    <i class="fa fa-user bg-danger p-4 font-2xl mr-3"></i>
                    <div>
                      <div class="text-value-sm text-danger">
                        <?php 
                          $result = mysqli_query($mysqli, "SELECT count(*) as total from admin");
                          $data = mysqli_fetch_assoc($result);
                          echo $data['total'];
                        ?>
                      </div>
                      <div class="text-muted text-uppercase font-weight-bold small">Admin</div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.col-->
            </div>
            <div class="row">
              <div class="col-md-12">
                <!-- <div class="card">
                  <div class="card-header">Sistem Pendukung Keputusan</div>
                  <div class="card-body">
                    
                  </div> -->
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