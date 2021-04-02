<?php
class Lectura
{
    private $objLibro;
    private $numeroPag;
    private $librosLeidos;

    public function __construct($pObjLibro, $pNumeroPag)
    {
        $this->objLibro = $pObjLibro;
        $this->numeroPag = $pNumeroPag;
        //$this->librosLeidos = null;
    }

    public function getLibro()
    {
        return $this->objLibro;
    }

    public function getNumeroPag()
    {
        return $this->numeroPag;
    }

    public function getLibrosLeidos()
    {
        return $this->librosLeidos;
    }

    public function setLibro($pObjLibro)
    {
        $this->objLibro = $pObjLibro;
    }

    public function setNumeroPag($pNumeroPag)
    {
        $this->numeroPag = $pNumeroPag;
    }

    public function setLibrosLeidos($pLibrosLeidos)
    {
        $this->librosLeidos = $pLibrosLeidos;
    }

    public function __toString()
    {
        $cadena = " ";
        $cadena = "\n----------Libro----------" . $this->getLibro() .
        $cadena .= "\n\nNúmero de página actual: " . $this->getNumeroPag();
        $cadena .= "\n\n=============LIBROS LEÍDOS=============";
        if ($this->getLibrosLeidos() != null) {
            $longitud = count($this->getLibrosLeidos());
            for ($i = 0; $i < $longitud; $i++) {
                $cadena .= "\n" . $this->getLibrosLeidos()[$i]->__toString();
            }
        } else {
            $cadena .= "\nNo existen libros leídos";
        }

        return $cadena;
    }

    public function siguientePagina()
    {
        $cant = $this->getLibro()->getCantPaginas();
        if (($this->getNumeroPag() > 0) && ($this->getNumeroPag() < $cant)) {
            $this->setNumeroPag($this->getNumeroPag() + 1);
        }
        return $this->getNumeroPag();
    }

    public function retrocederPagina()
    {
        $cant = $this->getLibro()->getCantPaginas();
        if (($this->getNumeroPag() > 1) && ($this->getNumeroPag() < $cant)) {
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

    public function darSinopsis($titulo)
    {
        $cadena = "\nNo hay sinopsis disponibles";
        if ($this->getLibrosLeidos() != null) {
            $aux = $this->getLibrosLeidos();
            $longitud = count($aux);
            //print_r($aux);
            for ($i = 0; $i < $longitud; $i++) {
                if ($aux[$i]->getTitulo() == $titulo) {
                    $cadena = "\nSinopsis de " . $titulo . ": " . $aux[$i]->getSinopsis();
                }
            }
        }
        return $cadena;
    }

    public function leidosAnioEdicion($x)
    {
        $col = null;
        if ($this->getLibrosLeidos() != null) {
            $aux = $this->getLibrosLeidos();
            $longitud = count($aux);
            $col = array();
            for ($i = 0; $i < $longitud; $i++) {
                if($aux[$i]->getAnioEdicion() == $x){
                    $col[$i] = $aux[$i]->getTitulo() . "- (".$x.")";
                }
            }
        }
        return $col;
    }

    public function darLibrosPorAutor($nombreAutor){
        $col = null;
        if ($this->getLibrosLeidos() != null) {
            $aux = $this->getLibrosLeidos();
            $longitud = count($aux);
            $col = array();
            for ($i = 0; $i < $longitud; $i++) {
                echo "\nNNNNN: ".$aux[$i]->getAutor()->getNombre();
                if($aux[$i]->getAutor()->getNombre() == $nombreAutor){
                    $col[$i] = $aux[$i]->getTitulo() . "- (".$nombreAutor.")";
                }
            }
        }
        return $col;
    }

}
