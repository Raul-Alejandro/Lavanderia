@extends('layouts.app')
@section('content')

<h2> Promociones
	<a href="requirement/create" class="btn btn-primary">Nuevo Requerimiento</a>
</h2>
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
				@foreach($services as $service)
					<tr>
						<td> {{$service->id}} </td>
						<td> {{$service->quantity}} </td>
						<td> {{$service->name}} </td>
						<td> {{$service->type}} </td>
						<td> 
							<a href="{{URL::action('PromotionController@edit',$promotion->id)}}" class="btn btn-primary btn-sm">Editar</a>
						</td>
						<td>
							<a href="" class="btn btn-danger btn-sm" data-target="#modal-delete-{{$promotion->id}}" data-toggle="modal">Delete</a>
						</td>
					</tr>
					@include('promotion.modal')
				@endforeach
			</tbody>
		</table>
	</div>
</div>

@endsection