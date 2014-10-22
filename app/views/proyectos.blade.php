
<table class="table table-bordered table-hover table-striped">
    <thead>
    <tr>

        <th>Número de la solicitud</th>
        <th>Nombre Completo del proyecto</th>
        <th>Nombre del titular del proyecto</th>
        <th>Tipo de solicitud</th>
        <th>Accion</th>


    </tr>
    </thead>
    <tbody>
    @foreach ($proyectos as $proyecto)
    <tr>

        <td class="visible-xs visible-lg"> </td>
        <td> {{$proyecto->proy_id_proyecto}}</td>
        <td> {{$proyecto->totaljobs}}</td>
        <td>{{$proyecto->totalcpu}} </td>
        <td>

        </td>


    </tr>
    @endforeach
    </tbody>
</table>