<?php

    require "functions_api.php";
    require "helper.php";


    $request_method = $_SERVER['REQUEST_METHOD'];

    switch ($request_method)
    {
        case 'GET':
            
            
            if (isset($_GET ['id']) && !empty($_GET ['id']))
            {
                $get_tanaman_id = $_GET ['id'];

                $get_edit_tanaman = ambil_data_tanaman($get_tanaman_id);
                if($get_edit_tanaman == NULL)
                {
                    $respon = array(
                        'status' => false,
                        'message' => 'Data tidak di temukan',
                        'data' => array()
                    );
                    echo respon($respon, 500);
                }
                else
                {
                    $respon = array(
                        'status' => true,
                        'message' => 'Sukses',
                        'data' => $get_edit_tanaman
                    );
                }
           
            }
            else
            {
                
                $respon = array(
                    'status' => true,
                    'message' => 'Sukses',
                    'data' => tampil_data()
                );
            }
            
            echo respon($respon, 200);

            break;

        case 'POST':

            if($_POST['tanggal'] == '' OR $_POST['tanaman'] == '' OR $_POST['keterangan'] == '' OR $_FILES['foto']['name'] == '' )
            {
                $respon = array(
                    'status' =>false,
                    'message' => 'Tanggal, tanaman, keterangan dan foto tidak boleh kosong !!!',
                    'data' => array()
                );
                echo respon($respon, 500);
            }
            else
            {
                $tanggal = $_POST['tanggal'];
                $tanaman = $_POST['tanaman'];
                $keterangan = $_POST['keterangan'];
                $foto = upload_tanaman();
                $tambah_tanaman = tambah_tanaman($tanggal, $tanaman, $keterangan,$foto);

                if($tambah_tanaman)
                {
                    $respon =  array(
                        'status' => true,
                        'message' => 'Data Berhasil ditambah',
                        'data' => array()
                    );
    
                    echo respon($respon, 200);
                }
                else
                {
    
                    $respon =  array(
                        'status' => false,
                        'message' => 'Data Gagal ditambah',
                        'data' => array()
                    );
    
                    echo respon($respon, 500);
                }
            }

            break;

            case 'DELETE':
                    $get_id = $_GET['id'];
                    $cek_tanaman = ambil_data_tanaman($get_id);

                if($cek_tanaman == FALSE)
                {
                    $respon = array(
                        'status' => false,
                        'message' => 'Data tanaman tidak ditemukan',
                        'data' => array()
                    );
                    echo respon($respon, 404);
                }
                else{
                    $delete_tanaman = delete_tanaman($get_id);
                    
                    if($delete_tanaman)
                    {
                        $respon = array(
                            'status' => true,
                            'message' => 'Berhasil Menghapus',
                            'data' => array()
                        );
                        echo respon($respon, 200);

                    }
                    else
                    {
                        $respon = array(
                            'status' => false,
                            'message' => 'Gagal Menghapus',
                            'data' => array()
                        );
                        echo respon($respon, 500);
                    }
                }
                    break;

            case 'PUT':

                $get_body = file_get_contents("php://input"); // jadi data JSON
                $get_json = json_decode($get_body, TRUE); // jadi array data

                $_POST['id'] = $get_json['id'];
                $_POST['tanggal'] = $get_json['tanggal'];
                $_POST['tanaman'] = $get_json['tanaman'];
                $_POST['keterangan'] = $get_json['keterangan'];

            if($_POST['id'] == '' OR $_POST['tanggal'] == '' OR $_POST['tanaman'] == '' OR $_POST['keterangan'] == '')
            {
              
        
                $respon =  array(
                    'status' => false,
                    'message' => 'ID, Tanggal, tanaman, keterangan dan foto tidak boleh kosong !!!',
                    'data' => array()
                );
    
                echo respon($respon, 500);
                
            }
            else
            {
                $get_id = $_GET['id'];
                $get_tanggal = $_POST['tanggal'];
                $get_tanaman = $_POST['tanaman'];
                $get_keterangan = $_POST['keterangan'];
                if (isset($_FILES['foto']) && $_FILES['foto']['name'] != '') {
                    $get_gambar = upload_tanaman();
                } else {
                    // Jika tidak ada file baru, tetap menggunakan gambar lama
                    $get_edit_tanaman = ambil_data_tanaman($get_id);
                    $get_gambar = $get_edit_tanaman['foto'];
                }   
                $update_tanaman = update_tanaman($get_id,$get_tanggal,$get_tanaman,$get_keterangan,$get_gambar);
                if ($update_tanaman)
                {
                    $respon =  array(
                        'status' => true,
                        'message' => 'Berhasil diubah',
                        'data' => array()
                    );
    
                    echo respon($respon, 200);
                }
                else
                {
    
                    $respon =  array(
                        'status' => false,
                        'message' => 'Gagal diubah',
                        'data' => array()
                    );
    
                    echo respon($respon, 500);
                }
            }
            break;
        default:

            $respon = array(
                'status' => FALSE,
                'message' => "Not Found",
                'data' => array()
            );
        echo respon($respon, 404);
        break;
    }