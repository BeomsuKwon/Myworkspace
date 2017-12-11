<?php
class Model {
    static private  $host           = "localhost",
                    $userId         = "root",
                    $userPassword   = "autoset",
                    $database       = null;
    static private  $connection     = null;

    private function __construct() {}

    static public function get_connection($database) {
        self::$database = $database;
        if(self::$connection == null){
            @self::$connection = new mysqli(self::$host, self::$userId, self::$userPassword, self::$database);
            if(self::$connection->connect_errno){
                exit("<script>alert('failed to connect with DB')</script>");
            }
        }
        return self::$connection;
    }
}
?>