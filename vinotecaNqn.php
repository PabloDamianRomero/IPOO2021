<?php
/**
 * PABLO DAMIAN ROMERO - FAI 1652
 *
 * Enlace gitHub: https://github.com/PabloDamianRomero/IPOO2021.git
 *
 * Dado una estructura de arreglos asociativos, donde cada posición del arreglo se corresponde
 * con una variedad de vino (malbec, cabernet Sauvignon, Merlot) y se almacena la siguiente información:
 * variedad, cantidad de botellas, año de producción, precio por unidad:
 * */

/**
 * Implementar una función que reciba un arreglo con las características mencionadas y
 * retorne  un arreglo que por variedad de vino guarde la cantidad total de botellas y el precio promedio.
 * @return array
 */
function inventario($vinos)
{
 $sumaMalbec           = 0;
 $cantBotellasMalbec   = 0;
 $sumaCabernet         = 0;
 $cantBotellasCabernet = 0;
 $sumaMerlot           = 0;
 $cantBotellasMerlot   = 0;
 $contadorMalbec       = 0;
 $contadorCabernet     = 0;
 $contadorMerlot       = 0;
 $longitudTotal        = count($vinos);
 $longitudMalbec       = count($vinos["Malbec"]);
 $longitudCabernet     = count($vinos["Cabernet"]);
 $longitudMerlot       = count($vinos["Merlot"]);

 // Se recorre el arreglo más externo en su totalidad
 for ($i = 0; $i < $longitudTotal; $i++) {
  // Se recorre la totalidad del arreglo con clave "Malbec" y se realizan las operaciones
  while (($contadorMalbec < $longitudMalbec) && ($i == 0)) {
   $cantBotellasMalbec = $cantBotellasMalbec + $vinos["Malbec"][$contadorMalbec]["cantidad"];
   $sumaMalbec         = $sumaMalbec + $vinos["Malbec"][$contadorMalbec]["precioUnidad"];
   $contadorMalbec++;
  }
// Se recorre la totalidad del arreglo con clave "Cabernet" y se realizan las operaciones
  while (($contadorCabernet < $longitudCabernet) && ($i == 1)) {
   $cantBotellasCabernet = $cantBotellasCabernet + $vinos["Cabernet"][$contadorCabernet]["cantidad"];
   $sumaCabernet         = $sumaCabernet + $vinos["Cabernet"][$contadorCabernet]["precioUnidad"];
   $contadorCabernet++;
  }
// Se recorre la totalidad del arreglo con clave "Merlot" y se realizan las operaciones
  while (($contadorMerlot < $longitudMerlot) && ($i == 2)) {
   $cantBotellasMerlot = $cantBotellasMerlot + $vinos["Merlot"][$contadorMerlot]["cantidad"];
   $sumaMerlot         = $sumaMerlot + $vinos["Merlot"][$contadorMerlot]["precioUnidad"];
   $contadorMerlot++;
  }
 }
 // Se calcula el promedio de precio de cada variedad de vino
 $promedioMalbec   = round($sumaMalbec / $longitudMalbec);
 $promedioCabernet = round($sumaCabernet / $longitudCabernet);
 $promedioMerlot   = round($sumaMerlot / $longitudMerlot);

 $coleccionInventario             = array();
 $coleccionInventario["Malbec"]   = array("cantidadTotal" => $cantBotellasMalbec, "promedioPrecio" => $promedioMalbec);
 $coleccionInventario["Cabernet"] = array("cantidadTotal" => $cantBotellasCabernet, "promedioPrecio" => $promedioCabernet);
 $coleccionInventario["Merlot"]   = array("cantidadTotal" => $cantBotellasMerlot, "promedioPrecio" => $promedioMerlot);
 return $coleccionInventario;
}

/**
 * Función para cargar datos de distintos vinos en un arreglo
 * @return array
 */
function cargarArreglo()
{
 $coleccionVinos = array(

  $malbec[0] = array("variedad" => "seco", "anioProduccion" => 1995, "cantidad" => 35, "precioUnidad" => 1300),
  $malbec[1] = array("variedad" => "dulce", "anioProduccion" => 1945, "cantidad" => 12, "precioUnidad" => 1600),
  $malbec[2] = array("variedad" => "semidulce", "anioProduccion" => 2002, "cantidad" => 56, "precioUnidad" => 900),
  $malbec[3] = array("variedad" => "seco", "anioProduccion" => 2014, "cantidad" => 576, "precioUnidad" => 340),

  $cabernet[0] = array("variedad" => "seco", "anioProduccion" => 1956, "cantidad" => 145, "precioUnidad" => 1500),
  $cabernet[1] = array("variedad" => "seco", "anioProduccion" => 1968, "cantidad" => 6, "precioUnidad" => 2430),
  $cabernet[2] = array("variedad" => "dulce", "anioProduccion" => 1999, "cantidad" => 45, "precioUnidad" => 1360),
  $merlot[0] = array("variedad" => "semidulce", "anioProduccion" => 2006, "cantidad" => 500, "precioUnidad" => 3000),
  $merlot[1] = array("variedad" => "seco", "anioProduccion" => 2012, "cantidad" => 346, "precioUnidad" => 1950),
  $merlot[2] = array("variedad" => "seco", "anioProduccion" => 2020, "cantidad" => 45, "precioUnidad" => 5000));

 $coleccionVinos["Malbec"]   = $malbec;
 $coleccionVinos["Cabernet"] = $cabernet;
 $coleccionVinos["Merlot"]   = $merlot;
 return $coleccionVinos;
}

function mostrarDatos($datos)
{
 echo "\nVINO: \n\tMalbec, CANT TOTAL: ", $datos["Malbec"]["cantidadTotal"], " PROM PRECIO: ", $datos["Malbec"]["promedioPrecio"];
 echo "\nVINO: \n\tCabernet Savignon, CANT TOTAL: ", $datos["Cabernet"]["cantidadTotal"], " PROM PRECIO: ", $datos["Cabernet"]["promedioPrecio"];
 echo "\nVINO: \n\tMerlot, CANT TOTAL: ", $datos["Merlot"]["cantidadTotal"], " PROM PRECIO: ", $datos["Merlot"]["promedioPrecio"];
}

/**
 * Implementar una función main() que cree un arreglo con las características mencionadas,
 * invoque a la función implementada en 1 y visualice su resultado
 * Función main()
 */
$vinos         = cargarArreglo();
$colInventario = array();
$colInventario = inventario($vinos);
mostrarDatos($colInventario);
