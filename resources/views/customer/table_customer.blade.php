@extends('customer.index')
@section('data')

<div class="row">
	<div class="col-lg-12 table-responsive">
		<table class="table table-striped table-hover table-sm">
			<thead class="table-dark">
				<tr align="center">
					<th>ID</th>
					<th>NOMBRE</th>
					<th>TELEFONO</th>
					<th>SUCURSAL</th>
					@if(Auth::user()->type == 'SUPER')
					<th colspan="2">OPCIONES</th>
					@endif
				</tr>
			</thead>
			<tbody>
				@foreach($customers as $key => $customer)
					<tr align="center">
						<td> {{$customer->id}} </td>
						<td> {{$customer->name}} </td>
						<td> {{$customer->phone}} </td>
						<td> {{$sucursals[$customer->idSucursal]}} </td>
						@if(Auth::user()->type == 'SUPER')
						<td> 
							<a href="{{URL::action('CustomerController@edit',$customer->id)}}" class="btn btn-primary btn-sm">Editar</a>
						</td>
						<td>
							<a href="" class="btn btn-danger btn-sm" data-target="#modal-delete-{{$customer->id}}" data-toggle="modal">Delete</a>
						</td>
						@endif
					</tr>
					@include('customer.modal')
				@endforeach
				{{ $customers->links() }}
			</tbody>
		</table>
	</div>
</div>

<script type="text/javascript">
	$(".pagination a").on("click",function(e){
		e.preventDefault();
		var url = "{{url('customer')}}";
		var page = $(this).attr('href').split('page=')[1];
		var start = document.getElementById('start').value;
		var final = document.getElementById('final').value;
		var idSucursal = document.getElementById('idSucursal').value;
		console.log('customer');
		$.ajax({
            type: 'GET',
            data: {"start": start, "final": final, "idSucursal": idSucursal, "page": page, _token: '{{csrf_token()}}'},
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