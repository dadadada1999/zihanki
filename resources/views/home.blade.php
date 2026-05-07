@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">

<div class="home">
    <div class="home__content">
        <div class="home__card">
            <div class="home__card-header">
                {{ __('Dashboard') }}
            </div>

            <div class="home__card-body">
                @if (session('status'))

                    <div class="home__alert">
                        {{ session('status') }}
                    </div>

                @endif

                {{ __('You are logged in!') }}
            </div>
        </div>
    </div>
</div>
@endsection