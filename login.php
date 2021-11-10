<?php

    require_once 'class.log.php';

    $db = new Login;
    $db->conect("login","localhost","root","qwe123@@");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Painel de Login</title>
</head>
<body>
    <div id="form">

        <h1>Painel de Login</h1>

            <!--Formulario-->
        <form method="POST" id="input_log" >
            <input type="email" placeholder="Email" name="email">
            <input type="password" placeholder="Senha" name="senha">
            <input type="submit" value="Entrar" id="button">
            <h4>Ainda não possui cadastro?<a href="cadastro.php"><strong>Clique aqui</strong></a> e cadastre-se!</h4>
        </form>

    </div>
    <?php

        if(isset($_POST['email'])){

            $email = addslashes($_POST['email']);
            $senha = addslashes($_POST['senha']);
            
            //Verifica campos nulos
            if(!empty($email) && !empty($senha)){
                
                if($db->msg == ""){
                    if($db->login($email,$senha)){
                        header("location: area_restrita.php");
                    }
                   else{
                        echo "Email e/ou Senha invalidos!";
                    }
                }
                else{
                    echo "Erro: ".$db->msg;
                }
                
            }
            else{
                echo "Preencha todos os dados!";
            }
        }

    ?>
</body>
</html>