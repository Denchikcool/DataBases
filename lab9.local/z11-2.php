<?php
    $teamNumber = '06';
    $filename = "notebook_br$teamNumber.txt";

    if (file_exists($filename))
    {
        $file_array = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    }
    else
    {
        die("Файл $filename не существует. Проверьте путь и права доступа.");
    }

    echo '<table border="1" cellpadding="10">';

    foreach ($file_array as $line)
    {
        $line = rtrim($line, " | \n");

        $line = str_replace(" | ", "</td><td>", $line);

        $line = preg_replace('/\b([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})\b/', '<a href="mailto:$1">$1</a>', $line);

        echo "<tr><td>$line</td></tr>";
    }

    echo '</table>';

    echo '<p>Последняя модификация файла: ' . date("d-m-Y H:i:s", filemtime($filename)) . '</p>';
?>

