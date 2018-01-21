<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Mismatch - Регистрация</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <h3>Несоответствия - Регистрация</h3>

<?php
  require_once('appvars.php');
  require_once('connectvars.php');


  if (isset($_POST['submit'])) {
    // Извлечение данных профиля из массива POST
    $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
    $password1 = mysqli_real_escape_string($dbc, trim($_POST['password1']));
    $password2 = mysqli_real_escape_string($dbc, trim($_POST['password2']));

    if (!empty($username) && !empty($password1) && !empty($password2) && ($password1 == $password2)) {
      // Проверка нет ли такого же имени в базе как и ввел новый пользователь
      $query = "SELECT * FROM mismatch_user WHERE username = '$username'";
      $data = mysqli_query($dbc, $query);
      if (mysqli_num_rows($data) == 0) {
        // Имя, которое ввел новый пользователь не используется, поэтому добавляем данные в базу
        $query = "INSERT INTO mismatch_user (username, password, join_date) VALUES ('$username', SHA('$password1'), NOW())";
        mysqli_query($dbc, $query);

        // Вывод подтверждения пользователю
        echo '<p>Ваша учетная запись успешно создана. Вы можете войти в приложение и <a href="editprofile.php">отредактировать свой профиль</a>.</p>';

        mysqli_close($dbc);
        exit();
      }
      else {
        // Учетная запись с таким именем существует
        echo '<p class="error">Учетная запись с таким именем существует. Введите пожалуйста другое имя.</p>';
        $username = "";
      }
    }
    else {
      echo '<p class="error">Вы должны ввести все данные, в том числе и пароль дважды.</p>';
    }
  }

  mysqli_close($dbc);
?>

  <p>Введите, пожалуйста, ваше имя и пароль для создания учетной записи в приложении &quot;Несоответствия&quot;.</p>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
      <legend>Входные данные</legend>
      <label for="username">Имя:</label>
      <input type="text" id="username" name="username" value="<?php if (!empty($username)) echo $username; ?>" /><br />
      <label for="password1">Пароль:</label>
      <input type="password" id="password1" name="password1" /><br />
      <label for="password2">Повторите пароль:</label>
      <input type="password" id="password2" name="password2" /><br />
    </fieldset>
    <input type="submit" value="Создать" name="submit" />
  </form>
</body> 
</html>
