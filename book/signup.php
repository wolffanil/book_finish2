<?php
    session_start();

    require_once 'connect.php';

    $name = trim($_POST['name']);
    $password = trim($_POST['password']);
    $password_confirm = trim($_POST['password_confirm']);
    
    $sql = "SELECT * FROM `user` WHERE `name` = '$name'";
    $exitUser = mysqli_query($connect, $sql);

    if(mysqli_num_rows($exitUser) > 0) {
        $_SESSION['error'] = 'логин занят';
        header('Location: register.php');
    } else if ($password === $password_confirm) {
        $password = md5($password);

        $sql = "INSERT INTO `user` (`id`, `name`, `password`, `status`, `isBan`) VALUES (NULL, '$name', '$password', '1', '0')";
        mysqli_query($connect, $sql);

        $_SESSION['user'] = ['name' => $name, 'status' => 'user'];
        header('Location: index.php');
    } else {
        $_SESSION['error'] = 'пароли не совпадают';
        header('Location: register.php');
    }

    
