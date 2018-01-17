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
    $screenshot = $_FILES['screenshot']['name'];
    $screenshot_type = $_FILES['screenshot']['type'];
    $screenshot_size = $_FILES['screenshot']['size'];

    if (!empty($name) && !empty($score) && !empty($screenshot)) {
        if ((($screenshot_type == 'image/gif') || ($screenshot_type == 'image/jpeg') || ($screenshot_type == 'image/pjpeg') || ($screenshot_type == 'image/png'))
          && ($screenshot_size > 0) && ($screenshot_size <= GW_MAXFILESIZE)) {
          if ($_FILES['screenshot']['error'] == 0) {
        //Перемещаем файл в постоянный каталог для изображений
        $target = GW_UPLOADPATH . $screenshot;
        if (move_uploaded_file($_FILES['screenshot']['tmp_name'], $target)) {
        // Соединение с базой данных
        require_once('connectvars.php');

        // Запись в базу данных
        $query = "INSERT INTO guitarwars VALUES (0, NOW(), '$name', '$score', '$screenshot')";
        mysqli_query($dbc, $query);

      // Вывод пользователю подтверждения в получении данных
      echo '<p>Спасибо, что добавили свой рейтинг!</p>';
      echo '<p><strong>Имя:</strong> ' . $name . '<br />';
      echo '<strong>Рейтинг:</strong> ' . $score . '</p>';
      echo '<img src="' . GW_UPLOADPATH . $screenshot . '" alt="Изображение с рейтингом" /></p>';
      echo '<p><a href="index.php">&lt;&lt; Назад к списку рейтингов</a></p>';

        // Очистка полей ввода данных
        $name = "";
        $score = "";
        $screenshot = "";

      mysqli_close($dbc);
    }
    else {
      echo '<p class="error">Извините, возникла ошибка при загрузке файла изображения.</p>';
    }
  }
}
else {
  echo '<p class="error">Файл, подтверждающий рейтинг, должен быть файлом изображения GIF, JPEG или PNG, и его размер не должен превышать ' . (GW_MAXFILESIZE / 1024) . ' KB in size.</p>';
}

// Попытка удалить временный файл изображения, подтверждающий рейтинг
@unlink($_FILES['screenshot']['tmp_name']);
}
else {
echo '<p class="error">Введите всю информацию для добавления рейтинга.</p>';
}
}
?>
    <hr />
    <div class="wrap_form">
    <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo GW_MAXFILESIZE; ?>" />
        <label for="name">Имя:</label>
        <input type="text" id="name" name="name" value="<?php if (!empty($name)) echo $name; ?>" /><br />
        <label for="score">Рейтинг:</label>
        <input type="text" id="score" name="score" value="<?php if (!empty($score)) echo $score; ?>" /><br />
        <label for="screenshot">Скриншот:</label>
        <input type="file" id="screenshot" name="screenshot" />
        <hr />
        <input type="submit" value="Добавить" name="submit" />
  </form>
    </div>
</body>

</html>
