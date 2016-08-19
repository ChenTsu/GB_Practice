<?php
/**
 * Created by PhpStorm.
 * User: Vaidakovich
 * Date: 20.06.2016
 * Time: 9:47
 */
error_reporting(E_ALL);
$page_title = "Добавление недвижимости";
$page_header = "Добавление объекта недвижимости";
$page_header_if_error = "Ошибка добавления записи!";
$page_header_if_not_available = "";
?>

<div class="row">
    <div class="col-lg-12">
        <?php
        if ( $realty === ERROR_ADD_REALTY )
        {
            echo "<h1 class=\"page-header\">{$page_header_if_error}</h1>";
        }
        elseif ( $realty )
        {
            ?>
            <h1 class="page-header"><?= $page_header ?></h1>
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

