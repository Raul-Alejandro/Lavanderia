@extends('graphic.searchCustomer')
@section('data')


<div class="row">
	<div class="col-lg-12 table-responsive">
		<table class="table table-striped table-hover table-sm">
			<thead class="table-dark">
				<tr align="center">
					<th>ID</th>
					<th>NOMBRE</th>
					<th>TELEFONO</th>
				</tr>
			</thead>
			<tbody>
				@foreach($customers as $customer)
					<tr align="center">
						<td> {{$customer->id}} </td>
						<td> {{$customer->name}} </td>
						<td> {{$customer->phone}} </td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection

