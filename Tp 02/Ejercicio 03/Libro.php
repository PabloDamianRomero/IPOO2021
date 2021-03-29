<?php
class Libro
{

    private $isbn;
    private $titulo;
    private $anioEdicion;
    private $editorial;
    private $cantPaginas;
    private $sinopsis;
    private $objAutor;

    public function __construct($pIsbn, $pTitulo, $pAnioEdicion, $pEditorial, $pCantPaginas, $pSinopsis, $pObjAutor)
    {
        $this->isbn = $pIsbn;
        $this->titulo = $pTitulo;
        $this->anioEdicion = $pAnioEdicion;
        $this->editorial = $pEditorial;
        $this->cantPaginas = $pCantPaginas;
        $this->sinopsis = $pSinopsis;
        $this->objAutor = $pObjAutor;
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

    public function getCantPaginas()
    {
        return $this->cantPaginas;
    }

    public function getSinopsis()
    {
        return $this->sinopsis;
    }

    public function getAutor()
    {
        return $this->objAutor;
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

    public function setCantPaginas($pCantPaginas)
    {
        $this->cantPaginas = $pCantPaginas;
    }

    public function setSinopsis($pSinopsis)
    {
        $this->sinopsis = $pSinopsis;
    }

    public function setAutor($pObjAutor)
    {
        $this->objAutor = $pObjAutor;
    }

    public function __toString()
    {
        return "-----------------------\n ISBN: " . $this->getIsbn() .
        "\n Título: " . $this->getTitulo() .
        "\n Año edición: " . $this->getAnioEdicion() .
        "\n Editorial: " . $this->getEditorial() .
        "\n Cantidad de páginas: " . $this->getCantPaginas() .
        "\n Sinopsis: " . $this->getSinopsis().
        "\n Autor" . $this->getAutor()."\n-----------------------";
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

    public function libroDeEditoriales($arreglo, $pEditorial)
    {
        $colFiltro = array();
        $longitud = count($arreglo);
        $posicion = 0;
        for ($i = 0; $i < $longitud; $i++) {
            $ed = $arreglo[$i]->getEditorial();
            if ($ed == $pEditorial) {
                $colFiltro[$posicion] = array("Datos" => $arreglo[$i]);
                $posicion++;
            }
        }
        return $colFiltro;
    }

}
