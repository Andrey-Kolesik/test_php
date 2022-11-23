<?php
session_start();
require_once 'classes/Handle.php';
$handle = new Handle();
$ip = $handle->getIp();

if ($_SESSION['user'] && $_SESSION['ip_user'] === $ip) {
    header('Location: /');

}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<form>
    <input type="text" name="login" placeholder="Введите свой логин">
    <input type="password" name="password" placeholder="Введите пароль">
    <button type="submit" class="login-btn">Вход</button>
    <p>
        У вас нет аккаунта? - <a href=" /register.php">Зарегистрируйтесь</a>!
    </p>
    <p class="msg none">Message</p>
    <noscript>
        <p class="msg">Javascript отключен в вашем веб-браузере.</p>
    </noscript>
</form>

<script src="js/jquery-3.6.1.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>