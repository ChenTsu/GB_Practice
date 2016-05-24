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


$method = "_{$_SERVER['REQUEST_METHOD']}";

if (isset(${$method}['x']) && isset(${$method}['y']) && isset(${$method}['operation']))
{
    $firstTime = false;
    if ( ( ${$method}['x'] !== '') && (${$method}['y'] !== '') )
    {
        $result = mathOperation( ${$method}['x'], ${$method}['y'], ${$method}["operation"] );
//        var_dump($_POST['operation']);
    }
else
    $result = "Введите значения и выберите операцию.";

//    var_dump($firstTime);
//    var_dump(${"\$_{$_SERVER['REQUEST_METHOD']}"});
//    var_dump($_SERVER);

//    header('location:'.$_SERVER['HTTP_REFERER'] . '?x='.$_POST['x'] . '&y=' . $_POST['y'] . '&operation=' . $_POST['operation']); // этот запрос нам не подходит т.к. происходит наращивание параметров
//    header('location:'.${$method}['PHP_SELF'] . '?x='.${$method}['x'] . '&y=' . ${$method}['y'] . '&operation=' . ${$method}['operation']); // то что нужно, но всё равно не понятно
}

$method = "_{$_SERVER['REQUEST_METHOD']}";
var_dump($method);
?>

<html>
<head>
    <title>Калькулятор с памятью</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Калькулятор с кнопками выбора действия, и сохранением введённых данных.</h1>

<form method="post">
    <input type="text" name="x" value="<?php !$firstTime ? print ( ${$method}['x'] ) : false; ?>" />

    <?php
    if ( isset( $$method ) )
    {
        var_dump(${$method}['operation']);
        var_dump($firstTime);
        (!$firstTime && (${$method}['operation']  == 'ADD') ) ? print '+' : false;
        (!$firstTime && (${$method}['operation']  === 'SUB') ) ? print '-' : false;
        (!$firstTime && (${$method}['operation']  == 'MUL') ) ? print '*' : false;
        (!$firstTime && (${$method}['operation']  == 'DIV') ) ? print '/' : false;
    }
    ?>

    <input type="text" name="y" value="<?php !$firstTime ? print ${$method}['y'] : false; ?>"/>
    <?php echo " = " . $result . "<br>\n";
    ?>
    <button type="submit" name="operation" value="ADD">+</button>
    <button type="submit" name="operation" value="SUB">-</button>
    <button type="submit" name="operation" value="MUL">*</button>
    <button type="submit" name="operation" value="DIV">/</button>
</form>
<?php


//if ( !$firstTime )
//{
////    header('location:'.$_SERVER['HTTP_REFERER'] . '?x='.$_POST['x'] . '&y=' . $_POST['y']);
//}
?>
</body>
</html>
