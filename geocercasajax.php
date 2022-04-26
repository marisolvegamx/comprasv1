<?php
include "Models/conexion.php";
include_once  'Controllers/geocercaController.php';

$geocercaCon=new GeocercaController();
$geocercaCon->vistaNuevo();
