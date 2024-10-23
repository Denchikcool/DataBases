<!DOCTYPE html>
<html lang='ru'>
<head>
    <meta charset='utf-8'>
    <title>Задание 3</title>
</head>
<body>
    <?php
        $cust = [
            'cnum' => 2001,
            'cname' => 'Hoffman',
            'city' => 'London',
            'snum' => 1001,
            'rating' => 100,
        ];

        echo "Массив: <br>";
        print_r($cust);

        asort($cust);
        echo "<br>Массив, отсортированный по значениям: <br>";
        print_r($cust);

        ksort($cust);
        echo "<br>Массив, отсортированный по ключам: <br>";
        print_r($cust);

        sort($cust);
        echo "<br>Массив, отсортированный функцией sort(): <br>";
        print_r($cust);

        echo "<br>Объяснение:<br>";
        echo "Функция sort() сортирует элементы массива по значениям, но не сохраняет ключи.<br>";
        echo "В этом случае ключи массива были перезаписаны числовыми индексами.<br>";
    ?>
</body>
</html>