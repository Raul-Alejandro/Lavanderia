@extends('layouts.app')
@section('content')

<h2>Agregar servicio de planchado - Orden #{{$order->id}}</h2> 
<div>
	{!!Form::open(['route'=>['order.add_iron',$order->id],'method'=>'POST','id'=>'order-form'])!!}
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
				<input type="button" id="price_button" value="Calcular costo" class="btn btn-danger" onClick="price()">
				<label style="font-size:20px;"> Total: </label> <label id="total" style="font-size:20px;"> 0 </label>
				<label id="state-promotion" style="font-size:20px;">  </label>
			</div>
		</div>
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
			<div class="form-group">
				{!!Form::submit('Enviar',['class'=>'btn btn-primary','id'=>'submit'])!!}
				<a href="{{url('order')}}" class="btn btn-danger">Cancelar</a>
			</div>
		</div>
	{!!Form::close()!!}
</div>

<script type="text/javascript">
	var i_cost = [];
	var i_pcost = [];

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

		divf = document.createElement('div');
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

		divf = document.createElement('div');
		divf.setAttribute("class","form-group");
		div.appendChild(divf);
			
		var check = document.createElement('input');
		check.type = "checkbox";
		check.style.zoom = 2;
		check.id = name+"_promotion"+total;
		check.name = name+"_promotion"+total;
		divf.appendChild(check);

		var label = document.createElement('label');
		label.setAttribute("class",'control-label');
		label.innerHTML = "¿Usar promocion?";
		divf.appendChild(label);		

		divf = document.createElement('div');
		divf.setAttribute("class","form-group");
		div.appendChild(divf);

		var check = document.createElement('input');
		check.type = "checkbox";
		check.style.zoom = 2;
		check.id = name+"_check"+total;
		check.name = name+"_check"+total;
		divf.appendChild(check);
			
		label = document.createElement('label');
		label.setAttribute("class",'control-label');
		label.innerHTML = "¿Dar gratis este servicio?";
		divf.appendChild(label);

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

	function price(){
		var label = document.getElementById("total"); //Variable del label "Total" que se encuentra en el top de la pagina
		var total_iron = 0;
		var num = 0; //Variable de control para subtotal de cada servicio de acuerdo a cantidad/peso

		var c_i = 1;
		while(c_i > 0){
			select = document.getElementById("iron_service"+c_i);
			quantity = document.getElementById("iron_quantity"+c_i);
			promotion_cost = document.getElementById("iron_promotion"+c_i);
			free = document.getElementById("iron_check"+c_i);

			if(select != null){
				if(select.selectedIndex > 0){
					input = select.options[select.selectedIndex];

					if(!free.checked){	
						if(promotion_cost.checked && i_pcost[input.index-1]){
							num = parseFloat(i_pcost[input.index-1]);
						}
						else{
							num = parseFloat(i_cost[input.index-1]);
						}

						num_q = 1;
						if(quantity.value){
							num_q = parseInt(quantity.value);
							num = num * num_q;
						}
						total_iron = total_iron + num;
					}
				}
				c_i++;
			}
			else{
				c_i = 0;
			}
		}

		label.innerHTML = Math.round(total_iron*Math.pow(10,2))/Math.pow(10,2);
	}

	$(document).ready(function(){
		$('#del_iron').attr('disabled','disabled');

		iron = @json($iron_services);
		for(var i = 0; i < iron.length; i++){
			i_cost.push(iron[i].cost);
			i_pcost.push(iron[i].promotion_cost);
		}
	});
</script>

{!! JsValidator::formRequest('App\Http\Requests\OrderFormRequest','#order-form') !!}
@endsection