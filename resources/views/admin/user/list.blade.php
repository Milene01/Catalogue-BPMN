@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Users</div>

                    <div class="panel-body">
                        <table class="table table-bordered table-striped table-hovered">
                            <thead>
                            <tr>
                                <td>Avatar</td>
                                <td>Name</td>
                                <td>E-mail</td>
                                <td>Affiliation</td>
                                <td>Personal URL</td>
                                <td>Provider</td>
                                <td>Rule</td>
                                <td>Created At</td>
                                <td>Last Update</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td><img src="{{ $user->avatar }}" class="img-circle img-icon"></td>
                                    <td><a href="{!! url("/admin/user/edit/{$user->id}")  !!}"> {{$user->name}}</a></td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->affiliation}}</td>
                                    <td>{{$user->personal_url}}</td>
                                    <td>{{$user->provider}}</td>
                                    <td>{{$user->rule}}</td>
                                    <td>{{$user->created_at}}</td>
                                    <td>{{$user->updated_at}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $users->render() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
