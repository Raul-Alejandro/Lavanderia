<div class="modal fade" role="dialog" tabindex="-1" data-backdrop="false" id="modal-pay-{{$order->id}}">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" type="button" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true"></span>
				</button>
				<h4 class="modal-tiitle">Pagar Pedido: {{$order->customer}} - {{$order->sucursal}} ? </h4>
			</div>
			<div class="modal-body">
				<h4> 
					<label style="font-size:20px;"> Total del Pedido: ${{$order->total}} </label>
					<label style="font-size:20px;"> Cargo Aplicado: $</label> 
					<label style="font-size:20px;" id='charge-label{{$order->id}}'>{{$order->charge}} </label>
				</h4>
				<h4>
					<label style="font-size:20px;"> Total: $</label> 
					<label style="font-size:20px;" id='total{{$order->id}}'>{{$order->balance}}</label> 
				</h4>
				<div class="form-group">
					{!!Form::label('pay','Pagar completo o parcialmente el servicio',['class'=>'control-label'])!!}
					{!!Form::number("pay$order->id",null,['class'=>'form-control','placeholder'=>'Dinero Recibido','id'=>"pay$order->id",'min'=>0])!!}
				</div>
				<div class="form-group">
					<input type="button" id="pay_button" value="Efectuar Pago" class="btn btn-outline-primary" onClick='payProcess({{$order->id}})'>
					<label style="font-size:20px;" id='pay-text{{$order->id}}'> </label> <label id='swap{{$order->id}}' style="font-size:20px;">  </label>
				</div>
				<div class="form-group">
					{!!Form::label('status','Status',['class'=>'control-label'])!!}
					{!!Form::text("status$order->id",'UNPAID',['class'=>'form-control','readonly','id'=>"status$order->id"])!!}
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button class="btn btn-primary" onclick="pay({{$order->id}})">Enviar</button> 
			</div>
		</div>
	</div>
</div>
