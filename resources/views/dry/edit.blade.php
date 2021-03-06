@extends('layouts.app')
@section('content')

<h2>Editar Servicio - {{$service->name}} - Tintoreria</h2>
<div>
	{!!Form::model($service,['route'=>['dry-service.update',$service->id],'method'=>'PATCH','id'=>'service-form'])!!}
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
				{!!Form::label('cost','Costo',['class'=>'control-label'])!!}
				{!!Form::number('cost',null,['class'=>'form-control','placeholder'=>'Costo del Servicio','min'=>0])!!}
			</div>
		</div>
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
			<div class="form-group">
				{!!Form::submit('Enviar',['class'=>'btn btn-primary'])!!}
				<a href="{{url('dry-service')}}" class="btn btn-danger">Cancelar</a>
			</div>
		</div>
	{!!Form::close()!!}
</div>

{!! JsValidator::formRequest('App\Http\Requests\ServiceFormRequest','#service-form') !!}
@endsection