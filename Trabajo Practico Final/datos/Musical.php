<?php
# PABLO DAMIAN ROMERO - FAI 1652
class Musical extends Funcion
{
    /**
     * Declaración de variables
     */
    private $director;
    private $cantPersonasEscena;

    /**
     * Método constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->director = "";
        $this->cantPersonasEscena = "";
    }

    /**
     * Método de carga de datos
     */
    public function cargar($datos)
    {
        parent::cargar($datos);
        $this->setDirector($datos["director"]);
        $this->setCantPersonasEscena($datos["cantPersonasEscena"]);
    }

    /**
     * Obtiene el valor de director
     */
    public function getDirector()
    {
        return $this->director;
    }

    /**
     * Obtiene el valor de cantPersonasEscena
     */
    public function getCantPersonasEscena()
    {
        return $this->cantPersonasEscena;
    }

    /**
     * Modifica el valor de director
     */
    public function setDirector($pDirector)
    {
        $this->director = $pDirector;
    }

    /**
     * Modifica el valor de cantPersonasEscena
     */
    public function setCantPersonasEscena($pCant)
    {
        $this->cantPersonasEscena = $pCant;
    }

    /**
     * Devuelve los datos de la clase
     */
    public function __toString()
    {
        $cadena = "";
        $cadena .= parent::__toString();
        $cadena .= "\n\t * Director: " . $this->getDirector();
        $cadena .= "\n\t * Personas en escena: " . $this->getCantPersonasEscena();
        return $cadena;
    }

    /**
     * Devuelve el precio de la función con calculo de incremento
     */
    public function recibirCosto()
    {
        $costo = parent::recibirCosto() * 0.12;
        return $costo;
    }

#-----------------------------------------------------------------------------------------------------------------------------------------------------------------------
    /**
     * Recupera los datos de un musical por id_funcion
     *
     * @return true en caso de encontrar los datos, false en caso contrario
     */
    public function Buscar($id)
    {
        $base = new BaseDatos();
        $consulta = "SELECT * FROM musical WHERE id_funcion=" . $id;
        $resp = false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                if ($row2 = $base->Registro()) {
                    parent::Buscar($id);
                    $this->setDirector($row2['director']);
                    $this->setCantPersonasEscena($row2['cantPersonasEscena']);
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
     * Genera un arreglo con todos los datos de la tabla musical en la bd
     * según una condición
     */
    public function listar($condicion = "")
    {
        $arreglo = null;
        $base = new BaseDatos();
        $consulta = "SELECT * FROM musical ";
        if ($condicion != "") {
            $consulta = $consulta . ' WHERE ' . $condicion;
        }
        $consulta .= " ORDER BY musical.id_funcion ";

        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                $arreglo = array();
                while ($row2 = $base->Registro()) {
                    $obj = new Musical();
                    $obj->Buscar($row2["id_funcion"]);
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
            $consultaInsertar = "INSERT INTO musical(id_funcion, director, cantPersonasEscena)
				VALUES (" . parent::getIdFuncion() . ",'" . $this->getDirector() . "'," . $this->getCantPersonasEscena() . ")";
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
            $consultaModifica = "UPDATE musical SET director='" . $this->getDirector() . "',cantPersonasEscena=" . 
            $this->getCantPersonasEscena() . " WHERE id_funcion=" . parent::getIdFuncion();
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
            $consultaBorra = "DELETE FROM musical WHERE id_funcion=" . parent::getIdFuncion();
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
