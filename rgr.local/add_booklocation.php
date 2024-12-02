<?php
    include 'db.php';

    $books = $pdo->query("SELECT BookID, Title FROM Books")->fetchAll(PDO::FETCH_ASSOC);
    $shelves = $pdo->query("SELECT ShelfID, ShelfName FROM Shelves")->fetchAll(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $bookId = $_POST['bookId'];
        $shelfId = $_POST['shelfId'];
        $quantity = $_POST['quantity'];

        if (!empty($bookId) && !empty($shelfId) && !empty($quantity) && preg_match('/^[0-9]+$/', $quantity))
        {
            try
            {
                $stmt = $pdo->prepare("INSERT INTO BookLocations (BookID, ShelfID, Quantity) VALUES (?, ?, ?)");
                $stmt->execute([$bookId, $shelfId, $quantity]);
                echo "<p style='color: green;'>Расположение книги успешно добавлено!</p>";
            }
            catch (PDOException $e)
            {
                if ($e->getCode() == 23000)
                {
                    echo "<p style='color: red;'>Ошибка: Нарушение уникальности (BookID, ShelfID) или внешний ключ.</p>";
                }
                else
                {
                    echo "<p style='color: red;'>Ошибка при добавлении расположения книги: " . htmlspecialchars($e->getMessage()) . "</p>";
                }
            }
        }
        else
        {
            echo "<p style='color: red;'>Пожалуйста, заполните все поля корректно. Количество должно быть числом.</p>";
        }
    }
?>

<form method="post" style="width: 350px; margin: 20px auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px;">
    <label for="bookId" style="display: block; margin-bottom: 5px;">Книга:</label>
    <select name="bookId" id="bookId" required style="width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 3px;">
        <option value="">Выберите книгу</option>
        <?php foreach ($books as $book): ?>
            <option value="<?php echo $book['BookID']; ?>">
                <?php echo htmlspecialchars($book['Title']); ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="shelfId" style="display: block; margin-bottom: 5px;">Полка:</label>
    <select name="shelfId" id="shelfId" required style="width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 3px;">
        <option value="">Выберите полку</option>
        <?php foreach ($shelves as $shelf): ?>
            <option value="<?php echo $shelf['ShelfID']; ?>">
                <?php echo htmlspecialchars($shelf['ShelfName']); ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="quantity" style="display: block; margin-bottom: 5px;">Количество:</label>
    <input type="number" name="quantity" id="quantity" required style="width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 3px;">

    <input type="submit" value="Добавить расположение книги" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 3px; cursor: pointer; display: block; margin: 10px auto;">
</form>

<a href="index.php" style="display: block; text-align: center; margin-top: 20px; text-decoration: none; color: #4CAF50;">Назад</a>

