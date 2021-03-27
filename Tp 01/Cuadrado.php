<?php
class Cuadrado
{
    private $puntos;

    public function __construct($ptos)
    {
        $this->puntos = $ptos;
    }

    public function getPuntos()
    {
        return $this->puntos;
    }

    public function setPuntos($p)
    {
        $this->puntos = $p;
    }

    public function comprobarFigura()
    {
        $respuesta = false;
        $pto1 = $this->puntos["Pto1"];
        $pto2 = $this->puntos["Pto2"];
        $pto3 = $this->puntos["Pto3"];
        $pto4 = $this->puntos["Pto4"];
        $lado1 = $this->distanciaEntrePuntos($pto1, $pto2);
        $lado2 = $this->distanciaEntrePuntos($pto2, $pto3);
        $lado3 = $this->distanciaEntrePuntos($pto3, $pto4);
        $lado4 = $this->distanciaEntrePuntos($pto4, $pto1);
        if ($lado1 == $lado2 && $lado1 == $lado3 && $lado1 == $lado4) {
            $respuesta = true;
        }
        return $respuesta;
    }

    public function distanciaEntrePuntos($p1, $p2)
    {
        $dist = sqrt(pow($p2[0]["valor1"] - $p1[0]["valor1"], 2) + pow($p2[0]["valor2"] - $p1[0]["valor2"], 2));
        return $dist;
    }

    public function area()
    {
        $pto1 = $this->puntos["Pto1"];
        $pto2 = $this->puntos["Pto2"];
        $lado = $this->distanciaEntrePuntos($pto1, $pto2);
        $areaCuadrado = pow($lado, 2);
        return $areaCuadrado;
    }

    public function desplazar($d){
        $x = $d[0]["valorX"];
        $y = $d[0]["valorY"];
        foreach ($this->puntos as $key => $coordenadas) {
            foreach ($coordenadas as $key => $valor) {
                //echo "\n".$valor["valor1"]+1;

                /**COMPLETAR (CAMBIAR VALORES INTERNOS DEL ARREGLO) */

            }
        }
        print_r($this->puntos);
    }

    public function puntoInferiorIzq()
    {
        $menorX = 999999;
        $menorY = 999999;
        foreach ($this->puntos as $key => $coordenadas) {
            foreach ($coordenadas as $key => $valor) {
                //echo "\n"."(".$valor["valor1"].",".$valor["valor2"].")";
                if ($valor["valor1"] < $menorX) {
                    $menorX = $valor["valor1"];
                }
                if ($valor["valor2"] < $menorY) {
                    $menorY = $valor["valor2"];
                }
            }
        }
        echo "\n MenorX: " . $menorX;
        echo "\n MenorY: " . $menorY;
    }

}