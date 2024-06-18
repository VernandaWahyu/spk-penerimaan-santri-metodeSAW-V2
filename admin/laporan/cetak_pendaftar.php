<?php

include "../../lib/koneksi.php";

// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");

// Mendefinisikan nama file ekspor "hasil-export.xls"

    header("Content-Disposition: attachment; filename=Laporan_Pendaftar_Semua_Jurusan.xls");

// Tambahkan table

?>
<table border="1">
    <thead>
        <tr>
            <th>No Pendaftaran</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Asal Sekolah</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $rank = 0;
                $tampilpeserta = mysqli_query($mysqli, "SELECT * FROM santri ");
            while($peserta = mysqli_fetch_array($tampilpeserta))
            {
                $rank = $rank + 1;
        ?>
        <tr>
            <td><?php echo $peserta['No_Pendaftaran']; ?></td>
            <td><?php echo $peserta['Nama']; ?></td>
            <td><?php echo $peserta['Email']; ?></td>
            <td><?php echo $peserta['Asal_Sekolah']; ?></td>
        </tr>
            <?php 
                }
            ?>
    </tbody>
</table>