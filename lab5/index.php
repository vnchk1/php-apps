<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Червяков Иван Алексеевич — Группа 241-352 — Лабораторная работа №5</title>
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
        }

        main {
            flex: 1;
            padding: 20px;
            background-color: #f5f5f5;
            margin: 20px;
            border-radius: 12px;
            display: flex;
        }

        footer {
            padding: 12px 20px;
            background-color: #ffffff;
            border-top: 1px solid #e0e0e0;
            font-size: 0.9rem;
            text-align: center;
        }

        /* меню*/
        #top_menu a {
            margin-right: 15px;
            text-decoration: none;
            color: black;
        }

        #side_menu {
            width: 220px;
        }

        #side_menu a {
            display: block;
            margin-bottom: 8px;
            text-decoration: none;
            color: black;
        }

        .selected {
            font-weight: bold;
            color: blue;
        }

        /* таблица */
        table {
            border-collapse: collapse;
        }

        td {
            border: 1px solid #ccc;
            padding: 5px 10px;
        }

        .ttRow {
            display: flex;
        }

        .ttColumn {
            margin-right: 15px;
        }

        .ttSingleRow {
            font-size: 1.4rem;
        }
    </style>
</head>
<body>

<header>
    <img src="logo.jpg" alt="Логотип" class="logo">
    <h1>
        Червяков Иван Алексеевич<br>
        Группа 241-352<br>
        Лабораторная работа №5
    </h1>
</header>

<?php

// число как ссылка (сбрасывает html_type!)
function outNumAsLink($x) {
    if ($x <= 9) {
        return '<a href="?content='.$x.'">'.$x.'</a>';
    }
    return $x;
}

// вывод столбца
function outRow($n) {
    for ($i = 2; $i <= 9; $i++) {
        echo outNumAsLink($n).'x'.outNumAsLink($i).'='.outNumAsLink($n*$i).'<br>';
    }
}
?>

<main>

<div style="width:100%">

<!-- ГЛАВНОЕ МЕНЮ -->
<div id="top_menu">
<?php
echo '<a href="?html_type=TABLE';
if (isset($_GET['content'])) echo '&content='.$_GET['content'];
echo '"';
if (isset($_GET['html_type']) && $_GET['html_type']=='TABLE') echo ' class="selected"';
echo '>Табличная верстка</a>';

echo '<a href="?html_type=DIV';
if (isset($_GET['content'])) echo '&content='.$_GET['content'];
echo '"';
if (isset($_GET['html_type']) && $_GET['html_type']=='DIV') echo ' class="selected"';
echo '>Блочная верстка</a>';
?>
</div>

<div style="display:flex; margin-top:20px;">

<!-- ОСНОВНОЕ МЕНЮ -->
<div id="side_menu">
<?php
$link = '';
if (isset($_GET['html_type'])) {
    $link = '?html_type='.$_GET['html_type'];
}

// ВСЁ
echo '<a href="'.$link.'"';
if (!isset($_GET['content'])) echo ' class="selected"';
echo '>Всё</a>';

// 2-9
for ($i=2;$i<=9;$i++) {
    echo '<a href="'.$link.(empty($link)?'?':'&').'content='.$i.'"';
    if (isset($_GET['content']) && $_GET['content']==$i) echo ' class="selected"';
    echo '>'.$i.'</a>';
}
?>
</div>

<!-- ТАБЛИЦА -->
<div style="flex:1;">

<?php
$html = (!isset($_GET['html_type']) || $_GET['html_type']=='TABLE') ? 'TABLE' : 'DIV';
$content = isset($_GET['content']) ? $_GET['content'] : null;

if ($html == 'TABLE') {

    echo '<table>';

    if (!$content) {
        echo '<tr>';
        for ($i=2;$i<=9;$i++) {
            echo '<td>';
            outRow($i);
            echo '</td>';
        }
        echo '</tr>';
    } else {
        echo '<tr><td>';
        outRow($content);
        echo '</td></tr>';
    }

    echo '</table>';

} else {

    if (!$content) {
        echo '<div class="ttRow">';
        for ($i=2;$i<=9;$i++) {
            echo '<div class="ttColumn">';
            outRow($i);
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo '<div class="ttSingleRow">';
        outRow($content);
        echo '</div>';
    }
}
?>

</div>
</div>

</div>

</main>

<footer>
<?php
// информация
date_default_timezone_set('Europe/Moscow');
if (!isset($_GET['html_type']) || $_GET['html_type']=='TABLE')
    $s = 'Табличная верстка. ';
else
    $s = 'Блочная верстка. ';

if (!isset($_GET['content']))
    $s .= 'Полная таблица. ';
else
    $s .= 'Таблица на '.$_GET['content'].'. ';

echo $s.date('d.m.Y H:i:s');
?>
</footer>

</body>
</html>