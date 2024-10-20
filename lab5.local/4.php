<!DOCTYPE html>
<html lang='ru'>
<head>
    <meta charset='utf-8'>
    <title>Задание 4</title>
</head>
<body>
    <?php
        $min = $_GET['min'];

        if ($min >= 0 && $min <= 15) {
            echo "Первая четверть часа";
        } elseif ($min > 15 && $min <= 30) {
            echo "Вторая четверть часа";
        } elseif ($min > 30 && $min <= 45) {
            echo "Третья четверть часа";
        } else {
            echo "Четвертая четверть часа";
        }
    ?>
</body>
</html>