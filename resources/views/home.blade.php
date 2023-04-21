@extends('app')

@section('main')
<div class="container mt-3">
    <div class="card text-center">
        <div class="card-header">
            Profile Page
        </div>
        <div class="card-body">

            <img src="{{ asset('img/2.jpg') }}" class="rounded-circle w-25 mx-auto d-block" alt="...">

            <h3 class="h3">{{ Auth::user()->name }}</h3>
            <p>{{ Auth::user()->email }}</p>

            <a href="{{ route('profile.edit',Auth::user()->id) }}" class="btn btn-primary mt-4">Edit Profile</a>
        </div>

    </div>
</div>
<!--/row-->
@endsection