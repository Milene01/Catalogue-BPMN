@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Conflict <a href="{{ url('team/conflict/edit') }}" class="btn btn-info">New</a> </div>

                    <div class="panel-body">
                        <table class="table table-bordered table-striped table-hovered">
                            <thead>
                            <tr>
                                <td>Description</td>
                                <td>Constructs Involved</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($conflicts as $conflict)
                                <tr>
                                    <td><a href="{{ url("team/conflict/edit/{$conflict->id}") }}">{{$conflict->description}}</a></td>
                                    <td>{{$conflict->constructs()->count()}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$conflicts->render()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
