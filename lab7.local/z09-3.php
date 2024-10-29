<?php
    header('Content-Type: text/html; charset=utf-8');
    $serverName = "mysql-8.0";
    $userName = "root";
    $passWord = "";
    $dataBaseName = "sample";
?>
<?php
    $connectionToDataBase = new mysqli($serverName, $userName, $passWord, $dataBaseName);

    if ($connectionToDataBase->connect_error)
    {
        die("Ошибка подключения: " . $connectionToDataBase->connect_error);
    }

    $queryToDataBase = "SELECT * FROM notebook_br06";
    $result = $connectionToDataBase->query($queryToDataBase);

    if ($result->num_rows > 0)
    {
        echo "<style>";
        echo ".table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }";
        echo "</style>";
        echo "<table class='table table-striped table-hover'>";
        echo "<thead><tr><th>ID</th><th>Имя</th><th>Город</th><th>Адрес</th><th>Дата рождения</th><th>Email</th></tr></thead><tbody>";

        while($row = $result->fetch_assoc())
        {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["city"] . "</td>";
            echo "<td>" . $row["address"] . "</td>";
            echo "<td>" . $row["birthday"] . "</td>";
            echo "<td style='width: 200px;'>" . $row["mail"] . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    }
    else
    {
        echo "Нет записей в таблице.";
    }

    $connectionToDataBase->close();
?>
