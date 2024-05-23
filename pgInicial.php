<?php
    include('proteger.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>E-co Gram</title>
<link rel="stylesheet" href="StylePgInicial.css">
</head>
<body>
<div id="container">
    <div id="logo">E-co Gram</div>
    <div id="gerenciador">Gerenciador de Imagens</div>
    <div id="retangulo">
        <div class="icone" onclick="window.location.href='pgCadastrarProduto.php'">
            <img src="cadastrar_icon.png" alt="Cadastrar">
            <div id="cadastrar">Cadastrar</div>
        </div>
        <div class="icone" onclick="window.location.href='pesquisarProduto.php'">
            <img src="pesquisar_icon.png" alt="Pesquisar">
            <div id="pesquisar">Pesquisar</div>
        </div>
    </div>
</div>
