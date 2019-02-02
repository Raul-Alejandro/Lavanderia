@extends('layouts.app')
@section('content')

<h2>Editar Usuario - {{$user->name}} </h2>
<div>
	{!!Form::model($user,['route'=>['user.updateprofile',$user->id],'method'=>'PATCH','id'=>'user-form'])!!}
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
			<div class="form-group">
				{!!Form::label('name','Nombre',['class'=>'control-label'])!!}
				{!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre del Usuario'])!!}
			</div>
		</div>
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
			<div class="form-group">
				{!!Form::label('email','Email',['class'=>'control-label'])!!}
				{!!Form::email('email',null,['class'=>'form-control','placeholder'=>'Email del Usuario'])!!}
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

{!! JsValidator::formRequest('App\Http\Requests\ProfileRequest','#user-form') !!}
@endsection