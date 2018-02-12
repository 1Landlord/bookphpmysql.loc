<?php header('Content-Type: text/xml'); ?>
<?php echo '<?xml version="1.0" encoding="utf-8"?>'; ?>
<rss version="2.0">
  <channel>
    <title>Космические пришельцы. Канал RSS</title>
    <link>http://bookphpmysql.loc/forFang/</link>
    <description>Сообщение о похищении космическими пришельцами, собранные со всегоо мира.</description>
    <language>ru-ru</language>

<?php
    //Соединение с БД
    require_once('connectvars.php');

  // Извлечение свидетельств из базы данных
  $query = "SELECT abduction_id, first_name, last_name, " .
    "DATE_FORMAT(when_it_happened,'%a, %d %b %Y %T') AS when_it_happened_rfc, " .
    "alien_description, what_they_did " .
    "FROM table_book " .
    "ORDER BY when_it_happened DESC";
  $data = mysqli_query($dbc, $query);

  // прохождение в цикле свидетельств о космических пришельцах и преобразование в RSS
  while ($row = mysqli_fetch_array($data)) { 
    // Вывод каждой записи результата запроса в виде RSS-новости
    echo '<item>';
    echo '  <title>' . $row['first_name'] . ' ' . $row['last_name'] . ' - ' . substr($row['alien_description'], 0, 32) . '...</title>';
    echo '  <link>http://bookphpmysql.loc/forFang/index.php?abduction_id=' . $row['abduction_id'] . '</link>';
    echo '  <pubDate>' . $row['when_it_happened_rfc'] . ' ' . date('T') . '</pubDate>';
    echo '  <description>' . $row['what_they_did'] . '</description>';
    echo '</item>';
  }
?>

  </channel>
</rss>
