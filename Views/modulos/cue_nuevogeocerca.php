<?php 
//error_reporting(E_ERROR);
//ini_set("display_errors", 1);
//echo "zzzz";
  include_once  'Controllers/geocercaController.php';

  $geocercaCon=new GeocercaController();
  $geocercaCon->vistaNuevo();
 

  $idc = filter_input(INPUT_GET, "n4id",FILTER_SANITIZE_NUMBER_INT);
  $ref = filter_input(INPUT_GET, "ref",FILTER_SANITIZE_NUMBER_INT);
   //echo "--".$idc;
  //clave mari AIzaSyANZ_tj0m9KI-W0MZKmXImqpH_V6AkJgfI
  ?>
    <style>#map_canvas {
 height: 90vh;
         width: 100%;
    margin: 0 auto;
    border: 1px solid grey;
    border-radius: 5px;
    box-shadow: 0px 0px 8px #999;
    color: black;
    text-align: center;
}
 </style> 

     <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCvmd3x0BmhG5yEhZqv0iJcjnESOT-lNVc&libraries=drawing&solution_channel=GMP_QB_locatorplus_v4_cABD" async defer></script>
 
 <script type="text/javascript">
 var colors = {N:'#1E90FF',S: '#FF1493',E: '#32CD32',O: '#FF8C00',C: '#4B0082'};
 var selectedColor;
 var drawingManager;
 var selectedShape;
 var puntos;
 var regionAct; //para saber en que region voy
 var conta=0;
 var arrreg=[{key: 'C',nombre:"Centro",cve:5},
	 {key:'N',nombre:"Norte",cve:1},
         {key:'S',nombre:"Sur",cve:2},
         {key:'E',nombre:"Este",cve:3},
         {key:'O',nombre:"Oeste",cve:4}];
 var markers=[];
 var map;

window.onload = function () {
	   map = new google.maps.Map(document.getElementById("map_canvas"), {
		  center: {lat: 19.36884, lng: -99.16410},
          zoom: 8   
	  });
	   new LocatorPlus();
	   drawingManager = new google.maps.drawing.DrawingManager({
	    drawingMode: null,
	    drawingControl: true,
	    drawingControlOptions: {
	      position: google.maps.ControlPosition.TOP_CENTER,
	      drawingModes: [
	       
	        null,
	      
	      ],
	    },
	    markerOptions: {
	      icon: "https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png",
	    },
	    polygonOptions: {
	        fillColor: '#BCDCF9',
	        fillOpacity: 0.5,
	        strokeWeight: 2,
	        strokeColor:'#57ACF9',
	        clickable: true,
	        editable: true,
	        zIndex: 1
	      }
	   
	  });

	  drawingManager.setMap(map);
	
	


google.maps.event.addListener(drawingManager, 'polygoncomplete', function(polygon) {

const coords = polygon.getPath().getArray().map(coord => {
  return {
    lat: coord.lat(),
    lng: coord.lng()
  }
});

//console.log(JSON.stringify(coords, null, 1));
markers.push(polygon);
ponerCoordenadas(coords);
// Add an event listener that selects the newly-drawn shape when the user
// mouses down on it.
//var newShape = e.overlay;
//newShape.type = e.type;
google.maps.event.addListener(polygon, 'click', function() {
  setSelection(polygon);
});

setSelection(polygon);
$("#confirmar").prop( "disabled", false );
// SAVE COORDINATES HERE
});



google.maps.event.addListener(drawingManager, 'drawingmode_changed', clearSelection);
google.maps.event.addListener(map, 'click', clearSelection);
google.maps.event.addDomListener(document.getElementById('delete-button'), 'click', deleteAll);
drawingManager.setOptions({
	  drawingControl: false
	});
//console.log("Esto es en el mapa");
<?php //dibujo los poligonos si ya tengo las opciones
		if($geocercaCon->isedit&&sizeof($geocercaCon->puntos)){
		      echo "markers=new Array();";
		        echo "dibujarRegion(eval(".json_encode($geocercaCon->puntos["N"])."),colors['N']);";
		        echo "dibujarRegion(eval(".json_encode($geocercaCon->puntos["C"])."),colors['C']);";
		        echo "dibujarRegion(eval(".json_encode($geocercaCon->puntos["S"])."),colors['S']);";
		        echo "dibujarRegion(eval(".json_encode($geocercaCon->puntos["E"])."),colors['E']);";
		        echo "dibujarRegion(eval(".json_encode($geocercaCon->puntos["O"])."),colors['O']);";
		        echo "map.setCenter(". json_encode($geocercaCon->puntos["C"][0]).");";
		}
		?>

}; //fin onload window

