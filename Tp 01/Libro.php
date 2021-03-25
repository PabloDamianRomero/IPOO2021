<?php
class Libro
{

    private $isbn;
    private $titulo;
    private $anioEdicion;
    private $editorial;
    private $nombreAutor;
    private $apellidoAutor;

    public function __construct($pIsbn, $pTitulo, $pAnioEdicion, $pEditorial, $pNombreAutor, $pApellidoAutor)
    {
        $this->isbn = $pIsbn;
        $this->titulo = $pTitulo;
        $this->anioEdicion = $pAnioEdicion;
        $this->editorial = $pEditorial;
        $this->nombreAutor = $pNombreAutor;
        $this->apellidoAutor = $pApellidoAutor;
    }

    public function getIsbn()
    {
        return $this->isbn;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getAnioEdicion()
    {
        return $this->anioEdicion;
    }

    public function getEditorial()
    {
        return $this->editorial;
    }

    public function getNombreAutor()
    {
        return $this->nombreAutor;
    }

    public function getApellidoAutor()
    {
        return $this->apellidoAutor;
    }

    public function setIsbn($pIsbn)
    {
        $this->isbn = $pIsbn;
    }

    public function setTitulo($pTitulo)
    {
        $this->titulo = $pTitulo;
    }

    public function setAnioEdicion($pAnioEdicion)
    {
        $this->anioEdicion = $pAnioEdicion;
    }

    public function setEditorial($pEditorial)
    {
        $this->editorial = $pEditorial;
    }

    public function setNombreAutor($pNombreAutor)
    {
        $this->nombreAutor = $pNombreAutor;
    }

    public function setApellidoAutor($pApellidoAutor)
    {
        $this->apellidoAutor = $pApellidoAutor;
    }

    public function __toString()
    {
        return "\n ISBN: " . $this->getIsbn() .
        "\n Título: " . $this->getTitulo() .
        "\n Año edición: " . $this->getAnioEdicion() .
        "\n Editorial: " . $this->getEditorial() .
        "\n Nombre y Apellido de autor/a: " . $this->getNombreAutor() .
        " " . $this->getApellidoAutor() . "\n";
    }

    public function perteneceEditorial($pEditorial)
    {
        $encontrado = false;
        if (($this->getEditorial()) == $pEditorial) {
            $encontrado = true;
        }
        return $encontrado;
    }

    public function iguales($pLibro, $pArreglo)
    {
        $longitud = count($pArreglo);
        $encontrado = false;
        $i = 0;
        while (($i < $longitud) && (!$encontrado)) {
            if (($pLibro->getIsbn()) == ($pArreglo[$i]->getIsbn())) {
                $encontrado = true;
            }
            $i++;
        }
        return $encontrado;
    }

    public function aniosDesdeEdicion()
    {
        $anioActual = date("Y");
        $diferencia = $anioActual - ($this->getAnioEdicion());
        return $diferencia;
    }

    public function libroDeEditoriales($arregloAutor, $pEditorial)
    {
        // completar
    }

}
