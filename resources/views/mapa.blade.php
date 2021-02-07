<!DOCTYPE html>
<html>
  <head>
    <title>Geocoding Service</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZTrnuoWZkmS8ZxoxJM-_AELDVJrPcGyE&callback=initMap&libraries=&v=weekly"
      defer
    ></script>
    <script type="text/javascript" charset="UTF-8" src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
    <script type="text/javascript" charset="UTF-8" src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
    <script type="text/javascript" charset="UTF-8" src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>
    <script type="text/javascript" charset="UTF-8" src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
    <script type="text/javascript" charset="UTF-8" src="https://js.api.here.com/v3/3.1/mapsjs-clustering.js"></script>
    <script type="text/javascript" charset="UTF-8" src="https://js.api.here.com/v3/3.1/mapsjs-data.js"></script>
      <script src="{{ asset('js/usuario.js') }}"    defer></script>
      <script src="{{ asset('js/finca.js') }}"     type="text/javascript"></script>
    <script src="{{ asset('js/usuario.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />

    <style type="text/css">

      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 50%;
      }

      /* Optional: Makes the sample page fill the window. */
      html,
      body {
        height: 100%;
        margin: 0;
        padding: 0;
      }

      #floating-panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: "Roboto", "sans-serif";
        line-height: 30px;
        padding-left: 10px;
      }
    </style>
    <script>
         var platform = new H.service.Platform({
        'apikey': '2OetLaJmz-VJNKdhDfObtZ3oWGemsOrSxjIr4CoP_4g'
      });

      var service = platform.getSearchService();
      var posiciones=[];


// Call the geocode method with the geocoding parameters,
// the callback and an error callback function (called if a
// communication error occurs):
        let map;
      function initMap() {


         map = new google.maps.Map(document.getElementById("map"), {
          zoom: 8,
          center: { lat: -34.397, lng: 150.644 },
        });
        const address= obtenerDireccionUsuario('direccion');
           console.log(address);

           service.geocode({
 q: address
}, (result) => {
  // Add a marker for each location found
  result.items.forEach((item) => {

    var marcador= new google.maps.Marker({
              map,
              position: item.position,
            });
    posiciones.push(marcador);

    map.setCenter(item.position);


      });
}, alert);
document.getElementById("submit").addEventListener("click", () => {
           const address = document.getElementById("address").value;
         service.geocode({
 q: address
}, (result) => {
  // Add a marker for each location found
  result.items.forEach((item) => {

    var marcador= new google.maps.Marker({
              map,
              position: item.position,
            });
    posiciones.push(marcador);

    if(posiciones.length>1){
     var distancia=getDistanciaMetros(posiciones[0].position.lat(),posiciones[0].position.lng(),posiciones[1].position.lat(),posiciones[1].position.lng());
//console.log(getDistanciaMetros(posiciones[0].position.lat(),posiciones[0].position.lng(),posiciones[1].position.lat(),posiciones[1].position.lng()));
alert("Se encuentra a " + distancia+ " metros de su ubicacion");
    }

      });
}, alert);
        });
      }




            function getDistanciaMetros(lat1,lon1,lat2,lon2){

                rad = function(x) {return x*Math.PI/180;}
                var R = 6378.137; //Radio de la tierra en km
                var dLat = rad( lat2 - lat1 );
                var dLong = rad( lon2 - lon1 );
                var a = Math.sin(dLat/2) * Math.sin(dLat/2) + Math.cos(rad(lat1)) *
                    Math.cos(rad(lat2)) * Math.sin(dLong/2) * Math.sin(dLong/2);
                var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));


                var d = R * c * 1000;
                return d ;

            }



                function obtenerDireccionUsuario(name) {
                    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
                      var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
                        results = regex.exec(location.search);
                             return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
                                                        }
    </script>
  </head>
  <body>
  <div id="usuario">
    <p id="direccion"></p>

    </div>
    <div id="map"></div>

  </body>

</html>
