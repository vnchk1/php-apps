<?php
date_default_timezone_set('Europe/Moscow');
define('APP_BOOTSTRAPPED', true);

$allowedPages = array('view', 'add', 'edit', 'delete');
$allowedSorts = array('added', 'last_name', 'birth_date');

$page = $_GET['p'] ?? 'view';
if (!in_array($page, $allowedPages, true)) {
    $page = 'view';
}

$sort = $_GET['sort'] ?? 'added';
if (!in_array($sort, $allowedSorts, true)) {
    $sort = 'added';
}

$pageNumber = isset($_GET['page']) ? max(0, (int) $_GET['page']) : 0;

require_once __DIR__ . '/storage.php';
require_once __DIR__ . '/menu.php';

switch ($page) {
    case 'add':
        require_once __DIR__ . '/add.php';
        $content = lab9_render_add();
        break;
    case 'edit':
        require_once __DIR__ . '/edit.php';
        $content = lab9_render_edit();
        break;
    case 'delete':
        require_once __DIR__ . '/delete.php';
        $content = lab9_render_delete();
        break;
    case 'view':
    default:
        require_once __DIR__ . '/viewer.php';
        $content = lab9_render_viewer($sort, $pageNumber);
        break;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ЛР9. Записная книжка</title>
    <link rel="stylesheet" href="styles.css?v=2">
</head>
<body>
    <header>
        <img src="logo.jpg" alt="Логотип университета" class="logo">
        <h1>
            Червяков Иван Алексеевич<br>
            Группа 241-352<br>
            Лабораторная работа №9
        </h1>
        <div class="header-meta">
            <span>Хранилище: <?php echo lab9_h(lab9_storage_mode() === 'sqlite' ? 'SQLite' : 'JSON'); ?></span>
            <span><?php echo date('d.m.Y H:i:s'); ?></span>
        </div>
    </header>

    <main>
        <div class="lab-content">
            <h2>Записная книжка</h2>
            <p class="subtitle">Модульная PHP-структура с просмотром, добавлением, редактированием и удалением записей.</p>

            <?php echo lab9_render_menu($page, $sort); ?>
            <?php echo $content; ?>
        </div>
    </main>

    <footer>
        Тип верстки: фиксированная + адаптивная
    </footer>
</body>
</html>