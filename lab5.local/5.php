<!DOCTYPE html>
<html lang='ru'>
<head>
    <meta charset='utf-8'>
    <title>Задание 5</title>
</head>
<body>
    <?php
        $color = "blue";

        echo "<table border='1' cellspacing='5'>";
        
        
        echo "<tr>";
        echo "<th style='color: red; padding: 5px;'>+</th>";
        
        for ($i = 1; $i <= 10; $i++) {
            echo "<th style='color: $color; padding: 5px;'>$i</th>";
        }
        echo "</tr>";
        
        
        for ($i = 1; $i <= 10; $i++) {
            echo "<tr>";
            echo "<th style='color: $color; padding: 5px;'>$i</th>";
        
            for ($j = 1; $j <= 10; $j++) {
                echo "<td style='padding: 5px;'>" . ($i + $j) . "</td>";
            }
            echo "</tr>";
        }
        
        echo "</table>";
    ?>
</body>
</html>