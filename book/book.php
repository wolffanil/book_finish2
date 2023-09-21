<?php 
    session_start();

    require_once 'connect.php';

    if(!(isset($_SESSION['user']))) {
        header('Location: login.php');
    } else {
        $id = $_GET['id'];

        $sql = "SELECT * FROM book INNER JOIN gener ON book.gener = gener.Id INNER JOIN author ON book.author = author.Id WHERE book.id_name = $id";
        $bookFromDb = mysqli_query($connect, $sql);
        $book = mysqli_fetch_assoc($bookFromDb);
    }



?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book</title>
    <link rel="stylesheet" href="./styles/style.css">
</head>
<body>
    <?php include('header.php') ?>

    <section class="book">
        <div class="container">
            <div class="book__container">
            
                <?php 
                    echo '<div class="book__img">';
                    echo ' <img src="' . $book['img'] .'" alt="img" class="book__img"> ';
                    echo '</div>';
                    echo '<div class="book__inform">';
                    echo '<h2 class="book__name">' . $book['name'] . '</h2>';
                    echo '<a href="index.php?search='.$book['Name_author'].'" class="book__avtor">' . $book['Name_author'] . '</a>';
                    echo '<p class="book__desc">' . $book['description'] .'</p>';
                    echo '<p class="book__year"> Год выпуска ' . $book['year'] .'</p>';
                    echo '<p class="book__janor"> Жанр: ' . $book['Name_gener'] .'</p>';
                    echo '</div>';
                ?>
            </div>
        </div>
    </section>

    <?php include('footer.php') ?>
<script src='./script.js'></script>

</body>
</html>