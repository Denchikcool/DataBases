<?php
    $servername = "mysql-8.0";
    $username = "root";
    $password = "";
    $dbname = "sample";
    
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Ошибка подключения: " . $conn->connect_error);
    }
?>