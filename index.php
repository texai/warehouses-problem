<?php
function __autoload($c) {include_once $c . '.php';}
Util::bmStart();

$lima = new Fabrica('Lima');
//echo $lima;

$clientes = array();
$pacasmayo = new Cliente('Pacasmayo',10);
$clientes[0] = $pacasmayo;
$cartavio = new Cliente('Cartavio',15);
$clientes[1] = $cartavio;
$motupe = new Cliente('Motupe',8);
$clientes[2] = $motupe;
$reque = new Cliente('Reque',5);
$clientes[3] = $reque;
//foreach ($clientes as $item) {echo $item;}


$almacenes = array();
$trujillo = new Almacen('Trujillo', 300, 0);
$almacenes[0] = $trujillo;
$chiclayo = new Almacen('Chiclayo', 250, 0);
$almacenes[1] = $chiclayo;
//foreach ($almacsenes as $item) {echo $item;}

$tren = new MedioTransporte('tren', 300, 2);
$barco = new MedioTransporte('barco', 0, 1);
$camion = new MedioTransporte('camion', 200, 3);
//echo $tren.$barco.$camion;

$tramos = array();
$tramos[0] = new Tramo($lima, $trujillo, $barco, 550);
$tramos[1] = new Tramo($trujillo, $pacasmayo, $camion, 150);
$tramos[2] = new Tramo($trujillo, $cartavio, $camion, 90);
$tramos[3] = new Tramo($lima, $chiclayo, $tren, 750);
$tramos[4] = new Tramo($chiclayo, $motupe, $camion, 170);
$tramos[5] = new Tramo($chiclayo, $reque, $camion, 70);
$tramos[6] = new Tramo($lima, $pacasmayo, $camion, 700);
$tramos[7] = new Tramo($lima, $cartavio, $camion, 640);
$tramos[8] = new Tramo($lima, $motupe, $camion, 920);
$tramos[9] = new Tramo($lima, $reque, $camion, 680);
$tramos[] = new Tramo($lima, $pacasmayo, $barco, 987);
$tramos[] = new Tramo($lima, $pacasmayo, $tren, 876);
$tramos[] = new Tramo($lima, $cartavio, $tren, 873);
//foreach ($tramos as $item) {echo $item;}

$planSinAlmacenes = new PlanDistribucion();
$planSinAlmacenes->addRuta(new RutaCliente($clientes[0], array($tramos[6])));
$planSinAlmacenes->addRuta(new RutaCliente($clientes[1], array($tramos[7])));
$planSinAlmacenes->addRuta(new RutaCliente($clientes[2], array($tramos[8])));
$planSinAlmacenes->addRuta(new RutaCliente($clientes[3], array($tramos[9])));

$planConAlmacenes = new PlanDistribucion();
$planConAlmacenes->addRuta(new RutaCliente($clientes[0], array($tramos[0], $tramos[1])));
$planConAlmacenes->addRuta(new RutaCliente($clientes[1], array($tramos[0], $tramos[2])));
$planConAlmacenes->addRuta(new RutaCliente($clientes[2], array($tramos[3], $tramos[4])));
$planConAlmacenes->addRuta(new RutaCliente($clientes[3], array($tramos[3], $tramos[5])));

echo PHP_EOL;
echo $planSinAlmacenes->calcCosto().PHP_EOL;
echo $planConAlmacenes->calcCosto().PHP_EOL;

$genPlan = new GeneradorPlanes($clientes, $tramos, $almacenes, $lima);
$genPlan->generarPlanes();


Util::printBenchMark();

array(
    1 => array(1,2,3),
    2 => array(4,5),
    3 => array(6),
    4 => array(7),
);

array(
    array(1,4,6,7),
    array(1,5,6,7),
    array(2,4,6,7),
    array(2,5,6,7),
    array(3,4,6,7),
    array(3,5,6,7),
);










