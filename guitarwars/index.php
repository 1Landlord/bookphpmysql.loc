<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Гитарные войны. Список рейтингов.</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
    <h2>Гитарные войны. Список рейтингов.</h2>
    <p>Приветствую тебя гитарист, твой рейтинг бьет рекорды? Добавь его в список!
        <a href="addscore.php">добавь свой рейтинг</a>.</p>
    <hr />

    <?php
    //Инициализация константы, содержащей имя каталога для загружаемых файлов изображений
    require_once('appvars.php');
    // Соединение с базой данных
    require_once('connectvars.php');

  // Извлечение данных рейтингов из базы MySQL
  $query = "SELECT * FROM guitarwars";
  $data = mysqli_query($dbc, $query);

  // Извлечение данных из массива в цикле. Формирование данных записей в виде кода HTML 
  echo '<table>';
  while ($row = mysqli_fetch_array($data)) { 
    // Вывод данных рейтинга
    echo '<tr><td class="scoreinfo">';
    echo '<span class="score">' . $row['score'] . '</span><br />';
    echo '<strong>Имя:</strong> ' . $row['name'] . '<br />';
    echo '<strong>Дата:</strong> ' . $row['date'] . '</td></tr>';
    if (is_file(GW_UPLOADPACH . $row['screenshot']) &&filesize(GW_UPLOADPACH . $row['screenshot'])>o) {
        echo '<td><img src="' . GW_UPLOADPACH . $row['screenshot'] .'" alt="Подтверждено"/></td></tr>';
    }else {
        echo '<td><img src="' . GW_UPLOADPACH . 'unverified.gif' .'" alt="Не подтверждено!"/></td></tr>';
    }
  }
  echo '</table>';

  mysqli_close($dbc);
?>

</body>

</html>
