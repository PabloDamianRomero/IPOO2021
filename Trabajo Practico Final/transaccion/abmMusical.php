<?php
class abmMusical
{

    public function insertarFuncion($col)
    {
        $objMusical = new Musical();
        $objMusical->cargar($col);
        $respuesta = $objMusical->insertar();
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
                $objFuncion->setDirector($valor);
                break;
            case 7:
                $objFuncion->setCantPersonasEscena($valor);
                break;
        }
        $respuesta = $objFuncion->modificar();
        return $respuesta;
    }

    public function eliminarFuncion($idFuncion)
    {
        $objFuncion = new Musical();
        $objFuncion->setIdFuncion($idFuncion);
        $respuesta = $objFuncion->eliminar();
        return $respuesta;
    }

    public function seleccionFuncion($idFuncion)
    {
        $funcion = new Musical();
        $retorno = null;
        $respuesta = $funcion->Buscar($idFuncion);
        if ($respuesta) {
            $retorno = $funcion;
        }
        return $retorno;
    }

}
