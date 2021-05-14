<?php
include 'Cliente.php';
include 'Producto.php';
include 'Venta.php';
include 'Empresa.php';

$objCLiente1 = new Cliente("Pablo", "Romero", "s", "DNI", 40068425);
$objCLiente2 = new Cliente("Hector", "Álvarez", "n", "DNI", 40012429);

//echo $objCLiente1->__toString();

$obProducto1 = new Producto(11, 50000, 2018, "Cemento Loma Negra", 70, true);
$obProducto2 = new Producto(12, 10000, 2019, "Hierro del 12", 60, true);
$obProducto3 = new Producto(13, 10000, 2020, "Cal Santa Clara", 50, false);

$colProductos = array();
$colProductos[0] = $obProducto1;
$colProductos[1] = $obProducto1;
$colProductos[2] = $obProducto1;

$colClientes = array();
$colClientes[0] = $objCLiente1;
$colClientes[1] = $objCLiente2;

$colVentasRealizadas = array();

$empresa = new Empresa("Cosmos", "Av Argentina 123", $colClientes, $colProductos, $colVentasRealizadas);



//---------------------------------------------------------------------

$colCodigosProducto = array();
$colCodigosProducto[0] = 11;
$colCodigosProducto[1] = 12;
$colCodigosProducto[2] = 13;

$importeFinal = $empresa->registrarVenta($colCodigosProducto, $objCLiente2);


echo "\nIMPORTE FINAL: " . $importeFinal;

//---------------------------------------------------------------------

/*
$colCodigosProducto = array();
$colCodigosProducto[0] = 0;

$importeFinal = $empresa->registrarVenta($colCodigosProducto, $objCLiente2);

echo "\nIMPORTE FINAL: " . $importeFinal;
*/

//---------------------------------------------------------------------

/*
$colCodigosProducto = array();
$colCodigosProducto[0] = 2;

$importeFinal = $empresa->registrarVenta($colCodigosProducto, $objCLiente2);

echo "\nIMPORTE FINAL: " . $importeFinal;
*/

//---------------------------------------------------------------------
/*
$ventasPorCliente = $empresa->retornarVentasXCliente("DNI",40068425);
print_r($ventasPorCliente);
*/
//---------------------------------------------------------------------

/*$ventasPorCliente = $empresa->retornarVentasXCliente("DNI",40012429);
print_r($ventasPorCliente);*/



echo $empresa;