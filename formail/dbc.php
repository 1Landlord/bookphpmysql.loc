<?php
    //Подключаемся к базе
    $dbc = mysqli_connect('localhost', 'root', 'root', 'book_php_mysql');

    if(mysqli_connect_errno()) {
        echo 'Ошибка соединения с MySQL серверром ('. mysqli_connect_errno() .'): '. mysqli_connect_error();
        exit();
    }
?>