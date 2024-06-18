<?php
require_once "conexao.php";
$conexao = conectar();
$email = $_POST['email'];
$sql = "SELECT * FROM usuario WHERE email='$email'";
$resultado = executarSQL($conexao, $sql);

$usuario = mysqli_fetch_assoc($resultado);
if ($usuario == null) {
    echo "Email não cadastrado! Faça o cadastro e
    em seguida realize o login.";
    die();
}
//gerar um token unico
$token = bin2hex(random_bytes(50));
?>