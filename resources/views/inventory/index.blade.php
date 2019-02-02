@extends('layouts.app')
@section('content')

<h2> Inventario
	<a href="inventory/create" class="btn btn-primary">Nuevo Producto</a>
	<a href="" class="btn btn-danger" data-target="#modal-search" data-toggle="modal">Busqueda Avanzada</a>
	@include('inventory.search')
</h2>

<div id="content">
	@section('data')

	@show
</div>

<script type="text/javascript">
	function render(){
		var url = "{{url('inventory')}}";
		var product = document.getElementById('product').value;
		var less = document.getElementById('less').value;
		var higher = document.getElementById('higher').value;
		var measure = document.getElementById('measure').value;
		var sucursal = document.getElementById('sucursal').value;
		$.ajax({
            type: 'GET',
            data: {"product": product, "less": less, "higher": higher, "measure": measure, "sucursal": sucursal, _token: '{{csrf_token()}}'},
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
	}

    function alta(id){
        var url = "{{url('inventory')}}"+"/"+id+"/alta"; //Ruta absoluta
        var quantity = document.getElementById("quantity-alta"+id);
        var quantity_table = document.getElementById("quantity-table-"+id);
        var total_alta = document.getElementById("total-alta"+id);
        var total_baja = document.getElementById("total-baja"+id);
        if(quantity.value < 0){
            alert("Ingrese un valor mayor a 0, valor ingresado: "+quantity.value);
        }
        else{
            $.ajax({
                type: "GET",
                url: url,
                data: {"quantity": quantity.value, _token: '{{csrf_token()}}'},
                dataType: 'json',
                success: function(result) {
                    quantity_table.innerHTML = result.inventory.quantity;
                    total_alta.innerHTML = result.inventory.quantity;
                    total_baja.innerHTML = result.inventory.quantity;
                    alert("Se ha dado de alta "+quantity.value+" "+result.inventory.measure+" exitosamente");
                    quantity.value = "";
                },
                error: function (xhr, thrownError) {
                    console.log('Algo salio mal'+xhr.responseText);
                } 
            });
        }
    }

    function baja(id){
        var url = "{{url('inventory')}}"+"/"+id+"/baja"; //Ruta absoluta
        var quantity = document.getElementById("quantity"+id);
        var quantity_table = document.getElementById("quantity-table-"+id);
        var total_alta = document.getElementById("total-alta"+id);
        var total_baja = document.getElementById("total-baja"+id);
        if(quantity.value < 0){
            alert("Ingrese un valor mayor a 0, valor ingresado: "+quantity.value);
        }
        else{
            $.ajax({
                type: "GET",
                url: url,
                data: {"quantity": quantity.value, _token: '{{csrf_token()}}'},
                dataType: 'json',
                success: function(result) {
                    quantity_table.innerHTML = result.inventory.quantity;
                    total_alta.innerHTML = result.inventory.quantity;
                    total_baja.innerHTML = result.inventory.quantity;
                    alert("Se ha dado de baja "+quantity.value+" "+result.inventory.measure+" exitosamente");
                    quantity.value = "";
                },
                error: function (xhr, thrownError) {
                    console.log('Algo salio mal'+xhr.responseText);
                } 
            });
        }
    }
</script>

@endsection