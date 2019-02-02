<div class="modal fade" role="dialog" tabindex="-1" data-backdrop="false" id="modal-print-{{$order->id}}">
	{!! Form::open(['route'=>['http://localhost:8717/print_order', $order->id],'method'=>'POST']) !!}
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button class="close" type="button" data-dismiss="modal" aria-label="close">
						<span aria-hidden="true"></span>
					</button>
					<h4 class="modal-tiitle">Pedido: {{$order->id}} - {{$order->sucursal->name}} ? </h4>
				</div>
				<div class="modal-body">
					<p>Confirme si desea eliminar</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        			{!!Form::submit('Enviar',['class'=>'btn btn-primary'])!!}
				</div>
			</div>
		</div>
	{!! Form::close() !!}
</div>