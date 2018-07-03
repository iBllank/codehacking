@extends('layouts.admin')


@section('content')

    @if(Session::has('deleted_user'))

        <h3 class="bg-danger">{{session('deleted_user')}}</h3>

        @endif

    @if(Session::has('updated_user'))

        <h3 class="bg-info">{{session('updated_user')}}</h3>

    @endif

    @if(Session::has('created_user'))

        <h3 class="bg-info">{{session('created_user')}}</h3>

    @endif


    <h1>Users</h1>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Avatar</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Created</th>
        </tr>
        </thead>
        <tbody>
        @if($users)
        @foreach($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td><img height="60" src="{{$user->photo ? $user->photo->file : 'http://placehold.it/400x400' }}" class="img-circle" alt=""></td>
            <td><a href="{{route('admin.users.edit', $user->id)}}">{{$user->name}}</a></td>
            <td>{{$user->email}}</td>
            <td>{{$user->role ? $user->role->name : 'User Have no role' }}</td>
            <td>{{$user->is_active == 1 ? 'Active' : 'Not Active'}}</td>
            <td>{{$user->created_at->diffForHumans()}}</td>
        </tr>
        @endforeach
        @endif
        </tbody>
    </table>




@stop