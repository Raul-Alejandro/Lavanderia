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
					<h5>Codigo del Pedido</h5>
					{!!Form::text('order',null,['class'=>'form-control','placeholder'=>'Numero de Orden','id'=>'search','autocomplete'=>'off'])!!}
				</div>
				<div class="form-group">
					<h5>Nombre del Cliente</h5>
					{!!Form::text('customer',null,['class'=>'form-control','placeholder'=>'Nombre del cliente','id'=>'customer','autocomplete'=>'off'])!!}
				</div>
				<div class="form-group">
					<h5>Fecha inicial</h5>
					{!!Form::date('start',null,['class'=>'form-control','id'=>'start'])!!}
				</div>
				<div class="form-group">
					<h5>Fecha final</h5>
					{!!Form::date('final',null,['class'=>'form-control','id'=>'final'])!!}
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