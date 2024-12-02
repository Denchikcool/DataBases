<?php
    include 'db.php';

    $authors = $pdo->query("SELECT AuthorID, AuthorName FROM Authors")->fetchAll(PDO::FETCH_ASSOC);
    $genres = $pdo->query("SELECT GenreID, GenreName FROM Genres")->fetchAll(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $title = trim($_POST['title']);
        $isbn = trim($_POST['isbn']);
        $authorId = $_POST['authorId'];
        $genreId = $_POST['genreId'];
        $publicationYear = $_POST['publicationYear'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];


        if (!empty($title) && !empty($isbn) && !empty($authorId) && !empty($genreId) && !empty($publicationYear) && !empty($price) && !empty($quantity) && preg_match('/^[0-9]+$/',$quantity) && preg_match('/^[0-9]+$/',$publicationYear) && preg_match('/^[0-9.]+$/',$price))
        {
            try
            {
                $stmt = $pdo->prepare("INSERT INTO Books (Title, ISBN, AuthorID, GenreID, PublicationYear, Price, Quantity) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([$title, $isbn, $authorId, $genreId, $publicationYear, $price, $quantity]);
                echo "<p style='color: green;'>Книга успешно добавлена!</p>";
            }
            catch (PDOException $e)
            {
                if ($e->getCode() == 23000)
                {
                    echo "<p style='color: red;'>Ошибка: Нарушение уникальности (ISBN) или внешний ключ.</p>";
                }
                else
                {
                    echo "<p style='color: red;'>Ошибка при добавлении книги: " . htmlspecialchars($e->getMessage()) . "</p>";
                }
            }
        }
        else
        {
            echo "<p style='color: red;'>Пожалуйста, заполните все поля корректно. Количество, год и цена должны быть числами.</p>";
        }
    }
?>

<form method="post" style="width: 400px; margin: 20px auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px;">
    <label for="title" style="display: block; margin-bottom: 5px;">Название книги:</label>
    <input type="text" name="title" id="title" required style="width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 3px;">

    <label for="isbn" style="display: block; margin-bottom: 5px;">ISBN:</label>
    <input type="text" name="isbn" id="isbn" required style="width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 3px;">

    <label for="authorId" style="display: block; margin-bottom: 5px;">Автор:</label>
    <select name="authorId" id="authorId" required style="width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 3px;">
        <option value="">Выберите автора</option>
        <?php foreach ($authors as $author): ?>
            <option value="<?php echo $author['AuthorID']; ?>">
                <?php echo htmlspecialchars($author['AuthorName']); ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="genreId" style="display: block; margin-bottom: 5px;">Жанр:</label>
    <select name="genreId" id="genreId" required style="width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 3px;">
        <option value="">Выберите жанр</option>
        <?php foreach ($genres as $genre): ?>
            <option value="<?php echo $genre['GenreID']; ?>">
                <?php echo htmlspecialchars($genre['GenreName']); ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="publicationYear" style="display: block; margin-bottom: 5px;">Год публикации:</label>
    <input type="number" name="publicationYear" id="publicationYear" required style="width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 3px;">

    <label for="price" style="display: block; margin-bottom: 5px;">Цена:</label>
    <input type="number" step="0.01" name="price" id="price" required style="width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 3px;">

    <label for="quantity" style="display: block; margin-bottom: 5px;">Количество:</label>
    <input type="number" name="quantity" id="quantity" required style="width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 3px;">

    <input type="submit" value="Добавить книгу" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 3px; cursor: pointer; display: block; margin: 10px auto;">
</form>

<a href="index.php" style="display: block; text-align: center; margin-top: 20px; text-decoration: none; color: #4CAF50;">Назад</a>
