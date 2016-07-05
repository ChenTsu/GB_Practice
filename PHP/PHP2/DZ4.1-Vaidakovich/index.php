<?php
/**
 * Created by PhpStorm.
 * User: Vaidakovich
 * Date: 27.06.2016
 * Time: 12:54
 */
error_reporting(E_ALL);
session_start();

require_once "models/db.php";
require_once "models/realty-model.php";
require_once "models/realty_type-model.php";

class Realty {
    protected $id;
    protected $type;
    protected $address;
    protected $square;
    protected $price;
    protected $additional;
    protected $agent;
    protected $description;
    protected $category;

    function __construct( $realty=[] /*id,type,address,square,price,additional,agent,description,category*/)
    {
        if ( $realty )
            foreach ( $realty as $item=>$value )
            {
                $this->$item = $value;
            }
            
    }

    function get_realty()
    {
        return ['id'=>$this->id, 'type'=>$this->type, 'address'=>$this->address, 'square'=>$this->square, 'price'=>$this->price,
            'additional'=>$this->additional, 'agent'=>$this->agent, 'description'=>$this->description, 'category'=>$this->category];
    }
}

class RealtyType{
    protected $id;
    protected $title;
    
    function __construct( $realty_type=[] )
    {
        if ( $realty_type )
            foreach ($realty_type as $item=>$value)
                $this->$item = $value;
    }
    function get_realty_types()
    {
        return ['id'=>$this->id, 'title'=>$this->title];
    }
}



if ( $_GET['act']=='show')
{
    $realty_list = new Realty( get_realty_by_id($_GET['id']));
    include "show.php";
    die();
}
if ( $_GET['act'==='edit'])
{
    $realty_list = new Realty( get_realty_by_id($_GET['id']));
    $tmp = get_all_realty_types();
    foreach ( $tmp as $i=>$v)
    {
        $realty_type_list[]= new RealtyType( $v );
    }
    include "edit.php";
    die();
}

$tmp = get_all_realty();
foreach ( $tmp as $i=>$v)
{
    $realty_list[]= new Realty( $v );
}
//var_dump($realty_list);
$tmp = get_all_realty_types();
foreach ( $tmp as $i=>$v)
{
    $realty_type_list[]= new RealtyType( $v );
}

include "list.php";

mysqli_close($db_link);