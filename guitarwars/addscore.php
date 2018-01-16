<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Гитарные войны. Добавьте свой рейтинг</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
    <h2>Гитарные войны. Добавьте свой рейтинг</h2>

    <?php
    //Инициализация константы, содержащей имя каталога для загружаемых файлов изображений
    require_once('appvars.php');

  if (isset($_POST['submit'])) {
    // Извлечение данных из массива POST
    $name = $_POST['name'];
    $score = $_POST['score'];
    $screenshot = $_FILES['screenshot'] ['name'];

    if (!empty($name) && !empty($score)) {
        //Перемещаем файл в постоянный каталог для изображений
        $target = GW_UPLOADPACH . $screenshot;
        // Соединение с базой данных
        require_once('connectvars.php');

        // Запись в базу данных
        $query = "INSERT INTO guitarwars VALUES (0, NOW(), '$name', '$score', '$screeshot')";
        mysqli_query($dbc, $query);

      // Вывод пользователю подтверждения в получении данных
      echo '<p>Спасибо, что добавили свой рейтинг!</p>';
      echo '<p><strong>Имя:</strong> ' . $name . '<br />';
      echo '<strong>Рейтинг:</strong> ' . $score . '</p>';
      echo '<img src"' . GW_UPLOADPACH . $screenshot . '" alt="Изображение подтверждающее подлиность рейтинга" /><br />';
      echo '<p><a href="index.php">&lt;&lt; Назад к списку рейтингов</a></p>';

      // Очистка полей ввода данных
      $name = "";
      $score = "";

      mysqli_close($dbc);
    }
    else {
      echo '<p class="error">Введите пожалуйста, всю необходимую информацию.</p>';
    }
  }
?>

    <hr />
    <div class="wrap_form">
        <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="MAX_FILE_SIZE" value="32768" />
            <label for="name">Имя:</label>
            <input type="text" id="name" name="name" value="<?php if (!empty($name)) echo $name; ?>" />
            <br />
            <label for="score">Рейтинг:</label>
            <input type="text" id="score" name="score" value="<?php if (!empty($score)) echo $score; ?>" />
            <br />
            <label for "screenshot">Файл изображения:</label>
            <input type="file" id="screenshot" name="screenshot" />
            <hr />
            <input type="submit" value="Add" name="submit" />
        </form>
    </div>
</body>

</html>
