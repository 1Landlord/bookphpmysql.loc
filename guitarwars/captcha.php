<?php
  session_start();

  // CAPTCHA константы
  define('CAPTCHA_NUMCHARS', 6);  // длина фразы
  define('CAPTCHA_WIDTH', 100);   // ширина фото
  define('CAPTCHA_HEIGHT', 25);   // высота фото

  // Создание идентификационной фразы, состоящей из шести случайных букв
  $pass_phrase = "";
  for ($i = 0; $i < CAPTCHA_NUMCHARS; $i++) {
    $pass_phrase .= chr(rand(97, 122));
  }

  // сохранение идентификационной фразы в переменной сессии в зашифрованном виде
  $_SESSION['pass_phrase'] = sha1($pass_phrase);

  // Создание изображения
  $img = imagecreatetruecolor(CAPTCHA_WIDTH, CAPTCHA_HEIGHT);

  // установка цветов: белый фон, черный текст, серый графика
  $bg_color = imagecolorallocate($img, 255, 255, 255);     // white
  $text_color = imagecolorallocate($img, 0, 0, 0);         // black
  $graphic_color = imagecolorallocate($img, 64, 64, 64);   // dark gray

  // заполнение фона
  imagefilledrectangle($img, 0, 0, CAPTCHA_WIDTH, CAPTCHA_HEIGHT, $bg_color);

  // рисование нескольких линий, расположенных случайным образом
  for ($i = 0; $i < 5; $i++) {
    imageline($img, 0, rand() % CAPTCHA_HEIGHT, CAPTCHA_WIDTH, rand() % CAPTCHA_HEIGHT, $graphic_color);
  }

  // рисование нескольких точек, расположенных случайным образом
  for ($i = 0; $i < 50; $i++) {
    imagesetpixel($img, rand() % CAPTCHA_WIDTH, rand() % CAPTCHA_HEIGHT, $graphic_color);
  }

  // написание текста идентификационной фразы
  imagettftext($img, 18, 0, 5, CAPTCHA_HEIGHT - 5, $text_color, 'Courier New Bold.ttf', $pass_phrase);

  // вывод изображения в png с использованием  заголовка
  header("Content-type: image/png");
  imagepng($img);

  // удаление изображения
  imagedestroy($img);
?>
