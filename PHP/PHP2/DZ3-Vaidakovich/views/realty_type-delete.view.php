<?php
/**
 * Created by PhpStorm.
 * User: Vaidakovich
 * Date: 20.06.2016
 * Time: 10:17
 */
error_reporting(E_ALL);
$page_title = "Удаление типа недвижимости";
$page_header = "Удаление типа недвижимости";
$page_header_if_error = "Ошибка удаления записи!";
$page_header_if_not_available = "Запись с таким id не найдена!";
$page_header_if_special_error = "Ошибка удаления записи!<br>Невозможно удалить тип недвижимости пока есть хоть один объект этого типа!";
?>

<div class="row">
    <div class="col-lg-12">
        <?php
        if ( $objects === ERROR_DELETE_OBJECT )
        {
            echo '<h1 class="page-header">'.$page_header_if_error.'</h1>';
        }
        elseif ($objects === ERROR_DELETE_OBJECT_CONSTRAINT )
        {
            echo '<h1 class="page-header">'.$page_header_if_special_error.'</h1>';
        }
        elseif ( $objects ) { ?>
            <h1 class="page-header"><?= $page_header ?></h1>
            <h3>Объект</h3>
            <p><?= $objects['title'] ?></p>
            <hr/>
            <h3>Подтверждение</h3>
            <form action="" method="post">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="object_id" value="<?= $objects['id'] ?>">
                <button type="submit" class="btn btn-danger"><i class="fa fa-check"></i> Удалить</button>
            </form>
            <a class="btn btn-primary" href="index.php?cat=realty_type">Отмена</a>
            <?php
        }
        else
            echo '<h1 class="page-header">'.$page_header_if_not_available.'</h1>';

        ?>
    </div>
    <!-- /.col-lg-12 -->

</div>
<!-- /.row -->