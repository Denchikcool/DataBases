<?php
    include 'db.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $authorName = trim($_POST['authorName']);

        if (!empty($authorName) && preg_match('/^[A-Za-zА-Яа-яЁё]+(?:\s[A-Za-zА-Яа-яЁё]+)?$/u', $authorName))
        {
            try
            {
                $stmt = $pdo->prepare("INSERT INTO Authors (AuthorName) VALUES (?)");
                $stmt->execute(array($authorName));
                echo "<p style='color:green;'>Автор успешно добавлен!</p>";
            }
            catch (PDOException $e)
            {
                if ($e->getCode() == 23000)
                {
                    echo "<p style='color:red;'>Автор с таким именем уже существует.</p>";
                }
                else
                {
                    echo "<p style='color:red;'>Ошибка при добавлении автора: " . htmlspecialchars($e->getMessage()) . "</p>";
                }
            }
        }
        else
        {
            echo "<p style='color:red;'>Поле 'Имя автора' не может быть пустым и должно содержать только буквы. Допускается одно или два слова.</p>";
        }
    }
?>

<form method="post" style="width:300px; margin: 20px auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px;">
    <label for="authorName" style="display:block; margin-bottom: 5px;">Имя автора:</label>
    <input type="text" name="authorName" id="authorName" required style="width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 3px;">
    <input type="submit" value="Добавить автора" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 3px; cursor: pointer;">
</form>

<a href="index.php" style="display: block; text-align: center; margin-top: 20px; text-decoration:none; color: #4CAF50;">Назад</a>

