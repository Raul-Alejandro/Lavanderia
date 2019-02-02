@extends('order.index')
@section('data')

<div class="row">
	<div class="col-lg-12 table-responsive">
		<table class="table table-striped table-hover table-sm">
			<thead class="table-dark" id="result-head">
			</thead>
			<tbody id="result-body">
			</tbody>
		</table>
	</div>
</div>
<div class="row">
	<div class="col-lg-12 table-responsive">
		<table class="table table-striped table-hover table-sm">
			<thead class="table-dark">
				<tr align="center">
					<th>ID</th>
					@if(Auth::user()->type == 'SUPER')
					<th>SUCURSAL</th>
					@endif
					<th>CLIENTE</th>
					<th>TELEFONO</th>
					<th>USUARIO</th>
					<th>FECHA</th>
					<th>ENTREGA</th>
					<th>ENTREGADO</th>
					<th>TOTAL</th>
					<th>CARGO POR RETRASO</th>
					<th>SALDO RESTANTE</th>
					<th>TIPO DE PAGO</th>
					<th>STATUS</th>
					<th colspan="4">OPCIONES</th>
				</tr>
			</thead>
			<tbody>
				@foreach($orders as $order)
					<tr align="center" id='order-{{$order->id}}'>
						<td> {{$order->id}} </td>
						@if(Auth::user()->type == 'SUPER')
						<td> {{$order->sucursal}} </td>
						@endif
						<td> {{$order->customer}} </td>
						<td> {{$order->phone}} </td>
						<td> {{$order->user}} </td>
						<td> {{$order->created_at}} </td>
						<td> {{$order->delivery_date}} </td>
						<td id='delivered-{{$order->id}}'> {{$order->delivered}} </td>
						<td> {{$order->total}} </td>
						<td id='charge-{{$order->id}}'> {{$order->charge}} </td>
						<td id='balance-{{$order->id}}'> {{$order->balance}} </td>
						<td> {{$order->payment_type}} </td>
						<td id='status-{{$order->id}}'> {{$order->status}} </td>
						<td> 
							<a href="{{URL::action('OrderController@show',$order->id)}}" class="btn btn-primary btn-sm">Detalles</a>
						</td>
						<td> 
							<button class="btn btn-danger btn-sm" onclick="print({{$order->id}})">Imprimir Recibo</button> 
							<button class="btn btn-danger btn-sm" onclick="print_note({{$order->id}})">Imprimir Nota Viajera</button>
							<button class="btn btn-danger btn-sm" onclick="print_talon({{$order->id}})">Imprimir Talon</button> 
						</td>
	
						@if($order->delivered == null and $order->status == 'PAID')
						<td id='delivery-button-{{$order->id}}'> 
							<button class="btn btn-primary btn-sm" onclick="delivery({{$order->id}})">Entregar</button> 
						</td>
						@endif
						@if($order->status == 'UNPAID')
						<td id='pay-button-{{$order->id}}'>
							@if($order->total > 0)
								<button class="btn btn-outline-primary btn-sm" data-target="#modal-pay-{{$order->id}}" data-toggle="modal">Pagar</button>
							@endif
						</td>
						@endif
						@if(!$order->charge and !$order->delivered)
						<td id='charge-button-{{$order->id}}'>
							<button class="btn btn-outline-primary btn-sm" data-target="#modal-charge-{{$order->id}}" data-toggle="modal">Aplicar Cargo</button>
						</td>
						@endif
					</tr>
					@include('order.modalpay')
					@include('order.modalcharge')

					@endforeach
				
				{{ $orders->links() }}
			</tbody>
		</table>
	</div>
</div>

<script type="text/javascript">
	$(".pagination a").on("click",function(e){
		e.preventDefault();
		var url = "{{url('order')}}";
		var page = $(this).attr('href').split('page=')[1];
		var start = document.getElementById('start').value;
		var final = document.getElementById('final').value;
		var search = document.getElementById('search').value;
		var customer = document.getElementById('customer').value;
		var sucursal = document.getElementById('sucursal').value;
		console.log('order');
		$.ajax({
            type: 'GET',
            data: {"search": search, "start": start, "final": final, "customer": customer, "sucursal": sucursal, "page": page, _token: '{{csrf_token()}}'},
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
	});
</script>

@endsection