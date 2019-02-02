@extends('layouts.app')
@section('content')

<h2> Estadisticas: Clientes </h2>
<div>
	<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
		<div class="form-group">
			{!!Form::label('start','Fecha inicial',['class'=>'control-label'])!!}
			{!!Form::date('start',null,['class'=>'form-control','id'=>'start'])!!}
		</div>
	</div>
	<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
		<div class="form-group">
			{!!Form::label('final','Fecha final',['class'=>'control-label'])!!}
			{!!Form::date('final',null,['class'=>'form-control','id'=>'final'])!!}
		</div>
	</div>
	<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12" id="tel">
		<div class="form-group">
			{!!Form::label('idSucursal','Sucursal',['class'=>'control-label'])!!}
			{!!Form::select('idSucursal',$sucursals,null,['class'=>'form-control','placeholder'=>'Seleccione una Sucursal','id'=>'idSucursal'])!!}
		</div>
	</div>
	<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
		<div class="form-group">
			{!!Form::submit('Enviar',['class'=>'btn btn-primary','onclick'=>'render()'])!!}
		</div>
	</div>
</div>

<div id="principalPanel">
	@section('data')

	@show
</div>

<script type="text/javascript">
	function render(){
		var url = "{{url('graphic/search_customers')}}";//+"/"+str;
		var start = document.getElementById('start').value;
		var final = document.getElementById('final').value;
		var idSucursal = document.getElementById('idSucursal').value;
		console.log(start);
		console.log(final);
		console.log(idSucursal);
		$.ajax({
            type: 'POST',
            data: {"start": start, "final": final, "idSucursal": idSucursal, _token: '{{csrf_token()}}'},
            url: url,
            dataType: 'json',
            success: function (data) {
            	console.log(data);
                $('#principalPanel').empty().append($(data)); 
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
</script>

@endsection