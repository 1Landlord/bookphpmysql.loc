<?php
    //Открытие сессии
      require_once('startsession.php');
    //Вывод заголовка страницы
      $page_title = 'Просмотр профиля.';
      require_once('header.php');
    //Инициализация констант
      require_once('appvars.php');
    // Вывод меню навигации
      require_once('navmenu.php');

  // Убедитесь, что пользователь вошел в систему, прежде чем идти дальше.
  if (!isset($_SESSION['user_id'])) {
    echo '<p class="login">Please <a href="login.php">log in</a> to access this page.</p>';
    exit();
  }
  else {
    echo('<p class="login">Вы вошли как  ' . $_SESSION['username'] . '. <a href="logout.php">Выйти</a>.</p>');
}

  // Соединение с базой данных
  require_once('connectvars.php');

  // Захват данных профиля из базы данных
  if (!isset($_GET['user_id'])) {
    $query = "SELECT username, first_name, last_name, gender, birthdate, city, state, picture FROM mismatch_user WHERE user_id = '" . $_SESSION['user_id'] . "'";
  }
  else {
    $query = "SELECT username, first_name, last_name, gender, birthdate, city, state, picture FROM mismatch_user WHERE user_id = '" . $_GET['user_id'] . "'";
  }
  $data = mysqli_query($dbc, $query);

  if (mysqli_num_rows($data) == 1) {
    // Строка пользователя была найдена, поэтому отобразите данные пользователя
    $row = mysqli_fetch_array($data);
    echo '<table>';
    if (!empty($row['username'])) {
      echo '<tr><td class="label">Ник:</td><td>' . $row['username'] . '</td></tr>';
    }
    if (!empty($row['first_name'])) {
      echo '<tr><td class="label">Имя:</td><td>' . $row['first_name'] . '</td></tr>';
    }
    if (!empty($row['last_name'])) {
      echo '<tr><td class="label">Фамилия:</td><td>' . $row['last_name'] . '</td></tr>';
    }
    if (!empty($row['gender'])) {
      echo '<tr><td class="label">Пол:</td><td>';
      if ($row['gender'] == 'M') {
        echo 'Male';
      }
      else if ($row['gender'] == 'F') {
        echo 'Female';
      }
      else {
        echo '?';
      }
      echo '</td></tr>';
    }
    if (!empty($row['birthdate'])) {
      if (!isset($_GET['user_id']) || ($_SESSION['user_id'] == $_GET['user_id'])) {
        // Показать пользователю их собственную дату рождения
        echo '<tr><td class="label">День рождения:</td><td>' . $row['birthdate'] . '</td></tr>';
      }
      else {
        // Показать только год рождения для всех остальных
        list($year, $month, $day) = explode('-', $row['birthdate']);
        echo '<tr><td class="label">Год рождения:</td><td>' . $year . '</td></tr>';
      }
    }
    if (!empty($row['city']) || !empty($row['state'])) {
      echo '<tr><td class="label">Местоположение:</td><td>' . $row['city'] . ', ' . $row['state'] . '</td></tr>';
    }
    if (!empty($row['picture'])) {
      echo '<tr><td class="label">Фото:</td><td><img src="' . MM_UPLOADPATH . $row['picture'] .
        '" alt="Profile Picture" /></td></tr>';
    }
    echo '</table>';
    if (!isset($_GET['user_id']) || ($_SESSION['user_id'] == $_GET['user_id'])) {
      echo '<p>Не хотите ли вы <a href="editprofile.php">редактировать профиль</a>?</p>';
    }
  } // Конец проверки для одной строки результатов пользователя
  else {
    echo '<p class="error">Была проблема с доступом к вашему профилю.</p>';
  }

  mysqli_close($dbc);
?>
<?php
    //Футер
    require_once('footer.php');
?>

