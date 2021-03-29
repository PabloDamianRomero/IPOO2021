<?php
class Lectura
{
    private $objLibro;
    private $numeroPag;

    public function __construct($pObjLibro, $pNumeroPag)
    {
        $this->objLibro = $pObjLibro;
        $this->numeroPag = $pNumeroPag;
    }

    public function getLibro()
    {
        return $this->objLibro;
    }

    public function getNumeroPag()
    {
        return $this->numeroPag;
    }

    public function setLibro($pObjLibro)
    {
        $this->objLibro = $pObjLibro;
    }

    public function setNumeroPag($pNumeroPag)
    {
        $this->numeroPag = $pNumeroPag;
    }

    public function __toString()
    {
        $cadena = " ";
        $cadena = "\n----------Libro----------" . $this->getLibro() .
        $cadena .= "\nNúmero de página actual: " . $this->getNumeroPag();
        return $cadena;
    }

    public function siguientePagina()
    {
        $cant = $this->getLibro()->getCantPaginas();
        if (($this->getNumeroPag() > 0) && ($this->getNumeroPag() <= $cant)) {
            $this->setNumeroPag($this->getNumeroPag() + 1);
        }
        return $this->getNumeroPag();
    }

    public function retrocederPagina()
    {
        $cant = $this->getLibro()->getCantPaginas();
        if (($this->getNumeroPag() > 0) && ($this->getNumeroPag() <= $cant)) {
            $this->setNumeroPag($this->getNumeroPag() - 1);
        }
        return $this->getNumeroPag();
    }

    public function irPagina($proxima)
    {
        $cant = $this->getLibro()->getCantPaginas();
        if (($proxima > 0) && ($proxima <= $cant)) {
            $this->setNumeroPag($proxima);
        }
        return $this->getNumeroPag();
    }
}
