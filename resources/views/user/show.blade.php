@extends('layouts.app')
@section('content')

<h2> Perfil
	<a href="{{URL::action('UserController@editprofile',$user->id)}}" class="btn btn-primary">Editar Perfil</a>
</h2>

<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
	<div class="form-group">
		<h4> Nombre: {{$user->name}} </h4>
	</div>
	<div class="form-group">
		<h4> Email: {{$user->email}} </h4>
	</div>
	@if($user->type != 'SUPER')
	<div class="form-group">
		<h4> Sucursal: {{$user->sucursal->name}} </h4>
	</div>
	@endif
</div>

</div>

@endsection