<?php
    include 'db.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $shelfName = trim($_POST['shelfName']);
        $capacity = trim($_POST['capacity']);

        if (!empty($shelfName) && !empty($capacity) && preg_match('/^[A-Za-zА-Яа-яЁё\s]+$/u', $shelfName) && preg_match('/^[0-9]+$/', $capacity))
        {
            try
            {
                $stmt = $pdo->prepare("INSERT INTO Shelves (ShelfName, Capacity) VALUES (?, ?)");
                $stmt->execute([$shelfName, $capacity]);
                echo "<p style='color: green;'>Полка успешно добавлена!</p>";
            }
            catch (PDOException $e)
            {
                echo "<p style='color: red;'>Ошибка при добавлении полки: " . htmlspecialchars($e->getMessage()) . "</p>";
            }
        }
        else
        {
            echo "<p style='color: red;'>Поле 'Название полки' не может быть пустым и должно содержать только буквы и пробелы.  'Вместимость' должна быть числом.</p>";
        }
    }
?>

<form method="post" style="width: 300px; margin: 20px auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px;">
    <label for="shelfName" style="display: block; margin-bottom: 5px;">Название полки:</label>
    <input type="text" name="shelfName" id="shelfName" required style="width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 3px;">

    <label for="capacity" style="display: block; margin-bottom: 5px;">Вместимость:</label>
    <input type="number" name="capacity" id="capacity" required style="width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 3px;">

    <input type="submit" value="Добавить полку" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 3px; cursor: pointer; display: block; margin: 10px auto;">
</form>

<a href="index.php" style="display: block; text-align: center; margin-top: 20px; text-decoration: none; color: #4CAF50;">Назад</a>

