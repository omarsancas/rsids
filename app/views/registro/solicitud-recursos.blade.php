 @extends('layout')

 @section('content')

 <!-- Main jumbotron for a primary marketing message or call to action -->
    
<div class="container">
  <div class="row">
    <div class="col-md-6">

    <h1>  2</h1>
    <h1>  </h1>
    <h1>Solicitud de recursos </h1>

    {{ Form::open (['route' => 'registrar', 'method' => 'POST', 'role' => 'form', 'files' => true]) }}

<div class="form-group">
    {{ Form::label('nombre', 'Nombre')}}
    {{ Form::text('nombre', '', ['class' => 'form-control'])}}
</div>

<div class="form-group">
    {{ Form::label('apellidoPaterno', 'Apellido Paterno')}}
    {{ Form::text('apellidoPaterno', '', ['class' => 'form-control'])}}
</div>
    

<div class="form-group">
    {{ Form::label('apellidoMaterno', 'Apellido Materno')}}
    {{ Form::text('apellidoMaterno', '', ['class' => 'form-control'])}}
</div>


    
<div class="form-group">
    {{ Form::label('Sexo', 'Sexo')}}
    
</div>

  <label class="radio-inline control-label">

    <input type="radio" name="sexo" id="sexo" value="m" checked>
  Masculino
  </label>


  <label class="radio-inline control-label">
    <input type="radio" name="sexo" id="sexo" value="f">
    Femenino
  </label>

  <p></p>


  <div class="form-group">
    {{ Form::label('telefono', 'Teléfono')}}
    {{ Form::text('telefono', '', ['class' => 'form-control'])}}
</div>


 <div class="form-group">
    {{ Form::label('extension', 'Extensión')}}
    {{ Form::text('extension', '', ['class' => 'form-control'])}}
</div>


<div class="form-group">
    {{ Form::label('email', 'Email')}}
    {{ Form::email('email', '', ['class' => 'form-control'])}}
</div>





        <div class="form-group">
    {{ Form::label('dependencias', 'Dependencias')}}
    
    {{ Form::select('dependencias', $dependencias_catalogo) }}
    </div>


<div class="form-group">
    {{ Form::label('curriculum', 'Curriculum con produccion académica')}}
    
    {{Form::file('pdf1');}}

</div>








<div class="form-group">
    {{ Form::label('docdescript', 'Recursos solicitados')}}
    
</div>

<div class="row">

  <div class="col-xs-3">
  {{ Form::label('docdescript', 'Horas en CPU')}}
    {{ Form::text('horasCPU', '', ['class' => 'form-control'])}}
  </div>


  <div class="col-xs-3">
  {{ Form::label('docdescript', 'Disco en GB')}}
    {{ Form::text('disco', '', ['class' => 'form-control'])}}
  </div>
  <div class="col-xs-3">
  {{ Form::label('docdescript', 'Memoria en GB')}}
    {{ Form::text('memoria', '', ['class' => 'form-control'])}}
  </div>
</div>


<div class="row">
              {{ Form::label('permission-lbl', 'Aplicaciones') }}
                <div class="col-lg-4">
                  
                           @foreach ($aplicaciones as $key=>$aplicacion)
                            <input type="checkbox" name="aplicaciones[]" value="{{$key}}"> <label> {{$aplicacion}} </label>
                            @endforeach
            </div>
        </div>







    <p>
      

    </p>

    <p>
      <input type="submit" value="Registrar" class="btn btn-success">
    </p>
    
    {{ Form::close() }}

    </div>
  </div>        
</div>

    @endsection