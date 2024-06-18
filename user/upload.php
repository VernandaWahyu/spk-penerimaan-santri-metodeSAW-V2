<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_saw"; 

session_start();

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['bukti_pembayaran'])) {
    $No_Pendaftaran = $_POST['No_Pendaftaran'];
    $target_dir1 = "../admin/pembayaran/uploads/";
    $target_dir2 = "../uploads/";  
    $file_base_name = "bukti_pembayaran";
    $imageFileType = strtolower(pathinfo($_FILES["bukti_pembayaran"]["name"], PATHINFO_EXTENSION));

    $target_file1 = $target_dir1 . $file_base_name . "." . $imageFileType;
    $counter = 1;

    while (file_exists($target_file1)) {
        $target_file1 = $target_dir1 . $file_base_name . "($counter)." . $imageFileType;
        $counter++;
    }

    $target_file2 = $target_dir2 . $file_base_name . "." . $imageFileType;
    $counter = 1;

    while (file_exists($target_file2)) {
        $target_file2 = $target_dir2 . $file_base_name . "($counter)." . $imageFileType;
        $counter++;
    }

    $uploadOk = 1;

    $check = getimagesize($_FILES["bukti_pembayaran"]["tmp_name"]);
    if($check !== false) {
        echo "File adalah gambar - " . $check["mime"] . ".<br>";
        $uploadOk = 1;
    } else {
        echo "File bukan gambar.<br>";
        $uploadOk = 0;
    }

    if ($_FILES["bukti_pembayaran"]["size"] > 5000000) {
        echo "File terlalu besar.<br>";
        $uploadOk = 0;
    }

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "Hanya JPG, JPEG, dan PNG yang diizinkan.<br>";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Maaf, file Anda tidak dapat diunggah.<br>";

    } else {

        if (!file_exists($target_dir1)) {
            mkdir($target_dir1, 0777, true);
        }
        if (!file_exists($target_dir2)) {
            mkdir($target_dir2, 0777, true);
        }

        if (move_uploaded_file($_FILES["bukti_pembayaran"]["tmp_name"], $target_file1)) {
            echo "File ". htmlspecialchars(basename($target_file1)). " telah diunggah ke folder pertama.<br>";

            if (copy($target_file1, $target_file2)) {
                echo "File ". htmlspecialchars(basename($target_file2)). " telah diunggah ke folder kedua.<br>";

                $sql_check = "SELECT No_Pendaftaran FROM santri WHERE No_Pendaftaran='$No_Pendaftaran'";
                $result_check = $conn->query($sql_check);
                if ($result_check->num_rows > 0) {

                    $path_file = "uploads/" . basename($target_file1);
                    $sql_update = "UPDATE santri SET Bukti_Pembayaran='$path_file' WHERE No_Pendaftaran='$No_Pendaftaran'";
                    if ($conn->query($sql_update) === TRUE) {
                        echo "Database telah diperbarui dengan bukti pembayaran.<br>";

                        $tgl_pembayaran = date("Y-m-d H:i:s");
                        $status_bayar = 'Lunas';
                        $sql_insert = "INSERT INTO pembayaran (No_Pendaftaran, tgl_pembayaran, status_bayar) VALUES ('$No_Pendaftaran', '$tgl_pembayaran', '$status_bayar')";
                        if ($conn->query($sql_insert) === TRUE) {
                            echo "Data pembayaran telah ditambahkan ke database.<br>";
                            $_SESSION['notifikasi'] = "Bukti pembayaran telah berhasil di-upload.";
                            header("Location: http://localhost/SPK-penerimaan-santri-master/user/");
                            exit();
                        } else {
                            echo "Error inserting into pembayaran: " . $conn->error . "<br>";
                        }
                    } else {
                        echo "Error updating database: " . $conn->error . "<br>";
                    }
                } else {
                    echo "No_Pendaftaran tidak ditemukan di database.<br>";
                }
            } else {
                echo "Maaf, terjadi kesalahan saat mengunggah file Anda ke folder kedua.<br>";
            }
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah file Anda ke folder pertama.<br>";
        }
    }
}

$conn->close();
?>
