<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8" />
  <title>Пришельцы Похитили Меня</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <h2>Пришельцы Похитили Меня</h2>
  <p>Добро пожаловать, у вас была встреча с инопланетянами? Тебя похитили? Ты видел мою похищенную собаку, Клыка? <a href="report.php">Сообщи об этом здесь!</a></p>

<?php
    //Соединение с БД
    require_once('connectvars.php');


  // See if we're viewing a single report or all of the most recent reports
  if (isset($_GET['abduction_id'])) {
    $query = "SELECT * FROM table_book WHERE abduction_id = '" . $_GET['abduction_id'] . "'";
  }
  else {
    $query = "SELECT * FROM table_book ORDER BY when_it_happened DESC LIMIT 5";
  }
  $data = mysqli_query($dbc, $query);

  if (mysqli_num_rows($data) == 1) {
    // Показать детали для этого одиночного похищения
    $row = mysqli_fetch_array($data);
    echo '<p><strong>Имя: </strong>' . $row['first_name'] . ' ' . $row['last_name'] . '<br />';
    echo '<strong>Дата:</strong> ' . $row['when_it_happened'] . '<br />';
    echo '<strong>Email:</strong> ' . $row['email'] . '<br />';
    echo '<strong>Отсутствовали в течении:</strong> ' . $row['how_long'] . '<br />';
    echo '<strong>Сколько их было:</strong> ' . $row['how_many'] . '<br />';
    echo '<strong>Опишите их:</strong> ' . $row['alien_description'] . '<br />';
    echo '<strong>Что они делали:</strong> ' . $row['what_they_did'] . '<br />';
    echo '<strong>Дополнительная информация:</strong> ' . $row['other'] . '<br />';
    echo '<strong>Видели ли Фэнга?</strong> ' . $row['fang_spotted'] . '</p>';
    echo '<p><a href="index.php">&lt;&lt; Вернуться на главную</a></p>';
  }
  else {
    echo '<h4>Последние сообщения о похищениях:</h4>';

    // выводим как HTML
    echo '<table width="100%">';
    while ($row = mysqli_fetch_array($data)) { 
      // Отображать каждую строку в виде строки таблицы
      echo '<tr class="heading"><td colspan="3"><a href="index.php?abduction_id=' . $row['abduction_id'] . '">' . $row['when_it_happened'] . ' : ' . $row['first_name'] . ' ' . $row['last_name'] . '</a></td></tr>';
      echo '<tr><td><strong>Отсутствовали в течении:</strong><br /> ' . $row['how_long'];
      echo '<td><strong>Опишите их:</strong><br /> ' . $row['alien_description'];
      echo '<td><strong>Видели ли Клыка?</strong><br /> ' . $row['fang_spotted'] . '</td></tr>';
    }
    echo '</table>';

    echo '<p><a href="newsfeed.php"><img style="vertical-align:top; border:none" src="rssicon.png" alt="Syndicate alien abductions" /> Щелкните для подписки на ленту новостей похищения.</a></p>';
  }

  mysqli_close($dbc);
?>

</body> 
</html>
