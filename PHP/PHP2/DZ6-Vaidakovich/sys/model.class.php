<?php
/**
 * Created by PhpStorm.
 * User: Vaidakovich
 * Date: 05.07.2016
 * Time: 11:49
 */

class Model
{

    protected static $fields = array();
    protected $data = array();
    protected static $db_link = NULL;

    public function __construct($id = NULL)
    {
        if (static::get_fields() AND $id !== NULL) {
            $this->get_by_id($id);
        }
    }

    public function __call($name, $arguments)
    {
        // TODO: Implement __call() method.
        if (method_exists(static::class, $name))
            $name($arguments);
//            die( " function $name shit ");
        throw new ErrorException ("Попытка вызвать несуществующую функцию $name из объекта класса " . static::class);
    }

    public function __get($name)
    {
        // TODO: Implement __get() method.
        if (static::get_fields()) {
            if (in_array($name, static::$fields)) {
                if (isset($this->data[$name]))
                    return $this->data[$name];
            } else
//                die("Обращение к $name не входящей в класс ". static::class);
                throw new ErrorException ("Обращение к $name не входящей в класс ". static::class);
        }
        return NULL;
    }

    public function __set($name, $value)
    {
        // TODO: Implement __set() method.
        if (static::get_fields()) {
            if (in_array($name, static::$fields)) {
                if ($name !== 'id') {
                    $this->data[$name] = $value;
                    return true;
                } else    return false;
            } else
                throw new ErrorException ("Переменная $name какая-то не такая!");
        }
        return false;
    }

    protected static function get_db_link()
    {
        if (self::$db_link === NULL) {
            self::$db_link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            if (mysqli_connect_errno()) {
                printf("Connect failed: %s\n", mysqli_connect_error());
                exit();
            }
            if (!mysqli_set_charset(self::$db_link, "utf8")) {
                printf("Ошибка при загрузке набора символов utf8: %s\n", mysqli_error(self::$db_link));
                exit();
            }
        }
        //else // не нужен т.к. в любом случае возвращать $db_link или обрываем скрипт
        return self::$db_link;
    }

    public static function get_fields()
    {
//        if (static::$fields === array()) // если пустой массив
//        {
            if (!static::load_fields())
                return false;
//        }

        return static::$fields;
    }

    protected static function load_fields()
    {
        if (self::$db_link === NULL) self::get_db_link();

        $query = "DESCRIBE `" . static::table_name() . "`;";
        $result = mysqli_query(self::$db_link, $query);
        if (!mysqli_errno(self::$db_link)) {
            while ($row = mysqli_fetch_assoc($result)) {
                static::$fields[] = $row['Field'];
            }
            return true;
        } else
            return false;
    }

     static function table_name()
    {
        $table_name = mb_strtolower( preg_replace('/([a-z])([A-Z])/', '$1_$2', static::class) );
//        $table_name = 'realty';
        return $table_name;
    }

    protected function get_by_id($id)
    {
        if (self::$db_link === NULL) self::get_db_link();

        $query = "SELECT * FROM `" . static::table_name() . "` WHERE `id`={$id};";
        if ($result = mysqli_query(self::$db_link, $query)) {
            if ($row = mysqli_fetch_assoc($result)) {
                $this->load($row);
                return true;
            } else
                return false;
        } else
            return false;
    }

    protected static function fields_for_query()
    {
        $list = '';
        if (!$fields = static::get_fields()) return false;

        foreach ($fields as $f) {
            if ($list !== '') $list .= ', ';
            $list .= "`{$f}`";
        }

        return $list;
    }
    protected function get_variables ()
    {
        $list = '';
        if (!$fields = static::get_fields()) return false;

        foreach ($fields as $f)
        {
            if ($list !== '') $list .= ', ';

            if ($this->data[$f] === NULL OR !isset($this->data[$f]))
                $list .= "NULL";
            else
                $list .= "`{$this->data[$f]}`";

        }
        return $list;
    }

    protected static function variables_for_query($values = array())
    {
        $list = '';
        if (!$fields = static::get_fields()) return false;

        if (count($values) > 0) {
            foreach ($fields as $f) {
                if ($list !== '') $list .= ', ';

                if (isset($values[$f])) {
                    $list .= "'{$values[$f]}'";
                }
                else
                    $list .= "NULL";
            }
        }
        return $list;
    }

    public static function add($values = array())
    {
        if (self::$db_link === NULL) self::get_db_link();

        $query = "INSERT INTO `" . static::table_name() . "` (" . static::fields_for_query() . ") VALUES (" . static::variables_for_query($values) . ");";

        var_dump(static::get_fields());
        die ( var_dump($query) );
        mysqli_query(self::$db_link, $query);
        if ( ! mysqli_errno(self::$db_link) ) {
            return mysqli_insert_id(self::$db_link);
        }

        return false;
    }

    public function del()
    {
        if (self::$db_link === NULL) self::get_db_link();
        if ( $this->data['id'] === NULL ) return false;

        $query = "DELETE FROM `" . static::table_name() . "` WHERE `" . static::table_name() . "`.`id` = {$this->data['id']} LIMIT 1;";

        mysqli_query(self::$db_link, $query);
        if ( ! mysqli_errno(self::$db_link)) {
            $this->data['id']= NULL;
            return true;
        }

        return false;
    }

    public function set($values = array())
    {
        if (!$fields = static::get_fields()) return false;

        if (count($values) > 0) {
            foreach ($values as $k => $v) {
                if (in_array($k, $fields)) {
                    $this->data[$k] = $v;
                }
            }
            return true;
        }

        return false;
    }

    public function update()
    {
        if (self::$db_link === NULL) self::get_db_link();

        $query = "UPDATE `" . static::table_name() . "` SET ".$this->variables_for_update_query()." WHERE `realty`.`id` = {$this->id};";

        mysqli_query(self::$db_link, $query);
        if ( ! mysqli_errno(self::$db_link))
        {
            return true;
        }

        return false;
    }

    public static function className()
    {
        return static::class;
    }

    public static function get_all ()
    {
        $all = [];
        $classname = static::className();
        if (self::$db_link === NULL) self::get_db_link();

        $query = "SELECT * FROM `".static::table_name()."` WHERE 1;";

        if ($result = mysqli_query(self::$db_link, $query)) {
//            die ( var_dump( $ ));
            while ($row = mysqli_fetch_assoc($result))
            {
                $one = new $classname;
                $one->load($row) ;
                $all[] = $one;
            }
            return $all;
        }
       return false;
    }

    protected function variables_for_update_query()
    {
        $list = '';
        if (!$fields = static::get_fields()) return false;

        foreach ( $fields as $f)
        {
            if ( $list !== '' ) $list.=', ';

            if ( isset($this->data[$f]) )
            {
                $list .= "`{$f}` = '{$this->data[$f]}'";
            }
        }

        return $list;
    }

    protected function load($array = [])
    {
        foreach($array as $k => $v)
        {
            $this->data[$k] = $v;
        }
    }

}