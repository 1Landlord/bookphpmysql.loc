<?php
    //Открытие сессии
    require_once('startsession.php');

    //Вывод заголовка страницы
    $page_title = 'Там, где противоположности сходятся!';
    require_once('header.php');

    //Инициализация констант
    require_once('appvars.php');
  
    // Вывод меню навигации
    require_once('navmenu.php'); 
    // Соединение с базой данных
    require_once('connectvars.php'); 

  // Извлечение данных пользователя из MySQL
  $query = "SELECT user_id, first_name, picture FROM mismatch_user WHERE first_name IS NOT NULL ORDER BY join_date DESC LIMIT 5";
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
    if (isset($_SESSION['user_id'])) {
      echo '<td><a href="viewprofile.php?user_id=' . $row['user_id'] . '">' . $row['first_name'] . '</a></td></tr>';
    }
    else {
      echo '<td>' . $row['first_name'] . '</td></tr>';
    }
  }
  echo '</table>';

  mysqli_close($dbc);
?>

<?php
    //Футер
    require_once('footer.php');
?>

