<?php
/**
 * Created by PhpStorm.
 * User: chentsu
 * Date: 03.07.2016
 * Time: 13:13
 */

class Realty
{
    protected $id;
    public $type_id;
    public $address;
    public $square;
    public $price;
    public $additional;
    public $realtor;
    public $description;
    public $category;

    function __construct( $id = NULL )
    {
        if ( $id !== NULL )
        {
            $this->id = $id;
            $this->get_by_id( $id );
        }
    }

    function __get($name)
    {
        if ( property_exists( Realty::class, $name) )
            return $this->$name;
        else
            return false;
    }

    public static function add($type_id, $address, $square, $price, $additional, $realtor, $description, $category )
    {
        global $db_link;

        $query = "INSERT INTO `realty` (`id`, `realty_type`, `address`, `square`, `price`, `additional`, `agent`, `description`, `category`)
              VALUES (NULL, '{$type_id}', '{$address}', '{$square}', '{$price}', '{$additional}', '{$realtor}', '{$description}', '{$category}');";

        if ( $result = mysqli_query($db_link, $query))
        {
            
            return new Realty(mysqli_insert_id($db_link));
        }
        else
            return false;
    }

    public function get_by_id ($realty_id)
    {
        global $db_link;

        $query = "SELECT `id`, (SELECT `title` FROM `realty_types` WHERE `realty_types`.`id`=`realty`.`id`) AS `type`, `address`, `square`, `price`, `additional`, `agent`, `description`, `category` FROM `realty` WHERE `id`={$realty_id};";
        if ( $result = mysqli_query($db_link, $query))
        {
            if ( $row = mysqli_fetch_assoc($result))
            {
                $this->load($row);
                return true;
            }
            else
                return false;
        }
        else
            return false;
    }

    public static function get_all()
    {
        global $db_link;

        $all_realty = array();
        $query = "SELECT `id`, (SELECT `title` FROM `realty_types` WHERE `realty_types`.`id`=`realty`.`realty_type`) AS `type_id`, `address`, `square`, `price`, `additional`, `agent`, `description`, `category` FROM `realty`;";
        if ( $result = mysqli_query($db_link, $query))
        {
            while ( $row = mysqli_fetch_assoc( $result ) )
            {
                $realty = new Realty();
                $realty->load($row);
                $all_realty[] = $realty;
            }
            return $all_realty;
        }
        else
            return false;
    }

    public function update()
    {
        global $db_link;

        $query = "UPDATE `realty` SET
              `realty_type` = '{$this->type_id}', `address` = '{$this->address}', `square` = '{$this->square}', `price` = '{$this->price}', `additional` = '{$this->additional}',
              `agent` = '{$this->realtor}', `description` = '{$this->description}', `category` = '{$this->category}' WHERE `realty`.`id` = {$this->id};";

        if ( $result = mysqli_query($db_link, $query))
        {
            return true;
        }
        else
            return false;
    }

    public function delete ()
    {
        global $db_link;

        $query = "DELETE FROM `realty` WHERE `realty`.`id` = {$this->id} LIMIT 1;";
        if ( $result = mysqli_query($db_link,$query) )
        {
            return true;
        }
        else
            return false;
    }
    
    function set_realty ( /*$realty_id=NULL,*/ $type_id, $address, $square, $price, $additional, $realtor, $description, $category )
    {
//        if ( $realty_id !== NULL ) $this->id = $realty_id;
        $this->type_id = $type_id;
        $this->address = $address;
        $this->square = $square;
        $this->price = $price;
        $this->additional = $additional;
        $this->realtor = $realtor;
        $this->description = $description;
        $this->category = $category;
    }

    function load($array = [])
    {
        foreach($array as $k => $v)
        {
            $this->$k = $v;
        }
    }
}

