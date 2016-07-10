<?php
/**
 * Created by PhpStorm.
 * User: chentsu
 * Date: 03.07.2016
 * Time: 11:47
 */

define("REALTY_FILENAME_START", "realty/realty-");

class  RealtyController
{
    public function add ()
    {
        $realty = true;
        if ( isset($_POST['action']) )
        {
            if ( $_POST['action'] === 'add' )
            {
//                $realty = new Realty ();
                if ( $realty = Realty::add( ['id'=>NULL, 'realty_type'=>$_POST['object_id'], 'address'=>$_POST['address'],
                                            'square'=>$_POST['square'], 'price'=>$_POST['price'], 'additional'=>$_POST['additional'],
                                            'agent'=>$_POST['agent'], 'description'=>$_POST['description'], 'category'=>$_POST['category']] ))
                {
                    header("Location: index.php?cat=realty&view=show&id={$realty->id}");
                    die();
                }
                else
                    $realty = ERROR_ADD_REALTY;
            }
        }

        $objects = RealtyType::get_all();
        
        return render(REALTY_FILENAME_START.'add', ['realty'=>$realty, 'objects'=>$objects]);
    }

    public function edit ()
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
                $realty = new Realty($_POST['realty_id']);
                $realty->set(   ['realty_type'=>$_POST['object_id'], 'address'=>$_POST['address'], 'square'=>$_POST['square'],
                                'price'=>$_POST['price'], 'additional'=>$_POST['additional'], 'agent'=>$_POST['agent'],
                                'description'=>$_POST['description'], 'category'=>$_POST['category']]);
                if ( $realty->update() )
                {
                    header("Location: index.php?cat=realty&view=show&id={$_POST['realty_id']}");
                    die();
                }
                else
                    $realty = ERROR_EDIT_REALTY;
            }
        }
        else
            $realty = new Realty($id);

        $objects = RealtyType::get_all();

        return render( REALTY_FILENAME_START . 'edit', ['realty' => $realty, 'objects'=>$objects]);
    }

    public function show ()
    {
        if ( isset($_GET['id']))
        {
            $id = (int) $_GET['id'];
        }
        else
        {
            die('Не передан параметр id');
        }

        $realty = new Realty($id);

        return render( REALTY_FILENAME_START . 'show', ['realty' => $realty] );
    }

    public function delete ()
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
                $realty = new Realty($_POST['realty_id']);
                
                if ( $realty->del( ))
                {
                    header("Location: index.php");
                    die();
                }
                else
                    $realty = ERROR_DELETE_REALTY;
            }
        }
        else
            $realty = new Realty($id);

        return render( REALTY_FILENAME_START . 'delete', ['realty' => $realty] );
    }

    public function get_list()
    {
        $realty_list =  Realty::get_all();

        return render( REALTY_FILENAME_START . 'list', ['realty' => $realty_list] );
    }
}