<?php
/**
 * Created by PhpStorm.
 * User: chentsu
 * Date: 21.05.2016
 * Time: 16:03
 */

error_reporting(E_ALL);
$firstTime = true;
$result ='';

require 'sum.php';

$requestMethod = "_{$_SERVER['REQUEST_METHOD']}";

if (isset(${$requestMethod}['x']) && isset(${$requestMethod}['y']) && isset(${$requestMethod}['operation']))
{
    $firstTime = false;
    if ( ( ${$requestMethod}['x'] !== '') && (${$requestMethod}['y'] !== '') )
    {
        $result = mathOperation( ${$requestMethod}['x'], ${$requestMethod}['y'], ${$requestMethod}["operation"] );
//        var_dump($_POST['operation']);
    }
else
    $result = "Введите значения и выберите операцию.";

    if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
        header('location:'.${$requestMethod}['PHP_SELF'] . '?x='.${$requestMethod}['x'] . '&y=' . ${$requestMethod}['y'] . '&operation=' . ${$requestMethod}['operation']); // то что нужно, но всё равно не понятно,

//    header('location:'.$_SERVER['HTTP_REFERER'] . '?x='.$_POST['x'] . '&y=' . $_POST['y'] . '&operation=' . $_POST['operation']); // REFERER нам не подходит т.к. происходит наращивание параметров
}

$requestMethod = "_{$_SERVER['REQUEST_METHOD']}";
//var_dump($method);
?>

<html>
<head>
    <title>Калькулятор с памятью</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Калькулятор с кнопками выбора действия, и сохранением введённых данных.</h1>

<form method="post">
    <input type="text" name="x" value="<?php !$firstTime ? print ( ${$requestMethod}['x'] ) : false; ?>" />

    <?php
    if ( isset( $$requestMethod ) )
    {
//        var_dump(${$method}['operation']);
//        var_dump($firstTime);
        (!$firstTime && (${$requestMethod}['operation']  == 'ADD') ) ? print '+' : false;
        (!$firstTime && (${$requestMethod}['operation']  == 'SUB') ) ? print '-' : false;
        (!$firstTime && (${$requestMethod}['operation']  == 'MUL') ) ? print '*' : false;
        (!$firstTime && (${$requestMethod}['operation']  == 'DIV') ) ? print '/' : false;
    }
    ?>

    <input type="text" name="y" value="<?php !$firstTime ? print ${$requestMethod}['y'] : false; ?>"/>
    <?php echo " = " . $result . "<br>\n";
    ?>
    <button type="submit" name="operation" value="ADD">+</button>
    <button type="submit" name="operation" value="SUB">-</button>
    <button type="submit" name="operation" value="MUL">*</button>
    <button type="submit" name="operation" value="DIV">/</button>
</form>
</body>
</html>
