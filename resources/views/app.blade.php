@extends('base')

@section('content')

<nav class="py-2 bg-body-tertiary border-bottom">
    <div class="container d-flex flex-wrap">
        <ul class="nav me-auto">
            <li class="nav-item"><a href="{{route('home') }}" class="nav-link link-dark px-2 active" aria-current="page">Home</a></li>
            <li class="nav-item"><a href="{{ route('chat.index') }}" class="nav-link link-dark px-2">Messenger</a></li>
            <li class="nav-item"><a href="{{ route('contacts') }}" class="nav-link link-dark px-2">Contacts</a></li>
        </ul>
        <ul class="nav">
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-link link-dark px-2"> Logout</button>
                </form>
            </li>
        </ul>
    </div>
</nav>

@yield('main')


@endsection