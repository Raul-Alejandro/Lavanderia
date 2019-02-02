@extends('layouts.app')
@section('content')

<h2> Pedidos 
	<a href="order/create" class="btn btn-primary">Nuevo Pedido</a>
	<a href="" class="btn btn-danger" data-target="#modal-search" data-toggle="modal">Busqueda Avanzada</a>
	@include('order.search')
</h2>

<div id="content">
	@section('data')

	@show
</div>

<script type="text/javascript">
	function payProcess(num){
		var str = document.getElementById("total"+num).innerHTML;
		var total = parseFloat(document.getElementById("total"+num).innerHTML);

		var pay = document.getElementById("pay"+num).value;
		var label_swap = document.getElementById("swap"+num);
		var label_pay_text = document.getElementById("pay-text"+num);
		var status = document.getElementById("status"+num);
		var swap = 0;

		if(total < pay || total == pay){	
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

	function render(){
		var url = "{{url('order')}}";
		var start = document.getElementById('start').value;
		var final = document.getElementById('final').value;
		var search = document.getElementById('search').value;
		var customer = document.getElementById('customer').value;
		var sucursal = document.getElementById('sucursal').value;
		console.log(start);
		console.log(final);
		console.log(search);
		$.ajax({
            type: 'GET',
            data: {"search": search, "start": start, "final": final, "customer": customer, "sucursal": sucursal, _token: '{{csrf_token()}}'},
            url: url,
            dataType: 'json',
            success: function (data) {
            	console.log(data);
                $('#content').empty().append($(data)); 
            },
            error: function (data) {
                var errors = data.responseJSON;
                if (errors) {
                    $.each(errors, function (i) {
                        console.log(errors[i]);
                    });
                }
            }
        });
	}

	function pay(id){
		var url = "{{url('order')}}"+"/"+id+"/pay"; //Ruta absoluta
		var pay = document.getElementById("pay"+id);
		var balance = document.getElementById("balance-"+id);
		var total_modal = document.getElementById("total"+id);
		var status = document.getElementById("status-"+id);
		var button = document.getElementById('pay-button-'+id);
		if(pay.value < 1){
			alert("Ingrese un valor mayor a 0, valor ingresado: "+pay.value);
		}
		else{
			$.ajax({
	      		type: "GET",
	      		url: url,
	      		data: {"pay": pay.value, _token: '{{csrf_token()}}'},
	      		dataType: 'json',
	      		success: function(result) {
	      			balance.innerHTML = result.order.balance;
	      			total_modal.innerHTML = result.order.balance;
	      			status.innerHTML = result.order.status;
	      			if(result.order.status == 'PAID'){
	      				button.id = 'delivery-button-'+id;
						button.innerHTML = '<button class="btn btn-primary btn-sm" onclick="delivery('+id+')">Entregar</button>';
	      			}
	      			open_cash();
	      			alert("Pago de $"+pay.value+" se ha completado exitosamente");
	      			pay.value = "";
	      		},
	      		error: function (xhr, thrownError) {
	        		console.log('Algo salio mal'+xhr.responseText);
	      		} 
	    	});
		}
	}

	function charge(id){
		var url = "{{url('order')}}"+"/"+id+"/charge"; //Ruta absoluta
		var balance = document.getElementById("balance-"+id); 
		var charge = document.getElementById("charge-"+id);
		var status = document.getElementById("status-"+id);
		var input = document.getElementById("input-"+id);
		var form = document.getElementById("form-"+id);
		var charge_button = document.getElementById('charge-button-'+id);
		var pay_button = document.getElementById('pay-button-'+id);
		var total_modal = document.getElementById("total"+id);
		var charge_modal = document.getElementById("charge-label"+id);
		var father = document.getElementById("order-"+id);

		if(input.value < 0){
			alert("Ingrese un valor mayor a 0, valor ingresado: "+input.value);
		}
		else{			
			$.ajax({
	      		type: "GET",
	      		url: url,
	      		data: {"charge": input.value, _token: '{{csrf_token()}}'},
	      		dataType: 'json',
	      		success: function(result) {
					//button.innerHTML = '<button class="btn btn-outline-primary btn-sm" data-target="#modal-pay-'+id+'" data-toggle="modal">Pagar</button>';
	      			//father.removeChild(charge_button);
	      			charge.innerHTML = result.order.charge;
	      			balance.innerHTML = result.order.balance;
	      			charge_modal.innerHTML = result.order.charge;
	      			total_modal.innerHTML = result.order.balance;
	      			status.innerHTML = result.order.status;
	      			if(result.order.status == 'UNPAID' && !pay_button){
	      				charge_button.id = 'pay-button-'+id;
						charge_button.innerHTML = '<button class="btn btn-primary btn-sm" data-target="#modal-pay-'+id+'">Pagar</button>';
	      			}
	      			else{
	      				father.removeChild(charge_button);
	      			}
	      			form.innerHTML = "";
	      			alert("El cargo de $"+input.value+" se ha registrado exitosamente");
	      		},
	      		error: function (xhr, thrownError) {
	        		console.log('Algo salio mal'+xhr.responseText);
	      		} 
	    	});
		}
	}

	function delivery(id){
		var url = "{{url('order')}}"+"/"+id+"/delivery"; //Ruta absoluta
		var delivered = document.getElementById("delivered-"+id);
		var button = document.getElementById("delivery-button-"+id);
		var charge_button = document.getElementById("charge-button-"+id);
		
		$.ajax({
	      	type: "GET",
	      	url: url,
	      	data: {_token: '{{csrf_token()}}'},
	      	dataType: 'json',
	      	success: function(result) {
	      		//console.log(result);
	      		delivered.innerHTML = result.order.delivered;
	      		button.innerHTML = "";
	      		if(charge_button){
	      			charge_button.innerHTML = "";
	      		}
	      	},
	   		error: function (xhr, thrownError) {
	       		console.log('Algo salio mal'+xhr.responseText);
	      	} 
	    });
	}

	function open_cash(){
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

	function print(id){
		var url = "http://localhost:8717/print_order/"+id; //Ruta absoluta

		$.ajax({
      		type: "GET",
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

	function print_note(id){
		var url = "http://localhost:8717/print_order-n/"+id;

		$.ajax({
      		type: "GET",
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

	function print_talon(id){
		var url = "http://localhost:8717/print_order-t/"+id;

		$.ajax({
      		type: "GET",
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

	$(document).ready(function(){
		var bloodhound = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.whitespace,
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                url: '/findorder?q=%QUERY%',
                wildcard: '%QUERY%'
            },
        });
            
        $('#search').typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
        	limit: 10,
            name: 'orders',
            source: bloodhound,
            display: function(data) {
                return data.id  //Input value to be set when you select a suggestion. 
            },
            templates: {
                empty: [
                    '<div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
                ],
                header: [
                    '<div class="list-group search-results-dropdown">'
                ],
                suggestion: function(data) {
                return '<div style="font-weight:normal; margin-top:-10px ! important;" class="list-group-item">' + data.id + ' ' + data.status + '</div></div>'
                }
            }
        });
	});
</script>

@endsection