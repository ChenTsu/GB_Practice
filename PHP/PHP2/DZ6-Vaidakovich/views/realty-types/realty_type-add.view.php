<?php
/**
 * Created by PhpStorm.
 * User: chentsu
 * Date: 19.06.2016
 * Time: 21:07
 */

error_reporting(E_ALL);
$page_title = "Добавление типа недвижимости";
$page_header = "Добавление типа недвижимости";
$page_header_if_error = "Ошибка добавления записи!";
$page_header_if_not_available = "";
?>
<div class="row">
    <div class="col-lg-12">
        <?php
        if ( $objects === ERROR_ADD_OBJECT )
        {
            echo "<h1 class=\"page-header\">{$page_header_if_error}</h1>";
        }
        else
        {
            ?>
            <h1 class="page-header"><?= $page_header ?></h1>
            <form action="" method="post">
                <input type="hidden" name="action" value="add"/>
                <div class="form-group input-group">
                    <span class="input-group-addon"><i class="fa fa-th-list"></i></span>
                    <input type="text" placeholder="Тип недвижимости" class="form-control" name="object_title" required
                           value="">
                </div>
                <button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Сохранить</button>
                <a class="btn btn-primary" href="index.php?cat=realty_type">Отмена</a>
            </form>
            <?php
        }
        ?>

    </div>
    <!-- /.col-lg-12 -->

</div>
<!-- /.row -->