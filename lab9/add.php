<?php
if (!defined('APP_BOOTSTRAPPED')) {
    exit('Прямой доступ к модулю запрещен.');
}

function lab9_render_add()
{
    $message = '';
    $messageClass = '';
    $contact = lab9_empty_contact();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_GET['p'] ?? '') === 'add') {
        list($contact, $errors) = lab9_validate_contact_input($_POST);

        if ($errors) {
            $message = implode(' ', $errors);
            $messageClass = 'error';
        } else {
            $contact['added_at'] = date('Y-m-d H:i:s');
            $ok = lab9_add_contact($contact);
            $message = $ok ? 'Запись добавлена.' : 'Ошибка: запись не добавлена.';
            $messageClass = $ok ? 'success' : 'error';
            if ($ok) {
                $contact = lab9_empty_contact();
            }
        }
    }

    ob_start();
    ?>
    <section class="content-card">
        <h2>Добавление записи</h2>
        <?php if ($message !== ''): ?>
            <p class="status <?php echo $messageClass; ?>"><?php echo lab9_h($message); ?></p>
        <?php endif; ?>
        <?php echo lab9_render_contact_form('add', $contact, 'Добавить запись'); ?>
    </section>
    <?php
    return ob_get_clean();
}
