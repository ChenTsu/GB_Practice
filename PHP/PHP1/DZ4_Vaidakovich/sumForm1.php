<?php
/**
 * Created by PhpStorm.
 * User: chentsu
 * Date: 21.05.2016
 * Time: 13:36
 */

error_reporting(E_ALL);
$firstTime = true;
$result ='';

require 'sum.php';


if (isset($_POST['a']) && isset($_POST['b']) && isset($_POST['operation']))
{
    if ( ( $_POST['a'] !== '') && ($_POST['b'] !== '') )
    {
        $firstTime = false;
        $result = mathOperation( $_POST['a'], $_POST['b'], $_POST["operation"] );
    }
    else
        $result = "Введите значения и выберите операцию.";
}

?>
<html>
<head>
    <title>Калькулятор</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Простой калькулятор с получением значений от пользователя методом POST</h1>
<form method="post">
    <input type="text" name="a" />
    <select name="operation">
        <optgroup label="Выберите операцию"> <!-- тут тоже добавим немного "памяти" форме -->
            <option value="ADD" <?php ( !$firstTime && $_POST['operation']=="ADD") ? print "selected" : false;?> >Сложение</option>
            <option value="SUB" <?php ( !$firstTime && $_POST['operation']=="SUB") ? print "selected" : false;?> >Вычитание</option>
            <option value="MUL" <?php ( !$firstTime && $_POST['operation']=="MUL") ? print "selected" : false;?> >Умножение</option>
            <option value="DIV" <?php ( !$firstTime && $_POST['operation']=="DIV") ? print "selected" : false;?> >Деление</option>
        </optgroup>
    </select>

    <input type="text" name="b"/> <input type="submit" value="="/>
    <?php echo $result;
//    echo "<br>" . var_dump( $_POST['a']) . ' | ' . var_dump($_POST['b']) . ' | ' . var_dump($_POST['operation']) . ' | ' . var_dump($result);
    ?>
</form>


</form>
</body>
</html>