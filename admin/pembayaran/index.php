<?php 
session_start();
  include "../../lib/koneksi.php";
  $session_admin = $_SESSION['admin']; 
  if(isset($_SESSION['admin']))
  {
    include "../template/header.php";
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

      <main class="main">
        <!-- Breadcrumb-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../dashboard">Home</a></li>
          <li class="breadcrumb-item active">Pembayaran</li>
        </ol>
        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">Data Pembayaran</div>
                  <div class="card-body">
                    <div class="col-6 col-sm-4 col-md mb-3 mb-xl-0">
                      <!-- <a href="insert_Pembayaran.php" class="btn btn-primary">
                        <i class="fa fa-plus-circle"> Tambah Pembayaran</i>
                      </a> -->
                    </div>
                    <table id="pembayaranTable" class="table table-responsive-sm table-striped" style="margin-top: 20px">
                      <thead>
                        <tr>
                          <th>No Pendaftaran</th>
                          <th>Nama</th>
                          <th>Tanggal Pembayaran</th>
                          <th>Bukti Pembayaran</th>
                          <th>Status Bayar</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php  
                          $tampilPembayaran = mysqli_query($mysqli, "
                          SELECT 
                              pembayaran.id_pembayaran, 
                              pembayaran.No_Pendaftaran, 
                              pembayaran.tgl_pembayaran, 
                              pembayaran.status_bayar, 
                              santri.Nama,
                              santri.Bukti_Pembayaran
                          FROM 
                              pembayaran
                          JOIN 
                              santri 
                          ON 
                              pembayaran.No_Pendaftaran = santri.No_Pendaftaran
                      ");
                      
                          while($Pembayaran = mysqli_fetch_array($tampilPembayaran))
                          {
                        ?>
                        <tr>
                          <td><?php echo $Pembayaran['No_Pendaftaran']; ?></td>
                          <td><?php echo $Pembayaran['Nama']; ?></td>
                          <td><?php echo $Pembayaran['tgl_pembayaran']; ?></td>
                          <td>
                            <a href="<?php echo $Pembayaran['Bukti_Pembayaran']; ?>" data-lightbox="image-1">
                                <img src="<?php echo $Pembayaran['Bukti_Pembayaran']; ?>" alt="Bukti_Pembayaran" width="100">
                            </a>
                          </td>
                          <td><?php echo $Pembayaran['status_bayar']; ?></td>
                          <td>
                            <a href="delete_Pembayaran.php?No_Pendaftaran=<?php echo $Pembayaran['No_Pendaftaran']; ?>" onClick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn btn-danger">
                                <i class="fa fa-trash"></i>
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
    $('#pembayaranTable').DataTable({
      dom: 'Bfrtip',
      buttons: [
        ''
        
      ]
    });
  });
</script>