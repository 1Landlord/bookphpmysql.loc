<?php
require_once('autorize.php');
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
            '&amp;screenshot=' . $row['screenshot'] . '">Удалить</a>';
            if ($row['approved'] == '0') {
                echo ' / <a href="approvescore.php?id=' . $row['id'] . '&amp;date=' . $row['date'] .
                  '&amp;name=' . $row['name'] . '&amp;score=' . $row['score'] . '&amp;screenshot=' .
                  $row['screenshot'] . '">Санкционировать</a>';
            }
            echo '</td></tr>';
        }
        echo '</table>';

        mysqli_close($dbc);
    ?>
</body>
</html>



