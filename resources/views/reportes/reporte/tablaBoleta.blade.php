<table class="table table-sm" id="datatable" style="width:100%">
    <thead class="table-dark">
        <tr class="fw-bold">
            <th>Materia</th>
            <th>E</th>
            <th>F</th>
            <th>M</th>
            <th>A</th>
            <th>R</th>
            <th>PT</th>
            <th>M</th>
            <th>J</th>
            <th>J</th>
            <th>R</th>
            <th>PT</th>
            <th>A</th>
            <th>S</th>
            <th>O</th>
            <th>R</th>
            <th>PT</th>
            <th>PF</th>
            <th>R</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($materias as $materia)
            <tr>
                <td>{{$materia->nombre}}</td>
                @foreach ($datas as $data)
                    @if ($data->idMateria == $materia->id)
                        <td>{{$data->sumaNotas}}</td>
                    @endif
                @endforeach
                
            </tr>
        @endforeach
    </tbody>
</table>
