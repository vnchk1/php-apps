<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Червяков Иван Алексеевич — Группа 241-352 — ЛР7</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
            background-color: #fafafa;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 20px;
            background-color: #ffffff;
            border-bottom: 1px solid #e0e0e0;
            flex-wrap: wrap;
        }

        .logo {
            width: 100px;
            border-radius: 4px;
        }

        header h1 {
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #222;
        }

        main {
            flex: 1;
            padding: 30px 20px;
            background-color: #f5f5f5;
            border: 1px dashed #b0b0b0;
            margin: 20px;
            border-radius: 12px;
        }

        footer {
            padding: 12px 20px;
            background-color: #ffffff;
            border-top: 1px solid #e0e0e0;
            font-size: 0.9rem;
            color: #4f4f4f;
            text-align: center;
        }


        .container {
            max-width: 600px;
            margin: 0 auto;
        }

        table {
            width: 100%;
            margin-bottom: 15px;
        }

        input, select, button {
            padding: 8px;
            width: 100%;
            margin-top: 5px;
        }

        button {
            cursor: pointer;
        }

        .actions {
            display: flex;
            gap: 10px;
        }
    </style>
</head>
<body>

<header>
    <img src="logo.jpg" class="logo">
    <h1>
        Червяков Иван Алексеевич<br>
        Группа 241-352<br>
        Лабораторная работа №7
    </h1>
</header>

<main>
    <div class="container">
        <h2>Сортировка массива</h2>
        <p>Введите числа и выберите алгоритм</p>

        <form action="result.php" method="post" target="_blank">
            <table id="elements">
                <tbody>
                    <tr>
                        <td>0</td>
                        <td><input type="text" name="element0"></td>
                    </tr>
                </tbody>
            </table>

            <input type="hidden" name="arrLength" id="arrLength" value="1">

            <label>Алгоритм:</label>
            <select name="algorithm">
                <option value="selection">Сортировка выбором</option>
                <option value="bubble">Пузырьковая</option>
                <option value="shell">Шелла</option>
                <option value="gnome">Гнома</option>
                <option value="quick">Быстрая</option>
                <option value="native">PHP sort()</option>
            </select>

            <div class="actions">
                <button type="button" onclick="addElement()">Добавить</button>
                <button type="submit">Сортировать</button>
            </div>
        </form>
    </div>
</main>

<footer>
    Тип верстки: адаптивная
</footer>

<script>
function addElement() {
    var table = document.getElementById('elements').getElementsByTagName('tbody')[0];
    var index = table.rows.length;
    var row = table.insertRow(index);

    row.insertCell(0).textContent = index;
    row.insertCell(1).innerHTML = '<input type="text" name="element' + index + '">';

    document.getElementById('arrLength').value = table.rows.length;
}
</script>

</body>
</html>