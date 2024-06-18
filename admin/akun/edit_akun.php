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
        <li class="breadcrumb-item"><a href="../akun">Akun</a></li>
        <li class="breadcrumb-item active">Ubah</li>
      </ol>
      <?php  
        $tampiladmin = mysqli_query($mysqli, "SELECT * FROM admin where Id_Admin = $session_admin");
        $admin = mysqli_fetch_assoc($tampiladmin);
      ?>
      <div class="container-fluid">
        <div class="animated fadeIn">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header">Ubah Data Pengguna</div>
                <div class="card-body">
                  <form action="edit_akun_action.php" method="post">
                    <input type="hidden" name="id_admin" value="<?php echo $session_admin; ?>">
                    <div class="form-group">
                      <label for="nama">Nama</label>
                      <input class="form-control" id="nama" type="text" name="nama" value="<?php echo $admin['Nama']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="username">Username</label>
                      <input class="form-control" id="username" type="text" value="<?php echo $admin['Username']; ?>" name="user">
                    </div>
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input class="form-control" id="password" type="password" value="<?php echo $admin['Password']; ?>" name="pass">
                    </div>
                    <div class="row align-items-center mt-3">
                      <div class="col-sm-6">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Simpan</button>
                      </div>
                      <div class="col-sm-6">
                        <a class="btn btn-outline-info btn-lg btn-block" href="../dashboard">Batal</a>
                      </div>
                    </div>
                  </form>
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