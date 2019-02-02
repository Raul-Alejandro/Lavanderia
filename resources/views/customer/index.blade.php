@extends('layouts.app')
@section('content')

<h2> Clientes
	@if(Auth::user()->type == 'SUPER')
	<a href="customer/create" class="btn btn-primary">Nuevo Cliente</a>
	@endif
	<a href="" class="btn btn-danger" data-target="#modal-search" data-toggle="modal">Busqueda Avanzada</a>
	@include('customer.search')
</h2>

<div id="content">
	@section('data')

	@show
</div>

<script type="text/javascript">
	function render(){
		var url = "{{url('customer')}}";
		var start = document.getElementById('start').value;
		var final = document.getElementById('final').value;
		var idSucursal = document.getElementById('idSucursal').value;
		$.ajax({
            type: 'GET',
            data: {"start": start, "final": final, "idSucursal": idSucursal, _token: '{{csrf_token()}}'},
            url: url,
            dataType: 'json',
            success: function (data) {
                $('#content').empty().append($(data)); 
            },
            error: function (data) {
                var errors = data.responseJSON;
                if (errors) {
                    $.each(errors, function (i) {
                        console.log(errors[i]);
                    });
                }
            }
        });
	}

	/*$(".pagination a").on("click",function(e){
		e.preventDefault();
		console.log('prueba');
		var url = "{{url('customer')}}";
		var page = $(this).attr('href').split('page=')[1];

		$.ajax({
            type: 'GET',
            data: {"page": page, _token: '{{csrf_token()}}'},
            url: url,
            dataType: 'json',
            success: function (data) {
            	console.log(data);
                $('#content').empty().append($(data)); 
            },
            error: function (data) {
                var errors = data.responseJSON;
                if (errors) {
                    $.each(errors, function (i) {
                        console.log(errors[i]);
                    });
                }
            }
        });
	});*/

    /*function test(){
        var pedidos = [];
        pedidos.push({"id": 959,"customer": "Patricia","phone": "84412346","delivery_date": "2019-01-07 8:00pm","delivered": null,"status": "UNPAID","charge": null,"payment_type": "TARJETA","total": 231,"balance": 75,"user": "Empleado Dos","sucursal": "Sucursal Dos","created_at": "2019-01-10 11:25:53","updated_at": "2019-01-21 15:37:26"});
        pedidos.push({"id": 102,"customer": "Mario","phone": "84412346","delivery_date": "2019-01-07 8:00pm","delivered": null,"status": "UNPAID","charge": null,"payment_type": "TARJETA","total": 231,"balance": 75,"user": "Empleado Dos","sucursal": "Sucursal Uno","created_at": "2019-01-10 11:25:53","updated_at": "2019-01-21 15:37:26"});
        pedidos.push({"id": 55,"customer": "Roberto","phone": "84412346","delivery_date": "2019-01-07 8:00pm","delivered": null,"status": "UNPAID","charge": null,"payment_type": "TARJETA","total": 231,"balance": 75,"user": "Empleado Dos","sucursal": "Sucursal Tres","created_at": "2019-01-10 11:25:53","updated_at": "2019-01-21 15:37:26"});
        pedidos.push({"id": 111,"customer": "Eva","phone": "84412346","delivery_date": "2019-01-07 8:00pm","delivered": null,"status": "UNPAID","charge": null,"payment_type": "TARJETA","total": 231,"balance": 75,"user": "Empleado Dos","sucursal": "Sucursal Dos","created_at": "2019-01-10 11:25:53","updated_at": "2019-01-21 15:37:26"});
        console.log(pedidos);
        console.log(pedidos[2].sucursal);

        //var grouped = _.mapValues(_.groupBy(pedidos, 'sucursal'),
        //                  clist => clist.map(pedido => _.omit(pedido, 'sucursal')));
        //var grouped = _.groupBy(pedidos, function(pedido) {
        //  return pedido.sucursal;
        //});

        //var result = pedidos.map(function(pedido){
        //    return pedido.sucursal;
        //});

        var result2 = pedidos.reduce(function(sucursals, pedido){
            sucursals.sucursal[pedido.customer] = pedido.id;
            return sucursals;
        });

        //console.log(result);
        console.log(result2);
    }

    $(document).ready(function(){
        test();
    });*/
</script>

@endsection