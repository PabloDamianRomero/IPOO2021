<?php
class Banco{
    private $coleccionCuentaCorriente;
    private $coleccionCajaAhorro;
    private $nroCuenta;
    private $coleccionCliente;

    public function __construct($pColClientes){
        $this->coleccionCuentaCorriente = array();
        $this->coleccionCajaAhorro = array();
        $this->nroCuenta = 0;
        $this->coleccionCliente = $pColClientes;
    }

    /**
     * Get the value of coleccionCuentaCorriente
     */
    public function getColeccionCuentaCorriente()
    {
        return $this->coleccionCuentaCorriente;
    }

    /**
     * Get the value of coleccionCajaAhorro
     */
    public function getColeccionCajaAhorro()
    {
        return $this->coleccionCajaAhorro;
    }

    /**
     * Get the value of nroCuenta
     */
    public function getNroCuenta()
    {
        return $this->nroCuenta;
    }

    /**
     * Get the value of coleccionCliente
     */
    public function getColeccionCliente()
    {
        return $this->coleccionCliente;
    }


    /**
     * Set the value of coleccionCuentaCorriente
     */
    public function setColeccionCuentaCorriente($coleccionCuentaCorriente)
    {
        $this->coleccionCuentaCorriente = $coleccionCuentaCorriente;

    }


    /**
     * Set the value of coleccionCajaAhorro
     */
    public function setColeccionCajaAhorro($coleccionCajaAhorro)
    {
        $this->coleccionCajaAhorro = $coleccionCajaAhorro;

    }


    /**
     * Set the value of nroCuenta
     */
    public function setNroCuenta($nroCuenta)
    {
        $this->nroCuenta = $nroCuenta;
    }


    /**
     * Set the value of coleccionCliente
     */
    public function setColeccionCliente($coleccionCliente)
    {
        $this->coleccionCliente = $coleccionCliente;
    }

    public function __toString(){
        $cadena = "";
        $cadena .= "\nNúmero de cuenta: ".$this->getNroCuenta();
        $cadena .= "\nColección Cuenta Corriente: ".$this->mostrarColeccion($this->getColeccionCuentaCorriente());
        $cadena .= "\nColección Caja Ahorro: ".$this->mostrarColeccion($this->getColeccionCajaAhorro());
        $cadena .= "\nColección Cliente: ".$this->mostrarColeccion($this->getColeccionCliente());
        return $cadena;
    }

    private function mostrarColeccion($unaCol){
        $longitud = count($unaCol);
        $cadena = "";
        $cadena .= "\n============================================================================================";
        for($i = 0; $i<$longitud;$i++){
            $cadena .= "\n ".$unaCol[$i];
        }
        $cadena .= "\n============================================================================================";
        return $cadena;
    }


    public function agregarCliente($objCliente){
        $existeElCliente = $this->existeCliente($objCliente);
        if($existeElCliente == null){
            $colClientes = $this->getColeccionCliente();
            array_push($colClientes,$objCliente);
            $this->setColeccionCliente($colClientes);
        }
    }

    private function existeCliente($objCliente){
        $clienteExiste = null;
        $colClientes = $this->getColeccionCliente();
        $longitud = count($colClientes);
        $dniParametro = $objCliente->getNumDoc();
        $i = 0;
        while(($i < $longitud) && ($clienteExiste == null)){
            $dniCliente = $colClientes[$i]->getNumDoc();
            if($dniCliente == $dniParametro){
                $clienteExiste = $colClientes[$i];
            }
            $i++;
        }
        return $clienteExiste;
    }

    private function verificarNumCliente($numCliente){
        $clienteExiste = null;
        $colClientes = $this->getColeccionCliente();
        $longitud = count($colClientes);
        $i = 0;
        while(($i < $longitud) && ($clienteExiste == null)){
            $numeroBusca = $colClientes[$i]->getNumCliente();
            if($numCliente == $numeroBusca){
                $clienteExiste = $colClientes[$i];
            }
            $i++;
        }
        return $clienteExiste;
    }

    public function incorporarCuentaCorriente($numCliente){
        $objCuentaCorriente = null;
        $objClienteNuevo = $this->verificarNumCliente($numCliente);
        if($objClienteNuevo != null){
            $numCuenta = $this->getNroCuenta() + 1;
            $objCuentaCorriente = new CuentaCorriente($numCuenta, 0, $objClienteNuevo, 0);
            $colCuentaCorriente = $this->getColeccionCuentaCorriente();
            array_push($colCuentaCorriente, $objCuentaCorriente);
            $this->setColeccionCuentaCorriente($colCuentaCorriente);
            $this->setNroCuenta($numCuenta);
        }
        return $objCuentaCorriente;
    }

    public function incorporarCajaAhorro($numCliente){
        $objCajaAhorro = null;
        $objClienteNuevo = $this->verificarNumCliente($numCliente);
        if($objClienteNuevo != null){
            $numCuenta = $this->getNroCuenta() + 1;
            $objCajaAhorro = new CajaAhorro($numCuenta, 0, $objClienteNuevo);
            $colCajaAhorro = $this->getColeccionCajaAhorro();
            array_push($colCajaAhorro, $objCajaAhorro);
            $this->setColeccionCajaAhorro($colCajaAhorro);
            $this->setNroCuenta($numCuenta);
        }
        return $objCajaAhorro;
    }

    private function obtenerCuenta($numCuenta){
        $objCuenta = null;
        $i = 0;
        $colCuentas = array_merge($this->getColeccionCuentaCorriente(), $this->getColeccionCajaAhorro());
        $longitud = count($colCuentas);
        while(($i < $longitud) && ($objCuenta == null)){
            $numeroBusca = $colCuentas[$i]->getNumCuenta();
            if($numCuenta == $numeroBusca){
                $objCuenta = $colCuentas[$i];
            }
            $i++;
        }
        return $objCuenta;
    }

    public function realizarDeposito($numCuenta, $monto){
        $objCuenta = $this->obtenerCuenta($numCuenta);
        if($objCuenta != null){
            $exito = $objCuenta->realizarDeposito($monto);
        }
        return $exito;
    }

    public function realizarRetiroBanco($numCuenta, $monto){
        $objCuenta = $this->obtenerCuenta($numCuenta);
        if($objCuenta != null){
            $exito = $objCuenta->realizarRetiro($monto);
        }
        return $exito;
    }
    
}

