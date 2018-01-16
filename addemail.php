<?php
    //Подключаемся к базе
    require_once 'dbc.php';
    //Собираем данные
    $first_name = $_POST['firstname'];
    $last_name =  $_POST['lastname'];
    $email =      $_POST['email'];
    //Запрос
    $query = "INSERT INTO email_list(first_name, last_name, email)" .
    "VALUES ('$first_name', '$last_name', '$email')";

    mysqli_query($dbc, $query)
    or die ('Ошибка выполнения запроса к базе данных');
    //Вывод после удачного запроса
    echo '<h2 style="text-align: center; padding: 20px; margin-top:30px;">Спасибо! Данные добавлены. </h2>';
    //Закрываем соединение с базой
    mysqli_close ($dbc);

?>