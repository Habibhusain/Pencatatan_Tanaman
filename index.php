<?php
require 'db.php';
require "functions.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanaman</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
    <div class="container">
    <div class="judul">
    <h1>Tanaman Anda</h1>
    <?php
        $hitung_data_murojaah="SELECT COUNT(*) FROM tanaman";
        $hitung_murojaah = $db->query($hitung_data_murojaah);
        while($hitung =$hitung_murojaah->fetchArray()):
    ?>
        <h4>Total Tanaman : <?php echo $hitung[0];?></h4>
     <?php 
         endwhile; 
     ?>
        <a href="tambah_tanaman.php">tambah</a>
    </div>
    <div class="box">
     <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Tanaman</th>
                <th>keterangan</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
             $tampilan_data = tampil_data();
             $no=1;
             foreach($tampilan_data as $row):
            ?>
            <tr>
                <td><?php echo $no;?></td>
                <td><?php echo date('d-m-Y', strtotime($row['tanggal'])); ?></td>
                <td><?php echo $row['tanaman'] ?></td>
                <td><?php echo $row['keterangan'] ?></td>
                <td><img src="image/<?php echo $row['foto']?>" alt="foto_tanaman"></td>
                <td><a href="edit_tanaman.php?id=<?php echo $row['id']?>">Edit</a> || <a href="hapus_tanaman.php?id=<?php echo $row['id']?>" onclick ="return confirm('Yakin Mau Hapus Tanaman Ini??? :( ')">hapus</a></td>
            </tr>
                <?php
                $no++;
                endforeach;
                ?>

        </tbody>
    </table>
    </div>
    </div>
</body>
</html>