<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Resgitro de nuevo usuario</title>
</head>

<body>
    <h1>Registro de nuevo usuario</h1>
    <p>El usuario {{ auth()->user()->name }} realizo el siguiente registro:</p>
    <p>Nombre: {{ $user->name }} </p>
    <p>Email: {{ $user->email }} </p>
    <p>Fecha de cración: {{ $user->created_at }} </p>
    <p>Roles:</p>
    @foreach ($user->roles as $item)
        <p>{{ $item->name }}</p>
    @endforeach
</body>

</html>
