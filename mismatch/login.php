<?php
  require_once('connectvars.php');

  if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
    // Имя пользователя и/или пароль не были введены,поэтому отправляются заголовки аутентификации
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Basic realm="Mismatch"');
    exit('<h3>Несоответствия</h3>Вы должны ввести ваше Имя и пароль для того, ' .
      'чтобы получить доступ к приложению. <a href="signup.php">Войти</a>.');
  }

  
  // Получение введенных данных пользователем для аутентификации
  $user_username = mysqli_real_escape_string($dbc, trim($_SERVER['PHP_AUTH_USER']));
  $user_password = mysqli_real_escape_string($dbc, trim($_SERVER['PHP_AUTH_PW']));

  // Поиск имени пользователя и его пароля в базе данных 
  $query = "SELECT user_id, username FROM mismatch_user WHERE username = '$user_username' AND password = SHA('$user_password')";
  $data = mysqli_query($dbc, $query);

  if (mysqli_num_rows($data) == 1) {
    // Процерура прошла нормально, присваиваем переменным значения идентификатора пользователя и его пароля
    $row = mysqli_fetch_array($data);
    $user_id = $row['user_id'];
    $username = $row['username'];
  }
  else {
    // Имя пользователя/пароль введены не верно, поэтому отправляются заголовки аутентификации
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Basic realm="Mismatch"');
    exit('<h2>Несоответствия</h2>Вы должны ввести ваше Имя и пароль для того, ' .
      'чтобы получить доступ к приложению. <a href="signup.php">sign up</a>.');
  }

  // Подтверждение успешного входа
  echo('<p class="login">Вы вошли в приложение как ' . $username . '.</p>');
?>
