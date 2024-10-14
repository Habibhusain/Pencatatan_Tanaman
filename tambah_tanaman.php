<?php

require "db.php";

function upload_tanaman(){
    $ambil_ukuran_file = $_FILES['foto']['size'];
    $ukuran_diizinkan = 10000000;

    if($ambil_ukuran_file > $ukuran_diizinkan)
    {
        echo 'ukurannya maksimal 10 MB !!';
        exit();
    }
    $ambil_nama_file = $_FILES['foto']['name'];
    $ambil_extensi_file = pathinfo($ambil_nama_file, PATHINFO_EXTENSION);
    $extensi_diizinkan = array('jpg','jpeg','png','avif','svg','JPG');

    if(in_array($ambil_extensi_file, $extensi_diizinkan))
    {
        $ambil_tmp_file = $_FILES['foto']['tmp_name'];
        $tujuan_folder = "css/image/";
        $target_file = $tujuan_folder . basename($ambil_nama_file);

        $gambar_file = move_uploaded_file($ambil_tmp_file, $target_file);

        if($gambar_file == TRUE)
        {
            return $ambil_nama_file;
        }
        else
        {
            return FALSE;
        }
    }
    else
    {
        return FALSE;
    }
}

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
            $tambah_data_tanaman = "INSERT INTO tanaman (tanggal,tanaman,keterangan,foto) VALUES ('$tanggal', '$tanaman', '$keterangan', '$foto')";
            $tambah_tanaman = $db ->query ($tambah_data_tanaman);

            if($tambah_tanaman)
            {
                echo "<script>
                alert('Data Berhasil di Tambah');
                window.location = 'tanaman.php';
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
            <a href="tanaman.php">Kembali ke Beranda</a>
            </div>
        </form>
    </div>
</body>
</html>