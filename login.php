<?php
include ('db.php');
include ('login.html');

if (isset($_POST['email']) && isset($_POST['senha'])) {

    if (strlen( $_POST ['email']) == 0 ) {
        echo " Preencha seu e-mail ";
    } else  if (empty( $_POST ['senha'])) {
        echo " Preencha sua senha ";
    } else {

        $email = trim($conn->real_escape_string ( $_POST ['email']));
        $senha = trim($conn->real_escape_string ( $_POST ['senha']));

        $sql_code = " SELECT *FROM usuario WHERE email='$email' AND senha='$senha' ";
        $sql_query = $conn->query ($sql_code) or die(" Falha na execução do código SQL: " .$conn->error );


        $quantidade = $sql_query->num_rows ;

        if ($quantidade == 1) {
            
            $usuário = $sql_query->fetch_assoc();

            if (!isset( $_SESSION )) {
                session_start();
            }

            $_SESSION ['nome'] = $usuário ['nome'];
            $_SESSION ['email'] = $usuário ['email'];

            header("Location: pgInicial.php");
            exit();
        } else {
            echo " Falha ao logar!! E-mail ou senha incorretos! ";
        }

    }

}

?>