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
          <li class="breadcrumb-item"><a href="../santri">Santri</a></li>
          <li class="breadcrumb-item active">Baru</li>
        </ol>
        <div class="container-fluid">
            <div class="animated fadeIn">
              <div class="row justify-content-center">
                <div class="col-md-8">
                  <div class="card">
                    <div class="card-header">Tambah Data Santri</div>
                    <form action="insert_santri_action.php" method="post">
                      <div class="card-body">
                        <div class="form-group">
                          <label for="email">Email</label>
                          <input class="form-control" id="email" type="email" placeholder="Email" name="email">
                        </div>
                        <div class="form-group">
                          <label for="password">Password</label>
                          <input class="form-control" id="password" type="Password" placeholder="Password" name="pass">
                        </div>
                        <input type="hidden" name="kuota" value="1">
                        <hr class="mt-0">
                        <div class="form-group">
                          <label for="nama">Nama</label>
                          <input class="form-control" id="nama" type="text" placeholder="Nama" name="nama">
                        </div>
                        <div class="form-group">
                          <label for="date-input">Tanggal Lahir</label>
                          <input class="form-control" id="date-input" type="date" name="date-input" placeholder="Tanggal Lahir">
                        </div>
                        <div class="form-group">
                          <label for="alamat">Alamat</label>
                          <input class="form-control" id="alamat" type="text" placeholder="Alamat" name="alamat">
                        </div>
                        <hr class="mt-0">
                        <div class="form-group">
                          <label for="smp">Asal Sekolah</label>
                          <input class="form-control" id="smp" type="text" placeholder="Asal Sekolah" name="smp">
                        </div>
                        <div class="form-group">
                          <label for="Jarak_Rumah">Jarak Rumah</label>
                          <select class="form-control" id="Jarak_Rumah" name="jarak">
                            <option value="100">< 5 km</option>
                            <option value="75">5 s.d < 10 km</option>
                            <option value="50">10 s.d < 15 km</option>
                            <option value="0">> 15 km</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="Penghasilan_Orang_Tua">Penghasilan Orang Tua</label>
                          <select class="form-control" id="Penghasilan_Orang_Tua" name="penghasilan">
                            <option value="100"><= 1.000.000</option>
                            <option value="75">1.000.000 s.d <= 2.000.000</option>
                            <option value="50">2.000.000 s.d <= 3.000.000</option>
                            <option value="0">>= 3.000.000</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="Yatim_Piatu">Yatim Piatu</label>
                          <select class="form-control" id="Yatim_Piatu" name="yatim">
                            <option value="100">Yatim Piatu</option>
                            <option value="55">Yatim</option>
                            <option value="50">Piatu</option>
                            <option value="0">Tidak</option>
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