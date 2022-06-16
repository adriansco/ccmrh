@extends('layouts.auth')

@section('title', 'Registro')

@section('content')
    <div class="be-content">
        <div class="main-content container-fluid">
            <div class="splash-container">
                <div class="card card-border-color card-border-color-primary">
                    <div class="card-header"><img class="logo-img" src="{{ asset('img/logo-xx.png') }}" alt="logo"
                            width="102" height="27"><span class="splash-description">Please enter your user
                            information.</span></div>
                    <div class="card-body">
                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name"></label>
                                <input class="form-control" id="name" name="name" type="text" placeholder="Nombre"
                                    autocomplete="off" value="{{ old('name') }}">
                                @error('name')
                                    *{{ $message }}
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email"></label>
                                <input class="form-control" id="email" name="email" type="email" placeholder="Email"
                                    autocomplete="off" value="{{ old('email') }}">
                                @error('email')
                                    *{{ $message }}
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password"></label>
                                <input class="form-control" id="password" name="password" type="password"
                                    placeholder="Contraseña">
                                @error('password')
                                    *{{ $message }}
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password"></label>
                                <input class="form-control" id="password-confirm" name="password_confirmation"
                                    type="password" placeholder="Confirma la contraseña">
                            </div>
                            <div class="form-group row login-tools">
                                <div class="col-12 login-forgot-password text-center">
                                    <a href="{{ route('login') }}">Si ya tienes una cuenta, inicia sesión</a>
                                </div>
                            </div>
                            <div class="form-group login-submit"><button class="btn btn-primary btn-xl" type="submit"
                                    data-dismiss="modal">Registrarme</button></div>
                        </form>
                    </div>
                </div>
                {{-- <div class="splash-footer"><span>Don't have an account? <a href="pages-sign-up.html">Sign
                            Up</a></span></div> --}}
            </div>
        </div>
    </div>
@endsection
