<?php

class ProcesosController
{
  static public function ctrListarTiemposProcesos()
  {
    $respuesta = ProcesosModelo::mdlListarTiemposProcesos();
    return $respuesta;
  }
}
