<div class="modal fade" role="dialog" tabindex="-1" data-backdrop="false" id="modal-search">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" type="button" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true"></span>
				</button>
				<h4 class="modal-tiitle">Busqueda Avanzada</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<h5>Nombre del Producto</h5>
					{!!Form::text('product',null,['class'=>'form-control','placeholder'=>'Nombre del producto','id'=>'product'])!!}
				</div>
				<div class="form-group">
					<h5>Cantidad menor a:</h5>
					{!!Form::number('less',null,['class'=>'form-control','placeholder'=>'Cantidad del producto','id'=>'less'])!!}
				</div>
				<div class="form-group">
					<h5>Cantidad mayor a:</h5>
					{!!Form::number('higher',null,['class'=>'form-control','placeholder'=>'Cantidad del producto','id'=>'higher'])!!}
				</div>
				<div class="form-group">
					<h5>Medida del Producto</h5>
					{!!Form::select('measure',['KILOS' => 'Kilos', "LITROS" => 'Litros', "UNIDADES" => 'Unidades'],null,['class'=>'form-control','id'=>'measure','placeholder'=>'Seleccione una opcion'])!!}
				</div>
				<div class="form-group">
					<h5>Sucursal</h5>
					{!!Form::select('sucursal',$sucursals,null,['class'=>'form-control','id'=>'sucursal','placeholder'=>'Selecciona una sucursal'])!!}
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        		{!!Form::submit('Enviar',['class'=>'btn btn-primary','onclick'=>'render()'])!!}
			</div>
		</div>
	</div>
</div>