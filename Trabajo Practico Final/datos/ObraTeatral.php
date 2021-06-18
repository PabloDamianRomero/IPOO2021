<?php
# PABLO DAMIAN ROMERO - FAI 1652
class ObraTeatral extends Funcion
{
    /**
     * Declaración de variables
     */
    private $autor;

    /**
     * Método constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->autor = "";
    }

    /**
     * Método de carga de datos
     */
    public function cargar($datos)
    {
        parent::cargar($datos);
        $this->setAutor($datos["autor"]);
    }

    /**
     * Obtiene el valor de autor
     */
    public function getAutor()
    {
        return $this->autor;
    }

    /**
     * Modifica el valor de autor
     */
    public function setAutor($pAutor)
    {
        $this->autor = $pAutor;
    }

    /**
     * Devuelve los datos de la clase
     */
    public function __toString()
    {
        $cadena = "";
        $cadena .= parent::__toString();
        $cadena .= "\n\t * Autor: " . $this->getAutor();
        return $cadena;
    }

    /**
     * Devuelve el precio de la función con calculo de incremento
     */
    public function recibirCosto()
    {
        $costo = parent::recibirCosto() * 0.45;
        return $costo;
    }

#-----------------------------------------------------------------------------------------------------------------------------------------------------------------------
    /**
     * Recupera los datos de un obraTeatral por id_funcion
     *
     * @return true en caso de encontrar los datos, false en caso contrario
     */
    public function Buscar($id)
    {
        $base = new BaseDatos();
        $consulta = "SELECT * FROM obrateatral WHERE id_funcion=" . $id;
        $resp = false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                if ($row2 = $base->Registro()) {
                    parent::Buscar($id);
                    $this->setAutor($row2['autor']);
                    $resp = true;
                }
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $resp;
    }

    /**
     * Genera un arreglo con todos los datos de la tabla obrateatral en la bd
     * según una condición
     */
    public function listar($condicion = "")
    {
        $arreglo = null;
        $base = new BaseDatos();
        $consulta = "SELECT * FROM obrateatral ";
        if ($condicion != "") {
            $consulta = $consulta . ' WHERE ' . $condicion;
        }
        $consulta .= " ORDER BY obrateatral.id_funcion ";

        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                $arreglo = array();
                while ($row2 = $base->Registro()) {
                    $obj = new ObraTeatral();
                    $obj->Buscar($row2['id_funcion']);
                    array_push($arreglo, $obj);
                }
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $arreglo;
    }

    /**
     *
     */
    public function insertar()
    {
        $base = new BaseDatos();
        $resp = false;

        if (parent::insertar()) {
            $consultaInsertar = "INSERT INTO obrateatral(id_funcion, autor)
				VALUES (" . parent::getIdFuncion() . ",'" . $this->getAutor() . "')";
            if ($base->Iniciar()) {
                if ($base->Ejecutar($consultaInsertar)) {
                    $resp = true;
                } else {
                    $this->setMensajeOperacion($base->getError());
                }
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        }
        return $resp;
    }

    /**
     *
     */
    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        if (parent::modificar()) {
            $consultaModifica = "UPDATE obrateatral SET autor='" . $this->getAutor() . "' WHERE id_funcion=" . parent::getIdFuncion();
            if ($base->Iniciar()) {
                if ($base->Ejecutar($consultaModifica)) {
                    $resp = true;
                } else {
                    $this->setMensajeOperacion($base->getError());
                }
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        }

        return $resp;
    }

    /**
     *
     */
    public function eliminar()
    {
        $base = new BaseDatos();
        $resp = false;
        if ($base->Iniciar()) {
            $consultaBorra = "DELETE FROM obrateatral WHERE id_funcion=" . parent::getIdFuncion();
            if ($base->Ejecutar($consultaBorra)) {
                if (parent::eliminar()) {
                    $resp = true;
                }
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $resp;
    }

} // Fin de clase
