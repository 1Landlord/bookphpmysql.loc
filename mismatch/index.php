<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Несоответствие - где противоположности притягиваются!</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <h3>Несоответствие - где противоположности притягиваются!</h3>

<?php
  //Инициализация констант
  require_once('appvars.php');
  
  // Создание меню навигации
  echo '&#10084; <a href="viewprofile.php">Просмотр профиля</a><br />';
  echo '&#10084; <a href="editprofile.php">Редактирование профиля</a><br />';

  // Соединение с базой данных
  require_once('connectvars.php'); 

  // Извлечение данных пользователя из MySQL
  $query = "SELECT user_id, first_name, picture FROM mismatch_user WHERE first_name IS NOT NULL ORDER BY join_date DESC LIMIT 7";
  $data = mysqli_query($dbc, $query);

  // Прохождение в цикле массива данных пользователей, вывод в формате HTML   
  echo '<h4>Новые члены сообщества:</h4>';
  echo '<table>';
  while ($row = mysqli_fetch_array($data)) {
    if (is_file(MM_UPLOADPATH . $row['picture']) && filesize(MM_UPLOADPATH . $row['picture']) > 0) {
      echo '<tr><td><img src="' . MM_UPLOADPATH . $row['picture'] . '" alt="' . $row['first_name'] . '" /></td>';
    }
    else {
      echo '<tr><td><img src="' . MM_UPLOADPATH . 'nopic.jpg' . '" alt="' . $row['first_name'] . '" /></td>';
    }
    echo '<td>' . $row['first_name'] . '</td></tr>';
  }
  echo '</table>';

  mysqli_close($dbc);
?>

</body> 
</html>
