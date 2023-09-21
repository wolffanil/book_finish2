<?php 
    session_start();

    require_once 'connect.php';

    $name = trim($_POST['name']);
    $password = trim($_POST['password']);

    $password = md5($password);


    $sql = "SELECT * FROM `user` WHERE `name` = '$name' AND `password` = '$password'";
    $user = mysqli_query($connect, $sql);

    if(mysqli_num_rows($user) > 0) {
        $user = mysqli_fetch_assoc($user);

        if($user['isBan'] === '1') {
            $_SESSION['error'] = 'Вы были забанены';
            header('Location: login.php');
        } else {

            $_SESSION['user'] = ['name' => $user['name'], 'status' => $user['status']];
    
            header('Location: index.php');
        }

        
    } else {
        $_SESSION['error'] = 'неверный логин или пароль';
        header('Location: login.php');
    }




