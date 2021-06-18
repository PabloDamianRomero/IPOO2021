<?php
class abmObraTeatro
{

    public function insertarFuncion($col)
    {
        $objObraTeatro = new ObraTeatral();
        $objObraTeatro->cargar($col);
        $respuesta = $objObraTeatro->insertar();
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
                $objFuncion->setAutor($valor);
                break;
        }
        $respuesta = $objFuncion->modificar();
        return $respuesta;
    }

    public function eliminarFuncion($idFuncion)
    {
        // echo "\n***". $idFuncion;
        $objFuncion = new ObraTeatral();
        $objFuncion->setIdFuncion($idFuncion);
        $respuesta = $objFuncion->eliminar();
        return $respuesta;
    }

    public function seleccionFuncion($idFuncion)
    {
        $funcion = new ObraTeatral();
        $retorno = null;
        $respuesta = $funcion->Buscar($idFuncion);
        if ($respuesta) {
            $retorno = $funcion;
        }
        return $retorno;
    }

}
