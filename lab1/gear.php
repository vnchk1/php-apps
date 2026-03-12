<?php
$title = "Червяков И.А. - Группа 241-352 - Лабораторная №1 - Снаряжение";
$currentPage = "gear";
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

<h1>Снаряжение альпиниста</h1>

<h2>Основное оборудование</h2>
<p>К основному снаряжению относятся верёвки, карабины, ледорубы и страховочные системы.</p>

<h2>Одежда и защита</h2>
<p>Используются мембранные материалы и многослойная система одежды.</p>

<?php
echo "<table>";
echo "<tr><td>Предмет</td><td>Назначение</td><td>Обязателен</td></tr>";
?>

<tr>
<td><?php echo "Верёвка"; ?></td>
<td><?php echo "Страховка"; ?></td>
<td><?php echo "Да"; ?></td>
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

<img src="fotos/climb1.jpg" alt="Снаряжение">

</div>

<footer>
<?php
echo "Сформировано ".date("d.m.Y")." в ".date("H-i:s");
?>
</footer>

</body>
</html>
