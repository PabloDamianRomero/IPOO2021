<?php
class abmCine
{

    public function insertarFuncion($col)
    {
        $objCine = new Cine();
        $objCine->cargar($col);
        $respuesta = $objCine->insertar();
        return $respuesta;
    }

    public function modificarFuncion($objFuncion, $opcion, $valor)
    {
        switch ($opcion) {
            case 1:
                $objFuncion->setNombreFuncion($valor);
                break;
            case 2:
                $objFuncion->setHoraInicio($valor);
                break;
            case 3:
                $objFuncion->setDuracion($valor);
                break;
            case 4:
                $objFuncion->setPrecioFuncion($valor);
                break;
            case 5:
                $objFuncion->setMes($valor);
                break;
            case 6:
                $objFuncion->setGenero($valor);
                break;
            case 7:
                $objFuncion->setPaisOrigen($valor);
                break;
        }
        $respuesta = $objFuncion->modificar();
        return $respuesta;
    }

    public function eliminarFuncion($idFuncion)
    {
        $objFuncion = new Cine();
        $objFuncion->setIdFuncion($idFuncion);
        $respuesta = $objFuncion->eliminar();
        return $respuesta;
    }

    public function seleccionFuncion($idFuncion)
    {
        $funcion = new Cine();
        $retorno = null;
        $respuesta = $funcion->Buscar($idFuncion);
        if ($respuesta) {
            $retorno = $funcion;
        }
        return $retorno;
    }

}
