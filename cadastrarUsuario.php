<?php

include ('db.php');

$msg = "";

if(isset($_POST['nome'], $_POST['email'], $_POST['senha'])) {
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $senha = $_POST['senha'];

    $smtp = $conn->prepare("INSERT INTO usuario (nome, email, senha) VALUES (?, ?, ?)");
    $smtp->bind_param("sss", $nome, $email, $senha);

    if($smtp->execute()){
        echo "<script>window.location.href = 'login.html';</script>";
    } else {
        $msg = "Erro no envio da mensagem: ".$smtp->error;
    }

    $smtp->close();
} else {
    $msg = "Por favor, preencha todos os campos.";
}

$conn->close();
?>