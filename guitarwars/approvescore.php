<?php
    require_once('autorize.php');
?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" type="text/css" href="style.css" />
        <title>Гитарные войны - проверка добавленых данных.</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <body>
    <h2>Гитарные войны - проверка добавленых данных.</h2>

<?php
    //Инициализация констант, содержащей имя каталога для загружаемых файлов изображений
    require_once('appvars.php');
    

  if (isset($_GET['id']) && isset($_GET['date']) && isset($_GET['name']) && isset($_GET['score'])) {
    // Извлечение данных из суперглобального массива GET
    $id = $_GET['id'];
    $date = $_GET['date'];
    $name = $_GET['name'];
    $score = $_GET['score'];
    $screenshot = $_GET['screenshot'];
  }
  else if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['score'])) {
    // Извлечение данных из суперглобального массива POST
    $id = $_POST['id'];
    $name = $_POST['name'];
    $score = $_POST['score'];
  }
  else {
    echo '<p class="error">Sorry, no high score was specified for approval.</p>';
  }

  if (isset($_POST['submit'])) {
    if ($_POST['confirm'] == 'Yes') {
      // Соединение с базой данных
      require_once('connectvars.php'); 

      // Санкционирование рейтинга путем установки значения 1 для колонка approved таблицы guitarwar
      $query = "UPDATE guitarwars SET approved = 1 WHERE id = $id";
      mysqli_query($dbc, $query);
      mysqli_close($dbc);

      // Вывод на экран пользователя подтверждения  об успешном санкционировании
      echo '<p>Рейтинг ' . $score . ' для пользователя ' . $name . ' успешно санкционирован.';
    }
    else {
      echo '<p class="error">Извините, возникли проблемы с санкционированием рейтинга.</p>';
    }
  }
  else if (isset($id) && isset($name) && isset($date) && isset($score)) {
    echo '<p>Вы уверены, что хотите Утвердить следующий рейтинг?</p>';
    echo '<p><strong>Имя: </strong>' . $name . '<br /><strong>Дата: </strong>' . $date .
      '<br /><strong>Рейтинг: </strong>' . $score . '</p>';
    echo '<form method="post" action="approvescore.php">';
    echo '<img src="' . GW_UPLOADPATH . $screenshot . '" width="160" alt="Score image" /><br />';
    echo '<input type="radio" name="confirm" value="Yes" /> Да ';
    echo '<input type="radio" name="confirm" value="No" checked="checked" /> Нет <br />';
    echo '<input type="submit" value="Подтвердить" name="submit" />';
    echo '<input type="hidden" name="id" value="' . $id . '" />';
    echo '<input type="hidden" name="name" value="' . $name . '" />';
    echo '<input type="hidden" name="score" value="' . $score . '" />';
    echo '</form>';
  }

  echo '<p><a href="admin.php">&lt;&lt; Назад к странице админ</a></p>';
?>

    </body>
</html>