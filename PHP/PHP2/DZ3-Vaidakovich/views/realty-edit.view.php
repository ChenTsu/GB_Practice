<?php
/**
 * Created by PhpStorm.
 * User: chentsu
 * Date: 19.06.2016
 * Time: 15:57
 */

error_reporting(E_ALL);
$page_title = "Редактирование - {$realty['type']}";
$page_header = "Редактирование объекта недвижимости";
$page_header_if_error = "Ошибка изменения записи!";
$page_header_if_not_available = "Запись с таким id не найдена!";
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?= $page_header ?></h1>
        <form action="" method="post">
            <input type="hidden" name="action" value="edit"/>
            <input type="hidden" name="realty_id" value="<?= $realty['id'] ?>"/>
            <!-- блин ['id'] испольлзуется до проверки,  надо будет потом продумать и переделать -->
            <div class="form-group input-group" style="width: 100%">
                <span class="input-group-addon"><i class="fa fa-home"></i></span>
                <select class="form-control" name="object_id">
                    <?php
                    if ( $realty === ERROR_EDIT_REALTY )
                    {
                        echo '<h1 class="page-header">'.$page_header_if_error.'</h1>';
                    }
                    elseif ( $realty )
                    {
                    foreach ($objects as $a_type) {
                        $selected = '';
                        if ($a_type['title'] === $realty['type']) $selected = ' selected';
                        ?>
                        <option
                            value="<?= $a_type['id'] ?>"<?= $selected ?>><?= $a_type['title'] ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group input-group">
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                <input type="text" placeholder="Адрес" class="form-control" name="address" required
                       value="<?= $realty['address'] ?>">
            </div>
            <div class="form-group input-group">
                <span class="input-group-addon"><i class="fa fa-th-large"></i></span>
                <input type="text" placeholder="Площадь" class="form-control" name="square" required
                       value="<?= $realty['square'] ?>">
            </div>
            <div class="form-group input-group">
                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                <input type="text" placeholder="Стоимость" class="form-control" name="price" required
                       value="<?= $realty['price'] ?>">
            </div>
            <div class="form-group input-group">
                <span class="input-group-addon"><i class="fa fa-file-text-o "></i></span>
                <input type="text" placeholder="Дополнительно" class="form-control" name="additional"
                       value="<?= $realty['additional'] ?>">
            </div>
            <div class="form-group input-group">
                <span class="input-group-addon"><i class="fa fa-phone "></i></span>
                <input type="text" placeholder="Контактное лицо" class="form-control" name="agent" required
                       value="<?= $realty['agent'] ?>">
            </div>
            <div class="form-group input-group">
                <label for="description">Описание</label>
                                    <textarea class="form-control" name="description" id="description">
                                    <?= $realty['description'] ?>
                                    </textarea>
            </div>
            <div class="form-group input-group">
                <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                <input type="text" placeholder="Категория" class="form-control" name="category"
                       value="<?= $realty['category'] ?>">
            </div>

            <button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Сохранить</button>
            <a class="btn btn-primary" href="index.php?cat=realty&view=show&id=<?= $realty['id'] ?>">Отмена</a>
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