@extends('layouts.app')
@section('styles')
    <style>
        #map{
            width: 350px;
            height: 400px;
            position: relative;
            left: 400px;
            top:-250px;
        }
        #exampleModal{
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
          <button @click="verFinca(usuario)">ver finca</button>
				<!--		<a href="{{ url('page') }}" class="btn btn-warning btn-sm" >ver finca</a>-->
					</td>

				</tr>
			</tbody>
		</table>





<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
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
                            <form  @submit.prevent="agregarFinca()">

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
                                    <input  type="text" class="form-control" tabindex="2" v-model="finca.departamento">
                                </div>


                                <button type="submit" class="btn btn-primary" tabindex="4">Guardar</button>
                            </form>
                        </div>

                        <map></map>

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

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZTrnuoWZkmS8ZxoxJM-_AELDVJrPcGyE&callback=App.init"></script>
<script>

</script>

@endsection
