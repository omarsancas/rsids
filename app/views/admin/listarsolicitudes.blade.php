<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link href="{{ asset ('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
<script src="{{asset ('bootstrap/js/bootstrap.min.js')}}"></script>

    <table class="table table-striped table-bordered table-condensed">
        <thead>
        <tr>

            <th class="col-lg-1" style="text-align: center;"><input type="checkbox" class="check-all"></th>
            <th class="col-lg-1 hidden-xs" style="text-align: center;">Id</th>
            <th class="col-lg-1">ID </th>
            <th class="col-lg-2 visible-lg visible-xs">Nombre</th>
            <th class="col-lg-2 hidden-xs">Apellido Paterno</th>
            <th class="col-lg-2 hidden-xs">Apellido Materno</th>
            <th class="col-lg-1 visible-lg">Depedencia</th>
            <th class="col-lg-1 visible-lg">nombre de proyecto</th>
            <th class="col-lg-1 hidden-xs">descripcion proyecto</th>
            <th class="col-lg-1 hidden-xs">prog paralela</th>

            <th class="col-lg-1" style="text-align: center;">duracion</th>

        </tr>
        </thead>
        <tbody>
        @foreach ($solicitudes2 as $solicitud)
        <tr>


            <td class="hidden-xs" style="text-align: center;">{{ $solicitud->SOAB_ID_SOLICITUD_ABSTRACTA }}</td>
            <td >&nbsp;{{ $solicitud->SOAB_ID_SOLICITUD_ABSTRACTA }}</td>
            <td class="visible-xs visible-lg">&nbsp;{{ $solicitud->SOAB_ID_SOLICITUD_ABSTRACTA }}</td>
            <td class="hidden-xs">
                {{$solicitud->SOAB_ID_SOLICITUD_ABSTRACTA}}
            </td>
            <td class="hidden-xs">{{$solicitud->SOAB_ID_SOLICITUD_ABSTRACTA}}</td>
            <td class="visible-lg">&nbsp;{{$solicitud->SOAB_ID_SOLICITUD_ABSTRACTA}}</td>
            <td class="visible-lg">&nbsp;{{$solicitud->SOAB_ID_SOLICITUD_ABSTRACTA}}</td>
            <td class="hidden-xs">{{$solicitud->SOAB_ID_SOLICITUD_ABSTRACTA}}</td>

            <td class="hidden-xs">{{$solicitud->SOAB_ID_SOLICITUD_ABSTRACTA}}</td>
            <td style="text-align: center;">&nbsp;<a href="{{$solicitud->SOAB_CURRICULUM}}">{{$solicitud->SOAB_CURRICULUM}}</a></td>

        </tr>
        @endforeach
        </tbody>
    </table>


