@extends('inventory.index')
@section('data')

<div class="row">
	<div class="col-lg-12 table-responsive">
		<table class="table table-striped table-hover table-sm">
			<thead class="table-dark">
				<tr align="center">
					<th>ID</th>
					<th>PRODUCTO</th>
					<th>MEDIDA</th>
					<th>CANTIDAD</th>
					<th>SUCURSAL</th>
					<th colspan="4">OPCIONES</th>
				</tr>
			</thead>
			<tbody>
				@foreach($inventories as $inventory)
					<tr align="center">
						<td> {{$inventory->id}} </td>
						<td> {{$inventory->product}} </td>
						<td> {{$inventory->measure}} </td>
						<td id='quantity-table-{{$inventory->id}}'> {{$inventory->quantity}} </td>
						<td> {{$inventory->sucursal}} </td>
						<td>
							<a href="" class="btn btn-outline-primary btn-sm" data-target="#modal-baja-{{$inventory->id}}" data-toggle="modal">Dar de baja</a>
						</td>
						<td>
							<a href="" class="btn btn-outline-primary btn-sm" data-target="#modal-alta-{{$inventory->id}}" data-toggle="modal">Dar de alta</a>
						</td>
						<!--<td> 
							<a href="{{URL::action('InventoryController@edit',$inventory->id)}}" class="btn btn-primary btn-sm">Editar</a>
						</td>-->
						@if(Auth::user()->type == 'SUPER')
						<td> 
							<a href="{{URL::action('InventoryController@edit',$inventory->id)}}" class="btn btn-primary btn-sm">Editar</a>
						</td>
						<td>
							<a href="" class="btn btn-danger btn-sm" data-target="#modal-delete-{{$inventory->id}}" data-toggle="modal">Delete</a>
						</td>
						@endif
					</tr>
					@include('inventory.modal')
					@include('inventory.baja')
					@include('inventory.alta')
				@endforeach

				{{ $inventories->links() }}
			</tbody>
		</table>
	</div>
</div>

<script type="text/javascript">
	$(".pagination a").on("click",function(e){
		e.preventDefault();
		var url = "{{url('inventory')}}";
		var page = $(this).attr('href').split('page=')[1];
		var product = document.getElementById('product').value;
		var less = document.getElementById('less').value;
		var higher = document.getElementById('higher').value;
		var measure = document.getElementById('measure').value;
		var sucursal = document.getElementById('sucursal').value;
		$.ajax({
            type: 'GET',
            data: {"product": product, "less": less, "higher": higher, "measure": measure, "sucursal": sucursal, "page": page, _token: '{{csrf_token()}}'},
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