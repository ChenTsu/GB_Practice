<?php
/**
 * Created by PhpStorm.
 * User: Vaidakovich
 * Date: 22.06.2016
 * Time: 17:04
 */

function realty_type_list()
{
    $objects = get_all_realty_types();

    echo render(REALTY_TYPES_FILENAME_START.'list', ['objects'=>$objects]);
//    include "views/realty_type-list.view.php";
}

function realty_type_add ()
{
//    $objects = array();
    if ( isset($_POST['action']) )
    {
        if ( $_POST['action'] === 'add' )
        {
            $objects = new_realty_type( $_POST['object_title']);
            if ( $objects )
            {
                header("Location: index.php?cat=realty_type");
                die();
            }
            else
                $objects= ERROR_ADD_OBJECT;
        }
    }

    echo render(REALTY_TYPES_FILENAME_START.'add', ['objects'=>$objects]);
//    include "views/realty_type-add.view.php";
}

function realty_type_delete()
{
    if ( isset($_GET['id']))
    {
        $id = (int) $_GET['id'];
    }
    else
    {
        die('Не передан параметр id');
    }

    if ( isset ($_POST['action']) ) {
        if ($_POST['action'] === 'delete') {
            $objects = delete_realty_type($_POST['object_id']);

            if ( $objects === ERROR_SQL_DELETE_CONSTRAINT )
                $objects = ERROR_DELETE_OBJECT_CONSTRAINT;
            elseif ( $objects === ERROR_SQL_DELETE )
            {
//            $objects = ERROR_DELETE_OBJECT;
            }
            else
            {
                header("Location: index.php?cat=realty_type");
                die();
            }
        }
    }
    else
        $objects = get_realty_type_by_id( $id);

    echo render( REALTY_TYPES_FILENAME_START.'delete',['objects'=>$objects]);
//    include "views/realty_type-delete.view.php";
}

function realty_type_edit ()
{
    if ( isset($_GET['id']))
    {
        $id = (int) $_GET['id'];
    }
    else
    {
        die('Не передан параметр id');
    }

    if ( isset($_POST['action']) )
    {
        if ( $_POST['action'] === 'edit' )
        {
            $objects = edit_realty_type($_POST['object_id'], $_POST['object_title'] );
            if ( $objects )
            {
                header("Location: index.php?cat=realty_type");
                die();
            }
            else
                $objects= ERROR_EDIT_OBJECT;
        }
    }
    else
        $objects = get_realty_type_by_id( $id);

    echo render( REALTY_TYPES_FILENAME_START.'edit', ['objects'=>$objects]);
//    include "views/realty_type-edit.view.php";
}