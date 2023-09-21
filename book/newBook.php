<?php
    session_start();

    require_once 'connect.php';

   $name = $_POST['name'];
   $author = $_POST['avtor'];
   $gener = $_POST['gener'];
   $year = $_POST['year'];
   $desc = $_POST['desc'];



  
   $sql9 = "SELECT * FROM `book` WHERE `name` = '$name'";

    $book1 = mysqli_query($connect, $sql9);

   if(isset($_SESSION['edit']) and $_SESSION['edit'] !== 0) {
    $edit = $_SESSION['edit'];
    $sqlAuthor = "SELECT * FROM `author` WHERE `Name_author` = '$author'";

    $author = mysqli_query($connect, $sqlAuthor);
    $name_img = isset($_SESSION['file']) ? $_SESSION['file'] : '';
    if($_FILES['avatar']['name'] !== $_SESSION['file'] and !empty($_FILES['avatar']['name']) ) {

        
        unlink($_SESSION['file']);
        unset($_SESSION['file']);

        $name_img = 'upload/' . time() . $_FILES['avatar']['name'];
    
        move_uploaded_file($_FILES['avatar']['tmp_name'], $name_img);
    }



    // $id_name = time();

    if(mysqli_num_rows($author) > 0) {
        $author = mysqli_fetch_assoc($author);
        $author = $author['Id'];

        
        $sql = "UPDATE book SET name = '$name', description = '$desc', year = '$year', author = '$author', img = '$name_img', gener = '$gener' WHERE id_name = '$edit'";

        
        
        
         mysqli_query($connect, $sql);
    unset($_SESSION['edit']);

        
        
    } else {
        $authorAdmin = $_POST['avtor'];

        $sql = "INSERT INTO `author` (`Id`, `Name_author`) VALUES (NULL, '$authorAdmin')";

        mysqli_query($connect, $sql);

        $sqlAuthor = "SELECT * FROM `author` WHERE `Name_author` = '$authorAdmin'";

        $author = mysqli_query($connect, $sqlAuthor);

        $author = mysqli_fetch_assoc($author);
        $author = $author['Id'];

        $sql = "UPDATE book SET name = '$name', description = '$desc', year = '$year', author = '$author', img = '$name_img', gener = '$gener' WHERE id_name = '$edit'";

        mysqli_query($connect, $sql);
        unset($_SESSION['edit']);

    }

    $_SESSION['admin_seccuss'] = 'успешно обновлена книга';

    unset($_SESSION['edit']);
    header('Location: admin.php');


   } else if(mysqli_num_rows($book1) > 0) {
    

    $_SESSION['admin_error'] = 'название уже существует';
    header("Location: admin.php");

    } else {
        $sqlAuthor = "SELECT * FROM `author` WHERE `Name_author` = '$author'";

        $author = mysqli_query($connect, $sqlAuthor);

        $name_img = 'upload/' . time() . $_FILES['avatar']['name'];

        move_uploaded_file($_FILES['avatar']['tmp_name'], $name_img);

        $id_name = time();

        if(mysqli_num_rows($author) > 0) {
            $author = mysqli_fetch_assoc($author);
            $author = $author['Id'];

            

            $sql = "INSERT INTO `book` (`Id`, `name`, `description`, `year`, `gener`, `author`, `img`, `id_name`) VALUES (NULL, '$name', '$desc', '$year', '$gener', '$author', '$name_img', '$id_name')";

            mysqli_query($connect, $sql);
        } else {
            $authorAdmin = $_POST['avtor'];

            $sql = "INSERT INTO `author` (`Id`, `Name_author`) VALUES (NULL, '$authorAdmin')";

            mysqli_query($connect, $sql);

            $sqlAuthor = "SELECT * FROM `author` WHERE `Name_author` = '$authorAdmin'";

            $author = mysqli_query($connect, $sqlAuthor);

            $author = mysqli_fetch_assoc($author);
            $author = $author['Id'];

            $sql = "INSERT INTO `book` (`Id`, `name`, `description`, `year`, `gener`, `author`, `img`, `id_name`) VALUES (NULL, '$name', '$desc', '$year', '$gener', '$author', '$name_img', '$id_name')";

            mysqli_query($connect, $sql);
        }

        unset($_SESSION['edit']);
        $_SESSION['admin_success'] = 'успешно дабавленно книга';
        header("Location: admin.php");
        
    }

    



    