@extends('app')

@section('main')
<div class="container mt-3">
    <div class="col-md-6 mx-auto d-block">
        <div class="card">
            <div class="card-body">
                <h1 class="text-center h1"> Update Profile</h1>
                {{ Form::model($user,['route'=>['profile.update',$user->id]]) }}
                @include('profile_form',['buttonText'=>' Update'])
                {{ Form::close() }}
            </div>
        </div>.
    </div>
</div>
@endsection