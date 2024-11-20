<?php
require 'db.php';
require "functions.php";

$get_id = $_GET['id'];
   
if (isset($_POST['tanaman']) && $_POST['tanaman'] !='') {
    
    $get_tanggal = $_POST['tanggal'];
    $get_tanaman = $_POST['tanaman'];
    $get_keterangan = $_POST['keterangan'];
    $get_gambar = upload_tanaman();

    if ($get_gambar == FALSE) {
        echo "<script>
        alert('Upload Gambar Anda');
        window.location = 'edit_tanaman.php';
        </script>";
        exit();
    }

    $update = update_tanaman($get_id,$get_tanggal,$get_tanaman,$get_keterangan,$get_gambar);

    if ($update) {
        echo "<script>
        alert('Data Berhasil di Edit');
        window.location = 'index.php';
        </script>";
    } else {
        echo "<script>
        alert('Data Gagal di Edit');
        window.location = 'edit_tanaman.php';
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
    <div class="container-edit">
        <form action="edit_tanaman.php?id=<?php echo ambil_data_tanaman($get_id)['id'];?>" method="POST" enctype="multipart/form-data">
            <div class="inputan">
                <h1>Edit Tanaman</h1>
                <label>Tanggal</label>
                <input type="date" name="tanggal" value="<?php echo ambil_data_tanaman($get_id)['tanggal'];?>" required>
                <label>Tanaman</label>
                <input type="text" name="tanaman" value="<?php echo ambil_data_tanaman($get_id)['tanaman'];?>" required>
                <label>keterangan</label>
                <textarea name="keterangan" required><?php echo ambil_data_tanaman($get_id)['keterangan'];?></textarea>
                <label>Dokumentasi</label>
                <img src="image/<?php echo ambil_data_tanaman($get_id)['foto'];?>" alt="foto_tanaman" width="100px" height="100px">
                <input type="file" name="foto" required >
            <input type="submit" name="submit">
            <a href="index.php">Kembali ke Beranda</a>
            </div>
        </form>
    </div>
</body>
</html>