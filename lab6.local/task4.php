<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Задание 4</title>
</head>
<body>

<?php
    $align = isset($_POST['align']) ? $_POST['align'] : 'left';
    $valign = isset($_POST['valign']) ? $_POST['valign'] : 'top';
?>


<table border="1" style="width: 300px; height: 300px;">
    <tr>
        <td align="<?php echo htmlspecialchars($align); ?>" valign="<?php echo htmlspecialchars($valign); ?>">
            Текст
        </td>
    </tr>
</table>

<form method="post" action="">
    <fieldset>
        <legend>Горизонтальное положение текста (align):</legend>
        <label>
            <input type="radio" name="align" value="left" <?php if ($align == 'left') echo 'checked'; ?>>Слева
        </label>
        <label>
            <input type="radio" name="align" value="center" <?php if ($align == 'center') echo 'checked'; ?>>По центру
        </label>
        <label>
            <input type="radio" name="align" value="right" <?php if ($align == 'right') echo 'checked'; ?>>Справа
        </label>
    </fieldset>

    <fieldset>
        <legend>Вертикальное положение текста (valign):</legend>
        <label>
            <input type="checkbox" name="valign" value="top" <?php if ($valign == 'top') echo 'checked'; ?>>Сверху
        </label>
        <label>
            <input type="checkbox" name="valign" value="middle" <?php if ($valign == 'middle') echo 'checked'; ?>>По центру
        </label>
        <label>
            <input type="checkbox" name="valign" value="bottom" <?php if ($valign == 'bottom') echo 'checked'; ?>>Снизу
        </label>
    </fieldset>

    <button type="submit">Выполнить</button>
</form>
</body>
</html>
