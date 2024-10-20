<!DOCTYPE html>
<html lang='ru'>
<head>
    <meta charset='utf-8'>
    <title>Задание 2</title>
</head>
<body>
    <?php
        $var1 = "Alice";
        $var2 = "My friend is $var1";
        $var3 = 'My friend is $var1';
        $var4 = &$var1;

        echo "До изменения:<br>";
        echo "var1: $var1<br>";
        echo "var2: $var2<br>";
        echo "var3: $var3<br>";
        echo "var4: $var4<br>";

        $var1 = "Bob";

        echo "<br>После изменения:<br>";
        echo "var1: $var1<br>";
        echo "var2: $var2<br>";
        echo "var3: $var3<br>";
        echo "var4: $var4<br>";

        $user = "Michael";
        $$user = "Jackson";

        echo "<br>Динамическая переменная: $Michael";
    ?>
</body>
</html>