@extends('layouts.auth')

@section('title', 'Actualizar Contraseña')

@section('content')
    <div class="be-wrapper be-login">
        <div class="be-content">
            <div class="main-content container-fluid">
                <div class="splash-container forgot-password">
                    <div class="card card-border-color card-border-color-primary">
                        <div class="card-header"><img class="logo-img" src="{{ asset('img/logo-xx.png') }}"
                                alt="logo" width="102" height="#{conf.logoHeight}"><span
                                class="splash-description">Restablece tu contraseña</span></div>
                        <div class="card-body">
                            <form action="{{ route('password.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                                <p class="text-center">Introduce tu nueva contraseña.</p>
                                <div class="form-group pt-4">
                                    {{-- required="" --}}
                                    <label for="email"></label>
                                    <input class="form-control" type="email" id="email" name="email" autocomplete="off"
                                        value="{{ $request->email }}" disabled>
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
                                        type="password" placeholder="Confirmar contraseña">
                                </div>
                                {{-- <p class="pt-1 pb-4">¿No recuerdas tu email? <a href="#">Contact Support</a>.</p> --}}
                                <div class="form-group pt-1"><input name="reset" id="reset"
                                        class="btn btn-block btn-primary btn-xl" type="submit" value="Actualizar"></div>
                            </form>
                        </div>
                    </div>
                    <div class="splash-footer">&copy; 2021 EAsuarez</div>
                </div>
            </div>
        </div>
    </div>
@endsection
