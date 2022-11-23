<?php
session_start();
if (@$_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
    $login = $_POST['login'];
    $password = $_POST['password'];
    require_once '../classes/Json.php';
    $db = new Json();
    require_once '../classes/Handle.php';
    $handle = new Handle();
    $jsonArray = $db->getData();

    $ip = $handle->getIp();

    $error_fields = [];
    if($login === '') {
        $error_fields[] = 'login';
    }

    if($password === '') {
        $error_fields[] = 'password';
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

    if(!empty($jsonArray)){
        foreach ($jsonArray as $data) {
            if($data['login'] === $login && $data['password'] === md5($data['salt'].$password)) {
                $_SESSION['user'] = [
                    "id" => $data['id'],
                    "name" => $data['name']
                ];
                $_SESSION['ip_user'] = $ip;

                $response = [
                    "status" => true
                ];
                $success = true;
                echo json_encode($response);
            }

        }
    }

    if(!$success) {
        $response = [
            "status" => false,
            "message" => 'Неверный логин или пароль'
        ];
        echo json_encode($response);
    }
}

