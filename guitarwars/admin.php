<?php>
//Имя пользователя и его пароль для аутентификации
$username = 'razrab';
$password = '55555';
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
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>Adminca</title>
</head>
<body>
    <p><a href="index.php">К рейтингу</a></p>
    <?php
        //Инициализация констант
        require_once('appvars.php');
        //Cоединения с базой данных
        require_once('connectvars.php');

        //запрос извлечения данных, в порядке убывания score (score DESC)
        $query = "SELECT * FROM guitarwars ORDER BY score DESC, date ASC";
        $data = mysqli_query($dbc, $query);

        // Извлечение данных из массива в цикле. Формирование данных записей в виде кода HTML 
        echo '<table>';
        while ($row = mysqli_fetch_array($data)) { 
            // Вывод данных рейтинга
            echo '<tr class="scorerow"><td><strong>' . $row['name'] . '</strong></td>';
            echo '<td>' . $row['date'] . '</td>';
            echo '<td>' . $row['score'] . '</td>';
            //GET запрос через url на удаление из таблицы с помощью removescore.php
            echo '<td><a href="removescore.php?id=' . $row['id'] .
            '&amp;date=' . $row['date'] .
            '&amp;name=' . $row['name'] . 
            '&amp;score=' . $row['score'] .
            '&amp;screenshot=' . $row['screenshot'] . 
            '">Удалить</a></td></tr>';
        }
        echo '</table>';

        mysqli_close($dbc);
    ?>
</body>
</html>



