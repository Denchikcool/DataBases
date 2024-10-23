<!DOCTYPE html>
<html lang='ru'>
<head>
    <meta charset='utf-8'>
    <title>Задание 1</title>
</head>
<body>
    <?php
        $treug = [];
        for ($n = 1; $n <= 10; $n++) {
            $treug[] = $n * ($n + 1) / 2;
        }

        echo "Треугольные числа: ";
        foreach ($treug as $value) {
            echo $value . "  ";
        }
        echo "<br>";

        $kvd = [];
        for ($n = 1; $n <= 10; $n++) {
            $kvd[] = $n * $n;
        }

        echo "Квадраты: ";
        foreach ($kvd as $value) {
            echo $value . " ";
        }
        echo "<br>";

        $rez = array_merge($treug, $kvd);

        echo "Объединенный массив: ";
        foreach ($rez as $value) {
            echo $value . " ";
        }
        echo "<br>";

        sort($rez);

        echo "Отсортированный массив: ";
        foreach ($rez as $value) {
            echo $value . " ";
        }
        echo "<br>";

        array_shift($rez);

        echo "Массив без первого элемента: ";
        foreach ($rez as $value) {
            echo $value . " ";
        }
        echo "<br>";

        $rez1 = array_unique($rez);

        echo "Массив без дубликатов: ";
        foreach ($rez1 as $value) {
            echo $value . " ";
        }
        echo "<br>";

        function cmp($a, $b){
            if ($a == $b) return 0;
            return ($a < $b) ? -1 : 1;
        }


        $a = [3, 1, 2, 5];
        usort($a, "cmp");
        foreach ($a as $value) {
            echo $value . " ";
        }
    ?>
</body>
</html>