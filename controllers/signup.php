<?php
session_start();

$login = $_POST['login'];
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];
$email = $_POST['email'];
$name = $_POST['name'];
require_once '../classes/Json.php';
$db = new Json();
$error_fields = [];
$valid_fields = [];



if($login === '') {
    $error_fields[] = 'login';
}

if($password === '') {
    $error_fields[] = 'password';
}
if($password_confirm === '') {
    $error_fields[] = 'password_confirm';
}
if($email === '') {
    $error_fields[] = 'email';
}
if($name === '') {
    $error_fields[] = 'name';
}

if(!empty($error_fields)) {
    $response = [
        "status" => false,
        "type" => 1,
        "message" => 'Заполните поля',
        "fields" => $error_fields
    ];

    echo json_encode($response);

    die();
}

if(strlen($login) < 6) {
    $valid_fields[] = 'login';
}

if(!ctype_alnum($password) || strlen($password) < 6) {
    $valid_fields[] = 'password';
}

if($password !== $password_confirm) {
    $valid_fields[] = 'password_confirm';
}
if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $valid_fields[] = 'email';
}
if(!ctype_alpha($name) || strlen($name) < 2 ) {
    $valid_fields[] = 'name';
}

if(!empty($valid_fields)) {
    $response = [
        "type" => 2,
        "fields" => $valid_fields,
        "status" => false,
        "message" => 'Неверные данные'
    ];

    echo json_encode($response);
    die();
}

$jsonArray = $db->getData();
if($jsonArray) {
    foreach ($jsonArray as $value) {
        if($value['login'] === $login) {
            $duplicate_login = true;
        }
    }
}

if(!$duplicate_login) {
    $salt = 'sdfsfsfef@sfsgsgsfgsmk4kl';
    $userData = array(
        'login' => $login,
        'password' => md5($salt.$password),
        'email' => $email,
        'name' => $name,
        'salt' => $salt
    );
    $db->insert($userData);
                $response = [
                    "status" => true
                ];
                $success = true;
                echo json_encode($response);
} else {
    $response = [
        "message" => 'Пользователь с таким логином уже существует'
    ];
    echo json_encode($response);
}