<?php

include "../../lib/koneksi.php";

// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");

// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=Laporan_Diterima.xls");
// Tambahkan table

?>
<table border="1" ">
    <thead>
        <tr>
            <th>Ranking</th>
            <th>No Pendaftaran</th>
            <th>Nama</th>
            <th>Asal Sekolah</th>
            <th>Nilai Akhir</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $rank = 0;
            $tampilpeserta = mysqli_query($mysqli, "SELECT * FROM santri ORDER BY Nilai_Akhir DESC");
            while($peserta = mysqli_fetch_array($tampilpeserta))
            {
                $rank = $rank + 1;
            ?>
        <tr>
            <td><?php echo $rank; ?></td>
            <td><?php echo $peserta['No_Pendaftaran']; ?></td>
            <td><?php echo $peserta['Nama']; ?></td>
            <td><?php echo $peserta['Asal_Sekolah']; ?></td>
            <td><?php echo $peserta['Nilai_Akhir']; ?></td>
        </tr>
        <?php 
            }
        ?>
    </tbody>
</table>