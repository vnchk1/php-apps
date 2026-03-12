<?php
$title = "Червяков И.А. - Группа 241-352 - Лабораторная №1 - Главная";
$currentPage = "index";
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

<h1>Альпинизм</h1>

<h2>Что такое альпинизм</h2>
<p>Альпинизм — это вид спорта и активного отдыха, связанный с восхождением на горные вершины различной сложности. 
Он требует серьёзной физической подготовки, выносливости и строгого соблюдения техники безопасности.</p>

<h2>Современное развитие</h2>
<p>Современный альпинизм включает высотные восхождения, технические маршруты и экспедиции.</p>

<?php
echo "<table>";
echo "<tr><td>Гора</td><td>Высота</td><td>Страна</td></tr>";
?>

<tr>
<td><?php echo "Эверест"; ?></td>
<td><?php echo "8848 м"; ?></td>
<td><?php echo "Непал / Китай"; ?></td>
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

<img src="fotos/climb1.jpg" alt="Альпинизм">

</div>

<footer>
<?php
echo "Сформировано ".date("d.m.Y")." в ".date("H-i:s");
?>
</footer>

</body>
</html>
