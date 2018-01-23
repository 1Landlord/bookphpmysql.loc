<?php
    // Если пользователь вошел в приложение, удаление переменных сессии, приводящее к выходу его из приложения
    //Старт сессии
    session_start();
    if (isset($_SESSION['user_id'])) {
    // Удаление переменных сессии путем обнуления суперглобального массива $_SESSION
    $_SESSION = array();
    // Удаление куки, содержащего id сессии, установка истечения срока куки на час (- 3600)
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 3600);
      }
    // Закрытие сессии
    session_destroy(); 
  }
  //Удаляем куки 
  setcookie('user_id', '', time() - 3600);
  setcookie('username', '', time() - 3600);

  // Переадресация на главную страницу
  $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
  header('Location: ' . $home_url);
?>