<?php
// тут логика

require_once("db.php");

$query = "SELECT
`apartments`.`id` AS `id`,
`apartments`.`title` AS `title`,
`apartments`.`address`,
`apartments`.`price`,
`apartments`.`description`,
`apartment_types`.`id` AS `type_id`,
`apartment_types`.`title` AS `type`
FROM `apartments`
LEFT JOIN
`apartment_types` ON `apartment_types`.`id` = `apartments`.`type_id`
WHERE 1
";

$result = mysqli_query($link,$query);
$apartments = array();
while($row = mysqli_fetch_assoc($result))
{
    $apartments[] = $row;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Список недвижимости</title>

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
            <a class="navbar-brand" href="index.html">SB Admin v2.0</a>
        </div>
        <!-- /.navbar-header -->


        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">

                    <li>
                        <a href="types.php">
                            <i class="fa fa-home"></i>
                            <i class="fa fa-building-o text-success"></i>

                        Типы недвижимости</a>
                    </li>
                    <li>
                        <a href="/"><i class="fa fa-building fa-fw"></i> Список недвижимости</a>
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
                    <h1 class="page-header">Недвижимость</h1>

                    <?php

                    // вывод данных тут
                    if (count($apartments)>0)
                    {
                        ?>
                        <a href="add.php" class="btn btn-success"><i class="fa fa-plus-circle"></i> Добавить</a>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Список
                            </div>
                        <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Название</th>
                                                <th>Тип</th>
                                                <th>Адрес</th>
                                                <th>Цена</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                    <tbody>
                        <?php
                        foreach($apartments as $a)
                        {
                            ?>

                                            <tr>
                                                <td><?= $a['id'] ?></td>
                                                <td><?= $a['title'] ?></td>
                                                <td><?= $a['type'] ?></td>
                                                <td><?= $a['address'] ?></td>
                                                <td><?= $a['price'] ?></td>
                                                <td>
                                                    <a class="btn btn-primary" href="view.php?id=<?= $a['id'] ?>"><i class="fa fa-eye"></i></a>
                                                    <a class="btn btn-success" href="edit.php?id=<?= $a['id'] ?>"><i class="fa fa-pencil"></i></a>
                                                    <a class="btn btn-danger" href="delete.php?id=<?= $a['id'] ?>"><i class="fa fa-times-circle"></i></a>
                                                </td>
                                            </tr>


                            <?php
                        }
                        ?>
                                    </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <a href="add.php" class="btn btn-success"><i class="fa fa-plus-circle"></i> Добавить</a>
                    <?php
                    }
                    else
                    {
                        ?>
                        <h2>Пока нет ни одной записи. Вы можете <a href="add.php">добавить</a> первую</h2>
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
