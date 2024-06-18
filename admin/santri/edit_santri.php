<?php 
session_start();
  include "../../lib/koneksi.php";
  $no_daftar=$_GET['No_Pendaftaran'];
  $session_admin = $_SESSION['admin']; 
  if(isset($_SESSION['admin']))
  {
    include "../template/header.php";
?>
      <main class="main">
        <!-- Breadcrumb-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="../santri">santri</a></li>
          <li class="breadcrumb-item active">Ubah</li>
        </ol>
        <?php  
          $tampilsantri = mysqli_query($mysqli, "SELECT * FROM santri where No_Pendaftaran = '$no_daftar'");
          $santri = mysqli_fetch_assoc($tampilsantri);
        ?>
        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row justify-content-center">
              <div class="col-md-4">
                <div class="card">
                  <div class="card-header">Data Santri</div>
                    <div class="card-body">
                      <h2><?php echo $no_daftar; ?></h2>
                      <h2><?php echo $santri['Nama']; ?></h2>
                    </div>
                </div>
              </div>
              <div class="col-md-8">
                <div class="card">
                  <div class="card-header">Ubah Data santri</div>
                  <form action="edit_santri_action.php" method="post">
                    <div class="card-body">
                      <div class="form-group">
                        <input type="hidden" name="no_daftar" value="<?php echo $no_daftar; ?>">
                        <label for="company">Email</label>
                        <input class="form-control" id="company" type="email" value="<?php echo $santri['Email']; ?>" name="email">
                      </div>
                      <div class="form-group">
                        <label for="company">Password</label>
                        <input class="form-control" id="company" type="Password" value="<?php echo $santri['Password']; ?>" name="pass">
                      </div>
                    
                      <div class="form-group">
                        <label for="select1">Kuota</label>
                          <select class="form-control" id="select1" name="kuota">
                            <?php 
                              $tampilkuota = mysqli_query($mysqli,"SELECT * from kuota");
                              while($kuota = mysqli_fetch_array($tampilkuota))
                              {
                            if($kuota['Id_kuota'] == $santri['Id_kuota'])
                              {
                            ?>
                            <option value="<?php echo $kuota['Id_kuota']; ?>" selected=""><?php echo $kuota['Kuota']; ?></option>
                            <?php  
                              }
                              else
                              {
                            ?>
                            <option value="<?php echo $kuota['Id_kuota']; ?>"><?php echo $kuota['Kuota']; ?></option>
                            <?php  
                                }
                              }
                            ?>
                          </select>
                      </div>
                      <hr class="mt-0">
                      <div class="form-group">
                        <label for="company">Nama</label>
                        <input class="form-control" id="company" type="text" value="<?php echo $santri['Nama']; ?>" name="nama">
                      </div>
                      
                      <div class="form-group">
                        <label for="company">Tanggal Lahir</label>
                        <input class="form-control" id="date-input" type="date" name="date-input" value="<?php echo $santri['Tanggal_Lahir']; ?>">
                      </div>
                      <div class="form-group">
                        <label for="company">Alamat</label>
                        <input class="form-control" id="company" type="text" value="<?php echo $santri['Alamat']; ?>" name="alamat">
                      </div>
                      <hr class="mt-0">
                      <div class="form-group">
                        <label for="company">Asal Sekolah</label>
                        <input class="form-control" id="company" type="text" value="<?php echo $santri['Asal_Sekolah']; ?>" name="smp">
                      </div>
                      <div class="form-group">
                      <label for="company">Jarak Rumah</label>
                      <select class="form-control" id="company" name="jarak">
                          <option value="100" <?php echo ($santri['Jarak_Rumah'] == 100) ? 'selected' : ''; ?>>< 5 km</option>
                          <option value="75" <?php echo ($santri['Jarak_Rumah'] == 75) ? 'selected' : ''; ?>>5 s.d < 10 km</option>
                          <option value="50" <?php echo ($santri['Jarak_Rumah'] == 50) ? 'selected' : ''; ?>>10 s.d < 15 km</option>
                          <option value="0" <?php echo ($santri['Jarak_Rumah'] == 0) ? 'selected' : ''; ?>>> 15 km</option>
                      </select>
                      </div>
                      <div class="form-group">
                      <label for="company">Penghasilan Orang Tua</label>
                      <select class="form-control" id="company" name="penghasilan">
                          <option value="100" <?php echo ($santri['Penghasilan_Orang_Tua'] == 100) ? 'selected' : ''; ?>><= 1.000.000</option>
                          <option value="75" <?php echo ($santri['Penghasilan_Orang_Tua'] == 75) ? 'selected' : ''; ?>>1.000.000 s.d <= 2.000.000</option>
                          <option value="50" <?php echo ($santri['Penghasilan_Orang_Tua'] == 50) ? 'selected' : ''; ?>>2.000.000 s.d <= 3.000.000</option>
                          <option value="0" <?php echo ($santri['Penghasilan_Orang_Tua'] == 0) ? 'selected' : ''; ?>>>= 3.000.000</option>
                      </select>
                      </div>
                      <div class="form-group">
                      <label for="status">Yatim Piatu</label>
                      <select class="form-control" id="status" name="yatim">
                          <option value="100" <?php if($santri['Yatim_Piatu'] == 100) echo 'selected'; ?>>Yatim Piatu</option>
                          <option value="55" <?php if($santri['Yatim_Piatu'] == 55 && $santri['Yatim_Piatu'] !== 100) echo 'selected'; ?>>Yatim</option>
                          <option value="50" <?php if($santri['Yatim_Piatu'] == 50 && $santri['Yatim_Piatu'] !== 100) echo 'selected'; ?>>Piatu</option>
                          <option value="0" <?php if($santri['Yatim_Piatu'] == 0) echo 'selected'; ?>>Tidak</option>
                      </select>
                      </div>
                      <div class="row align-items-center mt-3">
                      <div class="col-sm-6">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Simpan</button>
                      </div>
                      <div class="col-sm-6">
                        <a class="btn btn-outline-info btn-lg btn-block" href="../santri">Batal</a>
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