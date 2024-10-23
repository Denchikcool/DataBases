<?php
    $otv = array(
        1 => 'a',
        2 => 'a',
        3 => 'b',
        4 => 'b',
        5 => 'a',
        6 => 'b'
    );

    $name = $_POST['name'];

    $correct = 0;

    for ($i = 1; $i <= 6; $i++) {
        if (isset($_POST['q' . $i]) && $_POST['q' . $i] == $otv[$i]) {
            $correct++;
        }
    }

    $result = '';
    switch (true) {
        case ($correct >= 5):
            $result = "Отлично! Вы показали глубокие знания истории России.";
            break;
        case ($correct >= 3 && $correct < 5):
            $result = "Хорошо! Вы обладаете хорошими знаниями по истории России.";
            break;
        case ($correct >= 1 && $correct < 3):
            $result = "Неплохо! Вам стоит немного повторить материал по истории России.";
            break;
        default:
            $result = "К сожалению, ваши знания по истории России не достаточны. Попробуйте пройти тест еще раз.";
    }

    echo "<h2>Результаты тестирования</h2>";
    echo "<p>Имя: $name</p>";
    echo "<p>Количество правильных ответов: $correct из 6</p>";
    echo "<p>$result</p>";
?>

