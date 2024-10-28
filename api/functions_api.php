<?php

    function database()
    {
            $db = new SQLite3('../db_tanaman.sqlite');

            if(!$db){
                echo $db -> lastErrorMsg();
                exit();
            }else{
                // echo "Database Berhasil";
            }
            
            return $db;
    }

    // function table()
    // {
    //     $db = database();

    //     $table = database() -> query("CREATE TABLE IF NOT EXISTS tanaman (id INTEGER PRIMARY KEY AUTOINCREMENT, tanggal TEXT NOT NULL, tanaman TEXT NOT NULL,  keterangan TEXT,foto TEXT NOT NULL)");
        
    // }


    function tampil_data()
    {


             $tampil_data_tanaman = "SELECT * FROM tanaman ORDER BY tanggal DESC";
             $tampil_tanaman = database()->query($tampil_data_tanaman);

             $tampilan_data=[];
             while ($row= $tampil_tanaman->fetchArray(SQLITE3_ASSOC)){
                $tampilan_data[] = $row;
             }

             return $tampilan_data;
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
            $tujuan_folder = "../image/";
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

    function tambah_tanaman($tanggal,$tanaman, $keterangan,$foto)
    {

        $tambah_data_tanaman = "INSERT INTO tanaman (tanggal,tanaman,keterangan,foto) VALUES ('$tanggal', '$tanaman', '$keterangan', '$foto')";
        $tambah_tanaman = database() ->query ($tambah_data_tanaman);
        
        return $tambah_tanaman;
    }

    function update_tanaman($get_id,$get_tanggal,$get_tanaman,$get_keterangan,$get_gambar)
    {
        $update_data_tanaman = "UPDATE tanaman SET tanggal='$get_tanggal', tanaman='$get_tanaman', keterangan='$get_keterangan', foto='$get_gambar' WHERE id ='$get_id'";
        $update_tanaman = database()->query($update_data_tanaman);

        return $update_tanaman;
    }

    function ambil_data_tanaman($get_id){

        $ambil_data_tanaman = "SELECT * FROM tanaman WHERE id ='$get_id'";
        $ambil_tanaman = database() -> query($ambil_data_tanaman);
        $ambil = $ambil_tanaman -> fetchArray(SQLITE3_ASSOC);

        return $ambil;

    }

    function delete_tanaman($get_id)
    {

        $delete_data_tanaman= "DELETE FROM tanaman WHERE id='$get_id'";
        $delete_tanaman = database() -> query($delete_data_tanaman);

        return $delete_tanaman;
    }

