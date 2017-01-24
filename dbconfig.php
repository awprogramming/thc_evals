<?php
  class Db {
    private static $instance = NULL;

    private function __construct() {}

    private function __clone() {}

    public static function getInstance() {
      if (!isset(self::$instance)) {
        define('DB_USERNAME','root');
		define('DB_PASSWORD','ariewolfdb');
		define('DB_SERVER','localhost');
		define('DB_DATABASE','ariedw5_evals');
		$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die( "Unable to connect");
		$database = mysqli_select_db($connection,DB_DATABASE) or die( "Unable to select database");
        self::$instance = $connection;
      }
      return self::$instance;
    }
  }
?>