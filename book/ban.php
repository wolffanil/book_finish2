<?php
    session_start();

    require_once 'connect.php';

     $name = $_POST['name'];

     $sql = "SELECT * FROM `user` WHERE `name` = '$name'";

     $user = mysqli_query($connect, $sql);
     $user1 = mysqli_fetch_assoc($user);


    if($user1['name'] === $_SESSION['user']['name']) {
        $_SESSION['admin_error_user'] = 'Суицид не выход';
        header('Location: admin.php');
    } else {

    
        if(mysqli_num_rows($user) > 0) {
            $sql = "SELECT * FROM `user` WHERE `name` = '$name'";

            $user2 = mysqli_query($connect, $sql);
            $user2 = mysqli_fetch_assoc($user2);
            if($user2['isBan'] === '1') {
                $_SESSION['admin_error_user'] = 'пользователь уже был забанен';
                header('Location: admin.php');
            } else {
    
                $sql = "UPDATE `user` SET `isBan` = '1' WHERE `name` = '$name'";
                mysqli_query($connect, $sql);
                $_SESSION['admin_success_user'] = 'пользователь успешно забанен';
                header('Location: admin.php');
            }
    
        } else {
            $_SESSION['admin_error_user'] = 'пользователь не найден';
            header('Location: admin.php');
        }
    }

    

    