<?php
    include 'db.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $fullName = trim($_POST['fullName']);
        $position = trim($_POST['position']);
        $hireDate = $_POST['hireDate'];

        if (!empty($fullName) && !empty($position) && !empty($hireDate) && preg_match('/^[A-Za-zА-Яа-яЁё]+ [A-Za-zА-Яа-яЁё]+$/u', $fullName))
        {
            try
            {
                $stmt = $pdo->prepare("INSERT INTO Employees (FullName, Position, HireDate) VALUES (?, ?, ?)");
                $stmt->execute(array($fullName, $position, $hireDate));
                echo "<p style='color: green;'>Сотрудник успешно добавлен!</p>";
            }
            catch (PDOException $e)
            {
                echo "<p style='color: red;'>Ошибка при добавлении сотрудника: " . htmlspecialchars($e->getMessage()) . "</p>";
            }
        }
        else
        {
            echo "<p style='color: red;'>Пожалуйста, заполните все поля корректно.  Полное имя должно состоять из двух слов.</p>";
        }
    }
?>

<form method="post" style="width: 350px; margin: 20px auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px;">
    <label for="fullName" style="display: block; margin-bottom: 5px;">Полное имя:</label>
    <input type="text" name="fullName" id="fullName" required style="width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 3px;">

    <label for="position" style="display: block; margin-bottom: 5px;">Должность:</label>
    <input type="text" name="position" id="position" required style="width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 3px;">

    <label for="hireDate" style="display: block; margin-bottom: 5px;">Дата найма:</label>
    <input type="date" name="hireDate" id="hireDate" required style="width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 3px;">

    <input type="submit" value="Добавить сотрудника" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 3px; cursor: pointer; display: block; margin: 10px auto;">
</form>

<a href="index.php" style="display: block; text-align: center; margin-top: 20px; text-decoration: none; color: #4CAF50;">Назад</a>

