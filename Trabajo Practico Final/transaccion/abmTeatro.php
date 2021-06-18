<?php
class abmTeatro
{

    public function insertarTeatro($objTeatro)
    {
        $mensaje = "";
        $respuesta = $objTeatro->insertar();
        if ($respuesta == true) {
            $mensaje = "\nOP INSERCION: El teatro fue ingresado correctamente a la BD";
        } else {
            $mensaje = $objTeatro->getMensajeOperacion();
        }
        return $mensaje;
    }

    public function modificarNombreTeatro($objTeatro, $nombre)
    {
        $mensaje = "";
        $objTeatro->setNombreTeatro($nombre);
        $respuesta = $objTeatro->modificar();
        if ($respuesta) {
            $mensaje = "\nOP MODIFICACION: Nombre actualizado correctamente";
        } else {
            $mensaje = $objTeatro->getMensajeOperacion();
        }
        return $mensaje;
    }

    public function modificarDireccionTeatro($objTeatro, $direccion)
    {
        $mensaje = "";
        $objTeatro->setDireccionTeatro($direccion);
        $respuesta = $objTeatro->modificar();
        if ($respuesta) {
            $mensaje = "\nOP MODIFICACION: Dirección actualizada correctamente";
        } else {
            $mensaje = $objTeatro->getMensajeOperacion();
        }
        return $mensaje;
    }

    public function eliminarTeatro($objTeatro)
    {
        $funciones = $objTeatro->getColObjFunciones();
        $respuesta = true;
        $i = 0;
        $longitud = count($funciones);
        while ($i < $longitud) {
            $respuesta = $funciones[$i]->eliminar();
            $i++;
        }
        if ($respuesta) {
            $respuesta = $objTeatro->eliminar();
        }
        return $respuesta;
    }

    public function seleccionTeatro($idTeatro)
    {
        $objTeatro = new Teatro();
        $retorno = null;
        $respuesta = $objTeatro->Buscar($idTeatro);
        if ($respuesta) {
            $retorno = $objTeatro;
        }
        return $retorno;
    }

}
