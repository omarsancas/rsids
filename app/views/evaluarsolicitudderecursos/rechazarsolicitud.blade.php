@extends('layout')

@section('content')
<div class="container">

<div class="panel panel-default">
<div class="panel-heading">This Page is Disabled</div>
<div class="panel-body">
<div class="col-md-6">


<h1></h1>

<h1>Rechazar Solicitud de recursos</h1>
{{ Form::open (['route' => 'rechazarsolicitud', 'method' => 'POST','class' => 'form-horizontal', 'role' =>'form', 'files' =>true]) }}
<input type="hidden" name="id" value="{{ $solicitudabstracta->SOAB_ID_SOLICITUD_ABSTRACTA }}">

<fieldset>
    <legend>Descripcion de rechazo de solicitud de recursos</legend>

    <div class="form-group">
        <textarea class="form-control" name="descrechazo"  id="descrechazo" rows="3"></textarea>
    </div>



    <div class="form-group">
        <p>
            <input type="submit" value="Aceptar" class="btn btn-success btn-lg">
        </p>

        <a href="{{ URL::to('evaluarsolicitudderecursos/evaluarsolicitud') }}" class="btn btn-danger">Cancelar</a>
    </div>
    {{ Form::close() }}

</div>
</div>
</div>
</div>


@endsection