<?php
    include 'db.php';

    $genres = $pdo->query("SELECT GenreID, GenreName FROM Genres")->fetchAll(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $genreName = trim($_POST['genreName']);

        if (!empty($genreName))
        {
            try
            {
                $stmt = $pdo->prepare("INSERT INTO Genres (GenreName) VALUES (?)");
                $stmt->execute(array($genreName));
                echo "<p style='color: green;'>Жанр успешно добавлен!</p>";
            }
            catch (PDOException $e)
            {
                if ($e->getCode() == 23000)
                {
                    echo "<p style='color: red;'>Жанр с таким названием уже существует.</p>";
                } else
                {
                    echo "<p style='color: red;'>Ошибка при добавлении жанра: " . htmlspecialchars($e->getMessage()) . "</p>";
                }
            }
        }
        else
        {
            echo "<p style='color: red;'>Поле 'Название жанра' не может быть пустым.</p>";
        }
    }
?>

<form method="post" style="width: 300px; margin: 20px auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px;">
    <label for="genreName" style="display: block; margin-bottom: 5px;">Название жанра:</label>
    <input type="text" name="genreName" id="genreName" required style="width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 3px;">
    <input type="submit" value="Добавить жанр" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 3px; cursor: pointer;">
</form>

<a href="index.php" style="display: block; text-align: center; margin-top: 20px; text-decoration: none; color: #4CAF50;">Назад</a>

