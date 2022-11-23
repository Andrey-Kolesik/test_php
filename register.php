<?php
    session_start();

    if ($_SESSION['user']) {
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
    <p class="err err-login none">минимум 6 символов</p>
    <input type="password" name="password" placeholder="Введите пароль">
    <p class="err err-password none">минимум 6 символов , обязательно должны
        состоять из цифр и букв</p>
    <input type="password" name="password_confirm" placeholder="Подтвердите пароль">
    <p class="err err-password_confirm none">должен совпадать с паролем</p>
    <input type="email" name="email" placeholder="Введите адрес своей почты">
    <p class="err err-email none">неверный email</p>
    <input type="text" name="name" placeholder="Введите свое имя">
    <p class="err err-name none">минимум 2 символа , только буквы</p>
    <button type="submit" class="register-btn">Регистрация</button>
    <p>
        У вас уже есть аккаунт? - <a href="/login.php">Авторизируйтесь</a>!
    </p>
    <p class="msg none">Message</p>
    <?php
    if ($_SESSION['message']) {
        echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
    }
    unset($_SESSION['message']);
    ?>
</form>

<script src="js/jquery-3.6.1.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>