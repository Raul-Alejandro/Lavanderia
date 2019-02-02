<div class="modal fade" role="dialog" tabindex="-1" data-backdrop="false" id="modal-alta-{{$inventory->id}}">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" type="button" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true"></span>
				</button>
				<h4 class="modal-tiitle">Producto: {{$inventory->product}} - {{$inventory->sucursal}}</h4>
			</div>
			<div class="modal-body">
				<h2>
					<label style="font-size:20px;"> Total: </label> 
					<label style="font-size:20px;" id='total-alta{{$inventory->id}}'>{{$inventory->quantity}}</label> 
				</h2>
				<div class="form-group">
					{!!Form::label('quantity','Cantidad a dar de alta',['class'=>'control-label'])!!}
					{!!Form::number("quantity$inventory->id",null,['class'=>'form-control','min'=>1,'id'=>"quantity-alta$inventory->id"])!!}
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        		<button class="btn btn-primary" onclick="alta({{$inventory->id}})">Enviar</button>
			</div>
		</div>
	</div>
</div>