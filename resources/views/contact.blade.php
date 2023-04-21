@extends('app')

@section('main')
<div class="container mt-3">
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <tr class="bg-primary">
                    <th>SN</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                @php $sn=1 @endphp
                @foreach($users as $user)
                <tr>
                    <td>{{ $sn++ }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ route('chat.index',$user->id) }}" class="btn btn-primary"> <i class="fa-regular fa-paper-plane"></i> Send Message</a>
                        <a href="{{ route('contact.delete',$user->id) }}" class="btn btn-danger"> <i class="fa-regular fa-trash-can"></i> Delete</a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection