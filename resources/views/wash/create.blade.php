@extends('layouts.app')
@section('content')

<h2>Agregar Servicio - Lavado</h2>
<div>
	{!!Form::open(['route'=>'wash-service.store','method'=>'POST','id'=>'service-form'])!!}
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12" id="tel">
			<div class="form-group">
				{!!Form::label('code','Codigo',['class'=>'control-label'])!!}
				{!!Form::text('code',null,['class'=>'form-control','placeholder'=>'Codigo del Servicio'])!!}
			</div>
		</div>
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12" id="tel">
			<div class="form-group">
				{!!Form::label('name','Nombre',['class'=>'control-label'])!!}
				{!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre del Servicio'])!!}
			</div>
		</div>
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12" id="tel">
			<div class="form-group">
				{!!Form::label('measure','Medida',['class'=>'control-label'])!!}
				{!!Form::select('measure',['CANTIDAD' => 'Cantidad', 'PESO' => 'Peso'],null,['class'=>'form-control','placeholder'=>'Seleccione una opción'])!!}
			</div>
		</div>
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12" id="tel">
			<div class="form-group">
				{!!Form::label('cost','Costo',['class'=>'control-label'])!!}
				{!!Form::number('cost',null,['class'=>'form-control','placeholder'=>'Costo del Servicio','min'=>0])!!}
			</div>
		</div>
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
			<div class="form-group">
				{!!Form::submit('Enviar',['class'=>'btn btn-primary'])!!}
				<a href="{{url('wash-service')}}" class="btn btn-danger">Cancelar</a>
			</div>
		</div>
	{!!Form::close()!!}
</div>

{!! JsValidator::formRequest('App\Http\Requests\ServiceFormRequest','#service-form') !!}
@endsection