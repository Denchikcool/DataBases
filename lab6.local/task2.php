<!DOCTYPE html>
<html>
<head>
<title>Задание 2</title>
<style>
table {
    border-collapse: collapse;
    border: 1px solid black;
}

td {
    border: 1px solid black;
    width: 14px;
    height: 15px;
    padding: 0;
    font-size: 1px;
    text-align: center;
}
</style>
</head>
<body>

<table>
    <thead>
        <tr>
            <th>&nbsp;</th>
            <?php for ($i = 1; $i <= 30; $i++) { ?>
                <th><?php echo $i; ?></th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php for ($i = 1; $i <= 30; $i++) { ?>
            <tr>
                <th><?php echo $i; ?></th>
                    <?php for ($j = 1; $j <= 30; $j++) {
                        $product = $i * $j;
                        $color = "";
                        if ($product % 7 == 0) {
                            $color = "white";
                        } else if ($product % 7 == 1) {
                            $color = "aqua";
                        } else if ($product % 7 == 2) {
                            $color = "blue";
                        } else if ($product % 7 == 3) {
                            $color = "yellow";
                        } else if ($product % 7 == 4) {
                            $color = "purple";
                        } else if ($product % 7 == 5) {
                            $color = "red";
                        } else if ($product % 7 == 6) {
                            $color = "lime";
                        }
                    ?>
                    <td style="background-color: <?php echo $color; ?>">
                    &nbsp;
                    </td>
                    <?php } ?>
                </tr>
            <?php } ?>
    </tbody>
</table>

</body>
</html>

