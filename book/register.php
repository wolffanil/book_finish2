<?php 
    session_start();
    $error = '';
    if(isset($_SESSION['error'])) {
        $error = $_SESSION['error'];

    }
    unset($_SESSION['error']);

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="stylesheet" href="./styles/loginStyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;700&family=Raleway:wght@400;700&family=Roboto+Mono:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="login">
        <div class="login__img">
            <a href="index.php">

                <img src="./icons/logo.png" alt="logo">
            </a>
        </div>
        <form class="login__container" method="post" action="signup.php">
            <h2 class="login__title">Регистрация</h2>
            <input type="text" name="name" required class="login__input_login" placeholder="Логин">
            <input type="password" name="password" required class="login__input_password" placeholder="Пароль">
            <input type="password" required name="password_confirm" class="login__input_password" placeholder="Подвердить пароль">
            <button>Зарегистрироваться</button>
            <?php 
                if($error !== '') {
                    echo '<p class="login__error">' . $error. '</p>';
                }
            ?>
            <span class="login__line"></span>
            <p class="login__agrement">
            Продолжая, вы соглашаетесь с положениями 
            основных документов Литературный компас. Это
            <span>Условия предоставления услуг</span> и 
            <span>Политика конфиденциальности.</span> A также
            подверждаете, что прочли их.
            </p>
            <a href="login.php">Уже есть аккаунт ?</a>
        </form>  
    </div>
</body>
</html>