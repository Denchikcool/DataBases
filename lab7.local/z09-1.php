<?php
    header('Content-Type: text/html; charset=utf-8');
    $serverName = "mysql-8.0";
    $userName = "root";
    $passWord = "";
    $dataBaseName = "sample";
?>
<?php
    $connectionToDataBase = new mysqli($serverName, $userName, $passWord, $dataBaseName);

    if ($connectionToDataBase->connect_error) {
        die("Ошибка подключения: " . $connectionToDataBase->connect_error);
    }

    $queryToDropTable = "DROP TABLE IF EXISTS notebook_br06";

    if ($connectionToDataBase->query($queryToDropTable) === TRUE)
    {
        echo "Таблица notebook_br06 удалена, т.к. существовала.<br>";
    }
    else
    {
        echo "Ошибка при удалении таблицы: " . $connectionToDataBase->error . "<br>";
    }

    $queryToCreateTable = "CREATE TABLE notebook_br06 (
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50),
        city VARCHAR(50),
        address VARCHAR(50),
        birthday DATE,
        mail VARCHAR(50)
    )";

    if ($connectionToDataBase->query($queryToCreateTable) === TRUE) {
        echo "Таблица notebook_br06 успешно создана.<br>";
    } else {
        echo "Нельзя создать таблицу notebook_br06: " . $connectionToDataBase->error . "<br>";
    }

    $connectionToDataBase->close();
?>
