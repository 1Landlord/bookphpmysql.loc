<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Рискованная работа - Регистрация</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <img src="riskyjobs_title.gif" alt="Risky Jobs" />
  <img src="riskyjobs_fireman.jpg" alt="Risky Jobs" style="float:right" />
  <h3>Рискованная работа - Регистрация</h3>

<?php
  if (isset($_POST['submit'])) {
    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $job = $_POST['job'];
    $resume = $_POST['resume'];
    $output_form = 'no';

    if (empty($first_name)) {
      // $first_name не определена
      echo '<p class="error">Вы забыли ввести свое имя.</p>';
      $output_form = 'yes';
    }

    if (empty($last_name)) {
      // $last_name не определена
      echo '<p class="error">Вы забыли ввести свою фамилию.</p>';
      $output_form = 'yes';
    }

    if (!preg_match('/^[a-zA-Z0-9][a-zA-Z0-9\._\-&!?=#]*@/', $email)) {
      // значение переменной $email не соответствует регулярному выражению
      echo '<p class="error">Вы ввели не правильный адрес почты.</p>';
      $output_form = 'yes';
    }
    else {
      // удаление из адреса всего кроме имени домена, т.е. части после @ 
      $domain = preg_replace('/^[a-zA-Z0-9][a-zA-Z0-9\._\-&!?=#]*@/', '', $email);
      // теперь проверка того, зарегистрирован домен с таким именем или нет
      if (!checkdnsrr($domain)) {
         echo '<p class="error">Вы ввели не правильный адрес почты.</p>';
         $output_form = 'yes';
      }
     }
    // этому регулярному выражению соответствуют ###-###-####, ### ###-####, (###)-##-####, (###) ###-####
    if (!preg_match('/^\(?[2-9]\d{2}\)?[-\s]\d{3}-\d{4}$/', $phone)) {
      // $phone is not valid
      echo '<p class="error">Вы забыли ввести номер своего телефона.</p>';
      $output_form = 'yes';
    }

    if (empty($job)) {
      // $job is blank
      echo '<p class="error">Вы забыли ввести желаемую работу.</p>';
      $output_form = 'yes';
    }

    if (empty($resume)) {
      // $resume is blank
      echo '<p class="error">Вы забыли ввести свое резюме.</p>';
      $output_form = 'yes';
    }
  }
  else {
    $output_form = 'yes';
  }

  if ($output_form == 'yes') {
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
   <p>Зарегистрируйтесь с рискованных работах, и разместите свое резюме.</p>
  <table>
    <tr>
      <td><label for="firstname">Имя:</label></td>
      <td><input id="firstname" name="firstname" type="text" value="<?php echo $first_name; ?>"/></td></tr>
    <tr>
      <td><label for="lastname">Фамилия:</label></td>
      <td><input id="lastname" name="lastname" type="text" value="<?php echo $last_name; ?>"/></td></tr>
    <tr>
      <td><label for="email">Email:</label></td>
      <td><input id="email" name="email" type="text" value="<?php echo $email; ?>"/></td></tr>
    <tr>
      <td><label for="phone">Телефон:</label></td>
      <td><input id="phone" name="phone" type="text" value="<?php echo $phone; ?>"/></td></tr>
    <tr>
      <td><label for="job">Желаемая работа:</label></td>
      <td><input id="job" name="job" type="text" value="<?php echo $job; ?>"/></td>
  </tr>
  </table>
  <p>
    <label for="resume">Напишите здесь ваше резюме:</label><br />
    <textarea id="resume" name="resume" rows="4" cols="40"><?php echo $resume; ?></textarea><br />
    <input type="submit" name="submit" value="Найти" />
  </p>
</form>

<?php
  }
  else if ($output_form == 'no') {
    echo '<p>' . $first_name . ' ' . $last_name . ', спасибо за регистрацию в рискованная работа!<br />';
    $pattern = '/[\(\)\-\s]/';
    $replacement = '';
    $new_phone = preg_replace($pattern, $replacement, $phone);
    echo 'Ваш номер телефона зарегистрирован как ' . $new_phone . '.</p>';

    // code to insert data into the RiskyJobs database...
  }
?>

</body>
</html>
