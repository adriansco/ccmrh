@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="be-content">
        <div class="main-content container-fluid">
            <div class="splash-container">
                <div class="card card-border-color card-border-color-primary">
                    <div class="card-header"><img class="logo-img" src="{{ asset('img/logo-xx.png') }}" alt="logo"
                            width="102" height="27"><span class="splash-description">Por favor, introduzca su información de
                            usuario.</span></div>
                    <div class="card-body">
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            {{-- <div class="form-group">
                                <label for="email"></label>
                                <input class="form-control" type="email" id="email" name="email" type="text"
                                    placeholder="Email" autocomplete="off" value="{{ old('email') }}">
                                @error('email')
                                    *{{ $message }}
                                @enderror
                            </div> --}}
                            <div class="form-group">
                                <label for="username"></label>
                                <input class="form-control" type="text" id="username" name="username" type="text"
                                    placeholder="Usuario" autocomplete="off" value="{{ old('username') }}">
                                @error('username')
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
                            <div class="form-group row login-tools">
                                {{-- <div class="col-6 login-remember">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="checkbox1">
                                        <label class="custom-control-label" for="checkbox1">Remember Me</label>
                                    </div>
                                </div> --}}
                                <div class="col-12 login-forgot-password text-center"><a
                                        href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a></div>
                            </div>
                            <div class="form-group login-submit"><button class="btn btn-primary btn-xl" type="submit"
                                    data-dismiss="modal">Ingresar</button></div>
                        </form>
                    </div>
                </div>
                <div class="splash-footer"><span>¿No tienes una cuenta? <a
                            href="{{ route('register') }}">Registrarse</a></span></div>
            </div>
        </div>
    </div>
@endsection
