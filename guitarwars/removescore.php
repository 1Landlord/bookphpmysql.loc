<?php
require_once('autorize.php');
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Удаление рейтинга</title>
</head>
<body>
<h2>Удаление рейтинга</h2>

<?php
    //Инициализация констант
    require_once('appvars.php');

    if (isset($_GET['id']) && isset($_GET['date']) && isset($_GET['name']) && isset($_GET['score']) && isset($_GET['screenshot'])) {
        // Извлечение данных из суперглобального массива GET
        $id = $_GET['id'];
        $date = $_GET['date'];
        $name = $_GET['name'];
        $score = $_GET['score'];
        $screenshot = $_GET['screenshot'];
    }
    else if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['score'])) {
        // Извлечение данных из суперглобального массива POST
        $id = $_POST['id'];
        $name = $_POST['name'];
        $score = $_POST['score'];
    }
    else {
        echo '<p class="error">Извините, ни одного рейтинга не выбрано для удаления.</p>';
    }

    if (isset($_POST['submit'])) {
        if ($_POST['confirm'] == 'Yes') {
        // Удаление с сервера файла изображений подтверждающего рейтинг
        @unlink(GW_UPLOADPATH . $screenshot);

        //Cоединения с базой данных
        require_once('connectvars.php');

        // Удаление рейтинга из базы данных
        $query = "DELETE FROM guitarwars WHERE id = $id LIMIT 1";
        mysqli_query($dbc, $query);
        mysqli_close($dbc);

        // Вывод пользователю страницы подтверждения
        echo '<p>Рейтинг со значением ' . $score . ' для пользователя ' . $name . ' был успешно удален.';
        }
        else {
        echo '<p class="error">Рейтинг не удален.</p>';
        }
    }
    else if (isset($id) && isset($name) && isset($date) && isset($score)) {
        echo '<p>Вы уверены, что хотите удалить этот рейтинг?</p>';
        echo '<p><strong>Имя: </strong>' . $name . '<br /><strong>Дата: </strong>' . $date .
        '<br /><strong>Рейтинг: </strong>' . $score . '</p>';
        echo '<form method="post" action="removescore.php">';
        echo '<input type="radio" name="confirm" value="Yes" /> Да ';
        echo '<input type="radio" name="confirm" value="No" checked="checked" /> Нет <br />';
        echo '<input type="submit" value="Удалить" name="submit" />';
        echo '<input type="hidden" name="id" value="' . $id . '" />';
        echo '<input type="hidden" name="name" value="' . $name . '" />';
        echo '<input type="hidden" name="score" value="' . $score . '" />';
        echo '</form>';
    }

    echo '<p><a href="admin.php">&lt;&lt; Назад к списку рейтингов</a></p>';
    ?>
</body>
</html>