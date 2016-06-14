<?php
/**
 * Created by PhpStorm.
 * User: Dusty
 * Date: 02.06.2016
 * Time: 22:24
 */

function get_staff()
{
    global $db_link;

    $query = "SELECT `staff`.*, `department`.`title` AS `department`, `department`.`id` AS `department_id` FROM `staff` JOIN `department` ON `department`.`id` = `staff`.`dep_id` WHERE 1";

    $result = mysqli_query($db_link,$query);

    $staff = array();
    while($row = mysqli_fetch_assoc($result))
    {
        //var_dump($row);
        $staff[] = $row;
    }

    return $staff;
}

function get_staff_by_id($id)
{
    global $db_link;

    $query = "SELECT `staff`.*, `department`.`title` AS `department`, `department`.`id` AS `department_id` FROM `staff` JOIN `department` ON `department`.`id` = `staff`.`dep_id` WHERE `staff`.`id` = '{$id}'";


    $result = mysqli_query($db_link,$query);


    if($row = mysqli_fetch_assoc($result))
    {
        //var_dump($row);
        return $row;
    }
    else
    {
        //error 404 = header(),

        return false;

    }
}

function new_staff($id_dept, $name, $surname, $middlename, $salary)
{
    global $db_link;
    $query = <<<SQL
INSERT INTO `staff` (
`id` ,
`dep_id` ,
`name` ,
`surname` ,
`middlename` ,
`salary`
)
VALUES (
NULL , '{$id_dept}', '{$name}', '{$surname}', '{$middlename}', '{$salary}'
);
SQL;

    $result = mysqli_query($db_link,$query);

    $id = mysqli_insert_id($db_link);
    if ($id)
    {
        //$uploads_dir = '/photo';
        //var_dump($_FILES);
        if ($_FILES["photo"]["error"] ===UPLOAD_ERR_OK)
        {
            $tmp_name = $_FILES["photo"]["tmp_name"];
            $name = $_FILES["photo"]["name"];
            if(@move_uploaded_file($tmp_name, UPLOADS_DIR."/$name")) {

                $query = <<<SQL
UPDATE `staff` SET
`photo` = '{$name}'
WHERE `id` = '{$id}';
SQL;
                $result = mysqli_query($db_link, $query);
                if ($result)
                {
                    return $id;// все ок
                } else
                {
                    return $id;// вот тут - только предупреждение (warning), а не фатальная ошибка
                }
            }
            else
            {
                return $id;// не загружено
            }

        }
        else
        {
            return $id;// не загружено
        }
    }
    else
    {
        return false;
    }



}

function edit_staff($id, $id_dept, $name, $surname, $middlename, $salary)
{
    global $db_link;

    $query = <<<SQL
UPDATE `staff` SET
`dep_id` = '{$id_dept}',
`name` = '{$name}',
`surname` = '{$surname}',
`middlename` = '{$middlename}',
`salary` = '{$salary}'
WHERE `id` = '{$id}';
SQL;
    $result = mysqli_query($db_link,$query);
    if ($result)
    {
        return true;
    }
    else
    {
        return false;
    }
}

function delete_staff($id)
{
    global $db_link;

    $id = (int) $id;

    $query = <<<SQL
DELETE FROM `staff` WHERE `id` = '{$id}'
SQL;
    $result = mysqli_query($db_link,$query);
    if ($result)
    {
        return true;
    }
    else
    {
        return false;
    }
}