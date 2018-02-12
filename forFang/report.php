<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" type="text/css" href="style.css" />
  <title>Сообщение о похищении</title>
</head>
<body>
  <h2>Космические пришельцы похищали меня.</h2>

<?php
  require_once('connectvars.php');

  if (isset($_POST['submit'])) {
    

    // //Сбор данных с формы
    $first_name = mysqli_real_escape_string($dbc, trim($_POST['firstname']));
    $last_name = mysqli_real_escape_string($dbc, trim($_POST['lastname']));
    $email = mysqli_real_escape_string($dbc, trim($_POST['email']));
    $when_it_happened = mysqli_real_escape_string($dbc, trim($_POST['whenithappened']));
    $how_long = mysqli_real_escape_string($dbc, trim($_POST['howlong']));
    $how_many = mysqli_real_escape_string($dbc, trim($_POST['howmany']));
    $alien_description = mysqli_real_escape_string($dbc, trim($_POST['aliendescription']));
    $what_they_did = mysqli_real_escape_string($dbc, trim($_POST['whattheydid']));
    $fang_spotted = mysqli_real_escape_string($dbc, trim($_POST['fangspotted']));
    $other = mysqli_real_escape_string($dbc, trim($_POST['other']));

    if (!empty($first_name) && !empty($last_name) && !empty($when_it_happened) && !empty($how_long) && !empty($what_they_did)) {
      // Запись данных в базу данных
      $query = "INSERT INTO table_book (first_name, last_name, email, when_it_happened, how_long, how_many, alien_description, what_they_did, fang_spotted, other) " .
        "VALUES ('$first_name', '$last_name', '$email', '$when_it_happened', '$how_long', '$how_many', '$alien_description', '$what_they_did', '$fang_spotted', '$other')";
      mysqli_query($dbc, $query);

      // Подтверждение успеха с пользователем
      echo '<p>Спасибо, что добавил свое похищение.</p>';
      echo '<p><a href="index.php">&lt;&lt; Вернуться на главную страницу</a></p>';

      mysqli_close($dbc);
      exit();
    }
    else {
      echo '<p class="error">Пожалуйста, введите ваше полное имя, дату похищения, как долго вы отсутствовали, и краткое описание инопланетян.</p>';
    }
  }
?>

  <p>Поделитесь своей историей похищения пришельцев:</p>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="firstname">Имя:</label>
    <input type="text" id="firstname" name="firstname" value="<?php if (!empty($first_name)) echo $first_name; ?>" /> <br />
    <label for="lastname">Фамилия:</label>
    <input type="text" id="lastname" name="lastname" value="<?php if (!empty($first_name)) echo $last_name; ?>" /><br />
    <label for="email">Ваш адрес почты?</label>
    <input type="text" id="email" name="email" value="<?php if (!empty($email)) echo $email; ?>" /><br />
    <label for="whenithappened">Когда это произошло?</label>
    <input type="text" id="whenithappened" name="whenithappened" value="<?php if (!empty($when_it_happened)) echo $when_it_happened; else echo 'YYYY-MM-DD'; ?>" /><br />
    <label for="howlong">Как долго тебя не было?</label>
    <input type="text" id="howlong" name="howlong" value="<?php if (!empty($how_long)) echo $how_long; ?>" /><br />
    <label for="howmany">Сколько их было?</label>
    <input type="text" id="howmany" name="howmany" value="<?php if (!empty($how_many)) echo $how_many; ?>" /><br />
    <label for="aliendescription">Опишите их:</label>
    <input type="text" id="aliendescription" name="aliendescription" size="32" value="<?php if (!empty($alien_description)) echo $alien_description; ?>" /><br />
    <label for="whattheydid">Что они с тобой сделали?</label>
    <input type="text" id="whattheydid" name="whattheydid" size="32" value="<?php if (!empty($what_they_did)) echo $what_they_did; ?>" /><br />
    <label for="fangspotted">Вы не видели мою собаку Клыка?</label>
    Да <input id="fangspotted" name="fangspotted" type="radio" value="yes" <?php echo ($fang_spotted == 'yes' ? 'checked="checked"' : ''); ?> />
    Нет <input id="fangspotted" name="fangspotted" type="radio" value="no"  <?php echo ($fang_spotted == 'no' ? 'checked="checked"' : ''); ?> /><br />
    <img src="fang.jpg" width="100" height="175" alt="My abducted dog Fang." /><br />
    <label for="other">Что-нибудь еще хочешь добавить?</label>
    <textarea id="other" name="other"><?php if (!empty($other)) echo $other; ?></textarea><br />
    <input type="submit" value="Сообщить о похищении" name="submit" />
  </form>
</body>
</html>


