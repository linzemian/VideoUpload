<?php
    namespace Qiniu\Model;

    use Think\Model;

    class IndexModel extends Model
    {
        private static $_instance;

        public static function getInstance(array $options = NULL)
        {
            if(self::$_instance === NULL) {

                if($options === NULL) {
                    throw new InvalidArgumentException('null options first run');
                }

                try {
                    self::$_instance = new PDO($options['dsn'], $options['user'], $options['password'], $options['driver_options']);
                } catch (PDOException $e) {
                    echo 'Connection failed: ' . $e->getMessage();
                }
            }
            return self::$_instance;
        }

    }


    $DB = DB::getInstance(array(
        'dsn'=>'mysql:dbname=' . Config::DB_NAME . ';host=' . Config::DB_HOST,
        'user' => Config::DB_USER,
        'password' => Config::DB_PWD,
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND =>  'SET NAMES utf8'
    )));
    return $DB;
