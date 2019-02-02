@extends('layouts.app')
@section('content')

<div>
<h2>Nueva Requerimiento - {{$promotion->name}}</h2>
	{!!Form::open(['route'=>['requirement.store',$promotion->id],'method'=>'POST','id'=>'requirement-form'])!!}
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
			<div class="form-group">
				{!!Form::label('lavado','Servicios de Lavado',['class'=>'control-label'])!!}
			</div>
		</div>
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12" id="wash_ord">
			
		</div>
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
			<div class="form-group">
				<input type="button" id="add_wash" value="Agregar Servicio de Lavado" class="btn btn-primary" onclick="add({{$wash_services}},'wash')">
				<input type="button" id="del_wash" value="Eliminar Ultimo" class="btn btn-danger" onClick="del('wash')">
			</div>
		</div>
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
			<div class="form-group">
				{!!Form::label('planchado','Servicios de Planchado',['class'=>'control-label'])!!}
			</div>
		</div>
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12" id="iron_ord">
			
		</div>
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
			<div class="form-group">
				<input type="button" id="add_iron" value="Agregar Servicio de Planchado" class="btn btn-primary" onclick="add({{$iron_services}},'iron')">
				<input type="button" id="del_iron" value="Eliminar Ultimo" class="btn btn-danger" onClick="del('iron')">
			</div>
		</div>
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
			<div class="form-group">
				{!!Form::label('tintoreria','Servicios de Tintoreria',['class'=>'control-label'])!!}
			</div>
		</div>
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12" id="dry_ord">
			
		</div>
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
			<div class="form-group">
				<input type="button" id="add_dry" value="Agregar Servicio de Tintoreria" class="btn btn-primary" onclick="add({{$dry_services}},'dry')">
				<input type="button" id="del_dry" value="Eliminar Ultimo" class="btn btn-danger" onClick="del('dry')">
			</div>
		</div>
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
			<div class="form-group">
				{!!Form::submit('Enviar',['class'=>'btn btn-primary'])!!}
				<a href="{{ URL::action('PromotionController@show',$promotion->id) }}" class="btn btn-danger">Cancelar</a>
			</div>
		</div>
	{!!Form::close()!!}
</div>

<script>
	function add(services, name){
		var padre = document.getElementById(name+"_ord");//("wash_ord");
		total = padre.childElementCount + 1;

		var div = document.createElement('div');
		div.id = "dynamic_"+name+total;
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
		select.name = name+"_service"+total;
		select.id = name+"_service"+total;
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
		input.id = name+"_quantity"+total;
		input.name = name+"_quantity"+total;
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
		type.name = name+"_type"+total;
		type.id = name+"_type"+total;
		type.setAttribute("class","form-control");

		option = document.createElement("option");
		option.text = "Seleccione una opcion";
		type.appendChild(option);

		option = document.createElement("option");
		option.text = "REQUISITO";
		option.value = 0;
		type.appendChild(option);

		for(var i = 50; i > 0; i-=10){
			option = document.createElement("option");
			option.text = i+" % de Descuento";
			option.value = i;
			type.appendChild(option);	
		}

		option = document.createElement("option");
		option.text = "GRATIS";
		option.value = 1;
		type.appendChild(option);

		divf.appendChild(type);

		$('#del_'+name).attr('disabled',false);
		if(total == 10){
			$('#add_'+name).attr('disabled','disabled');
		}
		total+=1;
	}

	function del(name){	
		var padre = document.getElementById(name+"_ord");
		var total = padre.childElementCount;
		var ultimo = document.getElementById("dynamic_"+name+total);
		padre.removeChild(ultimo);
		$('#add_'+name).attr('disabled',false);

		if(total -1 == 0){
			$('#del_'+name).attr('disabled','disabled');
		}
	}

	$(document).ready(function(){
		$('#del_wash').attr('disabled','disabled');
		$('#del_iron').attr('disabled','disabled');
		$('#del_dry').attr('disabled','disabled');
    });
</script>

{!! JsValidator::formRequest('App\Http\Requests\PromotionFormRequest','#requirement-form') !!}
@endsection