$(document).ready(function() {
makeColorButton();
$("#confirmar").prop( "disabled", true );
$("#insertar").prop( "disabled", true );
$("#insertar").click(function(){
	insertar2();
   // salir();
	
	});
});
puntos=new Array();
function Region(geo_id,geo_n4id,geo_region,p1,p2,p3,p4){ 
	this.geo_id==geo_id;
    this.geo_n4id=geo_n4id; 
    this.geo_region=geo_region;
     this.geo_p1=p1;
      this.geo_p2=p2;
      this. geo_p3=p3; 
       this.geo_p4=p4;  
}
function iniciar(){
	regionAct=arrreg[conta].key;
	$("#confirmar").prop( "disabled", false );
	console.log("region=>"+regionAct);
	$("#geo_region").val(regionAct);
	$("#cve_region").val(arrreg[conta].cve);
	
}
function confirmar(){
	if($("#p1").val()==""||$("#p2").val()==""||$("#p3").val()==""||
			$("#p4").val()=="")
		{
			alert("Seleccione la región en el mapa");
			return;
		}
	drawingManager.setDrawingMode(google.maps.drawing.OverlayType.MARKER);
	nvaregion=new Region($("#geo_id").val(), $("#geo_n4id").val(),$("#cve_region").val(),$("#p1").val(),$("#p2").val(),$("#p3").val(),$("#p4").val());
	puntos.push(nvaregion);
	console.log(puntos);
	conta++;
	limpiarCampos();
	$("#confirmar").prop( "disabled", true );
	if(conta<5){
	regionAct=arrreg[conta].key;
	$("#agregar").text("Marcar "+arrreg[conta].nombre); 

	
	}
	else
	{
		$("#agregar").prop( "disabled", true );
		
		$("#insertar").prop( "disabled", false );
	}
	
	
}
function insertar2(){
	//valido que tenga toda la info
	/*if($("#geo_region").val()==""){
		alert("Seleccione una región");
		return;
	}
	if($("#p1").val()==""||$("#p2").val()==""||$("#p3").val()==""||
			$("#p4").val()=="")
		{
			alert("Seleccione la región en el mapa");
			return;
		}*/
	$("#insertar").prop( "disabled", false );
		
	if(puntos.length<1){
		alert("Seleccione la región en el mapa");
		return;
	}
	drawingManager.setDrawingMode(google.maps.drawing.OverlayType.MARKER);
	//agregarRegion($("#geo_id").val(), $("#geo_n4id").val(),$("#geo_region").val(),$("#p1").val(),$("#p2").val(),$("#p3").val(),$("#p4").val());
	agregarRegion();
	
}

function limpiarCampos(){
	//limpio los campos en campos aux
	  var children = $("#camposaux").children();


  for (var i = 0; i < children.length; i++) {
	  var elemento=children[i];
	//  alert(elemento.id);
	  if(elemento.id!="geo_n4id")
	  elemento.value="";
  }

	
}
function dibujarRegion(policoords,color){
	/* const triangleCoords = [
		    { lat: 25.774, lng: -80.19 },
		    { lat: 18.466, lng: -66.118 },
		    { lat: 32.321, lng: -64.757 },
		    { lat: 25.774, lng: -80.19 },
		  ];*/
		  // Construct the polygon.
		  console.log(policoords);
		  const regionpoly = new google.maps.Polygon({
		    paths: policoords,
		    strokeColor: color,
		    strokeOpacity: 0.8,
		    strokeWeight: 2,
		    fillColor: color,
		    fillOpacity: 0.35,
		  });
			markers.push(regionpoly);
		  regionpoly.setMap(map);
}
function ponerCoordenadas(vertices){
	
	 for (let i = 0; i < vertices.length; i++) {
		    const xy = vertices[i];
		  
			$("#p"+(i+1)).val(
		     xy.lat + "," + xy.lng);
			
		  }
}
function selectColor(color) {
	  selectedColor = color;
	  
	  var polygonOptions = drawingManager.get('polygonOptions');
	  polygonOptions.fillColor = color;
	  polygonOptions.strokeColor=color;
	  drawingManager.set('polygonOptions', polygonOptions);
	}

