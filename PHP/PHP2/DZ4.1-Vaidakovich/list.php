<?php
/**
 * Created by PhpStorm.
 * User: Vaidakovich
 * Date: 27.06.2016
 * Time: 13:24
 */

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PHP 2 Урок 4</title>

    <!--    Ссылки будут правильными без ../ потому что мы это всё инклудим, и путь будет считаться относительно index.php; Или можно писать полный путь -->
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
            <a class="navbar-brand" href="index.php">PHP 2 Урок 4 Недвижимость v0.2</a>
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
                    <h1 class="page-header">Имеющиеся предложения</h1>
                    <?php

                    // вывод данных тут
                    if (count($realty_list)>0)
                    {
                    ?>
                    <a href="add.php" class="btn btn-success col-lg-offset-11"><i class="fa fa-plus-circle"></i> Добавить</a>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Недвижимость
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Объект</th>
                                        <th>Адрес</th>
                                        <th>Площадь</th>
                                        <th>Цена</th>
                                        <th>Дополнительно</th>
                                        <th>Контактное лицо</th>
                                        <th>Описание</th>
                                        <th>Категория</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($realty_list as $item=>$value) {
                                        $value = $value->get_realty(); // перезаписываем элемент класса результатом функции1
                                        ?>
                                        <tr>
                                            <td><?= $value['id'] ?></td>
                                            <td><?= $value['type'] ?></td>
                                            <td><?= $value['address'] ?></td>
                                            <td><?= $value['square'] ?></td>
                                            <td><?= $value['price'] ?></td>
                                            <td><?= $value['additional'] ?></td>
                                            <td><?= $value['agent'] ?></td>
                                            <td><?= $value['description'] ?></td>
                                            <td><?= $value['category'] ?></td>
                                            <td>
                                                <a class="btn btn-primary" href="show.php?id=<?= $value['id'] ?>"><i
                                                        class="fa fa-eye"></i></a>
                                                <a class="btn btn-success" href="edit.php?id=<?= $value['id'] ?>"><i
                                                        class="fa fa-pencil"></i></a>
                                                <a class="btn btn-danger" href="delete.php?id=<?= $value->id ?>"><i
                                                        class="fa fa-times-circle"></i></a>
                                            </td>
                                        </tr>


                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                                <?php
                                }
                                else
                                {
                                    echo '<p>Записей удовлетворяющих критерию выбора не найдено</p>';
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

            <!--    Ссылки будут правильными без ../ потому что мы это всё инклудим, и путь будет считаться относительно index.php; Или можно писать полный путь -->
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
