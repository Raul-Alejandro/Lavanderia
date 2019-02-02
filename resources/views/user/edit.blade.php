@extends('layouts.app')
@section('content')

<h2>Editar Usuario - {{$user->name}} </h2>
<div>
	{!!Form::model($user,['route'=>['user.update',$user->id],'method'=>'PATCH','id'=>'user-form'])!!}
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
			<div class="form-group">
				{!!Form::label('name','Nombre',['class'=>'control-label'])!!}
				{!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre del Usuario'])!!}
			</div>
		</div>
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
			<div class="form-group">
				{!!Form::label('password','Cambiar Contraseña',['class'=>'control-label'])!!}
				{!!Form::password('password',['class'=>'form-control'])!!}
			</div>
		</div>
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
			<div class="form-group">
				{!!Form::label('password_confirmation','Confirmar Contraseña',['class'=>'control-label'])!!}
				{!!Form::password('password_confirmation',['class'=>'form-control','id'=>'password_confirmation'])!!}
			</div>
		</div>
		@if(Auth::user()->type == 'SUPER' and $user->id != 1)
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
			<div class="form-group">
				{!!Form::label('status','Status del Usuario',['class'=>'control-label'])!!}
				{!!Form::select('status',['ACTIVO' => 'Activo', 'INACTIVO' => 'Inactivo'],null,['class'=>'form-control','placeholder'=>'Define un Status para el Usuario'])!!}
			</div>
		</div>
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
			<div class="form-group">
				{!!Form::label('type','Tipo de Usuario',['class'=>'control-label'])!!}
				{!!Form::select('type',['ADMIN' => 'Admin', 'EMPLEADO' => 'Empleado'],null,['class'=>'form-control','placeholder'=>'Tipo de Usuario'])!!}
			</div>
		</div>
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
			<div class="form-group">
				{!!Form::label('idSucursal','Sucursal',['class'=>'control-label'])!!}
				{!!Form::select('idSucursal',$sucursals,null,['class'=>'form-control','placeholder'=>'Seleccione una Sucursal'])!!}
			</div>
		</div>
		@endif
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
			<div class="form-group">
				{!!Form::submit('Enviar',['class'=>'btn btn-primary'])!!}
				@if(Auth::user()->type == 'SUPER')
					<a href="{{url('user')}}" class="btn btn-danger">Cancelar</a>
				@else
					<a href="{{URL::action('UserController@show',$user->id)}}" class="btn btn-danger">Cancelar</a>
				@endif
			</div>
		</div>
	{!!Form::close()!!}
</div>

{!! JsValidator::formRequest('App\Http\Requests\UserEditFormRequest','#user-form') !!}
@endsection