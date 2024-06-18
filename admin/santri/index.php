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
    <li class="breadcrumb-item active">Santri</li>
  </ol>
  <div class="container-fluid">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-md-12">
          
          <div class="card">
            <div class="card-header">Data Santri</div>
            <div class="card-body">
            <a href="insert_Santri.php" class="btn btn-primary my-2">
                  <i class="fa fa-plus-circle"> Tambah Santri</i>
                </a>
              <div class="col-6 col-sm-4 col-md mb-3 mb-xl-0">
              </div>
              <table id="santriTable" class="table table-responsive-sm table-striped" style="margin-top: 20px">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Asal Sekolah</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php  
                  $tampilSantri = mysqli_query($mysqli, "SELECT No_Pendaftaran, Nama, Asal_Sekolah FROM santri");
                  while($Santri = mysqli_fetch_array($tampilSantri))
                  {
                  ?>
                  <tr>
                    <td><?php echo $Santri['No_Pendaftaran']; ?></td>
                    <td><?php echo $Santri['Nama']; ?></td>
                    <td><?php echo $Santri['Asal_Sekolah']; ?></td>
                    <td>
                      <a href="detail_Santri.php?No_Pendaftaran=<?php echo $Santri['No_Pendaftaran']; ?>" class="btn btn-primary">
                        <i class="fa fa-file-text"></i>
                      </a>
                      <a href="edit_Santri.php?No_Pendaftaran=<?php echo $Santri['No_Pendaftaran']; ?>" class="btn btn-success">
                        <i class="fa fa-pencil"></i>
                      </a>
                      <a href="delete_Santri.php?No_Pendaftaran=<?php echo $Santri['No_Pendaftaran']; ?>" onClick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn btn-danger">
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
    $('#santriTable').DataTable({
      dom: 'Bfrtip',
      buttons: [
        'csv', 'excel', 'pdf', 'print'
        
      ]
    });
  });
</script>
