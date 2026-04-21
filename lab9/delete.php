<?php
if (!defined('APP_BOOTSTRAPPED')) {
    exit('Прямой доступ к модулю запрещен.');
}

function lab9_render_delete()
{
    $message = '';
    $messageClass = '';

    if (isset($_GET['delete_id'])) {
        $contact = lab9_get_contact((int) $_GET['delete_id']);
        if ($contact !== null && lab9_delete_contact((int) $_GET['delete_id'])) {
            $message = 'Запись с фамилией ' . $contact['last_name'] . ' удалена.';
            $messageClass = 'success';
        } else {
            $message = 'Ошибка: запись не удалена.';
            $messageClass = 'error';
        }
    }

    $contacts = lab9_sort_contacts(lab9_read_contacts(), 'last_name');

    ob_start();
    ?>
    <section class="content-card">
        <h2>Удаление записи</h2>

        <?php if ($message !== ''): ?>
            <p class="status <?php echo $messageClass; ?>"><?php echo lab9_h($message); ?></p>
        <?php endif; ?>

        <?php if (!$contacts): ?>
            <p>В записной книжке нет записей для удаления.</p>
        <?php else: ?>
            <div class="record-list delete-list">
                <?php foreach ($contacts as $contact): ?>
                    <a href="?p=delete&delete_id=<?php echo (int) $contact['id']; ?>">
                        <?php echo lab9_h(lab9_short_name($contact)); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>
    <?php
    return ob_get_clean();
}
