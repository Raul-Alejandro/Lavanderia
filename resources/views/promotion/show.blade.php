@extends('layouts.app')
@section('content')

<h2> Detalles Promocion : {{$promotion->name}} 
	<a href="{{URL::action('PromotionController@createRequirement',$promotion->id)}}" class="btn btn-primary btn">Nuevo Requerimiento</a>
</h2>
<a href="{{url('promotion')}}" class="btn btn-danger">Regresar</a>
<div class="row">
	<div class="col-lg-12 table-responsive">
		<table class="table table-striped table-hover table-sm">
			<thead>
				<tr>
					<th>ID</th>
					<th>CANTIDAD</th>
					<th>SERVICIO</th>
					<th>TIPO</th>
				</tr>
			</thead>
			<tbody>
				@foreach($promotion->requirements as $service)
					<tr>
						<td> {{$service->id}} </td>
						<td> {{$service->quantity}} </td>
						@if($service->idWashService)
							<td> {{$service->washService->name}} </td>
						@elseif($service->idIronService)
							<td> {{$service->ironService->name}} </td>
						@else 
							<td> {{$service->dryService->name}} </td>
						@endif
						@switch($service->type)
								@case(0)
									<td> REQUISITO </td>
									@break
								@case(1)	
									<td> GRATIS </td>
									@break
								@default
									<td> {{$service->type}}% de descuento </td>
							@endswitch	
						<td> 
							<a href="{{URL::action('PromotionController@editRequirement',[$promotion->id,$service->id])}}" class="btn btn-primary btn-sm">Editar</a>
						</td>
						@if(Auth::user()->type == 'SUPER')
						<td>
							<a href="" class="btn btn-danger btn-sm" data-target="#modal-delete-{{$service->id}}" data-toggle="modal">Delete</a>
						</td>
						@endif
					</tr>
					@include('promotion.modal')
				@endforeach
			</tbody>
		</table>
	</div>
</div>

@endsection