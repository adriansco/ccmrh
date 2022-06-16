<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Genero</th>
                <th>Status</th>
                <th>N° nómina</th>
                <th>Fecha contratación</th>
                <th>Departamento</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                <tr>
                    <td>{{ $employee->id }}</td>
                    <td>{{ $employee->first_name }}</td>
                    <td>{{ $employee->last_name }}</td>
                    <td>{{ $employee->gender }}</td>
                    <td>{{ $employee->status }}</td>
                    <td>{{ $employee->payroll }}</td>
                    <td>{{ $employee->hire_date }}</td>
                    <td>{{ $employee->dep_name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
