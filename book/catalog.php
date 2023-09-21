<?php 

    require_once 'connect.php';

    if(isset($_GET['gener'])) {
        $generT = $_GET['gener'];


        $sql = "SELECT * FROM book INNER JOIN gener ON book.gener = gener.Id INNER JOIN author ON book.author = author.Id";
       



        $result = mysqli_query($connect, $sql);

      

    } else {
        header('Location: index.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $generT?></title>
    <link rel="stylesheet" href="./styles/style.css">
</head>
<body>
    <?php include('header.php')?>

    <section class='main'>
        <div class="container">
        <h1 class="main__title">
            Жанр: <?= $generT ?>
        </h1>

        <div class="main__container">
            <?php 
                    while($elem = mysqli_fetch_assoc($result)) {
                        $name = '';
                        $name__mobile = '';
                        $gener = $elem['Name_gener'];
                        if(mb_strlen($elem['name']) > 21) {
                            $name = mb_substr($elem['name'], 0, 21, 'UTF-8') . '...';
                        } else {
                            $name = $elem['name'];
                            $name__mobile = $elem['name'];

                        }

                        if(mb_strlen($elem['name']) > 13) {
                            $name2 = $elem['name'];
                            $name__mobile = mb_substr($name2, 0, 13, 'UTF-8') . '...';

                        

                        } else {
                            $name = $elem['name'];
                            $name__mobile = $elem['name'];

                        }
                        if($gener === $generT) {
                            $img = $elem['img'];
                            $avtor = $elem['Name_author'];
                            $id = $elem['id_name'];
    
                            echo '<div class="main__item">';
                            echo '<img src="' . $img . '" alt="img" class="main__img">';
                            echo '<p class="main__name">' . $name .'</p>';
                            echo '<p class="main__name__mobile">' . $name__mobile .'</p>';
                            echo '<a href="index.php?search='.$avtor.'" class="main__avtor">' . $avtor . '</a>';
                            echo '
                            <a href="book.php?id=' .$id .'"><button class="main__button">Подробнее</button></a>';
                            echo '</div>';
                        }
                    }
            ?>
        
        </div>

        </div>
    </section>

    <?php include('footer.php') ?>

    <script src='./script.js'></script>

</body>
</html>