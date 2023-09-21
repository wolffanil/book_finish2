<?php 
    session_start();

    $user = '';
    $isAdmin = false;
    error_reporting(0);
    if(isset($_SESSION['user'])) {
        $user = $_SESSION['user']['status'];
        $sql = "SELECT * FROM `status` WHERE `id` = '$user'";
    
        $status = mysqli_query($connect, $sql);
    
        $isAdmin = mysqli_fetch_assoc($status);

        $isAdmin = ($isAdmin['status']) === 'admin';
    } 

?>

<nav class="nav">
    <div class="container">
        <div class="nav__container">

            <div class="nav__logo">
                <a href="index.php" class='nav__big__logo'>
                    <img src="./icons/logo.png" alt="logo">
                </a>
                <a href="index.php" class="nav__mobile__logo">
                     <img src="./icons/compass.png" alt="logo">
                </a>
            </div>
             
            <div class="nav__search">
                <input type="text" placeholder="Что ищем?" class="nav__search__input">
                <div class="nav__search__icon">
                    <img src="./icons/search.png" alt="search">
                </div>
            </div>
            
            <div class="nav__catalog">Каталог</div>
                <?php 
                    if($user) {
                        echo '<div class="nav__user">';
                        echo '<img src="./icons/user.png" alt="user">';   
                        echo '</div>';
                    } else {
                        echo '<div class="nav__enter">';
                        echo '<a href="login.php">Войти</a>';
                        echo '</div>';
                    }
                ?>
        </div>      

        <div class='overview'>
            <?php 
                echo '<div class="nav__name">'.$_SESSION['user']['name'].'</div>';

                if($isAdmin) {
                    echo '<a class="overview__admin" href="admin.php">';
                    echo '<img src="./icons/settings.png" alt="setting">';
                    echo '<p>Админ</p>';
                    echo '</a>';
                }
            ?>
            <a class="overview__exit" href='logout.php'>
                <img src="./icons/exit.png" alt="exit">
                <p>Выход</p>
            </a>
        </div>

    </div>
    <div class="catalog__overview">
        <div class="catalog__close">
            <img src="./icons/close.png" alt="close">

            
        </div>

       



        <div class="overview__catalog">
            <div class="overview__books">
                <img src="./icons/gener/books.png" alt="books">
                <h2 class='overview__title'>Книги</h2>
            </div>
            <p class='overview__janr'>Жанры</p>
            
            <div class="overview__list">
                <div class="overview__gener__item">
                    
                    <a href="catalog.php?gener=Романтика" class='overview__janr_p' data-janr="romantic">
                        <img src="./icons/gener/Love.png" alt="love">Романтика</a>
                </div>

                <div class="overview__gener__item">
                    
                    <a href="catalog.php?gener=Психология" class='overview__janr_p' data-janr="phisical">
                        <img src="./icons/gener/Learning_psyho.png" alt="psyho">Психология</a>
                </div>

                <div class="overview__gener__item">
                    
                    <a href="catalog.php?gener=Хоррор" class='overview__janr_p' data-janr="horror">
                        <img src="./icons/gener/Scream.png" alt="horror">Хоррор</a>
                </div>

                <div class="overview__gener__item">
                    
                    <a href="catalog.php?gener=Фантастика" class='overview__janr_p' data-janr="Fantasi">
                        <img src="./icons/gener/Magic.png" alt="Magic">Фантастика</a>
                </div>

                <div class="overview__gener__item">
                    
                    <a href="catalog.php?gener=Детектив" class='overview__janr_p' data-janr="decetiv">
                        <img src="./icons/gener/Detective_Hat.png" alt="Detective">Детектив</a>
                </div>



               


            </div>
            
        </div>
    </div>

    <div class="nav__catalog__mobile">
        <div class="container">
            <div class="container__mobile__catalog">
                <p class='nav__genre'>Жанры:</p>
                <a href="catalog.php?gener=Романтика" class='nav__catalog__genres'>
                    <img src="./icons/gener/Love.png" alt="love">
                </a>
    
                <a href="catalog.php?gener=Психология" class='nav__catalog__genres'>
                    <img src="./icons/gener/Learning_psyho.png" alt="psycho">
                </a>
    
                <a href="catalog.php?gener=Хоррор" class='nav__catalog__genres'>
                    <img src="./icons/gener/Scream.png" alt="Scream">
                </a>
    
                <a href="catalog.php?gener=Фантастика" class='nav__catalog__genres'>
                    <img src="./icons/gener/Magic.png" alt="magic">
                </a>
                
                <a href="catalog.php?gener=Детектив" class='nav__catalog__genres'>
                    <img src="./icons/gener/Detective_Hat.png" alt="Detective">
                </a>
            </div>
        </div>
    </div>
</nav>
