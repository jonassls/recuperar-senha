<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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

require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';
require_once 'PHPMailer/src/Exception.php';
include 'config.php';

$mail = new PHPMailer(true);

try {
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';
    $mail->setLanguage('br');
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = $config['email'];
    $mail->Password = $config['senha-email'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
        );

    //Recepients
    $mail->setFrom($config['email'], 'Aula de Tópicos');
    $mail->addAddress($usuario['email'], $usuario['nome']);
    $mail->addReplyTo($config['email'], 'Aula de Tópicos');

    //content
    $mail->isHTML(true);
    $mail->Subject = 'Recuperação de Senha do Sistema';
    $mail->Body = 'Olá! <br>
        Você solicitou a recuperação da sua conta no nosso sitema.
        Para isso, clique no Link abaixo para realizar a troca de senha:<br>
        <a href="'. $_SERVER['SERVER_NAME']. '/nova-senha.php?email='. $usuario['email']. '&token=' . $token . '">
        Clique aqui para recuperar o acesso à sua conta!</a><br>">
        <br>
        Atenciosamente<br>
        Equipe do sistema...';
    $mail->send();
    echo 'Email enviado com sucesso!<br> Confira seu email.';

} catch (Exception $e) {
    echo "Não foi possível enviar o email.
    Mailer Error:{$mail->ErrorInfo}";
}
