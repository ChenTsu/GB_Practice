<?php
// тут логика
error_reporting(E_ALL);

$page_title = "";
$page_header = "Имеющиеся предложения";
$page_header_if_error = "";
$page_header_if_not_available = "Записей удовлетворяющих критерию выбора не найдено";
?>
<div class="row">
    <div class="col-lg-12">

<?php
// вывод данных тут
if ( count($realty) > 0 )
{
?>
<h1 class="page-header"><?= $page_header ?></h1>
<a href="index.php?cat=realty&view=add" class="btn btn-success col-lg-offset-11"><i class="fa fa-plus-circle"></i> Добавить</a>

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
                    foreach ( $realty as $item ) {
                        ?>
                        <tr>
                            <td><?= $item->id ?></td>
                            <td><?= $item->realty_type ?></td>
                            <td><?= $item->address ?></td>
                            <td><?= $item->square ?></td>
                            <td><?= $item->price ?></td>
                            <td><?= $item->additional ?></td>
                            <td><?= $item->agent ?></td>
                            <td><?= $item->description ?></td>
                            <td><?= $item->category ?></td>
                            <td>
                                <a class="btn btn-primary" href="index.php?cat=realty&view=show&id=<?= $item->id ?>"><i
                                        class="fa fa-eye"></i></a>
                                <a class="btn btn-success" href="index.php?cat=realty&view=edit&id=<?= $item->id ?>"><i
                                        class="fa fa-pencil"></i></a>
                                <a class="btn btn-danger" href="index.php?cat=realty&view=delete&id=<?= $item->id ?>"><i
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
                echo "<h1 class=\"page-header\">{$page_header_if_not_available}</h1>>";
            }
            ?>
        </div>
    </div>
</div>

</div>
<!-- /.col-lg-12 -->

</div>
<!-- /.row -->