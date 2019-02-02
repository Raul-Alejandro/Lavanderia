<div class="modal fade" role="dialog" tabindex="-1" data-backdrop="false" id="modal-charge-{{$order->id}}">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" type="button" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true"></span>
				</button>
				<h4 class="modal-tiitle">Aplicar Cargo al Pedido: {{$order->customer}} - {{$order->sucursal}} ? </h4>
			</div>
			<div class="modal-body">
				<div class="form-group" id="form-{{$order->id}}">
					{!!Form::label('charge','Cargo al Pedido',['class'=>'control-label'])!!}
					{!!Form::number("charge$order->id",null,['class'=>'form-control','placeholder'=>'Cantidad','id'=>"input-$order->id",'min'=>0])!!}
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button class="btn btn-primary" onclick="charge({{$order->id}})">Enviar</button> 
			</div>
		</div>
	</div>
</div>
