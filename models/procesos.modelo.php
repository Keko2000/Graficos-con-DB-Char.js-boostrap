<?php
require_once "conexion.php";
class ProcesosModelo{
  static public function mdlListarTiemposProcesos(){
    $stmt = Conexion::conectar()->prepare("CALL prc_ListarTiemposProcesos");
    $stmt -> execute();
    $resultado = $stmt -> fetchAll();
    $stmt = null;
    return $resultado;
  }
}