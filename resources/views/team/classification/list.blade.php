@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Classification <a href="{{ url('team/classification/edit') }}" class="btn btn-info">New</a> </div>

                    <div class="panel-body">
                        <table class="table table-bordered table-striped table-hovered">
                            <thead>
                            <tr>
                                <td>Description</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($classifications as $classification)
                                <tr>
                                    <td><a href="{{ url("team/classification/edit/{$classification->id}") }}">{{$classification->description}}</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$classifications->render()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
