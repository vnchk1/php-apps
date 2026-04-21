<?php
if (!defined('APP_BOOTSTRAPPED')) {
    exit('Прямой доступ к модулю запрещен.');
}

function lab9_render_menu($currentPage, $currentSort)
{
    $mainItems = array(
        'view' => 'Просмотр',
        'add' => 'Добавление записи',
        'edit' => 'Редактирование записи',
        'delete' => 'Удаление записи'
    );

    $sortItems = array(
        'added' => 'По добавлению',
        'last_name' => 'По фамилии',
        'birth_date' => 'По дате рождения'
    );

    $html = '<nav class="main-menu">';
    foreach ($mainItems as $key => $label) {
        $html .= '<a href="?p=' . $key . '"' . ($currentPage === $key ? ' class="active"' : '') . '>' . lab9_h($label) . '</a>';
    }
    $html .= '</nav>';

    if ($currentPage === 'view') {
        $html .= '<nav class="sub-menu">';
        foreach ($sortItems as $key => $label) {
            $html .= '<a href="?p=view&sort=' . $key . '"' . ($currentSort === $key ? ' class="active"' : '') . '>' . lab9_h($label) . '</a>';
        }
        $html .= '</nav>';
    }

    return $html;
}
