<?php

require 'db.php';

$get_id = $_GET['id'];
    function ambil_data_tanaman(){
        global $db;
        global $get_id;

        $ambil_data_tanaman = "SELECT * FROM tanaman WHERE id ='$get_id'";
        $ambil_tanaman = $db -> query($ambil_data_tanaman);
        $ambil = $ambil_tanaman -> fetchArray();

        return $ambil;

    }

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
        $get_tanggal = $_POST['tanggal'];
        $get_tanaman = $_POST['tanaman'];
        $get_keterangan = $_POST['keterangan'];
        $get_gambar = upload_tanaman();
        if($get_gambar == FALSE){
            echo "<script>
            alert('Upload Gambar Anda');
            window.location = 'edit_tanaman.php';
            </script>";
            exit();
        }
        $update_data_tanaman = "UPDATE tanaman SET tanggal='$get_tanggal', tanaman='$get_tanaman', keterangan='$get_keterangan', foto='$get_gambar' WHERE id ='$get_id'";
        $update_tanaman = $db->query($update_data_tanaman);

        if(ambil_data_tanaman())
        {
            echo "<script>
            alert('Data Berhasil di Edit');
            window.location = 'tanaman.php';
            </script>";
        }
        else{
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
        <form action="edit_tanaman.php?id=<?php echo ambil_data_tanaman()['id'];?>" method="POST" enctype="multipart/form-data">
            <div class="inputan">
                <h1>Edit Tanaman</h1>
                <label>Tanggal</label>
                <input type="date" name="tanggal" value="<?php echo ambil_data_tanaman()['tanggal'];?>" required>
                <label>Tanaman</label>
                <input type="text" name="tanaman" value="<?php echo ambil_data_tanaman()['tanaman'];?>" required>
                <label>keterangan</label>
                <textarea name="keterangan" required><?php echo ambil_data_tanaman()['keterangan'];?></textarea>
                <label>Dokumentasi</label>
                <img src="css/image/<?php echo ambil_data_tanaman()['foto'];?>" alt="foto_tanaman" width="100px" height="100px">
                <input type="file" name="foto" required >
            <input type="submit" name="submit">
            <a href="tanaman.php">Kembali ke Beranda</a>
            </div>
        </form>
    </div>
</body>
</html>