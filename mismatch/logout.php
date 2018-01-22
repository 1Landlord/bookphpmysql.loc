<?php
  // Если пользователь вошел в приложение, удаление куки, приводящее к выходу его из приложения
  if (isset($_COOKIE['user_id'])) {
    // Установка момента истечения куки, содержащих id пользователя и его имя. В результате эти куки удаляются
    setcookie('user_id', '', time() - 3600);
    setcookie('username', '', time() - 3600);
  }

  // Переадресация на главную страницу
  $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
  header('Location: ' . $home_url);
?>