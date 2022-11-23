<?php
session_start();
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

if (!$_SESSION['user'] || $ip !== $_SESSION['ip_user']) {
    header('Location: login.php');
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
    <h2 style="margin: 10px 0;">Hello, <?= $_SESSION['user']['name']?></h2>
    <a href="controllers/logout.php" class="logout">Выход</a>
</form>

</body>
</html>