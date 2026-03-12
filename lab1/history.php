<?php
$title = "Червяков И.А. - Группа 241-352 - Лабораторная №1 - История";
$currentPage = "history";
date_default_timezone_set('Europe/Moscow');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo $title; ?></title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<header>
<nav>

<?php
$name='Главная';
$link='index.php';
$current_page = ($currentPage == "index") ? true : false;
?>
<a href="<?php echo $link; ?>"<?php if($current_page) echo ' class="selected_menu"'; ?>><?php echo $name; ?></a>

<?php
$name='История';
$link='history.php';
$current_page = ($currentPage == "history") ? true : false;
?>
<a href="<?php echo $link; ?>"<?php if($current_page) echo ' class="selected_menu"'; ?>><?php echo $name; ?></a>

<?php
$name='Снаряжение';
$link='gear.php';
$current_page = ($currentPage == "gear") ? true : false;
?>
<a href="<?php echo $link; ?>"<?php if($current_page) echo ' class="selected_menu"'; ?>><?php echo $name; ?></a>

</nav>
</header>

<div class="container">

<h1>История альпинизма</h1>

<h2>Первые восхождения</h2>
<p>История альпинизма началась в XVIII веке с покорения Монблана.</p>

<h2>Развитие в XX веке</h2>
<p>В 1953 году Хиллари и Норгей впервые покорили Эверест.</p>

<?php
echo "<table>";
echo "<tr><td>Год</td><td>Событие</td><td>Гора</td></tr>";
?>

<tr>
<td><?php echo "1953"; ?></td>
<td><?php echo "Первое восхождение"; ?></td>
<td><?php echo "Эверест"; ?></td>
</tr>

</table>

<h2>Фотографии</h2>

<?php
$s = date('s');
if ($s % 2 == 0)
    $photo = "foto1.jpg";
else
    $photo = "foto2.jpg";

echo '<img src="fotos/'.$photo.'" alt="Меняющееся фото">';
?>

<img src="fotos/climb2.jpg" alt="История">

</div>

<footer>
<?php
echo "Сформировано ".date("d.m.Y")." в ".date("H-i:s");
?>
</footer>

</body>
</html>
