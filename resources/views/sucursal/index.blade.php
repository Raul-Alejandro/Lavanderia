@extends('layouts.app')
@section('content')

<h2> Sucursales
	<a href="sucursal/create" class="btn btn-primary">Nueva Sucursal</a>
</h2>
<div class="row">
	<div class="col-lg-12 table-responsive">
		<table class="table table-striped table-hover table-sm">
			<thead class="table-dark">
				<tr align="center">
					<th>ID</th>
					<th>SUCURSAL</th>
					<th colspan="2">OPCIONES</th>
				</tr>
			</thead>
			<tbody>
				@foreach($sucursals as $sucursal)
					<tr align="center">
						<td> {{$sucursal->id}} </td>
						<td> {{$sucursal->name}} </td>
						<td> 
							<a href="{{URL::action('SucursalController@edit',$sucursal->id)}}" class="btn btn-primary btn-sm">Editar</a>
						</td>
						<td>
							<a href="" class="btn btn-danger btn-sm" data-target="#modal-delete-{{$sucursal->id}}" data-toggle="modal">Delete</a>
						</td>
					</tr>
					@include('sucursal.modal')
				@endforeach
			</tbody>
		</table>
	</div>
</div>

@endsection