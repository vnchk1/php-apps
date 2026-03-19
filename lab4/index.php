<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Червяков Иван Алексеевич — Группа 241-352 — Лабораторная работа №4</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
            background-color: #fafafa;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            display: flex;
            align-items: center; 
            gap: 15px;             
            padding: 15px 20px;
            background-color: #ffffff;
            border-bottom: 1px solid #e0e0e0;
            flex-wrap: wrap;    
        }

        .logo {
            width: 100px;          
            height: auto;
            border-radius: 4px;
        }

        header h1 {
            font-size: 1rem;       
            font-weight: 400;
            line-height: 1.5;
            color: #222;
            letter-spacing: 0.2px;
        }

        main {
            flex: 1;
            padding: 30px 20px;
            background-color: #f5f5f5;
            border: 1px dashed #b0b0b0;
            margin: 20px;
            border-radius: 12px;
            display: block;
            font-size: 1rem;
            color: #3a3a3a;
        }

        table {
            border-collapse: collapse;
            margin-bottom: 20px;
            background: #fff;
        }

        td {
            border: 1px solid #999;
            padding: 6px 10px;
        }

        h2 {
            margin: 15px 0 10px;
        }

        footer {
            padding: 12px 20px;
            background-color: #ffffff;
            border-top: 1px solid #e0e0e0;
            font-size: 0.9rem;
            color: #4f4f4f;
            text-align: center;
        }
    </style>
</head>
<body>

<header>
    <img src="logo.jpg" alt="Логотип университета" class="logo">
    <h1>
        Червяков Иван Алексеевич<br>
        Группа 241-352<br>
        Лабораторная работа №4
    </h1>
</header>

<main>

<?php

$cols = 3; // количество колонок

// массив структур
$structures = array(
    'A*B*C#D*E*F',
    '1*2#3*4*5*6',
    'X*Y*Z',
    'Q*W*E#R*T',
    '',
    '#',
    'AA*BB*CC#',
    '11*22*33#44*55',
    'K*L*M*N',
    'P'
);

// функция строки
function getTR($data, $cols)
{
    $cells = explode('*', $data);

    // если строка пустая
    if (count($cells) == 1 && trim($cells[0]) == '') {
        return '';
    }

    $ret = '<tr>';

    for ($i = 0; $i < $cols; $i++) {
        if (isset($cells[$i]) && $cells[$i] !== '') {
            $ret .= '<td>' . $cells[$i] . '</td>';
        } else {
            $ret .= '<td></td>'; // пустая ячейка
        }
    }

    $ret .= '</tr>';

    return $ret;
}

// функция таблицы
function outTable($structure, $cols, $num)
{
    echo "<h2>Таблица №$num</h2>";

    // проверка колонок
    if ($cols <= 0) {
        echo "Неправильное число колонок<br>";
        return;
    }

    // проверка структуры
    if ($structure === '') {
        echo "В таблице нет строк<br>";
        return;
    }

    $strings = explode('#', $structure);

    if (count($strings) == 0) {
        echo "В таблице нет строк<br>";
        return;
    }

    $rowsHTML = '';

    for ($i = 0; $i < count($strings); $i++) {
        $row = getTR($strings[$i], $cols);
        if ($row != '') {
            $rowsHTML .= $row;
        }
    }

    if ($rowsHTML == '') {
        echo "В таблице нет строк с ячейками<br>";
        return;
    }

    echo "<table>$rowsHTML</table>";
}

// вывод всех таблиц
for ($i = 0; $i < count($structures); $i++) {
    outTable($structures[$i], $cols, $i + 1);
}

?>

</main>

<footer>
    Тип верстки: блочная
</footer>

</body>
</html>