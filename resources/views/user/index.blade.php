@extends('layouts.app')
@section('content')

<h2> Usuarios
	<a href="user/create" class="btn btn-primary">Nuevo Usuario</a>
</h2>
<div class="row">
	<div class="col-lg-12 table-responsive">
		<table class="table table-striped table-hover table-sm">
			<thead class="table-dark">
				<tr align="center">
					<th>ID</th>
					<th>NOMBRE</th>
					<th>EMAIL</th>
					<th>TIPO</th>
					<th>STATUS</th>
					<th>SUCURSAL</th>
					<th colspan="2">OPCIONES</th>
				</tr>
			</thead>
			<tbody>
				@foreach($users as $user)
					<tr align="center">
						<td> {{$user->id}} </td>
						<td> {{$user->name}} </td>
						<td> {{$user->email}} </td>
						<td> {{$user->type}} </td>
						<td> {{$user->status}} </td>
						<td> {{$user->sucursal->name}} </td>
						<td> 
							<a href="{{URL::action('UserController@edit',$user->id)}}" class="btn btn-primary btn-sm">Editar</a>
						</td>
						@if(Auth::user()->type == 'SUPER')
						<td>
							<a href="" class="btn btn-danger btn-sm" data-target="#modal-delete-{{$user->id}}" data-toggle="modal">Delete</a>
						</td>
						@endif
					</tr>
					@include('user.modal')
				@endforeach
			</tbody>
		</table>
	</div>
</div>

@endsection