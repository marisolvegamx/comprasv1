<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
  integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
  crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
  integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
  crossorigin=""></script>
<style>

#mapid { height: 280px;
 }
</style>
<?php 
$coordenadas=filter_input(INPUT_GET, "coor",FILTER_SANITIZE_STRING);
?>

<title>Muesmerc</title>
</head>
<body>
 <div id="mapid"></div>
 
 <script type="text/javascript">
var mymap = L.map('mapid').setView([<?= $coordenadas ?>], 13);
L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'pk.eyJ1IjoibnVicmFuZSIsImEiOiJja29mMmNhajYwMW1oMnBveTFnOGo4bjc5In0.smpCq03X9sorWFnhDY8n6g'
}).addTo(mymap);
var marker = L.marker([<?= $coordenadas ?>]).addTo(mymap);
</script>
</body>
</html>