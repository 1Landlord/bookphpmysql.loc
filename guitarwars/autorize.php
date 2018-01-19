<?php>
//Имя пользователя и его пароль для аутентификации
$username = 'razrab';
$password = '12345';
if (!isset($_SERVER['PHP_AUTH_USER']) ||
!isset($_SERVER['PHP_AUTH_PW']) ||
($_SERVER['PHP_AUTH_USER'] != $username) ||
($_SERVER['PHP_AUTH_PW'] != $password)) {
    //Имя пользователя/пароль не действительны для отправки HTTP-заголовков, подтверждающих аутентификацию
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Basic realm = "Гитарные войны"');
    exit('<h2>Гитарные войны</h2>Вы, ввели неправильный логин и пароль.');
}
?>