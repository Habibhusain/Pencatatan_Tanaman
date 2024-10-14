<?php

require "db.php";
$get_id = $_GET['id'];

$delete_data_tanaman= "DELETE FROM tanaman id='$get_id'";
$delete_tanaman = $db -> query($delete_data_tanaman);

if($delete_tanaman)
{
    echo "<script>
    alert('Data Berhasil di Hapus');
    window.location='tanaman.php';
    </script>";
}else{
    echo "<script>
    alert('Data Gagal di Hapus');
    window.location='tanaman.php';
    </script>";
}