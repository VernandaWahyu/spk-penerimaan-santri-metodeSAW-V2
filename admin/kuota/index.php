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
          <li class="breadcrumb-item active">Kuota</li>
        </ol>
        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">Data Kuota</div>
                    <table class="table table-responsive-sm table-striped" style="margin-top: 20px">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Kuota</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php  
                          $tampilkuota = mysqli_query($mysqli, "SELECT * FROM kuota");
                          while($kuota = mysqli_fetch_array($tampilkuota))
                          {
                        ?>
                        <tr>
                          <td><?php echo $kuota['Id_kuota']; ?></td>
                          <td><?php echo $kuota['Kuota']; ?></td>
                          <td>
                            <a href="edit_kuota.php?id_kuota=<?php echo $kuota['Id_kuota']; ?>">
                              <button class="btn btn-success"? type="button">
                                <i class="fa fa-pencil"></i>
                              </button>
                            </a>
                          </td>
                        </tr>
                        <?php  
                          }
                        ?>
                      </tbody>
                    </table>
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