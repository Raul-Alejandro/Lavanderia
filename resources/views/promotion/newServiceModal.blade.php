<div class="modal fade" role="dialog" tabindex="-1" data-backdrop="false" id="modal-add-{{$promotion->id}}">
	{!! Form::open(['route'=>['requirement.create',$promotion->id],'method'=>'POST','id'=>'requirement-form']) !!}
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button class="close" type="button" data-dismiss="modal" aria-label="close">
						<span aria-hidden="true"></span>
					</button>
					<h4 class="modal-tiitle">Agregar contenido: {{$promotion->name}} ? </h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						{!!Form::label('pay','Pagar completo o parcialmente el servicio',['class'=>'control-label'])!!}
						{!!Form::number("pay",null,['class'=>'form-control','placeholder'=>'Dinero Recibido','id'=>"pay"])!!}
					</div>
					<div class="form-group">
						{!!Form::label('lavado','Servicios de Lavado',['class'=>'control-label'])!!}
					</div>
					<div id="{{$promotion->id}}wash_ord">
							
					</div>
					<div class="form-group">
						<input type="button" id="add_wash{{$promotion->id}}" value="Agregar Servicio de Lavado" class="btn btn-primary" onclick="add({{$wash_services}},'wash',{{$promotion->id}})">
						<input type="button" id="del_wash{{$promotion->id}}" value="Eliminar Ultimo" class="btn btn-danger" disabled onClick="del('wash',{{$promotion->id}})">
					</div>
					<div class="form-group">
						{!!Form::label('planchado','Servicios de Planchado',['class'=>'control-label'])!!}
					</div>
					<div id="{{$promotion->id}}iron_ord">
						
					</div>
					<div class="form-group">
						<input type="button" id="add_iron{{$promotion->id}}" value="Agregar Servicio de Planchado" class="btn btn-primary" onclick="add({{$iron_services}},'iron',{{$promotion->id}})">
							<input type="button" id="del_iron{{$promotion->id}}" value="Eliminar Ultimo" class="btn btn-danger" disabled onClick="del('iron',{{$promotion->id}})">
				</div>
					<div class="form-group">
						{!!Form::label('tintoreria','Servicios de Tintoreria',['class'=>'control-label'])!!}
					</div>
					<div id="{{$promotion->id}}dry_ord">
						
					</div>
					<div class="form-group">
						<input type="button" id="add_dry{{$promotion->id}}" value="Agregar Servicio de Tintoreria" class="btn btn-primary" onclick="add({{$dry_services}},'dry',{{$promotion->id}})">
						<input type="button" id="del_dry{{$promotion->id}}" value="Eliminar Ultimo" class="btn btn-danger" disabled onClick="del('dry',{{$promotion->id}})">
					</div>
					{!!Form::submit('Enviar',['class'=>'btn btn-primary'])!!}
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        			{!!Form::submit('Enviar',['class'=>'btn btn-primary'])!!}
				</div>
			</div>
		</div>
	{!! Form::close() !!}

</div>