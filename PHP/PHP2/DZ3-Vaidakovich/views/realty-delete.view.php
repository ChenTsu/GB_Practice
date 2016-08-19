<?php
/**
 * Created by PhpStorm.
 * User: chentsu
 * Date: 19.06.2016
 * Time: 18:27
 */
error_reporting(E_ALL);
$page_title = "Удаление: {$realty['type']}";
$page_header = "Удаление объекта недвижимости";
$page_header_if_error = "Ошибка удаления записи!";
$page_header_if_not_available = "Запись с таким id не найдена!";
?>
<div class="row">
    <div class="col-lg-12">
        <?php
        if ( $realty === ERROR_DELETE_REALTY )
        {
            echo '<h1 class="page-header">'.$page_header_if_error.'</h1>';
        }
        elseif ( $realty ) { ?>
            <h1 class="page-header"><?= $page_header ?></h1>
            <h3>Объект</h3>
            <p><?= $realty['object'] ?></p>
            <h3>Адрес</h3>
            <p><?= $realty['address'] ?></p>
            <h3>Площадь</h3>
            <p><?= $realty['square'] . ' м<sup>2</sup>'?></p>
            <h3>Стоимость</h3>
            <p><?= $realty['price'] .' рублей' ?></p>
            <h3>Дополнительное описание</h3>
            <p><?= $realty['additional'] ?></p>
            <h3>Контактное лицо</h3>
            <p><?= $realty['agent'] ?></p>
            <h3>Описание</h3>
            <p><?= $realty['description'] ?></p>
            <h3>Категория</h3>
            <p><?= $realty['category'] ?></p>
            <hr/>
            <h3>Подтверждение</h3>
            <form action="" method="post">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="realty_id" value="<?= $realty['id'] ?>">
                <button type="submit" class="btn btn-danger"><i class="fa fa-check"></i> Удалить</button>
            </form>
            <!--                        <a class="btn btn-danger" href="delete.php?id=--><?//= $realty['id'] ?><!--"> Удалить</a>-->
            <a class="btn btn-primary" href="index.php">Отмена</a>
            <?php
        }
        else
            echo '<h1 class="page-header">'.$page_header_if_not_available.'</h1>';

        ?>
    </div>
    <!-- /.col-lg-12 -->

</div>
<!-- /.row -->