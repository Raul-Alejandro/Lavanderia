@extends('layouts.app')
@section('content')

<h2>Nuevo Cliente</h2>
<div>
	{!!Form::open(['route'=>'customer.store','method'=>'POST','id'=>'sucursal-form'])!!}
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12" id="tel">
			<div class="form-group">
				{!!Form::label('name','Nombre',['class'=>'control-label'])!!}
				{!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre del Cliente'])!!}
			</div>
		</div>
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12" id="tel">
			<div class="form-group">
				{!!Form::label('phone','Telefono',['class'=>'control-label'])!!}
				{!!Form::text('phone',null,['class'=>'form-control','placeholder'=>'Telefono del Cliente'])!!}
			</div>
		</div>
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12" id="tel">
			<div class="form-group">
				{!!Form::label('idSucursal','Sucursal',['class'=>'control-label'])!!}
				{!!Form::select('idSucursal',$sucursals,null,['class'=>'form-control','placeholder'=>'Seleccione una Sucursal'])!!}
			</div>
		</div>
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
			<div class="form-group">
				{!!Form::submit('Enviar',['class'=>'btn btn-primary'])!!}
				<a href="{{url('customer')}}" class="btn btn-danger">Cancelar</a>
			</div>
		</div>
	{!!Form::close()!!}
</div>

{!! JsValidator::formRequest('App\Http\Requests\SucursalFormRequest','#sucursal-form') !!}
@endsection