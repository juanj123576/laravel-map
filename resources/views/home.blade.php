@extends('layouts.app')
@section('styles')
    <style>
        #map{
            width: 350px;
            height: 400px;
            position: relative;
            left: 400px;
            top:-390px;
        }
        #map2{
            width: 400px;
            height: 385px;
            position: relative;
            left: 16px;
            top:20px;
        }

        #exampleModal{
            width: 1200px;
        }
        #exampleModal2{
            width: 1200px;
        }
        #exampleModal3{
            width: 1200px;
        }




    </style>
@endsection

@section('content')
   <div id="finca">
       <table class="table table-hover table-striped">
			<thead>
				<tr>

					<th>nombre</th>
					<th colspan="2">
						&nbsp;
					</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="finca in fincas">

				<td v-text="finca.nombre"></td>

					<td width="10px">
                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModal"
                                @click="cambiarEditar(finca)">Editar</button>
				<!--		<a href="{{ url('page') }}" class="btn btn-warning btn-sm" >ver finca</a>-->
					</td>

				</tr>
			</tbody>
		</table>
       <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" @click="cambiarAgregar()">
           Agregar finca
       </button>



       <!-- Modal -->
       <div class="modal fade "  id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
           <div class="modal-dialog modal-lg" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                       </button>
                   </div>

                   <div class="row">
                       <div class="modal-body">

                           <div class="col-sm-6">
                               <template v-if="modoEditar===true">
                                   <form @submit.prevent="editarFinca(finca)">
                                       <h3>Editar Finca</h3>
                                       <div class="mb-3">
                                           <label for="" class="form-label">nombre</label>
                                           <input  type="text" class="form-control" tabindex="1" v-text="finca.nombre" v-model="finca.nombre">
                                       </div>
                                       <div class="mb-3">
                                           <label for="" class="form-label">Municipio</label>
                                           <input type="text" class="form-control" tabindex="2" v-model="finca.municipio">
                                       </div>
                                       <div class="mb-3">
                                           <label for="" class="form-label">Departamento</label>

                                           <input type="text" class="form-control" tabindex="3" v-model="finca.departamento">
                                       </div>
                                       <div class="mb-3">
                                           <label>Por favor, ingrese la dirección del corregimiento
                                               o municipio más cercano a su finca, para el transporte de mercancia
                                           </label>
                                           <input placeholder="Search for a Place or an Address." type="text" name="search" id="search" value="Berlin, Germany" autocomplete="off" onkeyup="autosuggest(this)" v-model="finca.direccion" autofocus/>

                                           <i class="fa fa-search fa-search-custom" aria-hidden="true"></i>
                                           <div class="dropdown">
                                               <ul id="list"></ul>
                                           </div>

                                       </div>
                                       <button type="submit" class="btn btn-primary" tabindex="4">Editar</button>

                                   </form>
                               </template>
                               <template v-else >
                                   <form  @submit.prevent="agregarFinca()" >
                                       <h3>Agregar Finca</h3>
                                       <div class="mb-3">
                                           <label for="" class="form-label">nombre</label>
                                           <input  type="text" class="form-control" tabindex="1" v-model="finca.nombre">
                                       </div>
                                       <div class="mb-3">
                                           <label for="" class="form-label">Municipio</label>
                                           <input type="text" class="form-control" tabindex="2" v-model="finca.municipio">
                                       </div>
                                       <div class="mb-3">
                                           <label for="" class="form-label">Departamento</label>

                                           <input type="text" class="form-control" tabindex="3" v-model="finca.departamento">


                                       </div>
                                       <div class="mb-3">
                                           <label>Por favor, ingrese la dirección del corregimiento
                                               o municipio más cercano a su finca, para el transporte de mercancia
                                           </label>
                                           <input placeholder="Search for a Place or an Address." type="text" name="search" id="search" value="Berlin, Germany" autocomplete="off" onkeyup="autosuggest(this)" v-model="finca.direccion" autofocus/>

                                           <i class="fa fa-search fa-search-custom" aria-hidden="true"></i>
                                           <div class="dropdown">
                                               <ul id="list"></ul>
                                           </div>

                                       </div>




                                       <button type="submit" class="btn btn-primary" tabindex="4">Guardar</button>

                                   </form>
                               </template>


                           </div>

                           <div id="map" ></div>

                           </div>


                       </div>

                   </div>
               </div>
           </div>
       </div>



   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2">
      Comparar distancia de fincas
   </button>

   <!-- Modal -->
   <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <div class="row">
               <div class="modal-body">
                   <div class="col-sm-6">
                       <div id="usuario">
                           <div class="dropdown">
                               <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                   Selecciona al usuario
                               </button>
                               <div class="dropdown-menu">
                                   <div v-for="usuario in usuarios">
                                       <form type="s">

                                       </form>
                                       <a v-on:click="verFinca(usuario)" class="dropdown-item" v-text="usuario.name"></a>

                                   </div>

                               </div>
                           </div>
                           <table>
                               <thead>Fincas del usuario</thead>
                               <tbody>

                               <div class="dropdown">
                                   <p>selecione la finca</p>
                                   <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                        Ver fincas
                                   </button>
                                   <div class="dropdown-menu" title="Fincas a comparar">
                                       <div v-for="finca in fincas">
                                            <form action="submit">
                                                <option type="buttom" id="boton" @click="enviardireccion(finca)"  v-text="finca.nombre"></option>
                                            </form>


                                       </div>

                                   </div>
                               </div>   <div class="dropdown">
                                   <p>selecione la finca</p>
                                   <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                       mis fincas
                                   </button>
                                   <div class="dropdown-menu" title="Fincas a comparar">
                                       <div v-for="finca in fincas2">
                                           <form action="submit">
                                               <option type="buttom" id="boton" @click="enviardireccion2(finca)"  v-text="finca.nombre"></option>
                                           </form>


                                       </div>

                                   </div>
                               </div>
                               <button type="button" class="btn btn-primary" onclick="Comparar()">
                                  Comparar fincas
                               </button>

                               </tbody>
                           </table>
                           <div id="map2"  ></div>
                           <span id="nombre" style="display: none"></span>
                           <span id="nombre2" style="display: none"></span>

                       </div>
                   </div>


                 </div>
               </div>




           </div>
       </div>
   </div>







