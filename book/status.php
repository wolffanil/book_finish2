<?php
    session_start();
    require_once 'connect.php';

    if(isset($_GET['up'])) {
        $name = $_GET['up'];
      $sql = "UPDATE `user` SET `status` = '2' WHERE `name` = '$name'";
         mysqli_query($connect, $sql);
        $_SESSION['admin_success_user'] = 'пользователь успешно повышен';
        header('Location: admin.php');
    }

    if(isset($_GET['down'])) {
        $name = $_GET['down'];
        $sql = "UPDATE `user` SET `status` = '1' WHERE `name` = '$name'";
        mysqli_query($connect, $sql);
        $_SESSION['admin_success_user'] = 'пользователь успешно понижен';
        header('Location: admin.php');
    }

    if(isset($_GET['setban'])) {
        $name = $_GET['setban'];
        $sql = "UPDATE `user` SET `isBan` = '1' WHERE `name` = '$name'";
        mysqli_query($connect, $sql);
        $_SESSION['admin_success_user'] = 'пользователь успешно забанен';
        header('Location: admin.php');
    }

    if(isset($_GET['unban'])) {
        $name = $_GET['unban'];
        $sql = "UPDATE `user` SET `isBan` = '0' WHERE `name` = '$name'";
        mysqli_query($connect, $sql);
        $_SESSION['admin_success_user'] = 'пользователь успешно разбанен';
        header('Location: admin.php');
    }
        
    
    
    header('Location: admin.php');


