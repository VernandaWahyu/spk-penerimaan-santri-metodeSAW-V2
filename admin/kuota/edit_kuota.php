<?php 
session_start();
  include "../../lib/koneksi.php";
  $idkuota=$_GET['id_kuota'];
  $session_admin = $_SESSION['admin']; 
  if(isset($_SESSION['admin']))
  {
    include "../template/header.php";
?>
      <main class="main">
        <!-- Breadcrumb-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="../kuota">Kuota</a></li>
          <li class="breadcrumb-item active">Ubah</li>
        </ol>
        <?php  
          $tampilkuota = mysqli_query($mysqli, "SELECT * FROM kuota where Id_kuota = $idkuota");
          $kuota = mysqli_fetch_assoc($tampilkuota)
        ?>
        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row justify-content-center">
              <div class="col-md-6">
                <div class="card">
                  <div class="card-header">Ubah Data kuota</div>
                  <form action="edit_kuota_action.php" method="post">
                    <div class="card-body">
                      <div class="form-group">
                        <input type="hidden" name="id_kuota" value="<?php echo $idkuota; ?>">
                      </div>
                      <div class="form-group">
                        <label for="vat">Kuota</label>
                        <input class="form-control" id="vat" type="text" name="kuota" value="<?php echo $kuota['Kuota']; ?>">
                      </div>
                      <div class="row align-items-center mt-3">
                      <div class="col-sm-6">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Simpan</button>
                      </div>
                      <div class="col-sm-6">
                        <a class="btn btn-outline-info btn-lg btn-block" href="../kuota">Batal</a>
                      </div>
                      </div>
                    </div>
                  </form>
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