function clearSelection() {
	  if (selectedShape) {
	    selectedShape.setEditable(false);
	    selectedShape = null;
	  }
	}

	function setSelection(shape) {
	  clearSelection();
	  selectedShape = shape;
	  shape.setEditable(true);
	  selectColor(shape.get('fillColor') || shape.get('strokeColor'));
	}

	function deleteSelectedShape() {
	  if (selectedShape) {
	    selectedShape.setMap(null);
	  }
	}

	function deleteAll() {
		for (let i = 0; i < markers.length; i++) {
		    markers[i].setMap(null);
		  }
		  puntos=new Array();
		  conta=0;
		  regionAct=arrreg[conta].key;
		  $("#agregar").text("Marcar "+arrreg[conta].nombre); 
		  
			}
	function setSelectedShapeColor(color) {
		  if (selectedShape) {
		    if (selectedShape.type == google.maps.drawing.OverlayType.POLYLINE) {
		      selectedShape.set('strokeColor', color);
		    } else {
		      selectedShape.set('fillColor', color);
		    }
		  }
		}
	function makeColorButton() {
		  var button = document.getElementById("agregar");
		
		  button.onclick=function() {
			  	iniciar();
				//alert(opcion);
			    selectColor(colors[regionAct]);
			    setSelectedShapeColor(colors[regionAct]);
			    drawingManager.setDrawingMode(google.maps.drawing.OverlayType.POLYGON);
			  
			  };
			  var btnconf = document.getElementById("confirmar");
			  btnconf.onclick=function(){
				confirmar();
			  };
		 // button.className = 'color-button';
		  //button.style.backgroundColor = color;
		 /* google.maps.event.addDomListener(button, 'onchange', function() {
			var opcion=button.val();
			alert(opcion);
		    selectColor(colors[opcion]);
		    setSelectedShapeColor(colors[opcion]);
		  });*/

		 // return button;
		}
//los envios seran con ajax para no estar actualizando la pagina

	function eliminar(id){
		//valido que tenga toda la info
        $.ajax({
            type: 'POST',
            url: 'geocercasajax.php?admin=eliminar',
         
            data: { geo_id:id 
               },
            dataType: 'json',
            success: function (data) {
                actualizarLista();
            }
        });


}
/*		
function agregarRegion(id,n4id,region,p1,p2,p3,p4){

//   console.log(idreporte);
    $.ajax({
        type: 'POST',
        url: 'geocercasajax.php?admin=insertar',
     
        data: { geocerca:{geo_id:id , 
            geo_n4id:n4id, 
            geo_region: region,
             geo_p1:p1,
              geo_p2:p2,
               geo_p3:p3, 
               geo_p4: p4  }},
        dataType: 'json',
        success: function (data) {
            actualizarLista();
        }
    });
}*/

function agregarRegion(){

//  console.log(idreporte);
   $.ajax({
       type: 'POST',
       url: 'geocercasajax.php?admin=insertar',
    
       data: { puntos},
     
   }).done(function () {
       //actualizarLista();
       //console.log("todo bien");
       salir();
   });
}

function salir(){
	console.log("saliendo");
	$("#cancelar")[0].click();
	//$("#cancelar").trigger('click') ;
	
}
function dialogoEliminar(){
if(confirm("¿ESTA SEGURO QUE DESEA ELIMINAR?"))
	return true;
else return false;
}
/**
 * Defines an instance of the Locator+ solution, to be instantiated
 * when the Maps library is loaded.
 */
