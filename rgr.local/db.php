<?php
    $servername = 'mysql-8.0';
    $dbname = 'book_shop';
    $username = 'root';
    $password = '';

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Ошибка подключения: " . $e->getMessage();
    }
?>
