<!DOCTYPE html>
<html>
  <head>
    <title>Locator</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/handlebars/4.7.7/handlebars.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <style>
      html,
      body {
        height: 100%;
        margin: 0;
        padding: 0;

      }

      #map-container {
        width: 100%;
        height: 100%;
        position: relative;
        font-family: "Roboto", sans-serif;
        box-sizing: border-box;
      }

      #map-container button {
        background: none;
        color: inherit;
        border: none;
        padding: 0;
        font: inherit;
        font-size: inherit;
        cursor: pointer;
      }

      #map {
        position: absolute;
         height: 90vh;
         width: 64vw;

        left: 12;
        top: 0;
        right: 0;
        bottom: 0;
      }

      #locations-panel {
        position: absolute;
        left: 0;
        width: 22em;
         height: 90vh;
        top: 0;
        bottom: 0;
        overflow-y: auto;
        background: white;
        padding: 0.5em;
        box-sizing: border-box;
      }

      @media only screen and (max-width: 876px) {
        #map {
          left: 0;
          bottom: 50%;
        }

        #locations-panel {
          top: 50%;
          right: 0;
          width: unset;
        }
      }

      #locations-panel-list > header {
        padding: 1.4em 1.4em 0 1.4em;
      }

      #locations-panel-list h1.search-title {
        font-size: 1em;
        font-weight: 500;
        margin: 0;
      }

      #locations-panel-list h1.search-title > img {
        vertical-align: bottom;
        margin-top: -1em;
      }

      #locations-panel-list .search-input {
        width: 100%;
        margin-top: 0.8em;
        position: relative;
      }

      #locations-panel-list .search-input input {
        width: 100%;
        border: 1px solid rgba(0, 0, 0, 0.2);
        border-radius: 0.3em;
        height: 2.2em;
        box-sizing: border-box;
        padding: 0 2.5em 0 1em;
        font-size: 1em;
      }

      #locations-panel-list .search-input-overlay {
        position: absolute;
      }

      #locations-panel-list .search-input-overlay.search {
        right: 2px;
        top: 2px;
        bottom: 2px;
        width: 2.4em;
      }

      #locations-panel-list .search-input-overlay.search button {
        width: 100%;
        height: 100%;
        border-radius: 0.2em;
        color: black;
        background: transparent;
      }

      #locations-panel-list .search-input-overlay.search .icon {
        margin-top: 0.05em;
        vertical-align: top;
      }

      #locations-panel-list .section-name {
        font-weight: 500;
        font-size: 0.9em;
        margin: 1.8em 0 1em 1.5em;
      }

      #locations-panel-list .location-result {
        position: relative;
        padding: 0.8em 3.5em 0.8em 1.4em;
        border-bottom: 1px solid rgba(0, 0, 0, 0.12);
        cursor: pointer;
      }

      #locations-panel-list .location-result:first-of-type {
        border-top: 1px solid rgba(0, 0, 0, 0.12);
      }

      #locations-panel-list .location-result:last-of-type {
        border-bottom: none;
      }

      #locations-panel-list .location-result.selected {
        outline: 2px solid #4285f4;
      }

      #locations-panel-list button.select-location {
        margin-bottom: 0.6em;
        text-align: left;
      }

      #locations-panel-list .location-result h2.name {
        font-size: 1em;
        font-weight: 500;
        margin: 0;
      }

      #locations-panel-list .location-result .address {
        font-size: 0.9em;
        margin-bottom: 0.5em;
      }

      #locations-panel-list .location-result .distance {
        position: absolute;
        top: 0.9em;
        right: 0;
        text-align: center;
        font-size: 0.9em;
        width: 5em;
      }

      #location-results-list {
        list-style-type: none;
        margin: 0;
        padding: 0;
      }
    </style>
    <script>
      'use strict';

      /**
       * Defines an instance of the Locator+ solution, to be instantiated
       * when the Maps library is loaded.
       */
      function LocatorPlus(configuration) {
        const locator = this;

        locator.locations = configuration.locations || [];
        locator.capabilities = configuration.capabilities || {};

        const mapEl = document.getElementById('map');
        const panelEl = document.getElementById('locations-panel');
        locator.panelListEl = document.getElementById('locations-panel-list');
        const sectionNameEl =
            document.getElementById('location-results-section-name');
        const resultsContainerEl = document.getElementById('location-results-list');

        const itemsTemplate = Handlebars.compile(
            document.getElementById('locator-result-items-tmpl').innerHTML);

        locator.searchLocation = null;
        locator.searchLocationMarker = null;
        locator.selectedLocationIdx = null;
        locator.userCountry = null;

        // Initialize the map -------------------------------------------------------
        locator.map = new google.maps.Map(mapEl, configuration.mapOptions);

        // Store selection.
        const selectResultItem = function(locationIdx, panToMarker, scrollToResult) {
          locator.selectedLocationIdx = locationIdx;
          for (let locationElem of resultsContainerEl.children) {
            locationElem.classList.remove('selected');
            if (getResultIndex(locationElem) === locator.selectedLocationIdx) {
              locationElem.classList.add('selected');
              if (scrollToResult) {
                panelEl.scrollTop = locationElem.offsetTop;
              }
            }
          }
          if (panToMarker && (locationIdx != null)) {
            locator.map.panTo(locator.locations[locationIdx].coords);
          }
        };

        // Create a marker for each location.
        const markers = locator.locations.map(function(location, index) {
          const marker = new google.maps.Marker({
            position: location.coords,
            map: locator.map,
            title: location.title,
          });
          marker.addListener('click', function() {
            selectResultItem(index, false, true);
          });
          return marker;
        });

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
        if (locator.locations.length) {
          locator.updateBounds();
        }

        // Get the distance of a store location to the user's location,
        // used in sorting the list.
        const getLocationDistance = function(location) {
          if (!locator.searchLocation) return null;

          // Use travel distance if available (from Distance Matrix).
          if (location.travelDistanceValue != null) {
            return location.travelDistanceValue;
          }

          // Fall back to straight-line distance.
          return google.maps.geometry.spherical.computeDistanceBetween(
              new google.maps.LatLng(location.coords),
              locator.searchLocation.location);
        };

        // Render the results list --------------------------------------------------
        const getResultIndex = function(elem) {
          return parseInt(elem.getAttribute('data-location-index'));
        };

        locator.renderResultsList = function() {
          let locations = locator.locations.slice();
          for (let i = 0; i < locations.length; i++) {
            locations[i].index = i;
          }
          if (locator.searchLocation) {
            sectionNameEl.textContent =
                'Nearest locations (' + locations.length + ')';
            locations.sort(function(a, b) {
              return getLocationDistance(a) - getLocationDistance(b);
            });
          } else {
            sectionNameEl.textContent = `Todas las tiendas (${locations.length})`;
          }
          const resultItemContext = { locations: locations };
          resultsContainerEl.innerHTML = itemsTemplate(resultItemContext);
          for (let item of resultsContainerEl.children) {
            const resultIndex = getResultIndex(item);
            if (resultIndex === locator.selectedLocationIdx) {
              item.classList.add('selected');
            }

            const resultSelectionHandler = function() {
              selectResultItem(resultIndex, true, false);
            };

            // Clicking anywhere on the item selects this location.
            // Additionally, create a button element to make this behavior
            // accessible under tab navigation.
            item.addEventListener('click', resultSelectionHandler);
            item.querySelector('.select-location')
                .addEventListener('click', function(e) {
                  resultSelectionHandler();
                  e.stopPropagation();
                });
          }
        };

        // Optional capability initialization --------------------------------------
        initializeSearchInput(locator);
       // initializeDistanceMatrix(locator);

        // Initial render of results -----------------------------------------------
        locator.renderResultsList();
      }

      /** When the search input capability is enabled, initialize it. */
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
          locator.renderResultsList();

          locator.updateTravelTimes();
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

        // Initialize Autocomplete.
        initializeSearchInputAutocomplete(
            locator, searchInputEl, geocodeSearch, updateSearchLocation);
      }

      /** Add Autocomplete to the search input. */
  /*    function initializeSearchInputAutocomplete(
          locator, searchInputEl, fallbackSearch, searchLocationUpdater) {
        // Set up Autocomplete on the search input. Bias results to map viewport.
        const autocomplete = new google.maps.places.Autocomplete(searchInputEl, {
          types: ['geocode'],
          fields: ['place_id', 'formatted_address', 'geometry.location']
        });
        autocomplete.bindTo('bounds', locator.map);
        autocomplete.addListener('place_changed', function() {
          const placeResult = autocomplete.getPlace();
          if (!placeResult.geometry) {
            // Hitting 'Enter' without selecting a suggestion will result in a
            // placeResult with only the text input value as the 'name' field.
            fallbackSearch(placeResult.name);
            return;
          }
          searchLocationUpdater(
              placeResult.formatted_address, placeResult.geometry.location);
        });
      }

      /** Initialize Distance Matrix for the locator. */
    /*  function initializeDistanceMatrix(locator) {
        const distanceMatrixService = new google.maps.DistanceMatrixService();

        // Annotate travel times to the selected location using Distance Matrix.
        locator.updateTravelTimes = function() {
          if (!locator.searchLocation) return;

          const units = (locator.userCountry === 'USA') ?
              google.maps.UnitSystem.IMPERIAL :
              google.maps.UnitSystem.METRIC;
          const request = {
            origins: [locator.searchLocation.location],
            destinations: locator.locations.map(function(x) {
              return x.coords;
            }),
            travelMode: google.maps.TravelMode.DRIVING,
            unitSystem: units,
          };
          const callback = function(response, status) {
            if (status === 'OK') {
              const distances = response.rows[0].elements;
              for (let i = 0; i < distances.length; i++) {
                const distResult = distances[i];
                let travelDistanceText, travelDistanceValue;
                if (distResult.status === 'OK') {
                  travelDistanceText = distResult.distance.text;
                  travelDistanceValue = distResult.distance.value;
                }
                const location = locator.locations[i];
                location.travelDistanceText = travelDistanceText;
                location.travelDistanceValue = travelDistanceValue;
              }

              // Re-render the results list, in case the ordering has changed.
              locator.renderResultsList();
            }
          };
          distanceMatrixService.getDistanceMatrix(request, callback);
        };
      }*/
    </script>
    <script>
      const CONFIGURATION = {
        "locations": [
          {"title":"Waltmart Universidad","address1":"CDMX","address2":"México","coords":{"lat":19.36884,"lng":-99.16410},"placeId":""},
          {"title":"Sams Club Universidad","address1":"CDMX","address2":"México","coords":{"lat":19.36998,"lng":-99.16421},"placeId":""},
          {"title":"Patio Universidad","address1":"CDMX","address2":"México","coords":{"lat":19.36597,"lng":-99.16704},"placeId":"235"},
          {"title":"Plaza Universidad","address1":"CDMX","address2":"México","coords":{"lat":19.37077,"lng":-99.16449},"placeId":"236"},
          {"title":"Abarrotes Montalvo","Morrovia 814 portales norte":"CDMX","address2":"México","coords":{"lat":19.36342,"lng":-99.15034},"placeId":"237"},
          {"title":"Bodega Aurrera Express","Portales 2":"CDMX","address2":"CDMX","coords":{"lat":19.36614,"lng":-99.15259},"placeId":"ChIJn93OiYBDkoAR7kSomO77gps"},
          {"title":"Galerías el triunfo","address1":"CDMX","address2":"CDMX","coords":{"lat":19.36762,"lng":-99.16260},"placeId":"238"},
          
        ],
        "mapOptions": {"center":{"lat":38.0,"lng":-100.0},"fullscreenControl":true,"mapTypeControl":false,"streetViewControl":false,"zoom":4,"zoomControl":true,"maxZoom":17},
        "mapsApiKey": "YOUR_API_KEY_HERE"
      };

      function initMap() {
        new LocatorPlus(CONFIGURATION);
      }

        function findMe(){
   var output = document.getElementById('map');

   if (navigator.geolocation){
       confirm("Tu navegador soporta Geolocalizacion");
       output.innerHTML = "<p>Tu navegador soporta Geolocalizacion</p>";

   } else{
       confirm("Tu navegador NO soporta Geolocalizacion");
       output.innerHTML = "<p>Tu navegador NO soporta Geolocalizacion</p>";
   }

   function localizacion (posicion){
    var latitude = posicion.coords.latitude;
    var longitude = posicion.coords.longitude;

    output.innerHTML = "<p>latitude: "+latitude+"<br>longitud "+longitude+"</p>";
      // guardar la posicion

   }

   function error(){
     output.innerHTML = "<p>No se pudo obtener tu ubicacion </p>";
   }


   navigator.geolocation.getCurrentPosition(localizacion,error);
}
    </script>
    <script id="locator-result-items-tmpl" type="text/x-handlebars-template">
      {{#each locations}}
        <li class="location-result" data-location-index="{{index}}">
          <button class="select-location">
            <h2 class="name">{{title}}</h2>
          </button>
          <div class="address">{{address1}}<br>{{address2}}</div>
          {{#if travelDistanceText}}
            <div class="distance">{{travelDistanceText}}</div>
          {{/if}}
        </li>
      {{/each}}
    </script>
  </head>
  <body>
    <div>
<button type="button" onclick="return findMe();">Mostrar ubicación </button>

</div>  
    <div id="map-container">
      <div id="locations-panel">
        <div id="locations-panel-list">
          <header>
            <h1 class="search-title">
              <img src="https://fonts.gstatic.com/s/i/googlematerialicons/place/v15/24px.svg"/>
              Encuentra tu localizacion
            </h1>
            <div class="search-input">
              <input id="location-search-input" placeholder="Agrega tu direccion o codigo postal">
              <div id="search-overlay-search" class="search-input-overlay search">
                <button id="location-search-button">
                  <img class="icon" src="https://fonts.gstatic.com/s/i/googlematerialicons/search/v11/24px.svg" alt="Buscar"/>
                </button>
              </div>
            </div>
          </header>
          <div class="section-name" id="location-results-section-name">
            Todas las localizaciones
          </div>
          <div class="results">
            <ul id="location-results-list"></ul>
          </div>
        </div>
      </div>
      <div id="map"></div>
    </div>
    <!-- <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCqa-ZHLmzXhgsxIeyyMetH_fAH34HLJ9k&libraries=drawing"></script>-->
    
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyANZ_tj0m9KI-W0MZKmXImqpH_V6AkJgfI&callback=initMap&libraries=places,geometry&solution_channel=GMP_QB_locatorplus_v4_cABD" async defer></script>
    <?php
    echo "aqui estoy haciendo pruebas";
  ?>  
  </body>
</html>