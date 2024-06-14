<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperação de senha</title>
</head>

<body>
    Digite seu email para que você possa criar uma nova senha. <br>
    Será enviado um email com um link de recuperação que você usará
    para criar uma nova senha.<br><br>
    <form action="recuperar.php" method="post">
        <label>Email: <input type="email" name="email"></label><br>
        <input type="submit" value="Enviar email de recuperação">
    </form>
</body>

</html>