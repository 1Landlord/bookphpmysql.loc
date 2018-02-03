<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Рискованная работа - Поиск</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <img src="riskyjobs_title.gif" alt="Risky Jobs" />
  <img src="riskyjobs_fireman.jpg" alt="Risky Jobs" style="float:right" />
  <h3>Рискованная работа - Поиск</h3>


  <?php
  // This function builds a search query from the search keywords and sort setting
  function build_query($user_search, $sort) {
    $search_query = "SELECT * FROM riskyjobs";

    // извлечение критериев поиска в массив
    // заменяем запятые символом пробела
    $clean_search = str_replace(',', ' ', $user_search);
    $search_words = explode(' ', $clean_search);
    $final_search_words = array();
    //проходим в цикле по каждому элементу массива $search_words. Каждый не пустой массив добавляем в массив $final_search_words
    if (count($search_words) > 0) {
      foreach ($search_words as $word) {
        if (!empty($word)) {
          //с помощью оператора [] добавляем елемент в конец массива
          $final_search_words[] = $word;
        }
      }
    }

    // Создание условного выражения с использованием всех критериев поиска
    $where_list = array();
    if (count($final_search_words) > 0) {
      //запускаем цикл, присваиваем массиву $where_list найденые данные
      foreach($final_search_words as $word) {
        $where_list[] = "description LIKE '%$word%'";
      }
    }
    $where_clause = implode(' OR ', $where_list);

    // добавление условного выражения WHERE к поисковому запросу
    if (!empty($where_clause)) {
      $search_query .= " WHERE $where_clause";
    }

    // добавление к запросу выражения, определяющего порядок сортировки
    switch ($sort) {
    // сортировка по наименованию работ в восходящем алфавитном порядке (от А до Я)
    case 1:
      $search_query .= " ORDER BY title";
      break;
    // сортировка по наименованию работ в нисходящем алфавитном порядке
    case 2:
      $search_query .= " ORDER BY title DESC";
      break;
    // сортировка по наименованию штата
    case 3:
      $search_query .= " ORDER BY state";
      break;
    // сортировка по наименованию штата
    case 4:
      $search_query .= " ORDER BY state DESC";
      break;
    // сортировка по дате
    case 5:
      $search_query .= " ORDER BY date_posted";
      break;
    // сортировка по дате 
    case 6:
      $search_query .= " ORDER BY date_posted DESC";
      break;
    default:
      // данные по порядку сортировки отсутствуют, поэтому записи выводятся в том порядке, в котором они расположены в таблице
    }

    return $search_query;
  }

  // Эта функция создает заголовки таблицы результатов поиска в виде гиперссылок, щелкая кнопкой мыши по которым пользователь задает вид сортировки результатов поиска
  function generate_sort_links($user_search, $sort) {
    $sort_links = '';

    switch ($sort) {
    case 1:
      $sort_links .= '<td><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=2">Наименование работы</a></td><td>Описание</td>';
      $sort_links .= '<td><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=3">Штат</a></td>';
      $sort_links .= '<td><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=5">Дата</a></td>';
      break;
    case 3:
      $sort_links .= '<td><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=1">Наименование работы</a></td><td>Описание</td>';
      $sort_links .= '<td><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=4">Штат</a></td>';
      $sort_links .= '<td><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=3">Дата</a></td>';
      break;
    case 5:
      $sort_links .= '<td><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=1">Наименование работы</a></td><td>Описание</td>';
      $sort_links .= '<td><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=3">Штат</a></td>';
      $sort_links .= '<td><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=6">Дата</a></td>';
      break;
    default:
      $sort_links .= '<td><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=1">Наименование работы</a></td><td>Описание</td>';
      $sort_links .= '<td><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=3">Штат</a></td>';
      $sort_links .= '<td><a href = "' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=5">Дата</a></td>';
    }

    return $sort_links;
  }

  // эта функция создает навигационные гиперссылки на странице результатовпоиска, основываясь на значениях номера текущей страницы и общего количества страниц
  function generate_page_links($user_search, $sort, $cur_page, $num_pages) {
    $page_links = '';

    // если это первая страница - создание гиперссылки "предыдущая страница"
    if ($cur_page > 1) {
      $page_links .= '<a href="' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=' . $sort . '&page=' . ($cur_page - 1) . '"><-</a> ';
    }
    else {
      $page_links .= '<- ';
    }

    // прохождение в цикле всех страниц и создание гиперссылок, указывающих на конкретные страницы
    for ($i = 1; $i <= $num_pages; $i++) {
      if ($cur_page == $i) {
        $page_links .= ' ' . $i;
      }
      else {
        $page_links .= ' <a href="' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=' . $sort . '&page=' . $i . '"> ' . $i . '</a>';
      }
    }

    // если это последняя страница - создание гиперссылки "следующая страница
    if ($cur_page < $num_pages) {
      $page_links .= ' <a href="' . $_SERVER['PHP_SELF'] . '?usersearch=' . $user_search . '&sort=' . $sort . '&page=' . ($cur_page + 1) . '">-></a>';
    }
    else {
      $page_links .= ' ->';
    }

    return $page_links;
  }

  // Извлечение идентификатора вида сортировки и поисковой строки из url с помощью массива GET
  $sort = $_GET['sort'];
  $user_search = $_GET['usersearch'];

  // Расчет данных, необходимых для разбиения текста результатов поиска на страницы
  $cur_page = isset($_GET['page']) ? $_GET['page'] : 1;
  $results_per_page = 5;  // кол-во объявлений на странице
  $skip = (($cur_page - 1) * $results_per_page);

  // создание таблицы с результатами поиска
  echo '<table border="0" cellpadding="2">';

  // вывод заголовков таблицы результатов поиска
  echo '<tr class="heading">';
  echo generate_sort_links($user_search, $sort);
  echo '</tr>';

  // соединение с базой данных
  require_once('connectvars.php');
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  // Строка запроса для извлечения всех записей, соответствующих критериям поистка 
  $query = build_query($user_search, $sort);
  $result = mysqli_query($dbc, $query);
  $total = mysqli_num_rows($result);
  $num_pages = ceil($total / $results_per_page);

  // Строка запроса для извлечения записей только для текущей страницы 
  $query =  $query . " LIMIT $skip, $results_per_page";
  $result = mysqli_query($dbc, $query);
  while ($row = mysqli_fetch_array($result)) {
    echo '<tr class="results">';
    echo '<td valign="top" width="20%">' . $row['title'] . '</td>';
    echo '<td valign="top" width="50%">' . substr($row['description'], 0, 100) . '...</td>';
    echo '<td valign="top" width="10%">' . $row['state'] . '</td>';
    echo '<td valign="top" width="20%">' . substr($row['date_posted'], 0, 10) . '</td>';
    echo '</tr>';
  }
  echo '</table>';

  // если вся информация не помещается на одной странице - создание навигационных ссылок
  if ($num_pages > 1) {
    echo generate_page_links($user_search, $sort, $cur_page, $num_pages);
  }

  mysqli_close($dbc);
?>

</body>
</html>





 

