<?php

require "db.php";
require "functions.php";


        if(isset($_POST['tanaman']) && $_POST['tanaman'] !='')
        {
            $foto = upload_tanaman();
            $tanaman = $_POST['tanaman'];
            $keterangan = $_POST['keterangan'];
            $tanggal = $_POST['tanggal'];
            if($foto == FALSE){
                echo "<script>
                alert('Upload Gambar Anda');
                window.location = 'tambah_tanaman.php';
                </script>";
                exit();
            }
           
            $tambah = tambah_tanaman($tanggal,$tanaman,$keterangan,$foto);
            if($tambah)
            {
                echo "<script>
                alert('Data Berhasil di Tambah');
                window.location = 'index.php';
                </script>";
            }else{
                echo "<script>
                alert('Data Berhasil di Tambah');
                window.location = 'tambah_tanaman.php';
                </script>";
            }
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container-tambah">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="inputan">
                <h1>Tambah Tanaman</h1>
                <label>Nama Tanaman</label>
                <input type="text" name="tanaman" required>
                <label>keterangan</label>
                <textarea name="keterangan" required></textarea>
                <label>Dokumentasi</label>
                <input type="file" name="foto" required>
                <label>Tanggal</label>
                <input type="date" name="tanggal" required>
            <input type="submit" name="submit">
            <a href="index.php">Kembali ke Beranda</a>
            </div>
        </form>
    </div>
</body>
</html>