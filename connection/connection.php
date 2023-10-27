<?php
class Database{
   public static $connection;
   public  static function setupConnection(){
      if(!isset(Database::$connection)){
         Database::$connection = new mysqli("localhost","root","UthilaMSI2021","school_management_system","3306");
      }
   }

   public static function uid($q){
      Database::setupConnection();
      if(!Database::$connection->query($q)){
         echo "Error description: " .Database:: $connection -> error;
      }
      return;
   }

   public static function select($q){
      Database::setupConnection();
      $resultset = Database::$connection->query($q); 
      return $resultset;
   }
}
