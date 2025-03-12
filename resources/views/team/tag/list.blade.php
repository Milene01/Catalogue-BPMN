@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Tags <a href="{{ url('team/tag/edit') }}" class="btn btn-info">New</a> </div>

                    <div class="panel-body">
                        <table class="table table-bordered table-striped table-hovered">
                            <thead>
                            <tr>
                                <td>Name</td>
                                <td>Description</td>
                                <td>Category</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tags as $tag)
                                <tr>
                                    <td><a href="{{ url("team/tag/edit/{$tag->id}") }}">{{$tag->name}}</a></td>
                                    <td>{{$tag->description}}</td>
                                    <td>{{$tag->category->name}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$tags->render()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
