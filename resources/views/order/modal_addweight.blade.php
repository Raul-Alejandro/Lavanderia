<div class="modal fade" role="dialog" tabindex="-1" data-backdrop="false" id="modal-addweight-{{$wash_order->id}}">
	{!! Form::open(['route'=>['edit-weight', $wash_order->id],'method'=>'PATCH','id'=>'form']) !!}
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button class="close" type="button" data-dismiss="modal" aria-label="close">
						<span aria-hidden="true"></span>
					</button>
					<h4 class="modal-tiitle">Editar peso a {{$wash_order->service}} de la Orden {{$wash_order->idOrder}} ? </h4>
				</div>
				<div class="modal-body" align="left">
					<div class="form-group">
					{!!Form::label('weight','Peso',['class'=>'control-label'])!!}
						{!!Form::number("weight",null,['class'=>'form-control','placeholder'=>'Peso','id'=>"input-weight", 'step'=>'any', 'required'])!!}
					</div>
					<button class="btn btn-outline-primary" id="button-weight">Valor de la bascula</button>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        			{!!Form::submit('Enviar',['class'=>'btn btn-danger'])!!}
				</div>
			</div>
		</div>
	{!! Form::close() !!}
</div>