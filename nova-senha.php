<?php

$email = $_GET['email'];
$token = $_GET['token'];

require_once "conexao.php";

$conexao = conectar();
$sql = "SELECT * FROM `recuperar-senha` WHERE email='$email' AND token='$token'";
$resultado = executarSQL($conexao, $sql);
$recuperar = mysqli_fetch_assoc($resultado);

if ($recuperar == null) {
    echo "Email ou token incorreto. Tente fazer um novo pedido
    de recuperação de senha.";
    die();
} else {
    date_default_timezone_set('America/Sao_Paulo');
    $agora = new DateTime('now');
    $data_criacao = DateTime::createFromFormat('Y-m-d H:i:s', $recuperar['data_criacao']);
    $umDia = DateInterval::createFromDateString('1 Day');
    $dataExpiracao = date_add($data_criacao, $umDia);

    if ($agora < $dataExpiracao) {
        
    }
}
