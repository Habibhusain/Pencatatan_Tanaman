<?php

require_once "helper.php";
require_once "functions_api.php";
// include composer
require_once "./vendor/autoload.php";
//include jwt
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


    $request_method = $_SERVER['REQUEST_METHOD'];

    if($request_method != 'POST')
    {
        echo respon(array(
            'status' => false,
            'message' => 'Method not allow',
            'data' => array()
        ), 400);
        exit();
    }

    $get_email = $_POST['email'];
    $get_password = $_POST['password'];

    $query_login = "SELECT * FROM user WHERE email = '$get_email'";
    $eksekusi_login = database()->query($query_login);
    $user = $eksekusi_login->fetchArray(SQLITE3_ASSOC);

    if($user)
    {
        if(password_verify($get_password, $user['password']))
        {
            $expired_time = time() + (60 * 60 * 24 * 30); // 30 hari
            // JWT encode
            $payload = array(
                'id' => $user['id'],
                'email' => 'Login successfully',
                'exp' => $expired_time
            );
            $jwt_encode = JWT:: encode($payload, JWT_KEY, 'HS256');

            echo respon(array(
                'status' => true,
                'message' => 'Login successfully !!',
                'data' => array(
                    'access_token' => $jwt_encode,
                    'expired_token' => date('Y-m-d H:i:s', $expired_time)
                )
                ), 200);
                exit();
        }
        else
        {
            echo respon(array(
                'status'=> false,
                'message' => 'Password WRONG !!',
                'data' =>array()
            ), 400);
            exit();
        }
    }
    else
    {
        echo respon(array(
            'status'=> false,
            'message' => 'User NOT registered!',
            'data' =>array()
        ), 400);
        exit();
    }