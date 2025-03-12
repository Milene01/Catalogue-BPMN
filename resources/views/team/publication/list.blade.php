@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Show: {{$type}}
                    <a href="{{url('team/publication')}}" class="btn btn-info">Waiting Review</a>
                    <a href="{{url('team/publication/accepted')}}" class="btn btn-success">Accepted</a>
                    <a href="{{url('team/publication/rejected')}}" class="btn btn-danger">Rejected</a>
                    </h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped table-hovered">
                        <thead>
                            <tr>
                                <td>Title</td>
                                <td>Year</td>
                                <td>Author</td>
                                <td>Journal</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($publications as $publication)
                                <tr>
                                    <td><a href="{{url("/publication/view/{$publication->id}")}}"> {{ $publication->title }}</a></td>
                                    <td>{{ $publication->year }}</td>
                                    <td>{{ $publication->authors }}</td>
                                    <td>{{ $publication->journal }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$publications->render()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
