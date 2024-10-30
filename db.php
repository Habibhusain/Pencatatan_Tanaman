<?php

$db = new SQLite3('db_tanaman.sqlite');

if(!$db){
    echo $db -> lastErrorMsg();
    exit();
}else{
    // echo "Database Berhasil";
}



$db -> query("CREATE TABLE IF NOT EXISTS tanaman (id INTEGER PRIMARY KEY AUTOINCREMENT, tanggal TEXT NOT NULL, tanaman TEXT NOT NULL,  keterangan TEXT,foto TEXT NOT NULL)");
$db -> query("CREATE TABLE IF NOT EXISTS user (id INTEGER PRIMARY KEY AUTOINCREMENT, nama TEXT NULL, email TEXT NULL,  password TEXT, token TEXT NOT NULL)");

$db -> query("ALTER TABLE tanaman ADD id_user TEXT");
?>