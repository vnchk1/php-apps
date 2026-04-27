<?php
date_default_timezone_set('Europe/Moscow');
session_start();

function h($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function formatNumber($value)
{
    if ((float) ((int) $value) === (float) $value) {
        return (string) ((int) $value);
    }

    return rtrim(rtrim(number_format((float) $value, 10, '.', ''), '0'), '.');
}

function skipSpaces($expression, &$position)
{
    $length = strlen($expression);
    while ($position < $length && ctype_space($expression[$position])) {
        $position++;
    }
}

function parseNumber($expression, &$position)
{
    skipSpaces($expression, $position);
    $length = strlen($expression);
    $start = $position;
    $hasDigits = false;
    $hasPoint = false;

    while ($position < $length) {
        $char = $expression[$position];
        if ($char >= '0' && $char <= '9') {
            $hasDigits = true;
            $position++;
            continue;
        }

        if ($char === '.') {
            if ($hasPoint) {
                throw new RuntimeException('Неверная запись числа: обнаружено несколько десятичных точек.');
            }
            $hasPoint = true;
            $position++;
            continue;
        }

        break;
    }

    $number = substr($expression, $start, $position - $start);
    if (!$hasDigits || $number === '' || $number === '.') {
        throw new RuntimeException('Ожидалось число.');
    }

    if ($number[0] === '.' || substr($number, -1) === '.') {
        throw new RuntimeException('Число не может начинаться или заканчиваться точкой.');
    }

    return (float) $number;
}

function parseFactor($expression, &$position)
{
    skipSpaces($expression, $position);
    $length = strlen($expression);

    if ($position >= $length) {
        throw new RuntimeException('Выражение неожиданно закончилось.');
    }

    $char = $expression[$position];

    if ($char === '+') {
        $position++;
        return parseFactor($expression, $position);
    }

    if ($char === '-') {
        $position++;
        return -parseFactor($expression, $position);
    }

    if ($char === '(') {
        $position++;
        $value = parseExpression($expression, $position);
        skipSpaces($expression, $position);
        if ($position >= $length || $expression[$position] !== ')') {
            throw new RuntimeException('Не найдена закрывающая скобка.');
        }
        $position++;
        return $value;
    }

    return parseNumber($expression, $position);
}

function parseTerm($expression, &$position)
{
    $value = parseFactor($expression, $position);
    $length = strlen($expression);

    while (true) {
        skipSpaces($expression, $position);
        if ($position >= $length) {
            return $value;
        }

        $char = $expression[$position];
        if ($char !== '*' && $char !== '/' && $char !== ':') {
            return $value;
        }

        $position++;
        $right = parseFactor($expression, $position);

        if (($char === '/' || $char === ':') && abs($right) < 1e-12) {
            throw new RuntimeException('Деление на ноль невозможно.');
        }

        if ($char === '*') {
            $value *= $right;
        } else {
            $value /= $right;
        }
    }
}

function parseExpression($expression, &$position)
{
    $value = parseTerm($expression, $position);
    $length = strlen($expression);

    while (true) {
        skipSpaces($expression, $position);
        if ($position >= $length) {
            return $value;
        }

        $char = $expression[$position];
        if ($char !== '+' && $char !== '-') {
            return $value;
        }

        $position++;
        $right = parseTerm($expression, $position);

        if ($char === '+') {
            $value += $right;
        } else {
            $value -= $right;
        }
    }
}

function calculateExpression($expression)
{
    $expression = trim(str_replace(',', '.', $expression));

    if ($expression === '') {
        throw new RuntimeException('Выражение не задано.');
    }

    if (!preg_match('/^[0-9+\-*\/:().\s]+$/', $expression)) {
        throw new RuntimeException('В выражении присутствуют недопустимые символы.');
    }

    $position = 0;
    $result = parseExpression($expression, $position);
    skipSpaces($expression, $position);

    if ($position !== strlen($expression)) {
        throw new RuntimeException('Нарушена структура арифметического выражения.');
    }

    return $result;
}

if (!isset($_SESSION['history']) || !is_array($_SESSION['history'])) {
    $_SESSION['history'] = array();
}

if (isset($_SESSION['pending'])) {
    array_unshift($_SESSION['history'], $_SESSION['pending']);
    $_SESSION['history'] = array_slice($_SESSION['history'], 0, 15);
    unset($_SESSION['pending']);
}

$expression = '';
$currentResult = null;
$currentClass = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $expression = trim((string) ($_POST['val'] ?? ''));

    try {
        $value = calculateExpression($expression);
        $currentResult = 'Значение выражения: ' . formatNumber($value);
        $currentClass = 'success';
    } catch (Throwable $e) {
        $currentResult = 'Ошибка вычисления выражения: ' . $e->getMessage();
        $currentClass = 'error';
    }

    $_SESSION['pending'] = array(
        'expression' => $expression,
        'result' => $currentResult
    );
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ЛР10. Калькулятор</title>
    <link rel="stylesheet" href="styles.css?v=1">
</head>
<body>
    <header>
        <img src="logo.jpg" alt="Логотип университета" class="logo">
        <h1>
            Червяков Иван Алексеевич<br>
            Группа 241-352<br>
            Лабораторная работа №10
        </h1>
    </header>

    <main>
        <div class="calculator-container">
            <div class="panel">
                <h2>Калькулятор</h2>
                <p class="subtitle">Поддерживаются целые числа, десятичные дроби, операции <code>+</code>, <code>-</code>, <code>*</code>, <code>/</code>, <code>:</code> и скобки.</p>

                <?php if ($currentResult !== null): ?>
                    <div class="result-box <?php echo h($currentClass); ?>">
                        <?php echo h($currentResult); ?>
                    </div>
                <?php endif; ?>

                <form method="post" action="" class="lab-form">
                    <label class="form-row">
                        <span>Введите выражение</span>
                        <input type="text" name="val" value="<?php echo h($expression); ?>" placeholder="Например: (12.5-2)*3+7/2">
                    </label>
                    <button type="submit">Вычислить</button>
                </form>
            </div>

            <div class="panel history-panel">
                <h2>История вычислений</h2>
                <?php if (!$_SESSION['history']): ?>
                    <p>История пока пуста.</p>
                <?php else: ?>
                    <div class="history-list">
                        <?php foreach ($_SESSION['history'] as $item): ?>
                            <div class="history-item">
                                <strong><?php echo h($item['expression']); ?></strong>
                                <span><?php echo h($item['result']); ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <footer>
        Тип верстки: фиксированная + адаптивная
    </footer>
</body>
</html>