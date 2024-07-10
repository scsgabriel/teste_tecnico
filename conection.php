<?php

    //consultas no servidor: 127.0.0.1 (local)

    $host = "localhost";
    $username = "root";
    $password = "";
    $db = "averbacoes";


    $mysqli = new mysqli($host, $username, $password, $db);
    if($mysqli -> connect_errno){
        die("Falha na conexão do DB." . $mysqli -> connect_error);
    }
