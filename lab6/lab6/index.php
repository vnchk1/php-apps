<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Червяков Иван Алексеевич — Группа 241-352 — Лабораторная работа №6</title>

    <style>
        * { margin:0; padding:0; box-sizing:border-box; }

        body {
            font-family: system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
            background:#fafafa;
            min-height:100vh;
            display:flex;
            flex-direction:column;
        }

        header {
            display:flex;
            align-items:center;
            gap:15px;
            padding:15px 20px;
            background:#fff;
            border-bottom:1px solid #e0e0e0;
            flex-wrap:wrap;
        }

        .logo { width:100px; border-radius:4px; }

        header h1 {
            font-size:1rem;
            font-weight:400;
            line-height:1.5;
        }

        main {
            flex:1;
            padding:30px 20px;
            background:#f5f5f5;
            border:1px dashed #b0b0b0;
            margin:20px;
            border-radius:12px;
            display:flex;
            justify-content:center;
        }

        footer {
            padding:12px;
            background:#fff;
            border-top:1px solid #e0e0e0;
            text-align:center;
        }

        .form-container {
            width:100%;
            max-width:550px;
            background:#fff;
            padding:25px;
            border-radius:8px;
        }

        .form-row {
            display:flex;
            align-items:center;
            margin-bottom:10px;
        }

        .form-row label {
            width:180px;
        }

        .form-row input,
        .form-row select,
        .form-row textarea {
            width:100%;
            max-width:300px;
            padding:6px;
        }

        textarea { min-height:60px; }

        .btn-submit {
            padding:10px;
            background:#4CAF50;
            color:white;
            border:none;
            cursor:pointer;
        }

        .report-browser {
            background:#fff;
            border:2px solid #2196F3;
            padding:20px;
            max-width:600px;
        }

        .report-print {
            background:none;
            font-family: "Times New Roman";
            max-width:600px;
        }

        .back-button {
            display:inline-block;
            margin-top:15px;
            padding:10px;
            background:#2196F3;
            color:#fff;
            text-decoration:none;
        }

        .mail-notice {
            color:#ff5722;
            font-weight:bold;
        }
    </style>
</head>
<body>

<header>
    <img src="logo.jpg" class="logo">
    <h1>
        Червяков Иван Алексеевич<br>
        Группа 241-352<br>
        Лабораторная работа №6
    </h1>
</header>

<main>

<?php
function toFloat($v){
    return floatval(str_replace(',', '.', $v));
}

if(isset($_POST['A'])){

    $A=toFloat($_POST['A']);
    $B=toFloat($_POST['B']);
    $C=toFloat($_POST['C']);

    $task=$_POST['TASK'];

    $user=trim($_POST['result']);

    switch($task){

        case 'area': 
            $p=($A+$B+$C)/2;
            $res=sqrt($p*($p-$A)*($p-$B)*($p-$C));
            $taskName='Площадь треугольника';
        break;

        case 'perimeter':
            $res=$A+$B+$C;
            $taskName='Периметр треугольника';
        break;

        case 'volume':
            $res=$A*$B*$C;
            $taskName='Объем параллелепипеда';
        break;

        case 'mean':
            $res=($A+$B+$C)/3;
            $taskName='Среднее арифметическое';
        break;

        case 'sum':
            $res=$A*$A+$B*$B+$C*$C;
            $taskName='Сумма квадратов';
        break;

        case 'max':
            $res=max($A,$B,$C);
            $taskName='Максимум';
        break;
    }

    $res=round($res,2);

    $out="";
    $out.="ФИО: ".htmlspecialchars($_POST['FIO'])."<br>";
    $out.="Группа: ".htmlspecialchars($_POST['GROUP'])."<br><br>";

    if(!empty($_POST['ABOUT']))
        $out.="О себе:<br>".nl2br(htmlspecialchars($_POST['ABOUT']))."<br><br>";

    $out.="Задача: $taskName<br>";

    $out.="Входные данные: A=$A, B=$B, C=$C<br>";

    if($user===""){
        $out.="Предполагаемый результат: —<br>";
        $out.="Вычисленный результат: $res<br>";
        $out.="<b>Задача самостоятельно решена не была</b><br>";
    } else {
        $u=toFloat($user);

        $out.="Ваш ответ: $u<br>";
        $out.="Результат: $res<br>";

        if(abs($res-$u)<0.01)
            $out.="<b style='color:green'>ТЕСТ ПРОЙДЕН</b><br>";
        else
            $out.="<b style='color:red'>ОШИБКА</b><br>";
    }

    $view=$_POST['VIEW'];
    $class=$view=='browser'?'report-browser':'report-print';

    echo "<div class='$class'>$out";


    if(isset($_POST['send_mail']) && !empty($_POST['MAIL'])){

        $mail=$_POST['MAIL'];

        // Перевод HTML в текст
        $text=strip_tags(str_replace("<br>","\r\n",$out));

        // Отправка письма
        $ok=mail($mail,"Результат",$text,
        "From: test@localhost\r\nContent-Type:text/plain;charset=utf-8");

        // уведомление
        echo "<br><span class='mail-notice'>";
        echo $ok?"Письмо отправлено на $mail":"Ошибка отправки";
        echo "</span>";
    }

    // кнопка повтора
    if($view=='browser'){
        $f=urlencode($_POST['FIO']);
        $g=urlencode($_POST['GROUP']);
        echo "<br><a class='back-button' href='?F=$f&G=$g'>Повторить тест</a>";
    }

    echo "</div>";

}else{

    // получение значений из GET для повторного теста
    $F=$_GET['F']??'';
    $G=$_GET['G']??'';

    $A=mt_rand(0,10000)/100;
    $B=mt_rand(0,10000)/100;
    $C=mt_rand(0,10000)/100;
?>

<div class="form-container">
<form method="post">

<div class="form-row">
<label>ФИО:</label>
<input type="text" name="FIO" value="<?=htmlspecialchars($F)?>">
</div>

<div class="form-row">
<label>Группа:</label>
<input type="text" name="GROUP" value="<?=htmlspecialchars($G)?>">
</div>

<div class="form-row">
<label>О себе:</label>
<textarea name="ABOUT"></textarea>
</div>

<div class="form-row">
<label>Задача:</label>
<select name="TASK">
<option value="area">Площадь треугольника</option>
<option value="perimeter">Периметр треугольника</option>
<option value="volume">Объем параллелепипеда</option>
<option value="mean">Среднее арифметическое</option>
<option value="sum">Сумма квадратов</option>
<option value="max">Максимум</option>
</select>
</div>

<div class="form-row"><label>A:</label><input name="A" value="<?=$A?>"></div>
<div class="form-row"><label>B:</label><input name="B" value="<?=$B?>"></div>
<div class="form-row"><label>C:</label><input name="C" value="<?=$C?>"></div>

<div class="form-row">
<label>Ваш ответ:</label>
<input name="result">
</div>

<div class="form-row">
<label>Отправить email:</label>
<input type="checkbox" name="send_mail"
onchange="document.getElementById('m').style.display=this.checked?'flex':'none'">
</div>

<div class="form-row" id="m" style="display:none;">
<label>Email:</label>
<input type="email" name="MAIL">
</div>

<div class="form-row">
<label>Версия:</label>
<select name="VIEW">
<option value="browser">Браузер</option>
<option value="print">Печать</option>
</select>
</div>

<div class="form-row">
<button class="btn-submit">Проверить</button>
</div>

</form>
</div>

<?php } ?>

</main>

<footer>
Тип верстки: Адаптивная
</footer>

</body>
</html>