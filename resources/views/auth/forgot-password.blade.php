@extends('layouts.auth')

@section('title', 'Contraseña olvidada')

@section('content')
    <div class="be-wrapper be-login">
        <div class="be-content">
            <div class="main-content container-fluid">
                <div class="splash-container forgot-password">
                    <div class="card card-border-color card-border-color-primary">
                        <div class="card-header"><img class="logo-img" src="{{ asset('img/logo-xx.png') }}"
                                alt="logo" width="102" height="#{conf.logoHeight}"><span
                                class="splash-description">¿Olvidaste tu contraseña?</span></div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <button class="close" type="button" data-dismiss="alert"
                                        aria-label="Close"><span class="mdi mdi-close" aria-hidden="true"></span></button>
                                    <div class="icon"><span class="mdi mdi-check"></span></div>
                                    <div class="message"> {{ session('status') }} </div>
                                </div>
                            @endif
                            <form action="{{ route('password.request') }}" method="POST">
                                @csrf
                                <p>No te preocupes, te enviaremos un correo electrónico para restablecer tu contraseña.</p>
                                <div class="form-group pt-4">
                                    {{-- required="" --}}
                                    <label for="email"></label>
                                    <input class="form-control" type="email" id="email" name="email"
                                        placeholder="Tu email" autocomplete="off">
                                    @error('email')
                                        *{{ $message }}
                                    @enderror
                                </div>
                                <p class="pt-1 pb-4">¿No recuerdas tu email? <a href="#">Contact Support</a>.</p>
                                <div class="form-group pt-1"><input name="reset" id="reset"
                                        class="btn btn-block btn-primary btn-xl" type="submit" value="Restablecer contraseña"></div>
                            </form>
                        </div>
                    </div>
                    <div class="splash-footer">&copy; 2021 EAsuarez</div>
                </div>
            </div>
        </div>
    </div>
@endsection
