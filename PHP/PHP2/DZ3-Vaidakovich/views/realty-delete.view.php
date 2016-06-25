<?php
/**
 * Created by PhpStorm.
 * User: chentsu
 * Date: 19.06.2016
 * Time: 18:27
 */
?>

<!DOCTYPE html>
<html lang="ru">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Удаление: </title>

<!-- Bootstrap Core CSS -->
<link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- MetisMenu CSS -->
<link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="dist/css/sb-admin-2.css" rel="stylesheet">

<!-- Custom Fonts -->
<link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">PHP 2 Урок 1-2 Недвижимость v0.2</a>
        </div>
        <!-- /.navbar-header -->


        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="index.php"> <i class="fa fa-home"></i></i> Список недвижимости</a>
                    </li>
                    <li>
                        <a href="index.php?cat=realty_type"> <i class="fa fa-th-list "></i> Типы недвижимости</a>
                    </li>

                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <?php
                    if ( $realty === ERROR_DELETE_REALTY )
                    {
                        echo '<h1 class="page-header">Ошибка удаления записи!</h1>';
                    }
                    elseif ( $realty ) { ?>
                        <h1 class="page-header">Удаление объекта недвижимости</h1>
                        <h3>Объект</h3>
                        <p><?= $realty['object'] ?></p>
                        <h3>Адрес</h3>
                        <p><?= $realty['address'] ?></p>
                        <h3>Площадь</h3>
                        <p><?= $realty['square'] . ' м<sup>2</sup>'?></p>
                        <h3>Стоимость</h3>
                        <p><?= $realty['price'] .' рублей' ?></p>
                        <h3>Дополнительное описание</h3>
                        <p><?= $realty['additional'] ?></p>
                        <h3>Контактное лицо</h3>
                        <p><?= $realty['agent'] ?></p>
                        <h3>Описание</h3>
                        <p><?= $realty['description'] ?></p>
                        <h3>Категория</h3>
                        <p><?= $realty['category'] ?></p>
                        <hr/>
                        <h3>Подтверждение</h3>
                        <form action="" method="post">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="realty_id" value="<?= $realty['id'] ?>">
                            <button type="submit" class="btn btn-danger"><i class="fa fa-check"></i> Удалить</button>
                        </form>
<!--                        <a class="btn btn-danger" href="delete.php?id=--><?//= $realty['id'] ?><!--"> Удалить</a>-->
                        <a class="btn btn-primary" href="index.php">Отмена</a>
                        <?php
                    }
                    else
                        echo '<h1 class="page-header">Запись с таким id не найдена!</h1>';

                    ?>
                </div>
                <!-- /.col-lg-12 -->

            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="dist/js/sb-admin-2.js"></script>

</body>

</html>