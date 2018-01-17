<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8" />
  <title>Сообщение о похищении</title>
</head>
<body>
  <h2>Космические пришельцы похищали меня.</h2>

<?php
  //Сбор данных с формы
  $first_name = $_POST['firstname'];
  $last_name = $_POST['lastname'];
  $when_it_happened = $_POST['whenithappened'];
  $how_long = $_POST['howlong'];
  $how_many = $_POST['howmany'];
  $alien_description = $_POST['aliendescription'];
  $what_they_did = $_POST['whattheydid'];
  $fang_spotted = $_POST['fangspotted'];
  $other = $_POST['other'];
  $email = $_POST['email'];
  
  //Соединение с БД
  $dbc = mysqli_connect('localhost', 'root', 'root', 'book_php_mysql')
  or die ('Ошибка соединения с MySQL сервером.');

  // Отправка на почту
  // $to = 'vl_che@bk.ru';
  // $subject = 'Космические пришельцы почищали меня - Сообщение о похищении';
  // $msg = "$name был похищен $when_it_happened и отсутствовал в течении $how_long.\n" .
  //   "Количество пришельцев: $how_many\n" .
  //   "Описание пришельцев: $alien_description\n" .
  //   "Что они делали: $what_they_did\n" .
  //   "Фэнг замечен?: $fang_spotted\n" .
  //   "Дополнительная информация: $other";
  // mail($to, $subject, $msg, 'From:' . $email);

  //Составление строки запроса
  $query = "INSERT INTO table_book (first_name, last_name, when_it_happened, how_long, how_many, alien_description, what_they_did, fang_spotted, other, email) " .
  "VALUES ('$first_name', '$last_name', '$when_it_happened', '$how_long', '$how_many', '$alien_description', '$what_they_did', '$fang_spotted', '$other', '$email') ";

  //Выполнение запроса
  $result = mysqli_query($dbc, $query)
  or die ('Ошибка соединенияпри выполнении запроса.');

  //Закрытие соединения с базой
  mysqli_close($dbc);


  echo 'Спасибо за заполнение формы.<br />';
  echo 'Вы были похищены ' . $when_it_happened;
  echo ' и отсутствовали в течении ' . $how_long . '<br />';
  echo 'Сколько их было: ' . $how_many . '<br />';
  echo 'Опишите их: ' . $alien_description . '<br />';
  echo 'Что они делали: ' . $what_they_did . '<br />';
  echo 'Видели ли Фэнга? ' . $fang_spotted . '<br />';
  echo 'Дополнительная информация: ' . $other . '<br />';
  echo 'Ваш email адрес ' . $email;
?>

</body>
</html>
