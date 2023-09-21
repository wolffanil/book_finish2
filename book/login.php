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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Вход</title>
    <link rel="stylesheet" href="./styles/loginStyle.css" />
  </head>
  <body>
    <div class="login">
      <div class="login__img">
        <a href="index.php">
          <img src="./icons/logo.png" alt="logo" />
        </a>
      </div>
      <form class="login__container" method="post" action="singin.php">
        <h2 class="login__title">Войти</h2>
        <input
          type="text"
          name="name"
          class="login__input_login"
          required
          placeholder="Логин"
        />
        <input
          type="password"
          name="password"
          required
          class="login__input_password"
          placeholder="Пароль"
        />
        <button>Вход</button>
        <?php 
                if($error !== '') {
                    echo '<p class="login__error">' . $error. '</p>';
                }
        ?>
        <span class="login__line"></span>
        <a href="register.php">Зарегистрироваться</a>
      </form>
    </div>
  </body>
</html>
