<?php
/**
 * Created by PhpStorm.
 * User: chentsu
 * Date: 19.06.2016
 * Time: 15:56
 */
// тут логика
error_reporting(E_ALL);
$page_title = "Виды объектов";
$page_header = "Объекты недвижимости";
$page_header_if_error = "";
$page_header_if_not_available = "Записей удовлетворяющих критерию выбора не найдено";
$page_header_if_special_error = "";
?>
<div class="row">
    <div class="col-lg-6">

        <?php

        // вывод данных тут
        if (count($objects)>0)
        {
        ?>
        <h1 class="page-header"><?= $page_header ?></h1>
        <a href="index.php?cat=realty_type&view=add" class="btn btn-success col-lg-offset-10" title="Ещё тип"><i class="fa fa-plus-circle"></i> Добавить</a>

        <div class="panel panel-default">
            <div class="panel-heading">
                Объекты
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Объект</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($objects as $item) {
                            ?>
                            <tr>
                                <td><?= $item->id ?></td>
                                <td><?= $item->title ?></td>
                                <td>
                                    <!--<a class="btn btn-primary" href="show.php?id=<?/*= $item['id'] */?>"><i
                                                        class="fa fa-eye"></i></a>-->
                                    <a class="btn btn-success" href="index.php?cat=realty_type&view=edit&id=<?= $item->id ?>"><i
                                            class="fa fa-pencil"></i></a>
                                    <a  href="index.php?cat=realty_type&view=delete&id=<?= $item->id ?>"
                                        <?php
                                        if ( $item->realty_id_count > 0 )
                                            echo 'class="btn btn-danger disabled" disabled data-toggle="tooltip" data-placement="top" data-original-title="Невозможно удалить тип недвижимости пока есть хоть один объект этого типа!" title="Невозможно удалить тип недвижимости пока есть хоть один объект этого типа!"';
                                        else
                                            echo  'class="btn btn-danger" title="Удалить" data-toggle="tooltip" data-placement="top" data-original-title="Удалить"  ';
                                        ?>
                                    ><i class="fa fa-times-circle"></i></a>
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
                        echo '<h1 class="page-header">'.$page_header_if_not_available.'</h1>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- /.col-lg-12 -->

</div>
<!-- /.row -->