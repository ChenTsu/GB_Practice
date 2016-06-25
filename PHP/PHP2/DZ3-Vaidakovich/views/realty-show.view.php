<?php
/**
 * Created by PhpStorm.
 * User: chentsu
 * Date: 19.06.2016
 * Time: 15:12
 */

error_reporting(E_ALL);
$page_title = "Просмотр объекта недвижимости";
$page_header = "Просмотр объекта недвижимости";
$page_header_if_error = "";
$page_header_if_not_available = "Запись с таким id не найдена!";
?>

<div class="row">
    <div class="col-lg-12">
        <?php
        if ( count( $realty ) >0 ) { ?>
            <h1 class="page-header"><?= $page_header ?></h1>
            <h3>Объект</h3>
            <p><?= $realty['type'] ?></p>
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
            <h3>Управление</h3>
            <a class="btn btn-success" href="index.php?cat=realty&view=edit&id=<?= $realty['id'] ?>"><i class="fa fa-pencil"></i> Редактировать</a>
            <a class="btn btn-danger" href="index.php?cat=realty&view=delete&id=<?= $realty['id'] ?>"><i class="fa fa-times-circle"></i> Удалить</a>
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