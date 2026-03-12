<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Червяков Иван Алексеевич — Группа 241-352 — Лабораторная работа №2</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <img src="logo.jpg" alt="Логотип университета" class="logo">
    <h1>
        Червяков Иван Алексеевич<br>
        Группа 241-352<br>
        Лабораторная работа №2<br>
        Вариант №8
    </h1>
</header>

<main>

<?php


$x = -5;              
$encounting = 30;     
$step = 1;            
$type = 'D';          

$min_value = -1000;   
$max_value = 1000;    


$sum = 0;
$count = 0;
$min = null;
$max = null;

# начало верстки

switch($type) {
    case 'B':
        echo "<ul>";
        break;
    case 'C':
        echo "<ol>";
        break;
    case 'D':
        echo "<table>";
        echo "<tr><th>№</th><th>x</th><th>f(x)</th></tr>";
        break;
}



for($i = 0; $i < $encounting; $i++, $x += $step) {

    if($x <= 10) {
        $f = 7*$x + 18;
    }
    elseif($x < 20) {

        if((8 - $x*0.5) == 0) {
            $f = "error";
        } else {
            $f = ($x - 17)/(8 - $x*0.5);
        }

    }
    else {
        $f = ($x + 4)*($x - 7);
    }

# вычисление статистики

    if($f !== "error") {

        $f = round($f, 3);

        if($f >= $max_value || $f <= $min_value)
            break;

        $sum += $f;
        $count++;

        if($min === null || $f < $min) $min = $f;
        if($max === null || $f > $max) $max = $f;
    }

# вывод

    switch($type) {

        case 'A':
            echo "f($x)=$f<br>";
            break;

        case 'B':
            echo "<li>f($x)=$f</li>";
            break;

        case 'C':
            echo "<li>f($x)=$f</li>";
            break;

        case 'D':
            echo "<tr>";
            echo "<td>".($i+1)."</td>";
            echo "<td>$x</td>";
            echo "<td>$f</td>";
            echo "</tr>";
            break;

        case 'E':
            echo "<div class='block-item'>f($x)=$f</div>";
            break;
    }
}

# закрытие тегов

switch($type) {
    case 'B':
        echo "</ul>";
        break;
    case 'C':
        echo "</ol>";
        break;
    case 'D':
        echo "</table>";
        break;
}

# статистика

if($count > 0) {
    $average = round($sum / $count, 3);
    echo "<hr>";
    echo "<p>Сумма: $sum</p>";
    echo "<p>Минимум: $min</p>";
    echo "<p>Максимум: $max</p>";
    echo "<p>Среднее арифметическое: $average</p>";
}

?>

</main>

<footer>
    Тип верстки: <?php echo $type; ?>
</footer>

</body>
</html>
