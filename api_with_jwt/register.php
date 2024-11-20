<?php
require_once "helper.php";
require_once "functions_api.php";

$request_method = $_SERVER['REQUEST_METHOD'];

if ($request_method != 'POST') {
    echo respon(array(
        'status' => false,
        'message' => 'Method not allowed',
        'data' => array()
    ), 400);
    exit();
}

$get_nama = $_POST['nama'];
$get_email = $_POST['email'];
$get_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$get_token = $_POST['token'];

$query_register = "INSERT INTO user (nama, email, password, token) VALUES 
('$get_nama', '$get_email', '$get_password', '$get_token')";
$eksekusi_register = database()->query($query_register);

if ($eksekusi_register) {
    echo respon(array(
        'status' => true,
        'message' => 'User successfully registered',
        'data' => array()
    ), 200);
    exit();
} else {
    echo respon(array(
        'status' => false,
        'message' => 'User unsuccessfully registered',
        'data' => array()
    ), 400);
    exit();
}