<!DOCTYPE html>
<html lang="es">

@include('layouts.partials.auth-head')

<body class="be-splash-screen">
    <div class="be-wrapper be-login">
        @yield('content')
    </div>
    @include('layouts.partials.auth-script')
</body>

</html>
