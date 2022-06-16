@extends('layouts.auth')

@section('title', 'Verificar Email')

@section('content')
    <div class="be-content">
        <div class="main-content container-fluid">
            <div class="splash-container">
                <div class="card card-border-color card-border-color-primary">
                    <div class="card-header"><img class="logo-img" src="{{ asset('img/logo-xx.png') }}" alt="logo"
                            width="102" height="27"><span class="splash-description">Confirma tu dirección de
                                correo electrónico.</span></div>
                    <div class="card-body">
                        <div class="alert alert-info alert-dismissible" role="alert">
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span
                                    class="mdi mdi-close" aria-hidden="true"></span></button>
                            <div class="icon"><span class="lar la-envelope"></span></div>
                            <div class="message"><strong>Para continuar,</strong> debe confirmar su dirección de
                                correo electrónico, compruebe la bandeja de entrada o spam.</div>
                        </div>
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span
                                        class="mdi mdi-close" aria-hidden="true"></span></button>
                                <div class="icon"><span class="mdi mdi-check"></span></div>
                                <div class="message"> {{ session('status') }} </div>
                            </div>
                        @endif
                        <form action="{{ route('verification.send') }}" method="POST">
                            @csrf
                            <div class="form-group login-submit">
                                <input class="btn btn-primary btn-xl" type="submit" name="login" id="login" type="text"
                                    value="Reenviar">
                            </div>
                        </form>
                    </div>
                </div>
                {{-- <div class="splash-footer"><span>Don't have an account? <a href="{{ route('register') }}">Sign
                            Up</a></span></div> --}}
            </div>
        </div>
    </div>
@endsection
