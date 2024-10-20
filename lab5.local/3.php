<!DOCTYPE html>
<html lang='ru'>
<head>
    <meta charset='utf-8'>
    <title>Задание 3</title>
</head>
<body>
    <?php
        $e = 2.718281;
        echo "Число Эйлера равно " . $e . "<br>";
        
        $e = (string) $e;
        echo "Тип: " . gettype($e) . ", Значение: " . $e . "<br>";
        
        $e = (int) $e;
        echo "Тип: " . gettype($e) . ", Значение: " . $e . "<br>";
        
        $e = (bool) $e;
        echo "Тип: " . gettype($e) . ", Значение: " . $e . "<br>";
    ?>
</body>
</html>