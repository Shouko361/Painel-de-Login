<?php

Class Login{
    private $pdo;
    public $msg = "";

    //Conexão com banco de dados
    public function conect($nome, $host, $usr, $pass){
        global $pdo;
        global $msg;

        //Gera a conexão com o banco de dados
        try {
            $pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usr,$pass);
        } catch (PDOException $e) {
            $msg = $e->getMessage();
        }
    }
    //Verificação de cadastro
    public function cadastro($nome,$telefone,$email,$senha){
        global $pdo;

        //Verifica se possui cadastro e cadastra no banco de dados
        $sql =$pdo->prepare("SELECT id FROM usuarios WHERE email = :e"); //Verifica o cadastro
        $sql->bindValue(":e",$email);
        $sql->execute();
        if($sql->RowCount() > 0){
            return false; //Já possui cadastro
        }
        else{
            $sql = $pdo->prepare("INSERT INTO usuarios (nome, telefone, email, senha) VALUES (:nome, :telefone, :email, :senha)"); //Insere os dados na tabela "usuarios"
            $sql->bindValue(":nome", $nome);
            $sql->bindValue(":telefone", $telefone);
            $sql->bindValue(":email", $email);
            $sql->bindValue(":senha", md5($senha));
            $sql->execute();
            return true; //Cadastrado
        }
    }
    //Verificação de login
    public function login($email,$senha){
        global $pdo;
        //Verifica email e senha no banco de dados
        global $pdo;

        //Verifica se possui cadastro e cadastra no banco de dados

        $sql = $pdo->prepare("SELECT id FROM usuarios WHERE email = :email AND senha = :senha");
        $sql->bindValue(":email", $email);
        $sql->bindValue(":senha", md5($senha));
        $sql->execute();
        if($sql->RowCount() > 0){
            //Entra em uma sessão
            $dados = $sql->fetch();
            session_start();
            $_SESSION['id'] = $dados['id'];
            return true; //Logado
        }
        else{
            return false; //Não foi possivel logar
        }
    }
}

?>