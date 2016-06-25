<?php
/**
 * Created by PhpStorm.
 * User: Vaidakovich
 * Date: 22.06.2016
 * Time: 14:11
 */

define('ERROR_ADD_REALTY','ERROR_ADD_REALTY');
define('ERROR_EDIT_REALTY','ERROR_EDIT_REALTY');
define("ERROR_DELETE_REALTY",'ERROR_DELETE_REALTY');

define("REALTY_FILENAME_START", "realty-");
define("REALTY_TYPES_FILENAME_START", "realty_type-");

function realty_add ()
{
    if ( isset($_POST['action']) )
    {
        if ( $_POST['action'] === 'add' )
        {
            $realty = new_realty( $_POST['object_id'], $_POST['address'], $_POST['square'], $_POST['price'], $_POST['additional'], $_POST['agent'], $_POST['description'], $_POST['category']);
            if ( $realty )
            {
                header("Location: index.php?cat=realty&view=show&id={$realty}");
                die();
            }
            else
                $realty = ERROR_ADD_REALTY;
        }
    }

    $realty = true;

    $objects = get_all_realty_types();

    include "views/realty-add.view.php";
}

function realty_edit ()
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
            $realty = edit_realty( $_POST['realty_id'], $_POST['object_id'],$_POST['address'], $_POST['square'], $_POST['price'], $_POST['additional'], $_POST['agent'], $_POST['description'], $_POST['category']);
            if ( $realty )
            {
                header("Location: index.php?cat=realty&view=show&id={$_POST['realty_id']}");
                die();
            }
            else
                $realty = ERROR_EDIT_REALTY;
        }
    }
    else
        $realty = get_realty_by_id( $id);

    $objects = get_all_realty_types();

    include "views/realty-edit.view.php";
}

function realty_show ()
{
    if ( isset($_GET['id']))
    {
        $id = (int) $_GET['id'];
    }
    else
    {
        die('Не передан параметр id');
    }

    $realty = get_realty_by_id( $id);

    include "views/realty-show.view.php";
}

function realty_delete ()
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
            $realty = delete_realty( $_POST['realty_id']);
            if ( $realty )
            {
                header("Location: index.php");
                die();
            }
            else
                $realty = ERROR_DELETE_REALTY;
        }
    }
    else
        $realty = get_realty_by_id( $id);

    include "views/realty-delete.view.php";
}

function realty_list()
{
    $realty = get_all_realty();

//    echo  render( REALTY_FILENAME_START . 'list', $realty);
    include "views/realty-list.view.php";
}