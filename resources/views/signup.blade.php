@extends('base')

@section('content')

<div class="container mt-3">
    <div class="col-md-6 mx-auto d-block">
        <div class="card">
            <div class="card-body">
                <h1 class="h1 text-center">Sign Up Page</h1>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                {{ Form::open(['route'=>'register']) }}
                @include('profile_form',['buttonText'=>' Register'])
                {{ Form::close() }}
            </div>
        </div>.
    </div>
</div>
@endsection