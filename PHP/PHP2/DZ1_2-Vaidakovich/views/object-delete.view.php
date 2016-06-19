<?php
/**
 * Created by PhpStorm.
 * User: chentsu
 * Date: 19.06.2016
 * Time: 20:45
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

    <title>Удаление объекта</title>

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
                        <a href="types.php"> <i class="fa fa-th-list "></i> Типы недвижимости</a>
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
                    <h1 class="page-header">Удаление объекта недвижимости</h1>
                    <form action="" method="post">
                        <input type="hidden" name="action" value="delete"/>
                        <input type="hidden" name="object_id" value="<?= $objects['id'] ?>"/>
                        <!-- блин objects['id'] испольлзуется до проверки,  надо будет потом продумать и переделать -->
                        <div class="form-group input-group" style="width: 100%">
                            <?php
                            if ( $objects === ERROR_DELETE_OBJECT )
                            {
                                echo '<h1 class="page-header">Ошибка изменения записи!</h1>';
                            }
                            elseif ( $objects )
                            {

                            ?>
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                            <input type="text" placeholder="Тип недвижимости" class="form-control" name="object_title" required
                                   value="<?= $objects['title'] ?>">
                        </div>

                        <a class="btn btn-danger" href="types-delete.php?id=<?= $objects['id'] ?>"><i class="fa fa-check"></i> Удалить</a>
                        <a class="btn btn-primary" href="types.php">Отмена</a>
                    </form>
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

