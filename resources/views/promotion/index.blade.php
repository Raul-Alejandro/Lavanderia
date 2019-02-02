@extends('layouts.app')
@section('content')

<h2> Promociones
	@if(Auth::user()->type != 'EMPLEADO')
	<a href="promotion/create" class="btn btn-primary">Nueva Promocion</a>
	@endif
</h2>
<div class="row">
	<div class="col-lg-12 table-responsive">
		<table class="table table-bordered table-hover table-sm">
			<thead class="table-dark">
				<tr align="center">
					<th>ID</th>
					<th>NOMBRE</th>
					<th>DESCRIPCION</th>
					<th>STATUS</th>
					@if(Auth::user()->type != 'EMPLEADO')
					<th colspan="4">OPCIONES</th>
					@endif
				</tr>
			</thead>
			<tbody>
				@foreach($promotions as $promotion)
					<tr class="table-active" align="center">
						<td> {{$promotion->id}} </td>
						<td> {{$promotion->name}} </td>
						<td> {{$promotion->description}} </td>
						<td> {{$promotion->status}} </td>
						
						@if(Auth::user()->type != 'EMPLEADO')
						<td> 
							<a href="{{URL::action('PromotionController@changeStatus',$promotion->id)}}" class="btn btn-primary btn-sm">
								@if($promotion->status == 'ACTIVE')
									Desactivar
								@else
									Activar
								@endif
							</a>
						</td>
						<td> 
							<a href="{{URL::action('PromotionController@edit',$promotion->id)}}" class="btn btn-primary btn-sm">Editar</a>
						</td>
						@if(Auth::user()->type == 'SUPER')
						<td>
							<a href="" class="btn btn-danger btn-sm" data-target="#modal-delete-{{$promotion->id}}" data-toggle="modal">Delete</a>
						</td>
						@endif
						@endif
					</tr>
					<tr>
						<td></td>
						<td class="table-info" colspan="3" align="center"> REQUERIMIENTOS </td>
						@if(Auth::user()->type != 'EMPLEADO')
						<td class="table-info" colspan="3" align="center"> 
							<a href="{{URL::action('PromotionController@show',$promotion->id)}}" class="btn btn-primary btn-sm">Agregar Requerimiento</a>
						</td>
						@endif
					</tr>
					<thead class="table-secondary" align="center" > 
						<tr>
							<th></th>
							<th>SERVICIO</th>
							<th>CANTIDAD</th>
							<th>TIPO</th>
						</tr>
					</thead>
					
						@foreach($promotion->requirements as $requirement)
						<tr align="center">
							<td></td>
							@if($requirement->idWashService)
								<td> {{$requirement->washService->name}} </td>
							@elseif($requirement->idIronService)
								<td> {{$requirement->ironService->name}} </td>
							@else 
								<td> {{$requirement->dryService->name}} </td>
							@endif
							<td> {{$requirement->quantity}} </td>
							@switch($requirement->type)
								@case(0)
									<td> REQUISITO </td>
									@break
								@case(1)	
									<td> GRATIS </td>
									@break
								@default
									<td> {{$requirement->type}}% de descuento </td>
							@endswitch	
						</tr>
						@endforeach
					@include('promotion.modal')
				@endforeach
			</tbody>
		</table>
	</div>
</div>

<script>
	function add(services, name, id){
		var padre = document.getElementById(id+name+"_ord");
		total = padre.childElementCount + 1;

		var div = document.createElement('div');
		div.id = id+"dynamic_"+name+total;
		padre.appendChild(div);

		//label 
		var label = document.createElement('label');
		label.setAttribute("class",'control-label');
		label.innerHTML = "Servicio "+total;
		div.appendChild(label);

		//Div form-group
		var divf = document.createElement('div');
		divf.setAttribute("class","form-group");
		div.appendChild(divf);

		//Select database
		var select = document.createElement('select');
		select.name = id+name+"_service"+total;
		select.id = id+name+"_service"+total;
		select.setAttribute("class","form-control");

		option = document.createElement("option");
		option.text = "Seleccione una opcion";
		select.appendChild(option);

		services.forEach(function(service){
		var option = document.createElement("option");
 		option.value = service.id;
 		option.text = service.name;
		select.appendChild(option);
		}); 

		divf.appendChild(select);

		//Div form-group
		var divf = document.createElement('div');
		divf.setAttribute("class","form-group");
		div.appendChild(divf);

		//Input quantity
		var input = document.createElement('input');
		input.type = "number";
		input.id = id+name+"_quantity"+total;
		input.name = id+name+"_quantity"+total;
		input.setAttribute("min",0);
		input.setAttribute("class","form-control");
		input.setAttribute("placeholder","Cantidad");
		divf.appendChild(input);

		//Div form-group
		var divf = document.createElement('div');
		divf.setAttribute("class","form-group");
		div.appendChild(divf);

		//Select options
		var type = document.createElement('select');
		type.name = id+name+"_type"+total;
		type.id = id+name+"_type"+total;
		type.setAttribute("class","form-control");

		option = document.createElement("option");
		option.text = "Seleccione una opcion";
		type.appendChild(option);

		option = document.createElement("option");
		option.text = "REQUISITO";
		option.value = "REQUISITO";
		type.appendChild(option);

		for(var i = 50; i > 0; i-=10){
			option = document.createElement("option");
			option.text = i+" % de Descuento";
			option.value = i;
			type.appendChild(option);	
		}

		option = document.createElement("option");
		option.text = "GRATIS";
		option.value = "GRATIS";
		type.appendChild(option);

		divf.appendChild(type);

		$('#del_'+name+id).attr('disabled',false);
		if(total == 10){
			$('#add_'+name+id).attr('disabled','disabled');
		}
		total+=1;
	}

	function del(name, id){	
		//$('#del_'+name).click(function(){
			var padre = document.getElementById(id+name+"_ord");
			var total = padre.childElementCount;
			var ultimo = document.getElementById(id+"dynamic_"+name+total);
			padre.removeChild(ultimo);
			$('#add_'+name+id).attr('disabled',false);

			if(total -1 == 0){
				$('#del_'+name+id).attr('disabled','disabled');
			}
			//finish();
		//});
	}

	$(document).ready(function(){
		
    });
</script>

{!! JsValidator::formRequest('App\Http\Requests\RequirementFormRequest','#requirement-form') !!}

@endsection