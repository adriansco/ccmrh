@extends('layouts.plantilla')

@section('title', '404')

@section('page-title', '404')

@section('content')
    <div class="be-wrapper be-error be-error-404">
        <div class="be-content">
            <div class="main-content container-fluid">
                <div class="error-container">
                    <div class="error-number">404</div>
                    <div class="error-description">The page you are looking for might have been removed.</div>
                    <div class="error-goback-text">Would you like to go home?</div>
                    <div class="error-goback-button"><a class="btn btn-xl btn-primary" href="/">Let's go home</a>
                    </div>
                    <div class="footer">&copy; 2021 EASuarez</div>
                </div>
            </div>
        </div>
    </div>
@endsection
