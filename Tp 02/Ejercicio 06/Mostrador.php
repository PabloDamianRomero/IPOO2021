<?php
class Mostrador
{
    private $nroMostrador;
    private $tipoTramiteAtiende;
    private $colaObjCliente;

    public function __construct($pNro, $pTipo, $pCola)
    {
        $this->nroMostrador = $pNro;
        $this->tipoTramiteAtiende = $pTipo;
        $this->colaObjCliente = $pCola;
    }

    public function getNroMostrador()
    {
        return $this->nroMostrador;
    }

    public function getTipoTramiteAtiende()
    {
        return $this->tipoTramiteAtiende;
    }

    public function getColaCliente()
    {
        return $this->colaObjCliente;
    }

    public function setNroMostrador($pNro)
    {
        $this->nroMostrador = $pNro;
    }

    public function setTipoTramiteAtiende($pTipo)
    {
        $this->tipoTramiteAtiende = $pTipo;
    }

    public function setColaCliente($pCola)
    {
        $this->colaObjCliente = $pCola;
    }

    public function __toString()
    {
        $cadena = "\n--------------------------------------------------------";
        $cadena .= "\n\t Nro mostrador: " . $this->getNroMostrador();
        $cadena .= "\n\t Tipo de tramite que atiende: " . $this->getTipoTramiteAtiende();
        $cadena .= "\n Cola de cliente: ";
        if ($this->getColaCliente() != null) {
            $aux = $this->getColaCliente();
            $longitud = count($aux);
            for ($i = 0; $i < $longitud; $i++) {
                if($aux[$i] != ""){
                    $cadena .= $aux[$i]->__toString();
                }else{
                    $cadena .= "\n\n\t\t **Espacio Libre para un cliente**";
                }
            }
            $cadena .= "\n--------------------------------------------------------";
        } else {
            echo "\n No existe cola de clientes. ";
        }
        return $cadena;
    }

    /**
     * Devuelve true o false indicando si el tramite se puede atender o no en el mostrador;
     * El tipo de trámite correspondiente a unTramite tiene que coincidir con
     * alguno de los tipos de trámite que atiende el mostrador.
     */
    public function atiende($unTramite)
    {
        $respuesta = false;
        $valor = $unTramite->getTipoTramite();
        if ($this->getTipoTramiteAtiende() == $valor) {
            $respuesta = true;
        }
        return $respuesta;
    }
}
