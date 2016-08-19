<?php
/**
 * Created by PhpStorm.
 * User: chentsu
 * Date: 19.06.2016
 * Time: 20:08
 */
error_reporting(E_ALL);
$page_title = "Редактирование объекта";
$page_header = "Редактирование объекта недвижимости";
$page_header_if_error = "Ошибка изменения записи!";
$page_header_if_not_available = "Запись с таким id не найдена!";
$page_header_if_special_error = "";
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?= $page_header ?></h1>
        <form action="" method="post">
            <input type="hidden" name="action" value="edit"/>
            <input type="hidden" name="object_id" value="<?= $objects['id'] ?>"/>
            <!-- блин objects['id'] испольлзуется до проверки,  надо будет потом продумать и переделать -->
            <div class="form-group input-group" style="width: 100%">
                <?php
                if ( $objects === ERROR_EDIT_OBJECT )
                {
                    echo '<h1 class="page-header">'.$page_header_if_error.'</h1>';
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

            <button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Сохранить</button>
            <a class="btn btn-primary" href="index.php?cat=realty_type">Отмена</a>
        </form>
        <?php
        }
        else
            echo '<h1 class="page-header">'.$page_header_if_not_available.'</h1>';
        ?>

    </div>
    <!-- /.col-lg-12 -->

</div>
<!-- /.row -->