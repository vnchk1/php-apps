<?php
date_default_timezone_set('Europe/Moscow');

function h($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function formatNumber($value)
{
    if ((float) ((int) $value) === (float) $value) {
        return (string) ((int) $value);
    }
    return rtrim(rtrim(number_format((float) $value, 6, '.', ''), '0'), '.');
}

function formatArrayState(array $arr)
{
    $result = array();
    foreach ($arr as $index => $value) {
        $result[] = $index . ': ' . formatNumber($value);
    }
    return implode(' | ', $result);
}

function getPostedElements()
{
    $elements = array();
    foreach ($_POST as $key => $value) {
        if (preg_match('/^element(\d+)$/', $key, $matches)) {
            $elements[(int) $matches[1]] = trim((string) $value);
        }
    }
    ksort($elements);
    return array_values($elements);
}

function isNumberString($value)
{
    return preg_match('/^-?\d+(?:[.,]\d+)?$/', $value) === 1;
}

function normalizeNumber($value)
{
    return (float) str_replace(',', '.', $value);
}

function algorithmName($algorithm)
{
    $names = array(
        'selection' => 'Сортировка выбором',
        'bubble' => 'Пузырьковая сортировка',
        'shell' => 'Алгоритм Шелла',
        'gnome' => 'Гномья сортировка',
        'quick' => 'Быстрая сортировка',
        'native' => 'Встроенная сортировка PHP'
    );
    return $names[$algorithm] ?? 'Неизвестный алгоритм';
}

function addLog(&$logs, &$counter, array $arr, $note)
{
    $counter++;
    $logs[] = array(
        'step' => $counter,
        'state' => formatArrayState($arr),
        'note' => $note
    );
}


function selectionSort(array $arr)
{
    $logs = array();
    $counter = 0;
    $count = count($arr);

    if ($count <= 1) {
        addLog($logs, $counter, $arr, 'Массив уже отсортирован.');
        return array($arr, $logs, $counter);
    }

    for ($i = 0; $i < $count - 1; $i++) {
        $minIndex = $i;
        for ($j = $i + 1; $j < $count; $j++) {
            if ($arr[$j] < $arr[$minIndex]) {
                $minIndex = $j;
            }
            addLog($logs, $counter, $arr, 'Поиск минимального элемента для позиции ' . $i . '.');
        }

        if ($minIndex !== $i) {
            $tmp = $arr[$i];
            $arr[$i] = $arr[$minIndex];
            $arr[$minIndex] = $tmp;
            addLog($logs, $counter, $arr, 'Перестановка элементов ' . $i . ' и ' . $minIndex . '.');
        }
    }

    return array($arr, $logs, $counter);
}

function bubbleSort(array $arr)
{
    $logs = array();
    $counter = 0;
    $count = count($arr);

    if ($count <= 1) {
        addLog($logs, $counter, $arr, 'Массив уже отсортирован.');
        return array($arr, $logs, $counter);
    }

    for ($i = 0; $i < $count - 1; $i++) {
        $swapped = false;
        for ($j = 0; $j < $count - $i - 1; $j++) {
            if ($arr[$j] > $arr[$j + 1]) {
                $tmp = $arr[$j];
                $arr[$j] = $arr[$j + 1];
                $arr[$j + 1] = $tmp;
                $swapped = true;
                addLog($logs, $counter, $arr, 'Обмен элементов ' . $j . ' и ' . ($j + 1));
            } else {
                addLog($logs, $counter, $arr, 'Сравнение элементов ' . $j . ' и ' . ($j + 1));
            }
        }
        if (!$swapped) break;
    }

    return array($arr, $logs, $counter);
}

function shellSort(array $arr)
{
    $logs = array();
    $counter = 0;
    $count = count($arr);

    for ($gap = floor($count / 2); $gap > 0; $gap = floor($gap / 2)) {
        for ($i = $gap; $i < $count; $i++) {
            $temp = $arr[$i];
            $j = $i;

            while ($j >= $gap && $arr[$j - $gap] > $temp) {
                $arr[$j] = $arr[$j - $gap];
                $j -= $gap;
                addLog($logs, $counter, $arr, 'Сдвиг элемента');
            }

            $arr[$j] = $temp;
            addLog($logs, $counter, $arr, 'Вставка элемента');
        }
    }

    return array($arr, $logs, $counter);
}

function gnomeSort(array $arr)
{
    $logs = array();
    $counter = 0;
    $index = 0;

    while ($index < count($arr)) {
        if ($index == 0 || $arr[$index] >= $arr[$index - 1]) {
            $index++;
        } else {
            $tmp = $arr[$index];
            $arr[$index] = $arr[$index - 1];
            $arr[$index - 1] = $tmp;
            addLog($logs, $counter, $arr, 'Перестановка элементов');
            $index--;
        }
    }

    return array($arr, $logs, $counter);
}

function quickSortRecursive(&$arr, $left, $right, &$logs, &$counter)
{
    if ($left >= $right) return;

    $i = $left;
    $j = $right;
    $pivot = $arr[floor(($left + $right) / 2)];

    while ($i <= $j) {
        while ($arr[$i] < $pivot) $i++;
        while ($arr[$j] > $pivot) $j--;

        if ($i <= $j) {
            [$arr[$i], $arr[$j]] = [$arr[$j], $arr[$i]];
            addLog($logs, $counter, $arr, 'Разделение массива');
            $i++; $j--;
        }
    }

    quickSortRecursive($arr, $left, $j, $logs, $counter);
    quickSortRecursive($arr, $i, $right, $logs, $counter);
}

function quickSortWithLogs(array $arr)
{
    $logs = array();
    $counter = 0;
    quickSortRecursive($arr, 0, count($arr) - 1, $logs, $counter);
    return array($arr, $logs, $counter);
}

function nativeSortWithLogs(array $arr)
{
    $logs = array();
    $counter = 0;

    addLog($logs, $counter, $arr, 'До сортировки');
    sort($arr);
    addLog($logs, $counter, $arr, 'После sort()');

    return array($arr, $logs, $counter);
}


$algorithm = $_POST['algorithm'] ?? 'selection';
$raw = getPostedElements();

$errors = [];
$normalized = [];

foreach ($raw as $i => $v) {
    if ($v === '' || !isNumberString($v)) {
        $errors[] = "Ошибка в элементе $i";
    } else {
        $normalized[] = normalizeNumber($v);
    }
}

$logs = [];
$sorted = [];
$iterations = 0;

if (!$errors && $raw) {
    switch ($algorithm) {
        case 'bubble':
            [$sorted, $logs, $iterations] = bubbleSort($normalized);
            break;
        case 'shell':
            [$sorted, $logs, $iterations] = shellSort($normalized);
            break;
        case 'gnome':
            [$sorted, $logs, $iterations] = gnomeSort($normalized);
            break;
        case 'quick':
            [$sorted, $logs, $iterations] = quickSortWithLogs($normalized);
            break;
        case 'native':
            [$sorted, $logs, $iterations] = nativeSortWithLogs($normalized);
            break;
        default:
            [$sorted, $logs, $iterations] = selectionSort($normalized);
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<title>Результат сортировки</title>

<style>
body {
    font-family: system-ui;
    background:#fafafa;
    margin:0;
}

header, footer {
    padding:15px;
    background:#fff;
    border-bottom:1px solid #ddd;
}

main {
    padding:20px;
    margin:20px;
    border:1px dashed #aaa;
    border-radius:10px;
    background:#f5f5f5;
}

.container{
    max-width:900px;
    margin:0 auto;
}

table{
    width:100%;
    border-collapse: collapse;
}

td, th{
    border:1px solid #ccc;
    padding:6px;
}
</style>
</head>

<body>

<header>
    <h1><?=h(algorithmName($algorithm))?></h1>
</header>

<main>
<div class="container">

<h2>Исходный массив</h2>
<p><?=h(implode(', ', $raw))?></p>

<?php if($errors): ?>
<p style="color:red"><?=implode(', ', $errors)?></p>
<?php else: ?>

<h2>Ход алгоритма</h2>
<table>
<tr><th>Шаг</th><th>Состояние</th><th>Комментарий</th></tr>

<?php foreach($logs as $log): ?>
<tr>
<td><?=$log['step']?></td>
<td><?=$log['state']?></td>
<td><?=$log['note']?></td>
</tr>
<?php endforeach; ?>

</table>

<h2>Результат</h2>
<p><?=implode(', ', array_map('formatNumber',$sorted))?></p>
<p>Итераций: <?=$iterations?></p>

<div style="margin-top:20px;">
    <a href="index.php">
        <button type="button" style="padding:8px 16px; cursor:pointer; border-radius:4px; border:1px solid #ccc; background:#fff;">
            Вернуться на главную
        </button>
    </a>
</div>

<?php endif; ?>

</div>
</main>

<footer>
Тип верстки: адаптивная
</footer>

</body>
</html>