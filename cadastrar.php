<?php
require_once "conexao.php";
$conexao = conectar();

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];

// TODO armazenar a senha de modo seguro
$sql = "INSERT INTO usuario (nome, email, senha) VALUES
('$nome', '$email','$senha')";
$resultado = mysqli_query($conexao, $sql);
if ($resultado === false) {
    if (mysqli_errno($conexao) == 1062) {
        echo "Email já cadastrado no sistema! Tente fazer o login ou faça a recuperação de senha.";
    } else {
        echo "Erro ao inserir o novo usuário!"
            . mysqli_errno($conexao) . ":" . mysqli_error($conexao);
    }
}
header("Location: index.php");
