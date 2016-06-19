<?php
require_once "db.php";

if (isset($_GET['id']))
{
    $id = (int) $_GET['id'];
}
else
{
    die('Не передан параметр id');
}

if (count($_POST))
{
    if ($_POST['action'] === 'edit')
    {
        $id = (int) $_POST['id'];
        $title = $_POST['title'];
        $type_id = $_POST['type_id'];
        $address = $_POST['address'];
        $price = $_POST['price'];
        $description = $_POST['description'];

        $query = "UPDATE `apartments`
SET
`type_id` = '{$type_id}',
`title` = '{$title}',
`address` = '{$address}',
`price` = '{$price}',
`description` = '{$description}'
WHERE `id` = '$id'";
        $result = mysqli_query($link, $query);

        if ($result)
        {
            // переадресация? сообщение?
        }
        else
        {
            die('Ошибка при операции'); // можно сделать красивее
        }

    }

}

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
WHERE `apartments`.`id` = '{$id}'
";

$result = mysqli_query($link,$query);
if ($row = mysqli_fetch_assoc($result))
{
    $apartment = $row;
}
else
{
    die('Элемент с таким id не найден');
}

$query = "SELECT
*
FROM `apartment_types`
WHERE 1
";

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

    <title>Редактирование - <?= $apartment['type'] ?>: <?= $apartment['title'] ?></title>

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
                        <a href="/"><i class="fa fa-building"></i> Список недвижимости</a>
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
                    <h1 class="page-header">Редактирование объекта недвижимости</h1>
                    <form action="" method="post">
                        <input type="hidden" name="action" value="edit"/>
                        <input type="hidden" name="id" value="<?= $apartment['id'] ?>"/>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-building-o"></i></span>
                            <input type="text" placeholder="Название" class="form-control" name="title" value="<?= $apartment['title'] ?>">
                        </div>
                        <div class="form-group input-group" style="width: 100%">
                            <select class="form-control" name="type_id">
                                <?php
                                foreach ($apartment_types as $a_type)
                                {
                                    $selected = '';
                                    if ($a_type['id'] === $apartment['type_id']) $selected = ' selected';
                                    ?>
                                    <option value="<?= $a_type['id'] ?>"<?= $selected ?>><?= $a_type['title'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                            <input type="text" placeholder="Адрес" class="form-control" name="address" value="<?= $apartment['address'] ?>">
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-money"></i></span>
                            <input type="text" placeholder="Стоимость" class="form-control" name="price" value="<?= $apartment['price'] ?>">
                        </div>
                        <div class="form-group input-group">
                            <label for="description">Описание</label>
                                    <textarea class="form-control" name="description" id="description">
<?= $apartment['description'] ?>
                                    </textarea>
                        </div>

                        <button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Сохранить</button>
                        <a class="btn btn-default" href="view.php?id=<?= $apartment['id'] ?>">Отмена</a>
                    </form>


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
