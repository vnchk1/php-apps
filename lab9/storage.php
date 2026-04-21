<?php
if (!defined('APP_BOOTSTRAPPED')) {
    exit('Прямой доступ к модулю запрещен.');
}

function lab9_h($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function lab9_data_dir()
{
    $dir = __DIR__ . DIRECTORY_SEPARATOR . 'data';
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
    return $dir;
}

function lab9_storage_mode()
{
    if (class_exists('PDO') && in_array('sqlite', PDO::getAvailableDrivers(), true)) {
        return 'sqlite';
    }
    return 'json';
}

function lab9_seed_contacts()
{
    return array(
        array('id' => 1, 'last_name' => 'Иванов', 'first_name' => 'Павел', 'middle_name' => 'Андреевич', 'gender' => 'Мужской', 'birth_date' => '1998-02-14', 'phone' => '+7 (903) 111-22-33', 'address' => 'Москва, ул. Новая, 15', 'email' => 'ivanov.pavel@example.com', 'comment' => 'Коллега по учебному проекту.', 'added_at' => '2026-03-01 09:10:00'),
        array('id' => 2, 'last_name' => 'Петрова', 'first_name' => 'Мария', 'middle_name' => 'Сергеевна', 'gender' => 'Женский', 'birth_date' => '2000-08-21', 'phone' => '+7 (916) 205-17-40', 'address' => 'Москва, пр-т Мира, 82', 'email' => 'petrova.maria@example.com', 'comment' => 'Организует встречи группы.', 'added_at' => '2026-03-01 09:18:00'),
        array('id' => 3, 'last_name' => 'Сидоров', 'first_name' => 'Илья', 'middle_name' => 'Петрович', 'gender' => 'Мужской', 'birth_date' => '1999-11-03', 'phone' => '+7 (925) 330-48-10', 'address' => 'Химки, Ленинский проспект, 6', 'email' => 'sidorov.ilya@example.com', 'comment' => 'Отвечает за оборудование.', 'added_at' => '2026-03-01 09:25:00'),
        array('id' => 4, 'last_name' => 'Орлова', 'first_name' => 'Екатерина', 'middle_name' => 'Дмитриевна', 'gender' => 'Женский', 'birth_date' => '2001-01-27', 'phone' => '+7 (985) 221-45-19', 'address' => 'Мытищи, ул. Садовая, 7', 'email' => 'orlova.ekaterina@example.com', 'comment' => 'Контакт по стажировке.', 'added_at' => '2026-03-01 09:32:00'),
        array('id' => 5, 'last_name' => 'Кузнецов', 'first_name' => 'Даниил', 'middle_name' => 'Олегович', 'gender' => 'Мужской', 'birth_date' => '1997-06-12', 'phone' => '+7 (977) 410-16-15', 'address' => 'Москва, ул. Большая Черемушкинская, 40', 'email' => 'kuznetsov.daniil@example.com', 'comment' => 'Помогает с серверной частью.', 'added_at' => '2026-03-01 09:40:00'),
        array('id' => 6, 'last_name' => 'Фомина', 'first_name' => 'Анна', 'middle_name' => 'Викторовна', 'gender' => 'Женский', 'birth_date' => '1998-12-30', 'phone' => '+7 (926) 807-14-22', 'address' => 'Королев, ул. Гагарина, 11', 'email' => 'fomina.anna@example.com', 'comment' => 'Редактор текстового контента.', 'added_at' => '2026-03-01 09:52:00'),
        array('id' => 7, 'last_name' => 'Лебедев', 'first_name' => 'Никита', 'middle_name' => 'Александрович', 'gender' => 'Мужской', 'birth_date' => '2002-04-18', 'phone' => '+7 (901) 610-33-54', 'address' => 'Москва, ул. Профсоюзная, 120', 'email' => 'lebedev.nikita@example.com', 'comment' => 'Участник спортивного клуба.', 'added_at' => '2026-03-01 10:01:00'),
        array('id' => 8, 'last_name' => 'Морозова', 'first_name' => 'Софья', 'middle_name' => 'Игоревна', 'gender' => 'Женский', 'birth_date' => '2000-03-09', 'phone' => '+7 (915) 712-55-08', 'address' => 'Москва, ул. Лесная, 14', 'email' => 'morozova.sofya@example.com', 'comment' => 'Координатор волонтерских проектов.', 'added_at' => '2026-03-01 10:16:00'),
        array('id' => 9, 'last_name' => 'Белов', 'first_name' => 'Григорий', 'middle_name' => 'Николаевич', 'gender' => 'Мужской', 'birth_date' => '1996-10-05', 'phone' => '+7 (968) 980-61-11', 'address' => 'Подольск, ул. Южная, 23', 'email' => 'belov.grigory@example.com', 'comment' => 'Консультант по базе данных.', 'added_at' => '2026-03-01 10:24:00'),
        array('id' => 10, 'last_name' => 'Зайцева', 'first_name' => 'Вероника', 'middle_name' => 'Романовна', 'gender' => 'Женский', 'birth_date' => '2001-07-15', 'phone' => '+7 (909) 210-99-31', 'address' => 'Москва, ул. Тверская, 19', 'email' => 'zaitseva.veronika@example.com', 'comment' => 'Контакт по дизайну интерфейсов.', 'added_at' => '2026-03-01 10:32:00'),
        array('id' => 11, 'last_name' => 'Ершов', 'first_name' => 'Максим', 'middle_name' => 'Леонидович', 'gender' => 'Мужской', 'birth_date' => '1999-09-29', 'phone' => '+7 (950) 773-15-44', 'address' => 'Балашиха, ул. Заречная, 2', 'email' => 'ershov.maxim@example.com', 'comment' => 'Курирует документацию.', 'added_at' => '2026-03-01 10:41:00'),
        array('id' => 12, 'last_name' => 'Романова', 'first_name' => 'Дарья', 'middle_name' => 'Павловна', 'gender' => 'Женский', 'birth_date' => '2002-05-24', 'phone' => '+7 (964) 501-64-28', 'address' => 'Люберцы, ул. Электрификации, 30', 'email' => 'romanova.daria@example.com', 'comment' => 'Организует публикацию новостей.', 'added_at' => '2026-03-01 10:56:00')
    );
}

function lab9_sqlite_path()
{
    return lab9_data_dir() . DIRECTORY_SEPARATOR . 'contacts.sqlite';
}

function lab9_json_path()
{
    return lab9_data_dir() . DIRECTORY_SEPARATOR . 'contacts.json';
}

function lab9_sqlite()
{
    static $pdo = null;
    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $pdo = new PDO('sqlite:' . lab9_sqlite_path());
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec('CREATE TABLE IF NOT EXISTS contacts (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        last_name TEXT NOT NULL,
        first_name TEXT NOT NULL,
        middle_name TEXT NOT NULL,
        gender TEXT NOT NULL,
        birth_date TEXT NOT NULL,
        phone TEXT NOT NULL,
        address TEXT NOT NULL,
        email TEXT NOT NULL,
        comment TEXT NOT NULL,
        added_at TEXT NOT NULL
    )');

    $count = (int) $pdo->query('SELECT COUNT(*) FROM contacts')->fetchColumn();
    if ($count === 0) {
        $stmt = $pdo->prepare('INSERT INTO contacts (last_name, first_name, middle_name, gender, birth_date, phone, address, email, comment, added_at)
            VALUES (:last_name, :first_name, :middle_name, :gender, :birth_date, :phone, :address, :email, :comment, :added_at)');
        foreach (lab9_seed_contacts() as $contact) {
            $stmt->execute(array(
                ':last_name' => $contact['last_name'],
                ':first_name' => $contact['first_name'],
                ':middle_name' => $contact['middle_name'],
                ':gender' => $contact['gender'],
                ':birth_date' => $contact['birth_date'],
                ':phone' => $contact['phone'],
                ':address' => $contact['address'],
                ':email' => $contact['email'],
                ':comment' => $contact['comment'],
                ':added_at' => $contact['added_at']
            ));
        }
    }

    return $pdo;
}

function lab9_read_contacts()
{
    if (lab9_storage_mode() === 'sqlite') {
        return lab9_sqlite()->query('SELECT * FROM contacts ORDER BY id ASC')->fetchAll(PDO::FETCH_ASSOC);
    }

    $path = lab9_json_path();
    if (!is_file($path)) {
        file_put_contents($path, json_encode(lab9_seed_contacts(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
    }

    $contacts = json_decode((string) file_get_contents($path), true);
    return is_array($contacts) ? $contacts : array();
}

function lab9_write_contacts(array $contacts)
{
    file_put_contents(lab9_json_path(), json_encode(array_values($contacts), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
}

function lab9_next_json_id(array $contacts)
{
    $max = 0;
    foreach ($contacts as $contact) {
        $max = max($max, (int) $contact['id']);
    }
    return $max + 1;
}

function lab9_add_contact(array $contact)
{
    if (lab9_storage_mode() === 'sqlite') {
        return lab9_sqlite()->prepare('INSERT INTO contacts (last_name, first_name, middle_name, gender, birth_date, phone, address, email, comment, added_at)
            VALUES (:last_name, :first_name, :middle_name, :gender, :birth_date, :phone, :address, :email, :comment, :added_at)')
            ->execute(array(
                ':last_name' => $contact['last_name'],
                ':first_name' => $contact['first_name'],
                ':middle_name' => $contact['middle_name'],
                ':gender' => $contact['gender'],
                ':birth_date' => $contact['birth_date'],
                ':phone' => $contact['phone'],
                ':address' => $contact['address'],
                ':email' => $contact['email'],
                ':comment' => $contact['comment'],
                ':added_at' => $contact['added_at']
            ));
    }

    $contacts = lab9_read_contacts();
    $contact['id'] = lab9_next_json_id($contacts);
    $contacts[] = $contact;
    lab9_write_contacts($contacts);
    return true;
}

function lab9_update_contact($id, array $contact)
{
    if (lab9_storage_mode() === 'sqlite') {
        return lab9_sqlite()->prepare('UPDATE contacts
            SET last_name = :last_name, first_name = :first_name, middle_name = :middle_name, gender = :gender,
                birth_date = :birth_date, phone = :phone, address = :address, email = :email, comment = :comment
            WHERE id = :id')
            ->execute(array(
                ':last_name' => $contact['last_name'],
                ':first_name' => $contact['first_name'],
                ':middle_name' => $contact['middle_name'],
                ':gender' => $contact['gender'],
                ':birth_date' => $contact['birth_date'],
                ':phone' => $contact['phone'],
                ':address' => $contact['address'],
                ':email' => $contact['email'],
                ':comment' => $contact['comment'],
                ':id' => (int) $id
            ));
    }

    $contacts = lab9_read_contacts();
    foreach ($contacts as &$item) {
        if ((int) $item['id'] === (int) $id) {
            $contact['id'] = $item['id'];
            $contact['added_at'] = $item['added_at'];
            $item = $contact;
            lab9_write_contacts($contacts);
            return true;
        }
    }

    return false;
}

function lab9_delete_contact($id)
{
    if (lab9_storage_mode() === 'sqlite') {
        return lab9_sqlite()->prepare('DELETE FROM contacts WHERE id = :id')->execute(array(':id' => (int) $id));
    }

    $contacts = lab9_read_contacts();
    $filtered = array();
    $deleted = false;
    foreach ($contacts as $contact) {
        if ((int) $contact['id'] === (int) $id) {
            $deleted = true;
            continue;
        }
        $filtered[] = $contact;
    }
    if ($deleted) {
        lab9_write_contacts($filtered);
    }
    return $deleted;
}

function lab9_get_contact($id)
{
    foreach (lab9_read_contacts() as $contact) {
        if ((int) $contact['id'] === (int) $id) {
            return $contact;
        }
    }
    return null;
}

function lab9_mb_lower($value)
{
    if (function_exists('mb_strtolower')) {
        return mb_strtolower($value, 'UTF-8');
    }

    return strtolower(strtr($value, array(
        'А' => 'а', 'Б' => 'б', 'В' => 'в', 'Г' => 'г', 'Д' => 'д', 'Е' => 'е', 'Ё' => 'ё',
        'Ж' => 'ж', 'З' => 'з', 'И' => 'и', 'Й' => 'й', 'К' => 'к', 'Л' => 'л', 'М' => 'м',
        'Н' => 'н', 'О' => 'о', 'П' => 'п', 'Р' => 'р', 'С' => 'с', 'Т' => 'т', 'У' => 'у',
        'Ф' => 'ф', 'Х' => 'х', 'Ц' => 'ц', 'Ч' => 'ч', 'Ш' => 'ш', 'Щ' => 'щ', 'Ъ' => 'ъ',
        'Ы' => 'ы', 'Ь' => 'ь', 'Э' => 'э', 'Ю' => 'ю', 'Я' => 'я'
    )));
}

function lab9_compare_text($left, $right)
{
    return strcmp(lab9_mb_lower($left), lab9_mb_lower($right));
}

function lab9_sort_contacts(array $contacts, $sort)
{
    usort($contacts, function ($left, $right) use ($sort) {
        if ($sort === 'last_name') {
            foreach (array('last_name', 'first_name', 'middle_name') as $part) {
                $cmp = lab9_compare_text($left[$part], $right[$part]);
                if ($cmp !== 0) {
                    return $cmp;
                }
            }
            return (int) $left['id'] <=> (int) $right['id'];
        }

        if ($sort === 'birth_date') {
            $cmp = strcmp($left['birth_date'], $right['birth_date']);
            if ($cmp !== 0) {
                return $cmp;
            }
            return lab9_compare_text($left['last_name'], $right['last_name']);
        }

        return strcmp($left['added_at'], $right['added_at']) ?: ((int) $left['id'] <=> (int) $right['id']);
    });

    return $contacts;
}

function lab9_full_name(array $contact)
{
    return trim($contact['last_name'] . ' ' . $contact['first_name'] . ' ' . $contact['middle_name']);
}

function lab9_mb_substr($value, $start, $length)
{
    if (function_exists('mb_substr')) {
        return mb_substr($value, $start, $length, 'UTF-8');
    }
    return substr($value, $start, $length);
}

function lab9_short_name(array $contact)
{
    $first = $contact['first_name'] !== '' ? lab9_mb_substr($contact['first_name'], 0, 1) . '.' : '';
    $middle = $contact['middle_name'] !== '' ? lab9_mb_substr($contact['middle_name'], 0, 1) . '.' : '';
    return trim($contact['last_name'] . ' ' . $first . $middle);
}

function lab9_empty_contact()
{
    return array(
        'last_name' => '',
        'first_name' => '',
        'middle_name' => '',
        'gender' => 'Мужской',
        'birth_date' => '',
        'phone' => '',
        'address' => '',
        'email' => '',
        'comment' => ''
    );
}

function lab9_validate_contact_input(array $source)
{
    $contact = array(
        'last_name' => trim((string) ($source['last_name'] ?? '')),
        'first_name' => trim((string) ($source['first_name'] ?? '')),
        'middle_name' => trim((string) ($source['middle_name'] ?? '')),
        'gender' => trim((string) ($source['gender'] ?? 'Мужской')),
        'birth_date' => trim((string) ($source['birth_date'] ?? '')),
        'phone' => trim((string) ($source['phone'] ?? '')),
        'address' => trim((string) ($source['address'] ?? '')),
        'email' => trim((string) ($source['email'] ?? '')),
        'comment' => trim((string) ($source['comment'] ?? ''))
    );

    $errors = array();
    if ($contact['last_name'] === '') {
        $errors[] = 'Не указана фамилия.';
    }
    if ($contact['first_name'] === '') {
        $errors[] = 'Не указано имя.';
    }
    if (!in_array($contact['gender'], array('Мужской', 'Женский'), true)) {
        $errors[] = 'Выбран некорректный пол.';
    }
    if ($contact['birth_date'] === '' || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $contact['birth_date'])) {
        $errors[] = 'Дата рождения должна быть задана в формате ГГГГ-ММ-ДД.';
    }
    if ($contact['phone'] === '') {
        $errors[] = 'Не указан телефон.';
    }
    if ($contact['address'] === '') {
        $errors[] = 'Не указан адрес.';
    }
    if ($contact['email'] === '' || !filter_var($contact['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Некорректный e-mail.';
    }

    return array($contact, $errors);
}

function lab9_render_contact_form($action, array $contact, $submitLabel)
{
    ob_start();
    ?>
    <form method="post" action="?p=<?php echo lab9_h($action); ?>" class="contact-form">
        <label><span>Фамилия</span><input type="text" name="last_name" value="<?php echo lab9_h($contact['last_name']); ?>"></label>
        <label><span>Имя</span><input type="text" name="first_name" value="<?php echo lab9_h($contact['first_name']); ?>"></label>
        <label><span>Отчество</span><input type="text" name="middle_name" value="<?php echo lab9_h($contact['middle_name']); ?>"></label>
        <label><span>Пол</span>
            <select name="gender">
                <option value="Мужской"<?php echo $contact['gender'] === 'Мужской' ? ' selected' : ''; ?>>Мужской</option>
                <option value="Женский"<?php echo $contact['gender'] === 'Женский' ? ' selected' : ''; ?>>Женский</option>
            </select>
        </label>
        <label><span>Дата рождения</span><input type="date" name="birth_date" value="<?php echo lab9_h($contact['birth_date']); ?>"></label>
        <label><span>Телефон</span><input type="text" name="phone" value="<?php echo lab9_h($contact['phone']); ?>"></label>
        <label><span>Адрес</span><input type="text" name="address" value="<?php echo lab9_h($contact['address']); ?>"></label>
        <label><span>E-mail</span><input type="email" name="email" value="<?php echo lab9_h($contact['email']); ?>"></label>
        <label class="full-width"><span>Комментарий</span><textarea name="comment" rows="4"><?php echo lab9_h($contact['comment']); ?></textarea></label>
        <button type="submit" class="submit-button"><?php echo lab9_h($submitLabel); ?></button>
    </form>
    <?php
    return ob_get_clean();
}

function lab9_format_date($date)
{
    if (preg_match('/^(\d{4})-(\d{2})-(\d{2})$/', $date, $matches)) {
        return $matches[3] . '.' . $matches[2] . '.' . $matches[1];
    }
    return $date;
}
