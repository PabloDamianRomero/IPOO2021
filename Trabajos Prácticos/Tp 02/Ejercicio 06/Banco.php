<?php
class Banco
{
    private $nombreBanco;
    private $colObjMostrador;

    public function __construct($pNombreBanco, $pColMostrador)
    {
        $this->nombreBanco = $pNombreBanco;
        $this->colObjMostrador = $pColMostrador;
    }

    public function getNombreBanco()
    {
        return $this->nombreBanco;
    }

    public function getColMostrador()
    {
        return $this->colObjMostrador;
    }

    public function setNombreBanco($pNombreBanco)
    {
        $this->nombreBanco = $pNombreBanco;
    }

    public function setColMostrador($pColMostrador)
    {
        $this->colObjMostrador = $pColMostrador;
    }

    public function __toString()
    {
        $cadena = "";
        $cadena .= "\n Nombre del banco: " . $this->getNombreBanco();
        if ($this->getColMostrador() != null) {
            $cadena .= "\n ====Mostradores==== ";
            $aux = $this->getColMostrador();
            $longitud = count($aux);
            for ($i = 0; $i < $longitud; $i++) {
                $cadena .= $aux[$i]->__toString();
            }
        } else {
            $cadena .= "\n No existen mostradores. ";
        }
        return $cadena;

    }

    /**
     * Retorna la colección de todos los mostradores que atienden ese trámite.
     */
    public function mostradoresQueAtienden($unTramite)
    {
        $col = null;
        if ($this->getColMostrador() != null) {
            $col = array();
            $aux = $this->getColMostrador();
            $longitud = count($aux);
            for ($i = 0; $i < $longitud; $i++) {
                if ($aux[$i]->atiende($unTramite)) {
                    $col[$i] = $aux[$i];
                }
            }
        }
        return $col;
    }

    /**
     *
     */
    public function mejorMostradorPara($unTramite)
    {
        $mejorMostrador = null;
        if ($this->getColMostrador() != null) {
            $aux = $this->getColMostrador();
            $longitud = count($aux);
            $menor = 9999999999;
            for ($i = 0; $i < $longitud; $i++) { // para c/ mostrador
                $tmp = count($aux[$i]->getColaCliente()); // longitud de Cola de cliente por mostrador
                $unaColaCliente = $aux[$i]->getColaCliente();
                if ($tmp < $menor) { // si la colaCliente es chica
                    $menor = $tmp; // reemplazo valor en menor
                    $j = 0;
                    $estaLibre = false;
                    while (($j < $tmp) && (!$estaLibre)) { // buscar espacio libre en colaCliente
                        if ($unaColaCliente[$j] == "") {
                            $estaLibre = true;
                            if ($aux[$i]->atiende($unTramite)) { // si el mostrador atiende ese tramite
                                $mejorMostrador = $aux[$i];
                            }
                        } else {
                            $j++;
                        }
                    }
                }
            }
        }
        return $mejorMostrador;
    }

    /**
     *
     */
    public function atender($unCliente)
    {
        $respuesta = "";
        if ($this->getColMostrador() != null) {
            $tramiteDelCliente = $unCliente->getTramite(); // un Objeto tramite
            $mejorMostrador = $this->mejorMostradorPara($tramiteDelCliente); // un objeto mostrador
            if ($mejorMostrador != null) { // ubicar cliente
                $cola = $mejorMostrador->getColaCliente(); // cola de clientes del mejor mostrador
                $longitudCola = count($cola);
                $i = 0;
                $seguir = true;
                while (($i < $longitudCola) && ($seguir)) {
                    if ($cola[$i] == "") { // si la cola de clientes tiene una posicion libre
                        $cola[$i] = $unCliente;
                        $seguir = false;
                    } else {
                        $i++;
                    }
                }
                if (!$seguir) { // si ya se encontró un lugar libre, se guardan los datos donde corresponden
                    $pocicionMostrador = $this->buscarPosicionMostrador($this->getColMostrador(), $mejorMostrador->getNroMostrador());
                    $colAuxMostrador = $this->getColMostrador();
                    $colAuxMostrador[$pocicionMostrador]->setColaCliente($cola);
                    $respuesta = "\nEl cliente ha sido atendido.\n";
                }
            } else {
                $respuesta = "\nSerá atendido en cuanto haya lugar en un mostrador.\n";
            }
        }
        return $respuesta;
    }

    public function buscarPosicionMostrador($col, $nro)
    {
        $valor = -1;
        $longitud = count($col);
        $i = 0;
        $encontrado = false;
        while (($i < $longitud) && (!$encontrado)) {
            if ($col[$i]->getNroMostrador() == $nro) {
                $encontrado = true;
                $valor = $i;
            } else {
                $i++;
            }
        }
        return $valor;
    }
}
