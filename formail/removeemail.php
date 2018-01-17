<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>Удаление подписчиков</title>
</head>
<body>
    <div class="wrap_form">
        <h3>Выберите адреса почты, которые хотите удалить из листа рассылки.</h3>

        <!--Форма ссылается сама на себя-->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?> ">

            <?php
                //Подключаемся к базе
                require_once 'dbc.php';

                //Удаление записей (только в том случае, если форма была отправлена на сервер)
                if (isset($_POST['submit'])) {
                    foreach ($_POST['todelete'] as $delete_id) {
                        $query ="DELETE FROM email_list WHERE id = $delete_id";
                        mysqli_query($dbc, $query)
                        or die('Ошибка запроса к базе данных');
                    }
                    echo 'Покупатель(ли) удален(ы). <br />';
                }
                //Ввод записей вместе с кнопками с независимой фиксацией для отметки удаления
                $query = "SELECT * FROM email_list";
                $result = mysqli_query($dbc, $query);
                while ($row = mysqli_fetch_array($result)) {
                    echo '<input type="checkbox" value="' .$row['id'] . '" name="todelete[]" />';
                    echo $row['first_name'];
                    echo ' ' . $row['last_name'];
                    echo ' ' . $row['email'];
                    echo '<br />';
                }
                //Закрываем соединение с базой
                mysqli_close($dbc);
            ?>
                <input type="submit" value="Удалить" name="submit" />
        </form>
    </div>
</body>
</html>




    <!-- //Собираем данные
    $email = $_POST['email'];
    //Запрос
    $query = "DELETE FROM email_list WHERE email = '$email' ";
    mysqli_query($dbc, $query)
    or die('Ошибка при выполнении запроса к базе данных.');
    //Вывод после удачного запроса
    echo '<h3 style="text-align:center; padding: 20px; margin-top:30px;">Удалена запись: '. $email .'</h3>';
    //Закрываем соединение с базой
    mysqli_close($dbc); -->
