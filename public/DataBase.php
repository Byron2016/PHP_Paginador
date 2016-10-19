<?php
/*
class Db
{
        public static function connect()
        {
                if(!$link = mysql_connect(DB_HOST,DB_USER, DB_PASS)){
                        die('erro al concetar con el servidor');

                }
                if(!msql_select_db(DB_NAME)){
                        die('erro al concetar con base');
                }

                return $link;
        }
}
*/
class DataBase extends  PDO
{
        public function __construct()
        {



                $var = 'mysql:host=' . DB_HOST . 
                ';dbname=' . DB_NAME.
                ';port=' . DB_PORT.','.DB_USER.','. DB_PASS;
                //echo $var;
        parent::__construct(
                'mysql:host=' . DB_HOST . 
                ';dbname=' . DB_NAME.
                ';port=' . DB_PORT,
                DB_USER, 
                DB_PASS, 
                array(
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . DB_CHAR 
                ));
        
        }

} 


 