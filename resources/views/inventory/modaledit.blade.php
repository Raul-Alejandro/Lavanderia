<div class="modal fade" role="dialog" tabindex="-1" data-backdrop="false" id="modal-edit-{{$inventory->id}}-{{$sucursals}}">
	{!!Form::model($inventory,['route'=>['inventory.update',$inventory->id],'method'=>'PATCH','id'=>'inventory-form'])!!}
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button class="close" type="button" data-dismiss="modal" aria-label="close">
						<span aria-hidden="true"></span>
					</button>
					<h4 class="modal-tiitle">Editar: {{$inventory->product}} ? </h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						{!!Form::label('product','Producto',['class'=>'control-label'])!!}
						{!!Form::text('product',null,['class'=>'form-control','placeholder'=>'Nombre del Producto'])!!}
					</div>
					<div class="form-group">
						{!!Form::label('measure','Medida',['class'=>'control-label'])!!}
						{!!Form::select('measure',['KILOS' => 'Kilos', "LITROS" => 'Litros'],null,['class'=>'form-control','placeholder'=>'Medida del producto (Kilos, Litros)'])!!}
					</div>	
					<div class="form-group">
						{!!Form::label('quantity','Cantidad',['class'=>'control-label'])!!}
						{!!Form::text('quantity',null,['class'=>'form-control','placeholder'=>'Cantidad del producto'])!!}
					</div>
					<div class="form-group">
						{!!Form::label('idSucursal','Sucursal',['class'=>'control-label'])!!}
						{!!Form::select('idSucursal',$sucursals,null,['class'=>'form-control','placeholder'=>'Seleccione una Sucursal'])!!}
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        			{!!Form::submit('Enviar',['class'=>'btn btn-primary'])!!}
				</div>
			</div>
		</div>
	{!! Form::close() !!}
{!! JsValidator::formRequest('App\Http\Requests\InventoryFormRequest','#inventory-form') !!}
</div>

