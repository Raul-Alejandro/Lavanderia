@extends('layouts.app')
@section('content')

<h2> Servicios de Lavado
	@if(Auth::user()->type != 'EMPLEADO')
		<a href="wash-service/create" class="btn btn-primary">Agregar Servicio</a>
	@endif
</h2>
<div class="row">
	<div class="col-lg-12 table-responsive">
		<table class="table table-striped table-hover table-sm">
			<thead class="table-dark">
				<tr align="center">
					<th>ID</th>
					<th>CODIGO</th>
					<th>NOMBRE</th>
					<th>COSTO</th>
					@if(Auth::user()->type != 'EMPLEADO')
					<th colspan="2">OPCIONES</th>
					@endif
				</tr>
			</thead>
			<tbody>
				@foreach($services as $service)
					<tr align="center">
						<td> {{$service->id}} </td>
						<td> {{$service->code}} </td>
						<td> {{$service->name}} </td>
						<td> {{$service->cost}} </td>
						@if(Auth::user()->type != 'EMPLEADO')
							<td> 
								<a href="{{URL::action('WashServiceController@edit',$service->id)}}" class="btn btn-primary btn-sm">Editar</a>
							</td>
							@if(Auth::user()->type == 'SUPER')
							<td>
								<a href="" class="btn btn-danger btn-sm" data-target="#modal-delete-{{$service->id}}" data-toggle="modal">Delete</a>
							</td>
							@endif
						@endif
					</tr>
					@include('wash.modal')
				@endforeach

				{{ $services->fragment('foo')->links() }}
			</tbody>
		</table>
	</div>
</div>

@endsection