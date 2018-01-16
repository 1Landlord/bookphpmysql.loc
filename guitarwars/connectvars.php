<?php

    //Инициализация констант для соединения с базой данных
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD', 'root');
    define('DB_NAME', 'book_php_mysql');

    $dbc = mysqli_connect('DB_HOST', 'DB_USER', 'DB_PASSWORD', 'DB_NAME');

?>
