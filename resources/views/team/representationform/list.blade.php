@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Representation Forms <a href="{{ url('team/representationform/edit') }}" class="btn btn-info">New</a> </div>

                    <div class="panel-body">
                        <table class="table table-bordered table-striped table-hovered">
                            <thead>
                            <tr>
                                <td>Classification</td>
                                <td>Description</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($representations as $representation)
                                <tr>
                                    <td>{{$representation->classification->description}}</td>
                                    <td><a href="{{ url("team/representationform/edit/{$representation->id}") }}">{{$representation->description}}</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$representations->render()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
