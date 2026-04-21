<?php
if (!defined('APP_BOOTSTRAPPED')) {
    exit('Прямой доступ к модулю запрещен.');
}

function lab9_render_edit()
{
    $contacts = lab9_sort_contacts(lab9_read_contacts(), 'last_name');
    $message = '';
    $messageClass = '';

    if (!$contacts) {
        return '<section class="content-card"><h2>Редактирование записи</h2><p>В записной книжке пока нет контактов.</p></section>';
    }

    $selectedId = isset($_GET['id']) ? (int) $_GET['id'] : (int) $contacts[0]['id'];
    $selected = lab9_get_contact($selectedId);
    if ($selected === null) {
        $selected = $contacts[0];
        $selectedId = (int) $selected['id'];
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_GET['p'] ?? '') === 'edit') {
        $postedId = isset($_GET['id']) ? (int) $_GET['id'] : $selectedId;
        list($candidate, $errors) = lab9_validate_contact_input($_POST);
        $existing = lab9_get_contact($postedId);

        if ($existing === null) {
            $message = 'Запись для редактирования не найдена.';
            $messageClass = 'error';
        } elseif ($errors) {
            $message = implode(' ', $errors);
            $messageClass = 'error';
            $candidate['id'] = $existing['id'];
            $candidate['added_at'] = $existing['added_at'];
            $selected = $candidate;
            $selectedId = $postedId;
        } else {
            $candidate['id'] = $existing['id'];
            $candidate['added_at'] = $existing['added_at'];
            $ok = lab9_update_contact($postedId, $candidate);
            $message = $ok ? 'Запись успешно обновлена.' : 'Ошибка: запись не обновлена.';
            $messageClass = $ok ? 'success' : 'error';
            $selected = lab9_get_contact($postedId) ?: $candidate;
            $selectedId = $postedId;
        }
    }

    ob_start();
    ?>
    <section class="content-card">
        <h2>Редактирование записи</h2>
        <div class="record-list">
            <?php foreach ($contacts as $contact): ?>
                <a href="?p=edit&id=<?php echo (int) $contact['id']; ?>" class="<?php echo (int) $contact['id'] === $selectedId ? 'active' : ''; ?>">
                    <?php echo lab9_h(lab9_full_name($contact)); ?>
                </a>
            <?php endforeach; ?>
        </div>

        <?php if ($message !== ''): ?>
            <p class="status <?php echo $messageClass; ?>"><?php echo lab9_h($message); ?></p>
        <?php endif; ?>

        <?php echo lab9_render_contact_form('edit&id=' . $selectedId, $selected, 'Сохранить изменения'); ?>
    </section>
    <?php
    return ob_get_clean();
}
