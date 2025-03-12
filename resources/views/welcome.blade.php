@extends('layouts.app')

@section('content')
<div class="container">
            <div class="col-md-9">
            <h3>{{env('PUBLICATION_LIST_NAME')}} List </h3>
                <h5>Search by Author, Title or Filter by Categories</h5>
                </div>
            <!--<div class="col-md-3">
                <br>
                <a href="{!! url('/publication/treeview') !!}" class="btn btn-info btn-block">Switch to Tree View</a>
            </div>-->
            <form action="{{ url('/publication/list') }}" method="get" class="form-inline">
                <div class="form-group">
                    <input type="search" name="q" class="form-control" placeholder="Author or Title Search" value="{{$query}}"> and/or
                    <select name="f" class="form-control">
                        <option value="0">Filter By</option>
                        @foreach($categories as $c)
                            <optgroup label="{{ $c->name }}">
                                @foreach($c->tags()->orderBy('name')->get() as $t)
                                    <option value="{{$t->id}}" @if($filter == $t->id) selected="selected" @endif title="{{$t->description}}">{{$t->name}}</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-success">Search</button>
                </div>
            </form>
            <table id="table" class="table table-responsive table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Authors</th>
                        <th>Year
                        <th>Source</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($publications as $publication)
                    <tr>
                        <td>{{$publication->id}}</td>
                        <td><a href="{{url("/publication/view/$publication->id")}}" title="View More"> {{$publication->title}}</a></td>
                        <td>{{$publication->authors}}</td>
                        <td>{{$publication->year}}</td>
                        <td>{{$publication->journal}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$publications->setPath("/publication/list?q=$query&f=$filter")->links()}}
</div>
@endsection
