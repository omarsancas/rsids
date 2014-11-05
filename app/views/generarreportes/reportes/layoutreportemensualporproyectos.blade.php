<!DOCTYPE html>
<html>
<head>
    <title>Title of the document</title>
</head>

<body>

    <table>
        <thead>
        <tr>

            <th>Número de proyecto</th>
            <th>Nombre del proyecto</th>
            <th>Número de trabajos</th>
            <th>Número de horas nodo</th>
            <th>Saldo de horas</th>
            <th>Porcentaje de uso</th>


        </tr>
        </thead>
        <tbody>

        @foreach ($reportesproyectos as $reportesproyecto)
        <tr>
            <td> {{$reportesproyecto->proy_id_proyecto}}</td>
            <td> {{$reportesproyecto->proy_nombre}}</td>
            <td> {{$reportesproyecto->totaljobs}}</td>
            <td> {{$reportesproyecto->totalnodo}}</td>
            <td>  {{ $reportesproyecto->proy_hrs_aprobadas - $reportesproyecto->totalnodo}}</td>
            <td>  {{$reportesproyecto->porcentajeproyecto }}%</td>


        </tr>
        @endforeach


        </tbody>
    </table>


</body>

</html>



