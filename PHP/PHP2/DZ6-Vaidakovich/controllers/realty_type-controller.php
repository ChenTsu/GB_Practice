<?php
/**
 * Created by PhpStorm.
 * User: chentsu
 * Date: 03.07.2016
 * Time: 22:16
 */

define("REALTY_TYPES_FILENAME_START", "realty-types/realty_type-");

class RealtyTypeController
{
    function get_list()
    {
        $objects = RealtyType::get_all();
//        die ( var_dump( $objects ));
        return render(REALTY_TYPES_FILENAME_START.'list', ['objects'=>$objects]);
    }

    function add ()
    {
        if ( isset($_POST['action']) )
        {
            if ( $_POST['action'] === 'add' )
            {
                $objects = RealtyType::add( ['title'=>$_POST['object_title']] );
                if ( !$objects/* === ERROR_SQL_INSERT*/)
                {
                    $objects= ERROR_ADD_OBJECT;
                }
                else
                {
                    header("Location: index.php?cat=realty_type");
                    die();
                }

            }
        }
        else
            $objects = true;

        return render(REALTY_TYPES_FILENAME_START.'add', ['objects'=>$objects]);
    }

    function delete()
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
                $objects = new RealtyType($_POST['object_id']);
                $objects = $objects->del();

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
            $objects = new RealtyType( $id );

        return render( REALTY_TYPES_FILENAME_START.'delete',['objects'=>$objects]);
    }

    function edit ()
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
                $objects = new RealtyType( $_POST['object_id'] );
                $objects->set($_POST['object_title']);

                if ( $objects->update() === ERROR_SQL_UPDATE )
                {
                    $objects= ERROR_EDIT_OBJECT;
                }
                else
                {
                    header("Location: index.php?cat=realty_type");
                    die();
                }
            }
        }
        else
            $objects = new RealtyType( $id );

        return render( REALTY_TYPES_FILENAME_START.'edit', ['objects'=>$objects]);
    }
}