<?php
require_once "../controllers/procesos.controller.php";
require_once "../models/procesos.modelo.php";
class AjaxProcesos{
  public function ListarTiemposProcesos(){
    $respesta = ProcesosController::ctrListarTiemposProcesos();
    echo json_encode($respesta);
  }
}

$procesos = new AjaxProcesos();
$procesos->ListarTiemposProcesos();