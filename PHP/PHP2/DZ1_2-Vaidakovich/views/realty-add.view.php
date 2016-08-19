<?php
/**
 * Created by PhpStorm.
 * User: Vaidakovich
 * Date: 20.06.2016
 * Time: 9:47
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

    <title>Добавление недвижимости</title>

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
                    <?php
                    if ( $realty === ERROR_ADD_REALTY )
                    {
                        echo '<h1 class="page-header">Ошибка добавления записи!</h1>';
                    }
                    elseif ( $realty )
                    {
                    ?>
                    <h1 class="page-header">Добавление объекта недвижимости</h1>
                    <form action="" method="post">
                        <input type="hidden" name="action" value="add"/>
                        <div class="form-group input-group" style="width: 100%">
                            <span class="input-group-addon"><i class="fa fa-home"></i></span>
                            <select class="form-control" name="object_id">
                                 <?php
                                 foreach($objects as $a_type) {
                                     echo "<option value=\"{$a_type['id']}\">{$a_type['title']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                            <input type="text" placeholder="Адрес" class="form-control" name="address" required
                                   value="">
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-th-large"></i></span>
                            <input type="text" placeholder="Площадь м.кв." class="form-control" name="square" required
                                   value="">
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-money"></i></span>
                            <input type="text" placeholder="Стоимость" class="form-control" name="price" required
                                   value="">
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-file-text-o "></i></span>
                            <input type="text" placeholder="Дополнительно" class="form-control" name="additional"
                                   value="">
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-phone "></i></span>
                            <input type="text" placeholder="Контактное лицо" class="form-control" name="agent" required
                                   value="">
                        </div>
                        <div class="form-group input-group">
                            <label for="description">Описание</label>
                                    <textarea class="form-control" name="description" id="description"> </textarea>
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                            <input type="text" placeholder="Категория" class="form-control" name="category"
                                   value="">
                        </div>

                        <button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Сохранить</button>
                        <a class="btn btn-primary" href="index.php">Отмена</a>
                    </form>
                    <?php
                    }
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

