<?php
/**
 * Created by PhpStorm.
 * User: Vaidakovich
 * Date: 26.05.2016
 * Time: 16:57
 */

session_start();

define("TIME_YEAR", 60*60*24*365);

if ( !isset($_SESSION['username']))
{
    header("Location: login.php");
    die();
}

if ( isset($_POST['color_theme']))
{
    $_SESSION['styles'] = "css/" . $_POST['color_theme'] . ".css";
    setcookie("styles",$_SESSION['styles'], time() + TIME_YEAR );
    header( "Location: settings.php" );
}

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Настройки</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="<?php echo $_SESSION['styles'] ?>">
    <style>
        <?php for ( $n=0; $n<3; $n++) { ?>
        label:first-child(<?php echo $n; ?>):hover { @import "css/<?php echo $n; ?>.css"; }
        <?php
        }
        ?>

    </style>
</head>
<body>
    <h3>Выберите цветовую схему</h3>

    <form action="" method="post">
        <label  ><input type="radio" name="color_theme" value="1"> Фон 1</label> <br>
        <label  ><input type="radio" name="color_theme" value="2"> Фон 2</label> <br>
        <label  ><input type="radio" name="color_theme" value="3"> Фон 3</label> <br>
        <input type="submit" value="Применить">
    </form>

    <a href="index.php">Назад</a>
</body>
</html>