@endsection





@section('Scripts')

<script src="{{ asset('js/usuario.js') }}"    defer></script>
<script src="{{ asset('js/finca.js') }}"     type="text/javascript"></script>

<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZTrnuoWZkmS8ZxoxJM-_AELDVJrPcGyE&callback=initMap&libraries=places&v=weekly"
    defer
></script>
        <link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />
        <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
        <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
        <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
        <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    var platform = new H.service.Platform({
        apikey: `2OetLaJmz-VJNKdhDfObtZ3oWGemsOrSxjIr4CoP_4g` // replace with your api key
    });
    var posiciones=[];


    const autosuggest = (e) => {
        if(event.metaKey){
            return
        }

        let searchString = e.value
        if (searchString != "") {
            fetch(
                `https://autosuggest.search.hereapi.com/v1/autosuggest?apiKey=2OetLaJmz-VJNKdhDfObtZ3oWGemsOrSxjIr4CoP_4g&at=33.738045,73.084488&limit=5&resultType=city&q=${searchString}&lang=en-US`
            )
                .then((res) => res.json())
                .then((json) => {
                    if (json.length != 0) {
                        document.getElementById("list").innerHTML = ``;
                        let dropData = json.items.map((item) => {
                            if (json.length != 0) {
                                document.getElementById("list").innerHTML = ``;
                                let dropData = json.items.map((item) => {
                                    if ((item.position != undefined) & (item.position != ""))
                                        document.getElementById("list").innerHTML += `<li onClick="addMarkerToMap(${item.position.lat},${item.position.lng})">${item.title}</li>`;
                                });
                            }

                        });
                    }
                });
        }
    };

    let map,map2;

    function initMap() {
        var myOptions = {
            zoom: 10,
            center: new google.maps.LatLng(10.4195841, -75.5271224),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        map = new google.maps.Map(document.getElementById("map"), myOptions);

        map2 = new google.maps.Map(document.getElementById("map2"), myOptions);
    }


  function Comparar (){
        console.log("hola");

      var service = platform.getSearchService();
      const address = document.getElementById("nombre").value;
      if(address==null){
          console.log("hola");

      }else{
          service.geocode({
              q: address
          }, (result) => {
              // Add a marker for each location found
              result.items.forEach((item) => {
                  const posicion = { lat: 0, lng: 0 };
                  posicion.lat=item.position.lat;
                  posicion.lng=item.position.lng;
                    console.log(posicion);
                  var marcador= new google.maps.Marker({
                      map:map2,
                      position: posicion,
                  });
                posiciones.push(posicion)




              });
          }, alert);
      }
      const address2 = document.getElementById("nombre2").value;
      let marcador2;
      if(address2==null){
          console.log("hola");
      }else{
          service.geocode({
              q: address2
          }, (result) => {
              // Add a marker for each location found
              result.items.forEach((item) => {
                  const posicion = { lat: 0, lng: 0 };
                  posicion.lat=item.position.lat;
                  posicion.lng=item.position.lng;

                  marcador2= new google.maps.Marker({
                      map:map2,
                      position:posicion,
                  });




                  posiciones.push(posicion);
                  map2.setCenter(item.position);
                  map2.setZoom(8);
                  if(posiciones.length>1){
                      console.log("no sirve")
                      let distancia=getDistanciaMetros(posiciones[0].lat,posiciones[0].lng,posiciones[1].lat,posiciones[1].lng);

                      alert("Se encuentra a " + distancia+ " metros de su ubicacion");
                  }

              });
          }, alert);
      }
  }

        var marcador;
    const addMarkerToMap = (lat, lng) => {
                const posicion = { lat: 0, lng: 0 };
        posicion.lat=lat;
        posicion.lng=lng;
        if(marcador==null){
            marcador= new google.maps.Marker({
                map,
                position: posicion,
            });
        }else{
            marcador.setMap(null);
            marcador= new google.maps.Marker({
                map,
                position: posicion,
            });
        }

        map.setCenter(posicion);

    };
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

</script>

@endsection
