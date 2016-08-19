<?php
/**
 * Created by PhpStorm.
 * User: Vaidakovich
 * Date: 07.07.2016
 * Time: 16:59
 */

class Realty extends Model
{
    private static $relations = array();

    public static function get_relations()
    {
        if (static::$relations === array()) // если пустой массив
        {
            if (!static::load_relations())
                return false;
        }

        return static::$relations;
    }
    
    protected static function load_relations()
    {
        
    }
}

