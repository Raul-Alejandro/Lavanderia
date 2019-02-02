@extends('layouts.app')
@section('content')

<h2>Nuevo Pedido</h2> 
<label style="font-size:20px;"> Total: </label> <label id="total" style="font-size:20px;"> 0 </label>
<div>
	{!!Form::open(['route'=>'order.store','method'=>'POST','id'=>'order-form'])!!}
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
			{!!Form::label('lcustomer','Cliente',['class'=>'control-label'])!!}
		</div>
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
			<div class="form-group has-error">
				{!!Form::text('customer',null,['class'=>'form-control','placeholder'=>'Nombre del Cliente','id'=>'search','autocomplete'=>'off'])!!}
			</div>
		</div>
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
			<div class="form-group">
				{!!Form::label('phone','Telefono',['class'=>'control-label'])!!}
				{!!Form::text('phone',null,['class'=>'form-control','placeholder'=>'Telefono del Cliente'])!!}
			</div>
		</div>
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
				{!!Form::label('delivery_date','Fecha de entrega',['class'=>'control-label'])!!}
				{!!Form::date('delivery_date',null,['class'=>'form-control','placeholder'=>'Seleccione la fecha de entrega'])!!}
				{!!Form::text('hour',null,['class'=>'form-control','placeholder'=>'Hora'])!!}
			</div>
		</div>
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
			<div class="form-group">
				{!!Form::label('payment_type','Tipo de Pago Empleado',['class'=>'control-label'])!!}
				{!!Form::select('payment_type',["EFECTIVO"=>"Efectivo","TARJETA"=>"Tarjeta"],null,['class'=>'form-control'])!!}
			</div>
		</div>
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
			<div class="form-group">
				{!!Form::label('descount','¿Aplicar Descuento al Pedido?, Solo para servicios de lavado y planchado',['class'=>'control-label'])!!}
				{!!Form::selectRange('descount',1,100,null,['id'=>'descount','class'=>'form-control','placeholder'=>'Porcentaje de Descuento'])!!}
			</div>
		</div>
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
			<div class="form-group">
				{!!Form::label('promotion','Promocion',['class'=>'control-label'])!!}
				{!!Form::select('promotion',$promotions,null,['class'=>'form-control','placeholder'=>'Seleccione una Promocion'])!!}
			</div>
		</div>
		@if(Auth::user()->type == 'SUPER')
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
			<div class="form-group">
				{!!Form::label('idSucursal','Sucursal',['class'=>'control-label'])!!}
				{!!Form::select('idSucursal',$sucursals,null,['class'=>'form-control','placeholder'=>'Seleccione una Sucursal'])!!}
			</div>
		</div>
		@endif
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
			<div class="form-group">
				<input type="button" id="price_button" value="Calcular costo" class="btn btn-danger" onClick="price()">
				<label style="font-size:20px;"> Total: </label> <label id="total2" style="font-size:20px;"> 0 </label>
				<label id="state-promotion" style="font-size:20px;">  </label>
			</div>
		</div>
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
			<div class="form-group">
				{!!Form::label('pay','Pagar completo o parcialmente el servicio',['class'=>'control-label'])!!}
				{!!Form::number('pay',null,['class'=>'form-control','placeholder'=>'Dinero Recibido','id'=>'pay'])!!}
			</div>
		</div>
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
			<div class="form-group">
				<input type="button" id="pay_button" value="Efectuar Pago" class="btn btn-outline-primary" onClick="payProcess()">
				<label style="font-size:20px;" id="pay-text"> </label> <label id="swap" style="font-size:20px;">  </label>
			</div>
		</div>
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
			<div class="form-group">
				{!!Form::label('status','Status',['class'=>'control-label'])!!}
				{!!Form::text('status','UNPAID',['class'=>'form-control','readonly','id'=>'status'])!!}
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
	var control, wash, iron, dry;
	/*var w_measure = [];
	var w_cost = [];
	var i_cost = [];
	var d_cost = [];
	var i_pcost = [];*/
	var total_price = 0;

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
		divf.setAttribute("class","form-group has-error");
		div.appendChild(divf);

		//Select database
		var select = document.createElement('select');
		select.name = name+"_service"+total;
		select.id = name+"_service"+total;
		select.setAttribute("class","form-control");

		if(name == 'wash'){	
			select.setAttribute("onChange","w_form('wash_service"+total+"','dyn_wash"+total+"',"+total+")");  //id select, id div, 
		}

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

		if(name != 'wash'){
			//Div form-group
			divf = document.createElement('div');
			divf.setAttribute("class","form-group has-error");
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
		}
		else{
			//Dynamic div for select wash
			divf = document.createElement('div');
			divf.id = "dyn_wash"+total;
			div.appendChild(divf);
		}

		if(name == 'iron'){
			divf = document.createElement('div');
			divf.setAttribute("class","form-group");
			div.appendChild(divf);
			
			var check = document.createElement('input');
			check.type = "checkbox";
			check.style.zoom = 2;
			check.id = name+"_promotion"+total;
			check.name = name+"_promotion"+total;
			//check.value = 'SI';
			divf.appendChild(check);

			var label = document.createElement('label');
			label.setAttribute("class",'control-label');
			label.innerHTML = "¿Usar promocion?";
			divf.appendChild(label);	
		}

		if(name == 'dry'){		
			//Apply any descount 
			divf = document.createElement('div');
			divf.setAttribute("class","form-group");
			div.appendChild(divf);

			label = document.createElement('label');
			label.setAttribute("class",'control-label');
			label.innerHTML = "¿Aplicar descuento?";
			divf.appendChild(label);

			var input = document.createElement('input');
			input.type = "number";
			input.id = name+"_descount"+total;
			input.name = name+"_descount"+total;
			input.setAttribute("min",0);
			input.setAttribute("class","form-control");
			input.setAttribute("placeholder","Descuento a aplicar");
			divf.appendChild(input);
		}
		else{
			divf = document.createElement('div');
			divf.setAttribute("class","form-group");
			div.appendChild(divf);

			var check = document.createElement('input');
			check.type = "checkbox";
			check.style.zoom = 2;
			check.id = name+"_check"+total;
			check.name = name+"_check"+total;
			//check.value = 'SI';
			divf.appendChild(check);
			
			label = document.createElement('label');
			label.setAttribute("class",'control-label');
			label.innerHTML = "¿Dar gratis este servicio?";
			divf.appendChild(label);
		}

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

	//Funcion para obtener el valor de la bascula accediendo a una url absoluta
	function bascule(name){
		var input = document.getElementById(name);  //Input que guardara el valor obtenido
		var url = "http://localhost:8717/weight"; //"{{url('ajax-test')}}";  //Ruta absoluta 6969

		$.ajax({
      		type: "GET",
      		url: url,
      		//headers: {'Access-Control-Allow-Origin': url},
      		//data: { u: url },
      		
      		beforeSend: function () {
        		//$("#alert").html("Procesando, espere por favor...");
        		console.log("Procesando, espere por favor...")
      		},
      		success: function(result) {
        		//$("#alert").html(result.message);
        		console.log(result.message);
        		input.value = result.message;
      		},
      		error: function () {
        		//$('#alert').html('Algo salio mal');
        		console.log('Algo salio mal');
      		} 
    	});
	}

	function w_form(id_s, id_d, total){
		var select = document.getElementById(id_s);
		var div = document.getElementById(id_d);
		div.innerHTML = '';

		var input = select.options[select.selectedIndex];
		var type = wash[input.index-1].measure;  //w_measure[input.index-1];

		if(type == 'CANTIDAD'){
			//Div form-group
			var divf = document.createElement('div');
			divf.setAttribute("class","form-group");
			div.appendChild(divf);

			//Input quantity
			var input = document.createElement('input');
			input.type = "number";
			input.id = "wash_quantity"+total;
			input.name = "wash_quantity"+total;
			input.setAttribute("min",0);
			input.setAttribute("class","form-control");
			input.setAttribute("placeholder","Cantidad");
			divf.appendChild(input);
		}
		if(type == 'PESO' && input.text != 'Secado por kilo'){
			//Div form-group
			var divf = document.createElement('div');
			divf.setAttribute("class","form-group");
			div.appendChild(divf);

			//Input weight
			var input = document.createElement('input');
			input.setAttribute("type",'text');
			input.setAttribute("name","wash_weight"+total);
			input.id = "wash_weight"+total;
			input.setAttribute("class","form-control col-lg-7");
			input.setAttribute("style","display:inline");
			input.setAttribute("placeholder","Peso");
			divf.appendChild(input);

			var button = document.createElement('input');
			button.setAttribute("type",'button');
			button.setAttribute("name",total);
			button.setAttribute("value",'Valor de la Bascula');
			button.setAttribute("class",'btn btn-outline-primary');
			button.setAttribute("onClick","document.getElementById('wash_weight"+total+"').innerHTML = bascule('wash_weight"+total+"')");
			divf.appendChild(button);
		}
	}

	//Esta función calcula el precio de todos los servicios que se hicieron en el pedido tomando en cuenta cantidad de cada uno y promociones
	function price(){
		//total_services = [];
		var label = document.getElementById("total"); //Variable del label "Total" que se encuentra en el top de la pagina
		var label2 = document.getElementById("total2"); //Variable del label "Total" que se encuentra a lado del boton "Calcular costo"
		var input_desc = document.getElementById("descount");
		var total = 0; //Variable donde se guardara el valor total de los servicios
		var total_wash = 0;
		var total_iron = 0;
		var total_dry = 0;
		var descount = 0;
		var num = 0; //Variable de control para subtotal de cada servicio de acuerdo a cantidad/peso

		//services();
	
		var c_w = 1; //Variable de control del ciclo while
		//Ciclo para identificar todos los servicios de lavado del pedido
		while(c_w > 0){
			//Variables necesarias para cada servicio
			select = document.getElementById("wash_service"+c_w); //Se obtiene el input select
			quantity = document.getElementById("wash_quantity"+c_w); //Se obtiene el input cantidad
			weight = document.getElementById("wash_weight"+c_w); //Se obtiene el input del peso
			free = document.getElementById("wash_check"+c_w);

			if(select != null){ //Si hay algun servicio seleccionado continua el ciclo
				if(select.selectedIndex > 0){
					input = select.options[select.selectedIndex]; //Se obtiene la informacion seleccionada del select
					type = wash[input.index-1].measure;//w_measure[input.index-1]; //Se obtiene que medida utiliza el servicio: cantidad/peso

					//Verificar si el servicio se va a cobrar o no (promocion aplicada por el usuario)
					if(!free.checked){
						num = parseFloat(wash[input.index-1].cost); //w_cost[input.index-1]
						//Avanza si la medida del servicio es en cantidad
						if(type == 'CANTIDAD'){
							num_q = 1;
							if(quantity.value){ //No avanza si el valor es null
								num_q = parseInt(quantity.value); //Se convierte a entero el valor ingresado
								num = num * num_q; //Se calcula el costo total por este servicio multiplicando por la cantidad
							}
						}

						//Avanza si la medida del servicio es en peso
						if(type == 'PESO'){
							//num_w = 2.6; //Restriccion: peso minimo por el que se cobra
							/*if(input.innerHTML == 'Secado por kilo'){
								if(weight.value > 1.8){
									num_w = parseFloat(weight.value); //Se convierte a numero flotante el peso
									num = num * num_w; //Se calcula el costo total por este servicio multiplicando por la cantidad
								}
								else{
									num = 30;
								}
							}
							else */
							if(input.innerHTML != 'Secado por kilo'){
								if(weight.value > 1.6){ //Avanza si el peso es mayor al de la restriccion
									num_w = parseFloat(weight.value); //Se convierte a numero flotante el peso
									num = num * num_w; //Se calcula el costo total por este servicio multiplicando por la cantidad
								}
								else{
									num = 70;
								}
							}
							else{
								num = 0;
							}
						}
						total_wash = total_wash + num;
					}
				}
				c_w++;
			}
			else{
				c_w = 0;
			}
		}

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
						if(promotion_cost.checked && iron[input.index-1].promotion_cost){  // i_pcost[input.index-1]
							num = parseFloat(iron[input.index-1].promotion_cost);          // i_pcost[input.index-1]
						}
						else{
							num = parseFloat(iron[input.index-1].cost);                    // i_cost[input.index-1]
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

		var c_d = 1;
		while(c_d > 0){
			select = document.getElementById("dry_service"+c_d);
			quantity = document.getElementById("dry_quantity"+c_d);
			descount = document.getElementById("dry_descount"+c_d);

			if(select != null){
				if(select.selectedIndex > 0){
					input = select.options[select.selectedIndex];
					num = parseFloat(dry[input.index-1].cost); //d_cost[input.index-1]
					num_q = 1;
					if(quantity.value){
						num_q = parseInt(quantity.value);
						num = num * num_q;
					}
					if(descount.value){
						num -= num * (parseFloat(descount.value/100));
					}
					total_dry = total_dry + num;
				}
				c_d++;
			}
			else{
				c_d = 0;
			}
		}

		if(input_desc.value){
			descount = total_wash + total_iron;
            descount = descount * (input_desc.value / 100);
		}

		total = total_wash + total_iron + total_dry - descount;

		label.innerHTML = Math.round(total*Math.pow(10,2))/Math.pow(10,2);
		label2.innerHTML = Math.round(total*Math.pow(10,2))/Math.pow(10,2);
	}

	function payProcess(){
		var total = parseFloat(document.getElementById("total").innerHTML);
		var pay = document.getElementById("pay").value;
		var label_swap = document.getElementById("swap");
		var label_pay_text = document.getElementById("pay-text");
		var status = document.getElementById("status");
		var swap = 0;
		var num = 0;

		if(total < pay){	
			swap = pay - total;
			label_pay_text.innerHTML = 'Cambio: ';
			label_swap.innerHTML = Math.round(swap*Math.pow(10,2))/Math.pow(10,2);
			status.value = 'PAID';
		}
		else{
			swap = total - pay;
			label_pay_text.innerHTML = 'Saldo restante: ';
			label_swap.innerHTML = Math.round(swap*Math.pow(10,2))/Math.pow(10,2);
			status.value = 'UNPAID';
		}
	}

	function open_cash(){
		form = document.getElementById('order-form');
		submit = document.getElementById('submit');
		console.log('Funcion de la caja');
		var url = "http://localhost:8717/open_cash"; //Ruta absoluta

		$.ajax({
      		type: "POST",
      		url: url,

      		beforeSend: function () {
        		console.log("Procesando, espere por favor...")
      		},
      		success: function(result) {
        		console.log(result.message);
      		},
      		error: function (xhr, thrownError) {
        		console.log('Algo salio mal'+xhr.responseText);
      		} 
    	});	
	}

	$('#order-form').submit(function(e){
		//e.preventDefault();
		var pay = document.getElementById('pay').value;		
		errors = document.getElementsByClassName('has-error').length;
		if(pay > 0 && !errors > 0){
			var url = "http://localhost:8717/open_cash"; //Ruta absoluta
			$.ajax({
	      		type: "POST",
	      		url: url,

	      		beforeSend: function () {
	        		console.log("Procesando, espere por favor...")
	      		},
	      		success: function(result) {
	        		console.log(result.message);
	      		},
	      		error: function (xhr, thrownError) {
	        		console.log('Algo salio mal'+xhr.responseText);
	      		} 
	    	});	
		}
	});

	$(document).ready(function(){
		$('#del_wash').attr('disabled','disabled');
		$('#del_iron').attr('disabled','disabled');
		$('#del_dry').attr('disabled','disabled');

		wash = @json($wash_services);
		/*for(var i = 0; i < wash.length; i++){
			w_cost.push(wash[i].cost);
			w_measure.push(wash[i].measure);
		}*/

		iron = @json($iron_services);
		/*for(var i = 0; i < iron.length; i++){
			i_cost.push(iron[i].cost);
			i_pcost.push(iron[i].promotion_cost);
		}*/

		dry = @json($dry_services);
		/*for(var i = 0; i < dry.length; i++){
			d_cost.push(dry[i].cost);
		}*/

		console.log(wash);

		var bloodhound = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.whitespace,
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                url: '/find?q=%QUERY%',
                wildcard: '%QUERY%'
            },
        });
            
        $('#search').typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
        	limit: 10,
            name: 'customers',
            source: bloodhound,
            display: function(data) {
                return data.name  //Input value to be set when you select a suggestion. 
            },
            templates: {
                empty: [
                    '<div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
                ],
                header: [
                    '<div class="list-group search-results-dropdown">'
                ],
                suggestion: function(data) {
                return '<div style="font-weight:normal; margin-top:-10px ! important;" class="list-group-item">' + data.name + '</div></div>'
                }
            }
        });
	});
</script>

{!! JsValidator::formRequest('App\Http\Requests\OrderFormRequest','#order-form') !!}
@endsection