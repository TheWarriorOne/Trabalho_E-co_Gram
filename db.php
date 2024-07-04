<?php

$server = 'localhost';
$usuario_db = 'root';
$senha_db = "";
$banco = 'E-cogram';

$conn = new mysqli($server, $usuario_db, $senha_db, $banco);

if($conn->connect_error){
    die("Falha em se comunicar com o banco de dados: ".$conn->connect_error);
}
