@extends('layouts.app')
@section('content')

<h2>Editar Requerimiento - {{$requirement->promotion->name}} </h2>
<div>
	{!!Form::model($requirement,['route'=>['requirement.update',$promotion,$requirement->id],'method'=>'PATCH','id'=>'requirement-form'])!!}
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
			<div class="form-group">
				{!!Form::label('quantity','Cantidad',['class'=>'control-label'])!!}
				{!!Form::number('quantity',null,['class'=>'form-control','placeholder'=>'Cantidad'])!!}
			</div>
		</div>
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
			<div class="form-group">
				{!!Form::label('type','Tipo',['class'=>'control-label'])!!}
				{!!Form::select('type', 
				[0 => 'REQUISITO', 
				50 => '50 % de descuento',
				40 => '40 % de descuento',
				30 => '30 % de descuento',
				20 => '20 % de descuento',
				10 => '10 % de descuento',
				1 => 'GRATIS'],
				null,['class'=>'form-control','placeholder'=>'Seleccione una opcion'])!!}
			</div>
		</div>
		@if($requirement->idWashService)
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
			<div class="form-group">
				{!!Form::label('idWashService','Servicio',['class'=>'control-label'])!!}
				{!!Form::select('idWashService',$services,null,['class'=>'form-control','placeholder'=>'Seleccione una opcion'])!!}
			</div>
		</div>
		@endif
		@if($requirement->idIronService)
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
			<div class="form-group">
				{!!Form::label('idIronService','Servicio',['class'=>'control-label'])!!}
				{!!Form::select('idIronService',$services,null,['class'=>'form-control','placeholder'=>'Seleccione una opcion'])!!}
			</div>
		</div>
		@endif
		@if($requirement->idDryService)
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
			<div class="form-group">
				{!!Form::label('idDryService','Servicio',['class'=>'control-label'])!!}
				{!!Form::select('idDryService',$services,null,['class'=>'form-control','placeholder'=>'Seleccione una opcion'])!!}
			</div>
		</div>
		@endif
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
			<div class="form-group">
				{!!Form::submit('Enviar',['class'=>'btn btn-primary'])!!}
				<a href="{{ URL::action('PromotionController@show',$requirement->promotion->id) }}" class="btn btn-danger">Cancelar</a>
			</div>
		</div>
	{!!Form::close()!!}
</div>

{!! JsValidator::formRequest('App\Http\Requests\RequirementFormRequest','#requirement-form') !!}
@endsection