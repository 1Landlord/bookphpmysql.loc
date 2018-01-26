<?php
  // Старт сессии
  require_once('startsession.php');

  // Вывод заголовка страницы
  $page_title = 'Анкета';
  require_once('header.php');

  require_once('appvars.php');
  require_once('connectvars.php');

  // Прежде чем продолжать необходимо проверить, вошел ли пользователь в приложение.
  if (!isset($_SESSION['user_id'])) {
    echo '<p class="login">Пожалуйста, <a href="login.php">log in</a> войдите в приложение.</p>';
    exit();
  }

  // Вывод навигации
  require_once('navmenu.php');

  // Если пользователь еще невводил ни одного признака несоответствия в анкету, добавление в таблицу базы данных записей с пустыми значениями признаков несоответствия
  $query = "SELECT * FROM mismatch_response WHERE user_id = '" . $_SESSION['user_id'] . "'";
  $data = mysqli_query($dbc, $query);
  if (mysqli_num_rows($data) == 0) {
    // Вначале извлечение списка идентификаторов признаков несоответствия из таблицы mismatch_topic
    $query = "SELECT topic_id FROM mismatch_topic ORDER BY category, topic_id";
    $data = mysqli_query($dbc, $query);
    $topicIDs = array();
    while ($row = mysqli_fetch_array($data)) {
      array_push($topicIDs, $row['topic_id']);
    }

    // Добавление записей с пустыми значениями признаков несоответствия в таблицу mismatch_response
    foreach ($topicIDs as $topic_id) {
      $query = "INSERT INTO mismatch_response (user_id, topic_id) VALUES ('" . $_SESSION['user_id']. "', '$topic_id')";
      mysqli_query($dbc, $query);
    }
  }

  // Если форма Анкета отправлена на сервер для обработки, обновление признаков несоответствия в таблице mismatch_response 
  if (isset($_POST['submit'])) {
    // Обновление признаков несоответствия в таблице mismatch_response
    foreach ($_POST as $response_id => $response) {
      $query = "UPDATE mismatch_response SET response = '$response' WHERE response_id = '$response_id'";
      mysqli_query($dbc, $query);
    }
    echo '<p>Ваши признаки несоответствия сохранены.</p>';
  }

  // Извлечение данных признаков несоответствия из базы для создания формы
  $query = "SELECT response_id, topic_id, response FROM mismatch_response WHERE user_id = '" . $_SESSION['user_id'] . "'";
  $data = mysqli_query($dbc, $query);
  $responses = array();
  while ($row = mysqli_fetch_array($data)) {
    // Поиск имен признаков несоответствия в таблице mismatch_topic для создания формы
    $query2 = "SELECT name, category FROM mismatch_topic WHERE topic_id = '" . $row['topic_id'] . "'";
    $data2 = mysqli_query($dbc, $query2);
    if (mysqli_num_rows($data2) == 1) {
      $row2 = mysqli_fetch_array($data2);
      $row['topic_name'] = $row2['name'];
      $row['category_name'] = $row2['category'];
      array_push($responses, $row);
    }
  }

  mysqli_close($dbc);

  // Создание формы Анкета путем прохождения в цикле
  echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '">';
  echo '<p>Что вы чувствуете по каждому признаку несоответствия?</p>';
  $category = $responses[0]['category_name'];
  echo '<fieldset><legend>' . $responses[0]['category_name'] . '</legend>';
  foreach ($responses as $response) {
    // Начните новую группу признаков несоответствия только в том случае, если изменилась категория, к которой они относятся
    if ($category != $response['category_name']) {
      $category = $response['category_name'];
      echo '</fieldset><fieldset><legend>' . $response['category_name'] . '</legend>';
    }

    // Вывод кнопок с зависимой фиксацией для выбора признаков несоответствия
    echo '<label ' . ($response['response'] == NULL ? 'class="error"' : '') . ' for="' . $response['response_id'] . '">' . $response['topic_name'] . ':</label>';
    echo '<input type="radio" id="' . $response['response_id'] . '" name="' . $response['response_id'] . '" value="1" ' . ($response['response'] == 1 ? 'checked="checked"' : '') . ' />Предпочтение ';
    echo '<input type="radio" id="' . $response['response_id'] . '" name="' . $response['response_id'] . '" value="2" ' . ($response['response'] == 2 ? 'checked="checked"' : '') . ' />Отрицание<br />';
  }
  echo '</fieldset>';
  echo '<input type="submit" value="Сохранение анкеты" name="submit" />';
  echo '</form>';

  //Футер
  require_once('footer.php');
?>
