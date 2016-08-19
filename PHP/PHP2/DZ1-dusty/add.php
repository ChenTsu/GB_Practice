<?php
// тут логика
require_once("db.php");

if (count($_POST))
{
    if ($_POST['action'] === 'add')
    {

        $title = $_POST['title'];
        $type_id = $_POST['type_id'];
        $address = $_POST['address'];
        $price = $_POST['price'];
        $description = $_POST['description'];

        $query = "INSERT INTO `apartments` VALUES (NULL, '{$type_id}', '{$title}', '{$address}', '{$price}', '{$description}')";

        $result = mysqli_query($link,$query);

        $id = mysqli_insert_id($link);

        if ($id)
        {
            header("Location: view.php?id={$id}");
            die();
        }
    }
}

$query = "SELECT * FROM `apartment_types` WHERE 1";

$result = mysqli_query($link,$query);

$apartment_types = array();
while($row = mysqli_fetch_assoc($result))
{
    $apartment_types[] = $row;
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

    <title>Добавить объект недвижимости</title>

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
                    <h1 class="page-header">Добавить объект недвижимости</h1>
                    <?php
                        if (count($apartment_types)>0)
                        {
                    ?>
                            <form action="" method="post">
                                <input type="hidden" name="action" value="add"/>
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-building-o"></i></span>
                                    <input type="text" placeholder="Название" class="form-control" name="title">
                                </div>
                                <div class="form-group input-group" style="width: 100%">
                                    <select class="form-control" name="type_id">
                                        <?php
                                        foreach ($apartment_types as $a_type)
                                        {
                                            ?>
                                            <option value="<?= $a_type['id'] ?>"><?= $a_type['title'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                    <input type="text" placeholder="Адрес" class="form-control" name="address">
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                    <input type="text" placeholder="Стоимость" class="form-control" name="price">
                                </div>
                                <div class="form-group input-group">
                                    <label for="description">Описание</label>
                                    <textarea class="form-control" name="description" id="description">

                                    </textarea>
                                </div>

                                <button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Добавить</button>
                            </form>
                            <?php
                        }
                        else
                        {
                            ?>
                            <div class="alert alert-danger">
                                Ошибка: нет ни одного типа недвижимости. <a class="alert-link" href="add_type.php">Добавить</a>.
                            </div>
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
