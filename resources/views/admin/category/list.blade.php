@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Categories
                        <a href="{{ url('admin/category/edit') }}" class="btn btn-info">New</a>
                    </div>

                    <div class="panel-body">
                        <table class="table table-bordered table-striped table-hovered">
                            <thead>
                            <tr>
                                <td>Name</td>
                                <td>Description</td>
                                <td>Type</td>
                                <td>Total</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td><a href="{{ url("admin/category/edit/{$category->id}") }}">{{$category->name}}</a></td>
                                    <td>{{$category->description}}</td>
                                    <td>{{$category->type}}</td>
                                    <td>{{$category->total_allowed}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $categories->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
