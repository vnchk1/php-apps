<?php
if (!defined('APP_BOOTSTRAPPED')) {
    exit('Прямой доступ к модулю запрещен.');
}

function lab9_render_viewer($sort, $page)
{
    $contacts = lab9_sort_contacts(lab9_read_contacts(), $sort);
    $perPage = 10;
    $total = count($contacts);
    $pages = max(1, (int) ceil($total / $perPage));
    $page = max(0, min($page, $pages - 1));
    $slice = array_slice($contacts, $page * $perPage, $perPage);

    $sortTitle = array(
        'added' => 'по порядку добавления',
        'last_name' => 'по фамилии',
        'birth_date' => 'по дате рождения'
    );

    ob_start();
    ?>
    <section class="content-card">
        <h2>Содержимое записной книжки</h2>
        <p>Текущий режим сортировки: <strong><?php echo lab9_h($sortTitle[$sort] ?? $sortTitle['added']); ?></strong>.</p>

        <table class="contacts-table">
            <thead>
                <tr>
                    <th>ФИО</th>
                    <th>Пол</th>
                    <th>Дата рождения</th>
                    <th>Телефон</th>
                    <th>Адрес</th>
                    <th>E-mail</th>
                    <th>Комментарий</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($slice as $contact): ?>
                    <tr>
                        <td><?php echo lab9_h(lab9_full_name($contact)); ?></td>
                        <td><?php echo lab9_h($contact['gender']); ?></td>
                        <td><?php echo lab9_h(lab9_format_date($contact['birth_date'])); ?></td>
                        <td><?php echo lab9_h($contact['phone']); ?></td>
                        <td><?php echo lab9_h($contact['address']); ?></td>
                        <td><?php echo lab9_h($contact['email']); ?></td>
                        <td><?php echo lab9_h($contact['comment']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php if ($pages > 1): ?>
            <div class="pagination">
                <?php for ($i = 0; $i < $pages; $i++): ?>
                    <a href="?p=view&sort=<?php echo lab9_h($sort); ?>&page=<?php echo $i; ?>" class="<?php echo $i === $page ? 'active' : ''; ?>">
                        <?php echo $i + 1; ?>
                    </a>
                <?php endfor; ?>
            </div>
        <?php endif; ?>
    </section>
    <?php
    return ob_get_clean();
}
