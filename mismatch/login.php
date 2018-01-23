<?php
    //соединение с базой
  require_once('connectvars.php');

  //Старт сессии
  session_start();

  // Обнуление сообщения об ошибке
  $error_msg = "";

  //Если пользователь еще не вошел в приложени, попытка войти
  if (!isset($_SESSION['user_id'])) {
    if (isset($_POST['submit'])) {

      // Получение введенных данных пользователем для аутентификации
      $user_username = mysqli_real_escape_string($dbc, trim($_POST['username']));
      $user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));

      if (!empty($user_username) && !empty($user_password)) {
        // Поиск имени пользователя и его пароля в базе данных
        $query = "SELECT user_id, username FROM mismatch_user WHERE username = '$user_username' AND password = SHA('$user_password')";
        $data = mysqli_query($dbc, $query);

        if (mysqli_num_rows($data) == 1) {
          // Вход в приложение прошел успешно, присваиваем значение идентификатора и его имени переменным сессии (и куки) и переадресуем на главную
          $row = mysqli_fetch_array($data);
          $_SESSION['user_id'] = $row['user_id'];
          $_SESSION['username'] = $row['username'];
          setcookie('user_id', $row['user_id'], time() + (60 * 60 * 24 * 30));   // срок действия истекает через 30 дней
          setcookie('username', $row['username'], time() + (60 * 60 * 24 * 30));  // срок действия истекает через 30 дней
          $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
          header('Location: ' . $home_url);
        }
        else {
          // Имя пользователя/пароль введены не верно, создание сообщения об ошибке
          $error_msg = 'Извините, чтобы войти, нужны правильные логин и пароль.';
        }
      }
      else {
        // Имя пользователя/пароль не введены, создание сообщения об ошибке
        $error_msg = 'Извините, чтобы войти, нужны ввести логин и пароль.';
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Вход в приложение</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <h3>Вход в приложение</h3>

<?php
  // Если сеанс пуст, покажите любое сообщение об ошибке и форму входа в систему; в противном случае подтвердите вход в систему
  if (empty($_SESSION['user_id'])) {
    echo '<p class="error">' . $error_msg . '</p>';
?>

  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
      <legend>Вход в приложение</legend>
      <label for="username">Имя:</label>
      <input type="text" name="username" value="<?php if (!empty($user_username)) echo $user_username; ?>" /><br />
      <label for="password">Пароль:</label>
      <input type="password" name="password" />
    </fieldset>
    <input type="submit" value="Войти" name="submit" />
  </form>

<?php
  }
  else {
    // Подтверждение успешного входа
    echo('<p class="login">Вы вошли в приложение как ' . $_SESSION['username'] . '.</p>');
  }
?>
<?php
    //Футер
    require_once('footer.php');
?>

