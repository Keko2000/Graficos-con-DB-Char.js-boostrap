<?php

class Conexion{
  static public function conectar(){
    try{
      $conn = new PDO("mysql:host=localhost;dbname=calidad_sima","root","",array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
      return $conn;
    }
    catch(PDOException $e){
      echo "Fallo coneccion " .$e->getMessage();
    }
  }
}
