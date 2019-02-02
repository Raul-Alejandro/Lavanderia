@extends('layouts.app')
@section('content')

<h2>Editar Producto - {{$inventory->product}} - {{$inventory->sucursal->name}} </h2>
<div>
	{!!Form::model($inventory,['route'=>['inventory.update',$inventory->id],'method'=>'PATCH','id'=>'inventory-form'])!!}
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12" id="tel">
			<div class="form-group">
				{!!Form::label('product','Producto',['class'=>'control-label'])!!}
				{!!Form::text('product',null,['class'=>'form-control','placeholder'=>'Nombre del Producto'])!!}
			</div>
		</div>
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12" id="tel">
			<div class="form-group">
				{!!Form::label('measure','Medida',['class'=>'control-label'])!!}
				{!!Form::select('measure',['KILOS' => 'Kilos', "LITROS" => 'Litros',"UNIDADES" => 'Unidades'],null,['class'=>'form-control','placeholder'=>'Medida del producto (Kilos, Litros)'])!!}
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
				<a href="{{url('inventory')}}" class="btn btn-danger">Cancelar</a>
			</div>
		</div>
	{!!Form::close()!!}
</div>

{!! JsValidator::formRequest('App\Http\Requests\InventoryFormRequest','#inventory-form') !!}
@endsection