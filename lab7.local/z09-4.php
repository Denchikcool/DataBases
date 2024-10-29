<?php
    header('Content-Type: text/html; charset=utf-8');
    $serverName = "mysql-8.0";
    $userName = "root";
    $passWord = "";
    $dataBaseName = "sample";

    $connectionToDataBase = new mysqli($serverName, $userName, $passWord, $dataBaseName);

    if ($connectionToDataBase->connect_error) {
        die("Ошибка подключения: " . $connectionToDataBase->connect_error);
    }

    $error_message = '';

    if (isset($_POST['id']) && isset($_POST['field_name']) && isset($_POST['field_value'])) {
        $id = $_POST['id'];
        $field_name = $_POST['field_name'];
        $field_value = trim($_POST['field_value']);

        if (($field_name === 'name' || $field_name === 'mail') && empty($field_value)) {
            $error_message = "Поле Имя и поле Email не могут быть пустыми или состоять только из пробелов!";
        } elseif ($field_name === 'mail' && !filter_var($field_value, FILTER_VALIDATE_EMAIL)) {
            $error_message = "Некорректный формат электронной почты!";
        } else {
            $sql_update = "UPDATE notebook_br06 SET $field_name = ? WHERE id = ?";
            $prepare = $connectionToDataBase->prepare($sql_update);

            if ($prepare === false) {
                die("Ошибка подготовки SQL-запроса: " . $connectionToDataBase->error);
            }

            $prepare->bind_param("si", $field_value, $id);
            $prepare->execute();
            $prepare->close();

            echo "<p>Запись обновлена!</p>";
        }
    }

    $queryToDataBase = "SELECT * FROM notebook_br06";
    $result = $connectionToDataBase->query($queryToDataBase);

    if ($result === false) {
        die("Ошибка выполнения запроса: " . $connectionToDataBase->error);
    }

    if ($result->num_rows > 0) {
        echo "<form method='POST' action='z09-4.php'>";
        echo "<style>";
        echo ".table { width: 80%; margin: 0 auto; border-collapse: collapse; }
                .table th, .table td { padding: 10px; text-align: left; border: 1px solid #ddd; }
                .table th { background-color: #f2f2f2; font-weight: bold; }";
        echo "</style>";
        echo "<table class='table table-striped table-hover'>";
        echo "<thead><tr><th>ID</th><th>Имя</th><th>Город</th><th>Адрес</th><th>Дата рождения</th><th>Email</th><th>Выбор</th></tr></thead><tbody>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["city"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["address"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["birthday"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["mail"]) . "</td>";
            echo "<td><input type='radio' name='id' value='" . $row["id"] . "'></td>";
            echo "</tr>";
        }

        echo "</tbody></table>";
        echo "<div style='text-align: center; margin-top: 15px;'>";
        echo "<input type='submit' value='Выбрать для редактирования' class='btn btn-primary'>";
        echo "</div>";
        echo "</form>";
    }

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $selectedRowToEdit = "SELECT * FROM notebook_br06 WHERE id = ?";
        $prepare = $connectionToDataBase->prepare($selectedRowToEdit);

        if ($prepare === false) {
            die("Ошибка подготовки SQL-запроса: " . $connectionToDataBase->error);
        }

        $prepare->bind_param("i", $id);
        $prepare->execute();
        $result_selected = $prepare->get_result();

        if ($row_selected = $result_selected->fetch_assoc()) {
            echo "<style>.centered-container { max-width: 600px; margin: 0 auto; text-align: center; }</style>";

            echo "<div class='centered-container'>";
            echo "<h3>Редактировать запись ID: $id</h3>";
            echo "<form method='POST' action='z09-4.php'>";

            echo "<div class='form-group'>";
            echo "<label for='field_name'>Поле:</label>";
            echo "<select name='field_name' id='field_name' class='form-control'>";
            echo "<option value='name'>Имя (" . htmlspecialchars($row_selected['name']) . ")</option>";
            echo "<option value='city'>Город (" . htmlspecialchars($row_selected['city']) . ")</option>";
            echo "<option value='address'>Адрес (" . htmlspecialchars($row_selected['address']) . ")</option>";
            echo "<option value='birthday'>Дата рождения (" . htmlspecialchars($row_selected['birthday']) . ")</option>";
            echo "<option value='mail'>Email (" . htmlspecialchars($row_selected['mail']) . ")</option>";
            echo "</select>";
            echo "</div>";

            echo "<div class='form-group'>";
            echo "<label for='field_value'>Новое значение:</label>";
            echo "<input type='text' name='field_value' id='field_value' class='form-control' placeholder='Новое значение'>";
            echo "</div>";

            echo "<input type='hidden' name='id' value='$id'>";
            echo "<input type='submit' value='Заменить' class='btn btn-primary'>";
            echo "</form>";
            echo "</div>";
        }

        $prepare->close();
    }

    if (!empty($error_message)) {
        echo "<p style='color:red; text-align: center;'>$error_message</p>";
    }

    echo "<div style='text-align: center;'>";
    echo "<br><a href='z09-3.php'>Показать все записи</a>";
    echo "</div>";

    $connectionToDataBase->close();
?>