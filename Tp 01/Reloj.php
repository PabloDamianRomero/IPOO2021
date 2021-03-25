<?php
class Reloj
{

    private $hora;
    private $minuto;
    private $segundo;

    public function __construct()
    {
        $this->hora = 0;
        $this->minuto = 0;
        $this->segundo = 0;
    }

    public function getHora()
    {
        return $this->hora;
    }

    public function getMinuto()
    {
        return $this->minuto;
    }

    public function getSegundo()
    {
        return $this->segundo;
    }

    public function setHora($h)
    {
        $this->hora = $h;
    }

    public function setMinuto($m)
    {
        $this->minuto = $m;
    }

    public function setSegundo($s)
    {
        $this->segundo = $s;
    }

    public function reiniciar()
    {
        $this->setHora(0);
        $this->setMinuto(0);
        $this->setSegundo(0);
    }

    public function incremento($seg)
    {
        $segTotales = $seg + $this->convertirTodoEnSegundos();
        $segRestante = (int) ($segTotales % 60); // calculo el resto usando función módulo (%)
        $hs = intdiv($segTotales, 60);
        $min = $hs % 60;
        $hs = intdiv($hs, 60);
        $this->setHora($hs);
        $this->setMinuto($min);
        $this->setSegundo($segRestante);
        if ($this->comprobarLimite()) {
            $this->reiniciar();
        }
    }

    public function convertirTodoEnSegundos()
    {
        $segTotales = ($this->getHora() * 3600) + ($this->getMinuto() * 60) + ($this->getSegundo());
        return $segTotales;
    }

    public function comprobarLimite()
    {
        $hs = $this->getHora();
        $min = $this->getMinuto();
        $seg = $this->getSegundo();
        $bandera = false;
        if (($hs > 23)) {
            $bandera = true;
        }
        return $bandera;
    }

    public function __toString()
    {
        return "\n" . $this->getHora() . " hs: " .
        $this->getMinuto() . " min: " .
        $this->getSegundo() . " seg\n";
    }
}
