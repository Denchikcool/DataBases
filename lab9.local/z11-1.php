<?php
    $teamNumber = '06';
    $filename = "notebook_br$teamNumber.txt";
    $tableName = "notebook_br$teamNumber";

    $servername = "mysql-8.0";
    $username = "root";
    $password = "";
    $dbname = "sample";

    if (file_exists($filename))
    {
        echo "<p>файл $filename существует</p>";
    }
    else
    {
        $file = fopen($filename, 'w');
        if (!$file)
        {
            die("Не удалось создать файл.");
        }
        fclose($file);
    }


    $file = fopen($filename, 'w');
    if (!$file)
    {
        die("Не удалось открыть файл для записи.");
    }

    $mysqli = new mysqli($servername, $username, $password, $dbname);
    if ($mysqli->connect_errno)
    {
        die("Connect Error: " . $mysqli->connect_error);
    }

    $result = $mysqli->query("SELECT * FROM $tableName");
    if (!$result)
    {
        die("Ошибка при получении данных из таблицы.");
    }

    while ($row = $result->fetch_assoc())
    {
        $line = array();
        foreach ($row as $column => $value)
        {
            if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $value))
            {
                $value = preg_replace('/(\d{4})-(\d{2})-(\d{2})/', '$3-$2-$1', $value);
            }
            $line[] = $value;
        }
        fwrite($file, implode(' | ', $line) . "\n");
    }

    fclose($file);

    $file = fopen($filename, 'r');
    if (!$file)
    {
        die("Не удалось открыть файл для чтения.");
    }

    while (($line = fgets($file)) !== false)
    {
        echo htmlspecialchars($line) . "<br>";
    }

    fclose($file);

    $mysqli->close();
?>

