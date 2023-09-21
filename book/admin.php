<?php 
    session_start();

    require_once 'connect.php';

    $user = $_SESSION['user']['status'];

    $sql = "SELECT * FROM `status` WHERE `id` = '$user'";
    
    $status = mysqli_query($connect, $sql);

    $isAdmin = mysqli_fetch_assoc($status);


    if($isAdmin['status'] !== 'admin') {
      header("Location: index.php");
    }




    ////////////////

    error_reporting(0);

    $sql = "SELECT * FROM book";
    $books = mysqli_query($connect, $sql);
    $book = '';

    if(isset($_GET['edit'])) {
      $edit = $_GET['edit'];

      $sql = "SELECT * FROM book 
      INNER JOIN author ON book.author = author.Id 
      WHERE book.id_name = $edit";

      $bookFromDB = mysqli_query($connect, $sql);
      $book2 = mysqli_fetch_assoc($bookFromDB);

      $_SESSION['edit'] = $edit;
      $_SESSION['file'] = $book2['img'];

      
    }

    //////////////////////

    if(isset($_GET['del'])) {
      $del = $_GET['del'];

      $sql = "SELECT * FROM `book` WHERE `id_name`= '$del'";

      $book9 = mysqli_query($connect, $sql);
      $book9 = mysqli_fetch_assoc($book9);
      unlink($book9['img']);

      $sql = "DELETE FROM book WHERE id_name = $del";
       $res = mysqli_query($connect, $sql);


      if($res) {
        header("Location: admin.php");
        $_SESSION['admin_success'] = 'удаление произошло успешно';
      } else {
        $_SESSION['admin_error'] = 'ошибка при удаление';
      }

    }


    ////////////////////
    $name = $_SESSION['user']['name'];


    $sql = "SELECT * FROM user";
    $users = mysqli_query($connect, $sql);


    /////// 

    

   
