<?php
    include 'db.php';

    $table = isset($_GET['table']) ? $_GET['table'] : 'Genres';
    echo "<h2 style='text-align: center; color: navy;'>Содержимое таблицы: " . htmlspecialchars($table) . "</h2>";

    try {
        $stmt = $pdo->prepare("SHOW TABLES LIKE ?");
        $stmt->execute(array($table));
        if ($stmt->rowCount() == 0) {
            echo "<p style='color: red; text-align: center;'>Таблица " . htmlspecialchars($table) . " не найдена в базе данных.</p>";
        } else {
            $stmt = $pdo->query("SELECT * FROM " . $table);

            echo "<table style='width: 100%; border-collapse: collapse; margin: 20px auto;'>";
            echo "<tr style='background-color: #f2f2f2;'>";
            for ($i = 0; $i < $stmt->columnCount(); $i++) {
                $col = $stmt->getColumnMeta($i);
                echo "<th style='padding: 8px; border: 1px solid #ddd; text-align: left;'>" . htmlspecialchars($col['name']) . "</th>";
            }
            echo "</tr>";

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td style='padding: 8px; border: 1px solid #ddd;'>" . htmlspecialchars($value) . "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        }
    } catch (PDOException $e) {
        echo "<p style='color: red; text-align: center;'>Ошибка: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
?>

<form method="get" style="text-align: center; margin-top: 20px;">
    <label for="table" style="margin-right: 10px;">Выберите таблицу:</label>
    <select name="table" id="table" style="padding: 8px; border: 1px solid #ccc; border-radius: 3px;">
        <option value="Genres" <?php if ($table == 'Genres') echo 'selected'; ?>>Жанры книг</option>
        <option value="Authors" <?php if ($table == 'Authors') echo 'selected'; ?>>Авторы</option>
        <option value="Books" <?php if ($table == 'Books') echo 'selected'; ?>>Книги</option>
        <option value="Shelves" <?php if ($table == 'Shelves') echo 'selected'; ?>>Стелажи книг</option>
        <option value="BookLocations" <?php if ($table == 'BookLocations') echo 'selected'; ?>>Расположение книг</option>
        <option value="Employees" <?php if ($table == 'Employees') echo 'selected'; ?>>Сотрудники</option>
    </select>
    <input type="submit" value="Просмотр" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 3px; cursor: pointer; margin-left: 10px;">
</form>

<a href="index.php" style="display: block; text-align: center; margin-top: 20px; text-decoration:none; color: #4CAF50;">Назад</a>

