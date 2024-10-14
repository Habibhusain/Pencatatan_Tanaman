<?php

$db = new SQLite3('tanaman.sqlite');

if(!$db){
    echo $db -> lastErrorMsg();
    exit();
}else{
    // echo "Database Berhasil";
}



$db -> query("CREATE TABLE IF NOT EXISTS tanaman (id INTEGER PRIMARY KEY AUTOINCREMENT, tanggal TEXT NOT NULL, tanaman TEXT NOT NULL,  keterangan TEXT,foto TEXT NOT NULL)");
?>