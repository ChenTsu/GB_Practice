<?php
/**
 * Created by PhpStorm.
 * User: Vaidakovich
 * Date: 22.06.2016
 * Time: 14:11
 */

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

    echo render(REALTY_FILENAME_START.'add', ['realty'=>$realty, 'objects'=>$objects]);
//    include "views/realty-add.view.php";
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

    echo render( REALTY_FILENAME_START . 'edit', ['realty' => $realty, 'objects'=>$objects]);
//    include "views/realty-edit.view.php";
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

    echo render( REALTY_FILENAME_START . 'show', ['realty' => $realty] );
//    include "views/realty-show.view.php";
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

    echo render( REALTY_FILENAME_START . 'delete', ['realty' => $realty] );
    //include "views/realty-delete.view.php";
}

function realty_list()
{
    $realty = get_all_realty();

        echo  render( REALTY_FILENAME_START . 'list', ['realty' => $realty] );
//    include "views/realty-list.view.php";
}