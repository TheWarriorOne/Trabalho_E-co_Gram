<?php

include ('db.php');
include('proteger.php');

$msg = "";

if(isset($_POST['descricao'], $_POST['grupo'],$_POST['usuario'], $_POST['data'], $_FILES['imagem'])) {
$descricao = $_POST['descricao'];
$grupo_id = $_POST['grupo'];
$usuario_id = $_POST['usuario'];
$data = $_POST['data'];
$imagem = $_FILES['imagem'];


    $pasta = "bancoImagem/";
    $nomeDoArquivo = $imagem['name'];
    $novoNomeDoArquivo = uniqid();
    $extensao = strtolower(pathinfo($nomeDoArquivo,PATHINFO_EXTENSION));

    if($extensao != 'jpg' && $extensao != 'png')
        die("Tipo de Arquivo não Suportado");

    $novoNomeDoArquivo = uniqid() . "." . $extensao;

    $caminhoDoArquivo = $pasta . $novoNomeDoArquivo;

    if(move_uploaded_file($imagem["tmp_name"], $caminhoDoArquivo)) {
        $data_formatada = date('Y-m-d', strtotime($data));
        $smtp = $conn->prepare("INSERT INTO produto (descricao, grupo_id, usuario_id, data, imagem) VALUES (?, ?, ?, ?, ?)");
        $smtp->bind_param("sssss", $descricao, $grupo_id, $usuario_id, $data_formatada, $caminhoDoArquivo);

        if($smtp->execute()){
            echo "<script>window.location.href = 'pgInicial.php';</script>";
        } else {
            $msg = "Erro no envio da mensagem: ".$smtp->error;
        }

        $smtp->close();
    } else {
        $msg = "Falha ao enviar o arquivo";
    }
    $conn->close();
} 
?>