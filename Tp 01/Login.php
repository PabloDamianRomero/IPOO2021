<?php
class Login
{
    private $nombreUsuario;
    private $passwordAnterior;
    private $passwordActual;
    private $frase;

    public function __construct($nom, $passAnt, $passAct, $txt)
    {
        $this->nombreUsuario = $nom;
        $this->passwordAnterior = $passAnt;
        $this->passwordActual = $passAct;
        $this->frase = $txt;
    }

    public function getNombreUsuario()
    {
        return $this->nombreUsuario;
    }

    public function getPasswordActual()
    {
        return $this->passwordActual;
    }

    public function getPasswordAnterior()
    {
        return $this->passwordAnterior;
    }

    public function getFrase()
    {
        return $this->frase;
    }

    public function setNombreUsuario($n)
    {
        $this->nombreUsuario = $n;
    }

    public function setPasswordActual($p)
    {
        $this->passwordActual = $p;
    }

    public function setPasswordAnterior($p)
    {
        $this->getPasswordAnterior = $p;
    }

    public function setFrase($f)
    {
        $this->frase = $f;
    }

    public function __toString()
    {
        return "\nNombre: " . $this->getNombreUsuario() . "\nContraseña: " . $this->getPasswordActual() . "\nFrase: " . $this->getFrase() . "\n";
    }

    public function comprobarPassword($nueva)
    {
        $longitud = count($this->passwordAnterior);
        $existe = false;
        $i = 0;
        while (($i < $longitud) && (!$existe)) {
            if ($this->passwordAnterior[$i] == $nueva) {
                $existe = true;
            }
            $i++;
        }
        return $existe;
    }

    public function cambiarPassword($nuevoPassword)
    {
        $longitud = count($this->passwordAnterior);
        $copiaArreglo = $this->getPasswordAnterior();
        //print_r($copiaArreglo);
        $i = 0;
        while ($i < $longitud) {
            if ($i == $longitud - 1) {
                $this->passwordAnterior[$i] = $nuevoPassword;
            } else {
                $this->passwordAnterior[$i] = $copiaArreglo[$i + 1];
            }
            $i++;
        }
        $this->setPasswordActual($nuevoPassword);
        return $this->passwordAnterior;
    }

    public function recordar($usuario)
    {
        if ($this->getNombreUsuario() == $usuario) {
            $recordatorio = $this->getFrase();
        }
        return $recordatorio;
    }

}
