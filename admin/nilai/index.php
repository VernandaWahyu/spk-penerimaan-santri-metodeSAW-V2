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
          <li class="breadcrumb-item active">Nilai</li>
        </ol>
        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">Data Nilai santri</div>
                  <div class="card-body">
                    <table id="nilaiTable" class="table table-responsive-sm table-striped" style="margin-top: 20px">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama</th>
                          <?php  
                            $tampilkriteria = mysqli_query($mysqli, "SELECT * FROM kriteria");
                            while($kriteria = mysqli_fetch_array($tampilkriteria))
                            {
                          ?>
                          <th><?php echo$kriteria['Nama_Kriteria']; ?></th>
                          <?php 
                            } 
                          ?>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          $tampilsantri = mysqli_query($mysqli, "SELECT p.No_Pendaftaran, Nama, C1, C2, C3, C4, C5 FROM santri p join nilai n on p.No_Pendaftaran = n.No_Pendaftaran");
                          while($santri = mysqli_fetch_array($tampilsantri))
                          {
                        ?>
                        <tr>
                          <td><?php echo $santri['No_Pendaftaran']; ?></td>
                          <td><?php echo $santri['Nama']; ?></td>
                          <td><?php if ($santri['C1'] > 85 && $santri['C1'] <= 100) {
                                echo 4;
                            } elseif ($santri['C1'] > 70 && $santri['C1'] <= 85) {
                                echo 3;
                            } elseif ($santri['C1'] > 55 && $santri['C1'] <= 70) {
                                echo 2;
                            } elseif ($santri['C1'] > 0 && $santri['C1'] <= 55) {
                                echo 1;
                            } else {
                                echo 0; // Default value for invalid input
                            }
                          ?></td>
                          <td><?php if ($santri['C2'] > 85 && $santri['C2'] <= 100) {
                                echo 4;
                            } elseif ($santri['C2'] > 70 && $santri['C2'] <= 85) {
                                echo 3;
                            } elseif ($santri['C2'] > 55 && $santri['C2'] <= 70) {
                                echo 2;
                            } elseif ($santri['C2'] > 0 && $santri['C2'] <= 55) {
                                echo 1;
                            } else {
                                echo 0; // Default value for invalid input
                            }
                          ?></td>
                          <td><?php 
                          if ($santri['C3'] >76 ) {
                              echo 4;
                          } elseif ($santri['C3'] >= 5 && $santri['C3'] < 76) {
                              echo 3;
                          } elseif ($santri['C3'] >= 10 && $santri['C3'] < 51) {
                              echo 2;
                          } elseif ($santri['C3'] >= 0) {
                              echo 1;
                          } else {
                              echo 0; // Default value for invalid input
                          }
                          ?>
                          </td>
                          <td><?php 
                          if ($santri['C4'] >76 ) {
                              echo 4;
                          } elseif ($santri['C4'] >= 5 && $santri['C4'] < 76) {
                              echo 3;
                          } elseif ($santri['C4'] >= 10 && $santri['C4'] < 51) {
                              echo 2;
                          } elseif ($santri['C4'] >= 0) {
                              echo 1;
                          } else {
                              echo 0; // Default value for invalid input
                          }
                          ?></td>
                          <td><?php 
                          if ($santri['C5'] == 100) {
                              echo 4;
                          } elseif ($santri['C5'] == 55) {
                              echo 3;
                          } elseif ($santri['C5'] == 50) {
                              echo 2;
                          } elseif ($santri['C5'] == 0) {
                              echo 1;
                          } else {
                              echo 0; // Default value for invalid input
                          }
                          ?>
                          </td>
                          <td>
                            <!--<a href="detail_nilai.php?No_Pendaftaran=<?php echo $santri['No_Pendaftaran']; ?>">
                              <button class="btn btn-primary" type="button">
                                <i class="fa fa-file-text"></i>
                              </button>-->
                            </a>
                            <a href="edit_nilai.php?No_Pendaftaran=<?php echo $santri['No_Pendaftaran']; ?>">
                              <button class="btn btn-success" type="button">
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

<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css" rel="stylesheet">

<!-- DataTables JS dependencies -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>

<script>
  $(document).ready(function() {
    $('#nilaiTable').DataTable({
      dom: 'Bfrtip',
      buttons: [
        'csv', 'excel', 'pdf', 'print'
        
      ]
    });
  });
</script>