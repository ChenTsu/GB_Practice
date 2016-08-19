<?php
/**
 * Created by PhpStorm.
 * User: chentsu
 * Date: 03.07.2016
 * Time: 22:20
 */

class RealtyType
{
    protected $id;
    public $title;
    protected $realty_id_count;

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
        if ( property_exists(RealtyType::class, $name))
        {
            return $this->$name;
        }
        else
            return false;
    }

    static function  add ( $type_title )
    {
        global $db_link;

        $query = "INSERT INTO `realty_types` (`id`, `title`) VALUES (NULL, '{$type_title}');";
        if ( $result = mysqli_query($db_link,$query) )
        {
            return new RealtyType(  mysqli_insert_id($db_link) );
        }
        else
            return ERROR_SQL_INSERT;
    }

    function update ( )
    {
        global $db_link;

        $query = "UPDATE `realty_types` SET `title` = '{$this->title}' WHERE `realty_types`.`id` = {$this->id};";
        if ( $result = mysqli_query($db_link,$query) )
        {
            return true;
        }
        else
            return ERROR_SQL_UPDATE;
    }

    function delete ( )
    {
        global $db_link;

        $query = "DELETE FROM `realty_types` WHERE `realty_types`.`id` = {$this->id} LIMIT 1;";
        mysqli_query($db_link,$query);
        $result = mysqli_errno( $db_link );
        if ( $result == 1451  )
        {
            return ERROR_SQL_DELETE_CONSTRAINT;
        }
        elseif ( $result )
            return ERROR_SQL_DELETE;
        else
            return true;
    }

    function get_by_id ( $type_id )
    {
        global $db_link;

        $query = "SELECT * FROM `realty_types` WHERE `id`={$type_id};";
        if ( $result = mysqli_query($db_link, $query))
        {
            if ( $row = mysqli_fetch_assoc($result))
            {
                $this->load( $row );
                return true;
            }
            else
                return false;
        }
        else
            return false;
    }

    static function get_all ()
    {
        global $db_link;

        $all_types = array();

        $query = "SELECT `realty_types`.*, COUNT(`realty`.`id`) AS `realty_id_count` FROM `realty_types` LEFT JOIN `realty` ON `realty`.`realty_type` = `realty_types`.`id` GROUP BY `realty_types`.`id`;";
        if ( $result = mysqli_query($db_link, $query))
        {
//            die ( var_dump( $result ));
            while ( $row = mysqli_fetch_assoc( $result ) )
            {
                $type = new RealtyType();
                $type->load ($row);
                $all_types[] = $type;
            }
            return $all_types;
        }
        else
            return false;
    }

    function load($array = [])
    {
        foreach($array as $k => $v)
        {
            $this->$k = $v;
        }
    }
    function set( $title )
    {
        $this->title = $title;
    }
}