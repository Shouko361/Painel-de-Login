<?php

    require_once 'class.log.php';

    //Conexão
    $db = new Login;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Painel de Cadastro</title>
</head>
<body>
    <div id="form">

        <h1 id="cad">Cadastro</h1>

            <!--Formulario-->
        <form method="POST" id="form_cad">
            <input type="text" placeholder="Nome" name="nome" id="form_cad" maxlength="30">
            <input type="text" placeholder="Telefone" name="telefone" id="form_cad" maxlength="30">
            <input type="email" placeholder="Email" name="email" id="form_cad" maxlength="40">
            <input type="password" placeholder="Senha" name="senha" id="form_cad" maxlength="32">
            <input type="password" placeholder="Confirmar Senha" name="conf_senha" id="form_cad" maxlength="32">
            <input type="submit" value="Cadastrar" id="button">
        </form>

    </div>
    <?php

        //Verifica os dados
        if(isset($_POST['nome'])){

            $nome = addslashes($_POST['nome']);
            $telefone = addslashes($_POST['telefone']);
            $email = addslashes($_POST['email']);
            $senha = addslashes($_POST['senha']);
            $confsenha = addslashes($_POST['conf_senha']);

            //Verifica campos nulos
            if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confsenha)){
                $db->conect("login","localhost","root","qwe123@@");
                if($db->msg == ""){
                    if($senha == $confsenha){
                        if($db->cadastro($nome,$telefone,$email,$senha,$confsenha)){
                            ?>
                            <div id="cad_suc">
                                <h4>Cadastrado no Banco de Dados! :) <a href="login.php">Clique aqui</a> para retornar a tela de login</h4>
                            </div>
                            <?php
                        }
                        else{
                            ?>
                            <div class="error_msg">
                                <h4>Email existente! Tente outro email.</h4>
                            </div>
                            <?php
                        }
                    }
                    else{
                        ?>
                        <div class="error_msg">
                            <h4>Senhas Divergentes!</h4>
                        </div>
                        <?php
                    }
                }
                else{
                    ?>
                    <div class="error_msg">
                        <h4><?php echo "Erro: ".$db->msg; ?></h4>
                    </div>
                    <?php
                } 
            }
            else{
                ?>
                <div class="error_msg">
                    <h4>Preencha todos os campos!</h4>
                </div>
                <?php
            }
        }

    ?>
</body>
</html>