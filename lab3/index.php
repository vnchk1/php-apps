<?php
// Инициализация хранилища
$store = isset($_GET['store']) ? $_GET['store'] : '';
$clicks = isset($_GET['clicks']) ? intval($_GET['clicks']) : 0;


// Обработка нажатой кнопки
if (isset($_GET['key'])) {
    if ($_GET['key'] === 'reset') {
        $store = ''; // очищаем только результат
    } else {
        $store .= $_GET['key'];
        $clicks++; 
    }
}


// Функция генерации кнопки
function button($num, $store, $clicks) {
    $link = "index.php?key={$num}&store=" . urlencode($store) . "&clicks={$clicks}";
    return "<a href='{$link}' class='btn'>{$num}</a>";
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<title>Червяков Иван Алексеевич — Группа 241-352 — Лабораторная работа №3</title>
<link rel="stylesheet" href="styles.css">

<style>

header {
    text-align: center;
    margin-bottom: 20px;
}

.logo {
    width: 80px;
    height: auto;
}

header h1 {
    font-size: 18px;
    font-weight: normal;
    margin-top: 10px;
    line-height: 1.4;
}

.calculator {
    width: 250px;
    margin: 40px auto;
}

.result {
    width: 100%;
    height: 50px;
    border: 2px solid #333;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 24px;
    background-color: #f0f0f0;
    margin-bottom: 10px;
}

.row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
}

.btn {
    display: inline-block;
    width: 40px;
    height: 40px;
    line-height: 40px;
    text-decoration: none;
    color: white;
    background-color: #08a100;
    border-radius: 5px;
    font-weight: bold;
    text-align: center;
}

.btn:hover {
    background-color: #056a00;
}

.reset {
    display: inline-block;
    width: 100%;
    height: 40px;
    line-height: 40px;
    text-decoration: none;
    color: white;
    background-color: #dc3545;
    border-radius: 5px;
    font-weight: bold;
    text-align: center;
}

.reset:hover {
    background-color: #a71d2a;
}

.footer-counter {
    text-align: center;
    margin-top: 15px;
    font-size: 16px;
}

</style>
</head>

<body>

<header>
    <img src="logo.jpg" alt="Логотип университета" class="logo">
    <h1>
        Червяков Иван Алексеевич<br>
        Группа 241-352<br>
        Лабораторная работа №3
    </h1>
</header>

<main>

<div class="calculator">

    <!-- Окно просмотра результата -->
    <div class="result">
        <?php echo htmlspecialchars($store); ?>
    </div>

    <!-- Первая строка цифр 1–5 -->
    <div class="row">
        <?php
        for ($i = 1; $i <= 5; $i++) {
            echo button($i, $store, $clicks);
        }
        ?>
    </div>

    <!-- Вторая строка цифр 6–0 -->
    <div class="row">
        <?php
        for ($i = 6; $i <= 9; $i++) {
            echo button($i, $store, $clicks);
        }
        echo button(0, $store, $clicks);
        ?>
    </div>

    <!-- Кнопка СБРОС -->
    <div class="row">
        <a href="index.php?key=reset&store=&clicks=<?php echo $clicks; ?>" class="reset">СБРОС</a>
    </div>

    <!-- Счетчик нажатий -->
    <div class="footer-counter">
        Общее число нажатий: <?php echo $clicks; ?>
    </div>

</div>

</main>

<footer>
    Тип верстки: блочная (Flexbox)
</footer>

</body>
</html>