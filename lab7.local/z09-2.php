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

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $name = $_POST["name"];
        $city = $_POST["city"];
        $address = $_POST["address"];
        $birthday = $_POST["birthday"];
        $mail = $_POST["mail"];

        if (!empty($name) && !empty($mail))
        {
            $queryToDataBase = "INSERT INTO notebook_br06 (name, city, address, birthday, mail)
                    VALUES ('$name', '$city', '$address', '$birthday', '$mail')";

            if ($connectionToDataBase->query($queryToDataBase) === TRUE)
            {
                echo "Запись успешно добавлена!";
            }
            else
            {
                echo "Ошибка: " . $queryToDataBase . "<br>" . $connectionToDataBase->error;
            }
        }
        else
        {
            echo "Поля 'Имя' и 'Email' обязательны для заполнения!";
        }
    }

    $connectionToDataBase->close();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Заполнение таблицы notebook_br06</title>
    <style>
        body {
            font-family: sans-serif;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
            margin-bottom: 15px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Форма для заполнения таблицы notebook_br06</h2>
    <form method="post" action="z09-2.php">
        <label for="name">Имя (обязательно для заполнения):</label>
        <input type="text" id="name" name="name" required>

        <label for="city">Город:</label>
        <input type="text" id="city" name="city">

        <label for="address">Адрес:</label>
        <input type="text" id="address" name="address">

        <label for="birthday">Дата рождения:</label>
        <input type="date" id="birthday" name="birthday">

        <label for="mail">Email (обязательно для заполнения):</label>
        <input type="email" id="mail" name="mail" required>

        <input type="submit" value="Отправить">
    </form>
</body>
</html>