function LocatorPlus() {
  const locator = this;

  //locator.locations = configuration.locations || [];
  //locator.capabilities = configuration.capabilities || {};

  const mapEl = document.getElementById('map_canvas');
  //const panelEl = document.getElementById('locations-panel');
  //locator.panelListEl = document.getElementById('locations-panel-list');
  //const sectionNameEl =
    //  document.getElementById('location-results-section-name');
  //const resultsContainerEl = document.getElementById('location-results-list');

 // const itemsTemplate = Handlebars.compile(
   //   document.getElementById('locator-result-items-tmpl').innerHTML);

  locator.searchLocation = null;
  locator.searchLocationMarker = null;
  locator.selectedLocationIdx = null;
  locator.userCountry = null;

  // Initialize the map -------------------------------------------------------
  locator.map = map

 
  // Fit map to marker bounds.
  locator.updateBounds = function() {
    const bounds = new google.maps.LatLngBounds();
    if (locator.searchLocationMarker) {
      bounds.extend(locator.searchLocationMarker.getPosition());
    }
    for (let i = 0; i < markers.length; i++) {
      bounds.extend(markers[i].getPosition());
    }
    locator.map.fitBounds(bounds);
  };
  /*if (locator.locations.length) {
    locator.updateBounds();
  }*/

 
 
  

  // Optional capability initialization --------------------------------------
 // initializeSearchInput(locator);
 // initializeDistanceMatrix(locator);

  // Initial render of results -----------------------------------------------
 // locator.renderResultsList();
}
function initializeSearchInput(locator) {
	  const geocodeCache = new Map();
	  const geocoder = new google.maps.Geocoder();

      

    const searchInputEl = document.getElementById('location-search-input');
    const searchButtonEl = document.getElementById('location-search-button');
    const updateSearchLocation = function(address, location) {
        if (locator.searchLocationMarker) {
          locator.searchLocationMarker.setMap(null);
        }
        if (!location) {
          locator.searchLocation = null;
          return;
        }
        locator.searchLocation = {'address': address, 'location': location};
        locator.searchLocationMarker = new google.maps.Marker({
          position: location,
          map: locator.map,
          title: 'My location',
          icon: {
            path: google.maps.SymbolPath.CIRCLE,
            scale: 12,
            fillColor: '#3367D6',
            fillOpacity: 0.5,
            strokeOpacity: 0,
          }
        });

        // Update the locator's idea of the user's country, used for units. Use
        // `formatted_address` instead of the more structured `address_components`
        // to avoid an additional billed call.
        const addressParts = address.split(' ');
        locator.userCountry = addressParts[addressParts.length - 1];

        // Update map bounds to include the new location marker.
        locator.updateBounds();

        // Update the result list so we can sort it by proximity.
       // locator.renderResultsList();
//
       // locator.updateTravelTimes();
      };
  


const geocodeSearch = function(query) {
    if (!query) {
      return;
    }

    const handleResult = function(geocodeResult) {
      searchInputEl.value = geocodeResult.formatted_address;
      updateSearchLocation(
          geocodeResult.formatted_address, geocodeResult.geometry.location);
    };

    if (geocodeCache.has(query)) {
      handleResult(geocodeCache.get(query));
      return;
    }
    const request = {address: query, bounds: locator.map.getBounds()};
    geocoder.geocode(request, function(results, status) {
      if (status === 'OK') {
        if (results.length > 0) {
          const result = results[0];
          geocodeCache.set(query, result);
          handleResult(result);
        }
      }
    });
  };

  // Set up geocoding on the search input.
  searchButtonEl.addEventListener('click', function() {
    geocodeSearch(searchInputEl.value.trim());
  });
}



	
</script>
  <section class="content-header">
  	<h1> GEOCERCAS</h1>
  	<h1> <?php echo $geocercaCon->ciudad; ?></h1>
  </section>
 
  <section class="content container-fluid">
     <div class="row">
      <div class="col-md-12">
             <div class="box box-info">
             <div class="box-body">
                 <div class="row">

             <div class="col-md-10">
                <div id="map_canvas"></div> 
             </div>
     <div class="form-group col-md-2">
   <form role="form" method="post" action="">
    
   
          
 <div class="row">
  <div class="form-group col-md-12">
              
                                   <!--   <div class="search-input">
              <input id="location-search-input" placeholder="Agrega tu direccion o codigo postal">
              <div id="search-overlay-search" class="search-input-overlay search">
                <button id="location-search-button">
                  <img class="icon" src="https://fonts.gstatic.com/s/i/googlematerialicons/search/v11/24px.svg" alt="Buscar"/>
                </button>
              </div>
            </div> -->
                 
                 <button type="button" id="agregar" onclick="" class="btn btn-info btn-block">Marcar Centro</button>
                </div>  
             </div>
             
             
              <div class="row">
  <div class="form-group col-md-12">
              
               <button type="button" id="confirmar" onclick="javascript:confirmar();" class="btn btn-info btn-block">Confirmar</button>
               
                </div>  
             </div>
             
            
             <div class="row">
  <div class="form-group col-md-12">
                
                 
                 <button type="button" class="btn btn-default btn-block" id="delete-button" name="delete-button"> Borrar</button>
            
               
              </div></div>
                <div class="row">
  <div class="form-group col-md-12">
              
                 
                  <button type="button" id="insertar" onclick="" class="btn btn-info btn-block">Guardar</button>
                  
              </div></div>
               <div class="row">
  <div class="form-group col-md-12">
              
                 
                 
                 <a class="btn btn-default btn-block" id="cancelar" href="index.php?action=listaciures"> Cancelar </a>
               
              </div></div>
                  <div id="camposaux" style="display:none">
                    <input id="geo_n4id" name="geo_n4id" type="text"  value="<?php echo $idc?>">
            
                <input id="geo_id" name="geo_id" type="text" value="<?php if($geocercaCon->isedit) echo $geocercaCon->puntos[0]["geo_id"]?>" >
                 <input class="form-control" name="cve_region" id="cve_region">
                 <input class="form-control" name="geo_region" id="geo_region">
p1<input id="p1" name="p1" type="text">
p2<input id="p2" name="p2" type="text">
p3<input id="p3" name="p3" type="text">
p4<input id="p4" name="p4" type="text">
</div>
   
 
             
    </form>
    </div>
    </div><!-- fin box body -->
</div>
</div>
</div>
</div>
</section> 
  