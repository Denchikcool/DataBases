
<?
    include 'db.php';

    $booksOnShelf = [];
    if (isset($_POST['shelf_id']))
    {
        $shelfId = intval($_POST['shelf_id']);
        try
        {
            $stmt = $pdo->prepare("
                SELECT b.Title, a.AuthorName, g.GenreName, s.ShelfName, bl.Quantity
                FROM Books b
                JOIN Authors a ON b.AuthorID = a.AuthorID
                JOIN Genres g ON b.GenreID = g.GenreID
                JOIN BookLocations bl ON b.BookID = bl.BookID
                JOIN Shelves s ON bl.ShelfID = s.ShelfID
                WHERE bl.ShelfID = ?
            ");
            $stmt->execute([$shelfId]);
            $booksOnShelf = $stmt->fetchAll();
        }
        catch (PDOException $e)
        {
            error_log("Ошибка в запросе 1: " . $e->getMessage() . "\n" . $e->getTraceAsString(), 3, "db_errors.log");
            echo "<p style='color:red;'>Ошибка при выполнении запроса 1.</p>";
        }
    }

    $booksPerGenre = [];
    try
    {
        $stmt = $pdo->query("
            SELECT g.GenreName, COUNT(b.BookID) AS TotalBooks
            FROM Genres g
            LEFT JOIN Books b ON g.GenreID = b.GenreID
            GROUP BY g.GenreName
        ");
        $booksPerGenre = $stmt->fetchAll();
    }
    catch (PDOException $e)
    {
        error_log("Ошибка в запросе 2: " . $e->getMessage() . "\n" . $e->getTraceAsString(), 3, "db_errors.log");
        echo "<p style='color:red;'>Ошибка при выполнении запроса 2.</p>";
    }

    $booksByAuthor = [];
    if (isset($_POST['author_id']))
    {
        $authorId = intval($_POST['author_id']);
        try
        {
            $stmt = $pdo->prepare("
                SELECT b.Title, g.GenreName
                FROM Books b
                JOIN Genres g ON b.GenreID = g.GenreID
                WHERE b.AuthorID = ?
            ");
            $stmt->execute([$authorId]);
            $booksByAuthor = $stmt->fetchAll();
        }
        catch (PDOException $e)
        {
            error_log("Ошибка в запросе 3: " . $e->getMessage() . "\n" . $e->getTraceAsString(), 3, "db_errors.log");
            echo "<p style='color:red;'>Ошибка при выполнении запроса 3.</p>";
        }
    }

    $shelves = $pdo->query("SELECT ShelfID, ShelfName FROM Shelves")->fetchAll();
    $authors = $pdo->query("SELECT AuthorID, AuthorName FROM Authors")->fetchAll();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Запросы к базе данных книг</title>
    <style>
        body {
            font-family: sans-serif;
            line-height: 1.6;
            margin: 20px;
        }
        h1, h2 {
            color: #333;
        }
        h2 {
            margin-bottom: 10px;
        }
        form {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        select, input[type="submit"] {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .error {
            color: red;
            font-weight: bold;
        }

    </style>
</head>
<body>

    <h1>Запросы к базе данных</h1>

    <h2>Запрос 1: Книги на определенном стеллаже</h2>
    <form method="post">
        <label for="shelf_id">Выберите стеллаж:</label>
        <select id="shelf_id" name="shelf_id">
            <option value="">Выберите стеллаж</option>
            <?php foreach ($shelves as $shelf): ?>
                <option value="<?php echo $shelf['ShelfID']; ?>">
                <?php echo htmlspecialchars($shelf['ShelfName']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Показать книги">
    </form>
    <?php if (!empty($booksOnShelf)): ?>
        <h3>Книги на выбранном стеллаже:</h3>
        <table>
            <tr><th>Название</th><th>Автор</th><th>Жанр</th><th>Количество</th></tr>
            <?php foreach ($booksOnShelf as $book): ?>
                <tr>
                    <td><?php echo htmlspecialchars($book['Title']); ?></td>
                    <td><?php echo htmlspecialchars($book['AuthorName']); ?></td>
                    <td><?php echo htmlspecialchars($book['GenreName']); ?></td>
                    <td><?php echo htmlspecialchars($book['Quantity']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <h2>Запрос 2: Общее количество книг по каждому жанру</h2>
    <table>
        <tr><th>Жанр</th><th>Количество книг</th></tr>
        <?php foreach ($booksPerGenre as $genre): ?>
            <tr>
                <td><?php echo htmlspecialchars($genre['GenreName']); ?></td>
                <td><?php echo htmlspecialchars($genre['TotalBooks']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>


    <h2>Запрос 3: Книги определенного автора</h2>
    <form method="post">
        <label for="author_id">Выберите автора:</label>
        <select id="author_id" name="author_id">
            <option value="">Выберите автора</option>
            <?php foreach ($authors as $author): ?>
                <option value="<?php echo $author['AuthorID']; ?>">
                    <?php echo htmlspecialchars($author['AuthorName']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Показать книги">
    </form>
    <?php if (!empty($booksByAuthor)): ?>
        <h3>Книги выбранного автора:</h3>
        <table>
            <tr><th>Название</th><th>Жанр</th></tr>
            <?php foreach ($booksByAuthor as $book): ?>
                <tr>
                    <td><?php echo htmlspecialchars($book['Title']); ?></td>
                    <td><?php echo htmlspecialchars($book['GenreName']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

</body>
</html>
