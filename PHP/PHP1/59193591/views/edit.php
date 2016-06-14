<?php
/**
 * Created by PhpStorm.
 * User: Dusty
 * Date: 02.06.2016
 * Time: 22:52
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<a href="/">К списку</a>
<form action="" method="post">
    <input type="hidden" name="id" value="<?= $employee['id'] ?>"/>
    <input type="hidden" name="action" value="edit_staff"/><br/>
    <select name="id_dept">
        <?php
        foreach ($departments as $key => $value)
        {
            $selected = "";
            if ((int) $key === (int) $employee['department_id']) $selected = " selected";
            ?>
            <option value="<?= $key ?>"<?= $selected ?>><?= $value ?></option>
            <?php
        }
        ?>
    </select><br/>
    <input type="text" name="name" placeholder="Имя" value="<?= $employee['name'] ?>"/><br/>
    <input type="text" name="surname" placeholder="Фамилия" value="<?= $employee['surname'] ?>"/><br/>
    <input type="text" name="middlename" placeholder="Отчество" value="<?= $employee['middlename'] ?>"/><br/>
    <input type="text"  name="salary" placeholder="Зарплата" value="<?= $employee['salary'] ?>"/><br/>
    <button type="submit">Отправить</button>
</form>
</body>
</html>
