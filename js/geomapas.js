/**
 * 
 */

function dibujarRegion(policoords,color){
	/* const triangleCoords = [
		    { lat: 25.774, lng: -80.19 },
		    { lat: 18.466, lng: -66.118 },
		    { lat: 32.321, lng: -64.757 },
		    { lat: 25.774, lng: -80.19 },
		  ];*/
		  // Construct the polygon.
		 // console.log(policoords);
		  const regionpoly = new google.maps.Polygon({
		    paths: policoords,
		    strokeColor: color,
		    strokeOpacity: 0.8,
		    strokeWeight: 2,
		    fillColor: "#000000",
		    fillOpacity: 0.0,
		  });
			markers.push(regionpoly);
		  regionpoly.setMap(map);
}

function dibujarPunto(plat,plng,map,color){
	if(color=='red'){
	//	icono={
			/* url:'data:image/svg+xml;charset=utf-8,' + encodeURIComponent (svgtienda),
  size: new google.maps.Size(200,200),
  scaledSize: new google.maps.Size(32,32),
  anchor: new google.maps.Point(16,16),*/
 
      //anchor:  new google.maps.Point(15, 30),*/
    //  url: './Views/dist/img/store-svgrepo-com.svg'
   // };
/*}*/

 icono = {
  url: './Views/dist/img/store-svgrepo-com.svg',
  scaledSize: new google.maps.Size(20, 20),
  origin: new google.maps.Point(0, 0), // used if icon is a part of sprite, indicates image position in sprite
  anchor: new google.maps.Point(20,40) // lets offset the marker image
};
}else
icono= {
      url: "http://maps.google.com/mapfiles/ms/icons/"+color+"-dot.png"
    };
	

 const marker = new google.maps.Marker({
    position: { lat:plat, lng: plng },
    map,
   /* icon: {
      url: "http://maps.google.com/mapfiles/ms/icons/"+color+"-dot.png"
    }*/
 icon:icono ,
  });
}
