@extends('layouts.app')
@section('content')

<h2> Detalles de la Orden - {{$order->sucursal->name}} </h2>
<h2> Cliente: {{$order->customer->name}} </h2>
<h3> Total del Pedido: ${{$order->total}} </h3>
<h3> Descuento Aplicado: {{$order->descount}}% = ${{($order->total_wash + $order->total_iron) * ($order->descount / 100)}} </h3>

@if(count($order->washOrders) > 0)
<div class="row">
	<h4> Servicios de Lavado </h4>
	<div class="col-lg-12 table-responsive">
		<table class="table table-striped table-hover table-sm">
			<thead class="table-dark">
				<tr align="center">
					<th>ID</th>
					<th>SERVICIO</th>
					<th>CANTIDAD</th>
					<th>PESO</th>
					<th>COSTO SERVICIO</th>
					<th>GRATIS</th>
					<th>COSTO TOTAL</th>
				</tr>
			</thead>
			<tbody>
				<tr> TOTAL: {{$order->total_wash}} </tr>
				
				@foreach($order->washOrders as $wash_order)
					<tr align="center">
						<td> {{$wash_order->id}} </td>
						<td> {{$wash_order->service}} </td>
						<td> {{$wash_order->quantity}} </td>
						<td>
							@if($wash_order->service == 'Secado por kilo' and $wash_order->weight == 0)
								<button class="btn btn-outline-primary btn-sm" data-target="#modal-addweight-{{$wash_order->id}}" data-toggle="modal">Editar Peso</button>
								@include('order.modal_addweight')
							@else 
								{{$wash_order->weight}}
							@endif 
						</td>
						<td> {{$wash_order->cost}} </td>
						<td> {{$wash_order->free}} </td>
						<td> 
							@if($wash_order->weight != null)
								@if($wash_order->service == 'Secado por kilo')
									@if($wash_order->weight < 1.8)
										30
									@else
										{{$wash_order->cost * $wash_order->weight}} 
									@endif
								@else
									@if($wash_order->weight < 2.6)
										70
									@else
										{{$wash_order->cost * $wash_order->weight}} 
									@endif
								@endif
							@else
								{{$wash_order->cost * $wash_order->quantity}} 
							@endif
						</td>
					</tr>
				@endforeach	
			</tbody>
		</table>
	</div>
</div>
@endif

@if(count($order->ironOrders) > 0)
<div class="row">
	<h4> Servicios de Planchado </h4>
	<div class="col-lg-12 table-responsive">
		<table class="table table-striped table-hover table-sm">
			<thead class="table-dark">
				<tr align="center">
					<th>ID</th>
					<th>SERVICIO</th>
					<th>CANTIDAD</th>
					<th>PROMOCION</th>
					<th>COSTO SERVICIO</th>
					<th>GRATIS</th>
					<th>COSTO TOTAL</th>
				</tr>
			</thead>
			<tbody>
				<tr> TOTAL: {{$order->total_iron}} </tr>
				@foreach($order->ironOrders as $iron_order)
					<tr align="center">
						<td> {{$iron_order->id}} </td>
						<td> {{$iron_order->service}} </td>
						<td> {{$iron_order->quantity}} </td>
						<td> {{$iron_order->promotion}} </td>
						<td> {{$iron_order->cost}} </td>
						<td> {{$iron_order->free}} </td>
						<td> {{$iron_order->cost * $iron_order->quantity}} </td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@else
	@if(count($order->washOrders) > 0)
	<div class="form-group">
		<a href="{{URL::action('OrderController@add_ironOrders',$order->id)}}" class="btn btn-primary">Agregar servicio de planchado</a>
	</div>
	@endif
@endif

@if(count($order->dryCleanerOrders) > 0)
<div class="row">
	<h4> Servicios de Tintoreria </h4>
	<div class="col-lg-12 table-responsive">
		<table class="table table-striped table-hover table-sm">
			<thead class="table-dark">
				<tr align="center">
					<th>ID</th>
					<th>SERVICIO</th>
					<th>CANTIDAD</th>
					<th>DESCUENTO</th>
					<th>COSTO SERVICIO</th>
					<th>COSTO TOTAL</th>
				</tr>
			</thead>
			<tbody>
				<tr> TOTAL: {{$order->total_dry}} </tr>
				@foreach($order->dryCleanerOrders as $dry_order)
					<tr align="center">
						<td> {{$dry_order->id}} </td>
						<td> {{$dry_order->service}} </td>
						<td> {{$dry_order->quantity}} </td>
						<td> {{$dry_order->descount}} </td>
						<td> {{$dry_order->cost}} </td>
						@if($dry_order->descount != null)
							<td> {{$dry_order->cost * $dry_order->quantity - ($dry_order->cost * $dry_order->quantity) * ($dry_order->descount / 100)}}  </td>
						@else
							<td> {{$dry_order->cost * $dry_order->quantity}} </td>
						@endif
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endif

@if($order->promotion)
<div class="row">
	<h4> Promocion aplicada por el usuario </h4>
	<div class="col-lg-12 table-responsive">
		<table class="table table-striped table-hover table-sm">
			<thead class="table-dark">
				<tr align="center">
					<th>ID</th>
					<th>NOMBRE</th>
					<th>DESCRIPCION</th>
				</tr>
			</thead>
			<tbody>
				<tr align="center">
					<td> {{$order->promotion->id}} </td>
					<td> {{$order->promotion->name}} </td>
					<td> {{$order->promotion->description}} </td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
@endif
<a href="{{url('order')}}" class="btn btn-danger">Regresar</a>

<script type="text/javascript">
	function bascule(name){
		var input = document.getElementById(name);  //Input que guardara el valor obtenido
		var url = "http://localhost:8717/weight"; //"{{url('ajax-test')}}";  //Ruta absoluta 6969

		$.ajax({
      		type: "GET",
      		url: url,
      		success: function(result) {
        		console.log(result.message);
        		input.value = result.message;
      		},
      		error: function () {
      			alert('Fallo');
      		} 
    	});
	}

	$('#button-weight').click(function(e){
		e.preventDefault();
		bascule('weight');
		console.log('Si funciona');
	});

	/*$('#form').submit(function(e){
        e.preventDefault();
		var input = document.getElementById("weight");
        if(input.value < 0){
            alert("Ingrese un valor mayor a 0, valor ingresado: "+input.value);
        }
	});*/

	/*function save(id){
        var url = "{{url('add-weight')}}"+"/"+id; //Ruta absoluta
        var input = document.getElementById("weight");
        if(input.value < 0){
            alert("Ingrese un valor mayor a 0, valor ingresado: "+input.value);
        }
        else{
            $.ajax({
                type: "PATCH",
                url: url,
                data: {"weight": input.value, _token: '{{csrf_token()}}'},
                dataType: 'json',
                success: function(result) {
                    quantity_table.innerHTML = result.inventory.quantity;
                    total_alta.innerHTML = result.inventory.quantity;
                    total_baja.innerHTML = result.inventory.quantity;
                    alert("Se ha dado de alta "+quantity.value+" "+result.inventory.measure+" exitosamente");
                    quantity.value = "";
                },
                error: function (xhr, thrownError) {
                    console.log('Algo salio mal'+xhr.responseText);
                } 
            });
        }
    }*/
</script>

@endsection