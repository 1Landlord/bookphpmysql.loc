<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>Document</title>
</head>
<body>
    <div class="wrap_form">
        <?php
            //Собираем данные
            if (isset($_POST['submit'])) {
                $from = 'vl_che@bk.ru';
                $subject = $_POST['subject'];
                $text = $_POST['elvismail'];
                $output_form = false;

                //Проверка на пустые поля
                if (empty($subject) && empty($text)) {
                    echo 'Вы забыли ввести тему письма и сообщение. <br />';
                    $output_form = true;
                }
                if (empty($subject) && (!empty($text))) {
                    echo 'Вы забыли ввести тему письма. <br />';
                    $output_form = true;
                }
                if ((!empty($subject)) && empty($text)) {
                    echo 'Вы забыли ввести тему письма. <br />';
                    $output_form = true;
                }
                if ((!empty($subject)) && (!empty($text))) {
                    //Подключаемся к базе
                    require_once 'dbc.php';
                    //Запрос
                    $query = "SELECT * FROM email_list";
                    $result= mysqli_query($dbc, $query)
                        or die('Ошибка при выполнении запроса к базе данных.');
                    
                    while ($row = mysqli_fetch_array($result)) {
                        $first_name = $row['first_name'];
                        $last_name =  $row['last_name'];
                        //Сообщение 
                        $msg = "Уважаемый $first_name $last_name, \n $text";
                        $to =   $row['email'];
                        mail($to, $subject, $msg, 'From:' . $from);
                        echo 'Электронное письмо отправлено: ' . $to . '<br />';
                    }
                    //Закрываем соединение с базой
                    mysqli_close($dbc);
                }
            }else {
                $output_form = true;
            }
            if ($output_form) {
        ?>

            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <label for="subject">Тема электронного письма:</label>
                <input type="text" id="subject" name="subject" value="<?php echo $subject; ?>" />
                <br />
                <label for="elvismail">Содержание эл. письма:</label>
                <textarea type="text" id="elvismail" name="elvismail" rows="8" cols="50" value="<?php echo $text; ?>"></textarea>
                <br />
                <input type="submit" value="Отправить" name="submit" />
            </form>
            
        <?php
            }
        ?>

    </div>

    <!-- //Проверка на пустые поля
    if ((!empty($subject)) && (!empty($text))) {
        //Подключаемся к базе
        require_once 'dbc.php';
        //Запрос
        $query = "SELECT * FROM email_list";
        $result= mysqli_query($dbc, $query)
            or die('Ошибка при выполнении запроса к базе данных.');
        
        while ($row = mysqli_fetch_array($result)) {
            $first_name = $row['first_name'];
            $last_name =  $row['last_name'];
            //Сообщение 
            $msg = "Уважаемый $first_name $last_name, \n $text";
            $to =   $row['email'];
            mail($to, $subject, $msg, 'From:' . $from);
            echo 'Электронное письмо отправлено: ' . $to . '<br />';
        }
        //Закрываем соединение с базой
        mysqli_close($dbc);
    }else {
        echo '<p style="text-align:center; padding: 20px; margin-top:30px;">Заполните все поля!</p>';
    } -->


    </body>
</html>