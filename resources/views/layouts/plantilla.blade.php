<!DOCTYPE html>
<html lang="es">
@include('layouts.partials.head')

<body>
    {{-- be-collapsible-sidebar --}}
    <div class="be-wrapper be-fixed-sidebar">
        @include('layouts.partials.nav-top')
        @include('layouts.partials.sidebar')
        <div class="be-content">
            @yield('breadcrumbs')
            <div class="main-content container-fluid">
                @yield('content')
            </div>
        </div>
        {{-- @include('layouts.partials.nav') --}}
    </div>
    <script src="{{ asset('lib/jquery/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('lib/perfect-scrollbar/js/perfect-scrollbar.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('lib/bootstrap/dist/js/bootstrap.bundle.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    {{-- <script src="{{ asset('lib/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script> --}}
    @yield('scriptzone')
    <script type="text/javascript">
        $(document).ready(function() {
            //-initialize the javascript
            App.init();
            @yield('appzone')
        });
    </script>
</body>
</html>