?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Админ</title>
    <link rel="stylesheet" href="./styles/adminStyle.css" />
  </head>
  <body>
    <section class="admin">
      <div class="admin__img">
        <a href="index.php">
          <img src="./icons/logo-v2.png" alt="logo" />
        </a>
      </div>

      <div class="admin__container">
        <div class="admin__books">
          <h2 class="admin__title">Добавленные книги </h2>
          <?php 
                if(isset($_SESSION['admin_success'])) {
                  echo '<p class="admin__success">'. $_SESSION['admin_success'] . '</p>';
                  unset($_SESSION['admin_success']);
                }
    
                if(isset($_SESSION['admin_error'])) {
                  echo '<p class="admin__error">'. $_SESSION['admin_error'] . '</p>';
                  unset($_SESSION['admin_error']);
    
                }
              ?>
          <div class="admin__header">
            <div class="admin__header__name">Название</div>
            <div class="admin__header__action">Действие</div>
          </div>
          <div class="admin__books__list">
            <?php 
                while($book = mysqli_fetch_assoc($books)) {
                  echo '<div class="admin__header__fullname">'.$book['name'] .'</div>';
                  echo '<div class="admin__header__actions">';
                  echo '<button class="admin__edit"><a href="admin.php?edit='.$book['id_name'] .'">Редактировать</a></button>';
                  echo '<button class="admin__delete"><a href="admin.php?del='.$book['id_name'].'">Удалить</a></button>';
                  echo '</div>';
                }
            ?>


          </div>

          <button class="admin__add">Добавить новую книга</button>

        </div>




        

        <div class="admin__user">
          <h2 class="admin__title">Список пользователь </h2>
                
          <?php 
                if(isset($_SESSION['admin_success_user'])) {
                  echo '<p class="admin__success">'. $_SESSION['admin_success_user'] . '</p>';
                  unset($_SESSION['admin_success_user']);
                }
    
                if(isset($_SESSION['admin_error'])) {
                  echo '<p class="admin__error">'. $_SESSION['admin_error'] . '</p>';
                  unset($_SESSION['admin_error']);
    
                }
              ?>
         
          <div class="admin__header">
            <div class="admin__header__name">Имя пользователя</div>
            <div class="admin__header__action">Действие</div>
          </div>
          <div class="admin__books__list">
            <?php 
              while($user = mysqli_fetch_assoc($users)) {
                if($user['name'] !== $_SESSION['user']['name']) {
                
                  echo "<div class='admin__header__fullname'>";
                  echo "<div class='admin__header__profile'>" .$user['name'] ."</div>";
                  if($user['status'] === '2') {
                     echo "<img src='./icons/king.png' alt='king' class='admin__header__king'>" ;
                  } 
                  echo "</div>";
                  echo '<div class="admin__header__actions">';
                  if($user['status'] === '1') {

                    echo '<button class="admin__edit"><a href="status.php?up='.$user['name'].'">Повысить</a></button>';
                  } else {
                    echo '<button class="admin__edit"><a href="status.php?down='.$user['name'].'">Понизить</a></button>';
                  }
                  if($user['isBan'] === '0') {
                    echo '<button class="admin__edit"><a href="status.php?setban='.$user['name'].'">Забанить</a></button>';
                    
                  } else {
                    echo '<button class="admin__edit"><a href="status.php?unban='.$user['name'].'">Разбанить</a></button>';
                    
                  }
                  echo '</div>';
                }
              }
            ?>




           

          </div>
          
        </div>
      </div>
    </section>


    <div class=admin__overview>

      <div class="admin__newbook">



        <form
              method="post"
              action="newBook.php"
              enctype="multipart/form-data"
              class="admin__book"
              accept="image/*"
            >
    
             
    
              <div class="admin__title admin__title_newbook">
                <?php 
                  if(isset($_GET['edit'])) {
                    echo 'Редактировать';
                  } else {
                    echo 'Добавить новую книгу';
                  }
                ?>
              </div>
              <input
                type="text"
                name="name"
                required
                placeholder="Название книги"
                value="<?php
                  echo $book2['name'] !== '' ? $book2['name'] : '';
                ?>"
              />
              <input type="text" name="avtor" required placeholder="Автор"
              value="<?php
                  echo $book2['Name_author'] !== '' ? $book2['Name_author'] : '';
                ?>"
              />
              <!-- <input type="text" name="gener" required placeholder="Жанр" /> -->
              <select name="gener" class='admin__select' required
              value="<?php
                  echo $book2['gener'] !== '' ? $book2['gener'] : '';
                ?>"
              >
              <option value="" disabled <?php if(!$edit) echo 'selected'; ?>hidden>Жанр</option>
                <option value="1"
                <?php
                  if($book2['gener'] === '1') {
                    echo 'selected';
                  }
                  ?>
                >
                  Психология
                </option>
                <option value="3"
                <?php
                  if($book2['gener'] === '3') {
                    echo 'selected';
                  }
                  ?>
                >
                Фантастика
                </option>
                <option value="4"
                <?php
                  if($book2['gener'] === '4') {
                    echo 'selected';
                  }
                  ?>
                >
                  Хоррор
                </option>
                <option value="2"
                <?php
                  if($book2['gener'] === '2') {
                    echo 'selected';
                  }
                  ?>
                >
                  Детектив
                </option>
                <option value="5"
                <?php
                  if($book2['gener'] === '5') {
                    echo 'selected';
                  }
                  ?>
                >
                  Романтика
                </option>
              </select>
              <input type="number" name="year" required placeholder="Год издание"
              value="<?php
                  echo $book2['year'] !== '' ? $book2['year'] : '';
                ?>"
              />
              <input type="file" name="avatar" <?php 
                if(!isset($_GET['edit'])) {
                  echo 'required';
                }
              ?>/>
              <textarea placeholder="Описание" name="desc" required
              ><?php
                  echo $book2['description'] !== '' ? $book2['description'] : '';
                ?></textarea>
              <button class="admin__btn_book">
                <?php 
                  if(isset($_GET['edit'])) {
                    echo 'Редактировать';
                  } else {
                    echo 'Добавить';
                  }
                ?>
              </button>
            </form>

            <button class='admin__cancel'>
              Отменить
            </button>

      </div>



    </div>

    <script src='./script.js'></script>
  </body>
</html>
