<?php
/**
 * Created by PhpStorm.
 * User: Dusty
 * Date: 02.06.2016
 * Time: 22:51
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<table>
    <tr>
        <td>
            Фото
        </td>
        <td>
            Имя
        </td>
        <td>
            Фамилия
        </td>
        <td>
            Зарплата
        </td>
        <td>
            Отдел
        </td>
        <td></td>
    </tr>
    <?php
    foreach($staff as $s)
    {
        ?>
        <tr>
            <td>
                <img src="/photo/<?= $s['photo'] ?>" width="100"/>
            </td>
            <td>
                <?= $s['name'] ?>
            </td>
            <td>
                <?= $s['surname'] ?>
            </td>
            <td>
                <?= $s['salary'] ?>
            </td>
            <td>
                <?= $s['department'] ?>
            </td>
            <td>
                <form action="view.php" method="get">

                    <input type="hidden" name="id" value="<?= $s['id'] ?>"/>
                    <button type="submit">Просмотр</button>
                </form>
                <form action="edit.php" method="get">

                    <input type="hidden" name="id" value="<?= $s['id'] ?>"/>
                    <button type="submit">Редактировать</button>
                </form>
                <form action="" method="post">
                    <input type="hidden" name="action" value="delete_staff"/>
                    <input type="hidden" name="id" value="<?= $s['id'] ?>"/>
                    <button type="submit">Удалить</button>
                </form>
            </td>
        </tr>
        <?php
    }
    ?>
</table>
<form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="action" placeholder="Зарплата" value="new_staff"/><br/>
    <input type="file" name="photo"/>
    <select name="id_dept">
        <?php
        foreach ($departments as $key => $value)
        {
            ?>
            <option value="<?= $key ?>"><?= $value ?></option>
            <?php
        }
        ?>
    </select><br/>
    <input type="text" name="name" placeholder="Имя" value=""/><br/>
    <input type="text" name="surname" placeholder="Фамилия" value=""/><br/>
    <input type="text" name="middlename" placeholder="Отчество" value=""/><br/>
    <input type="text"  name="salary" placeholder="Зарплата" value=""/><br/>
    <button type="submit">Отправить</button>
</form>
</body>
</html>
