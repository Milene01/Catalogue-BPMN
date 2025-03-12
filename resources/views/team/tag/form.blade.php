@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>Tag {{ $tag->name }}</h4></div>
                    <div class="panel-body">
                    <form action="{{url('team/tag/save')}}" class="form-horizontal" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{$tag->id}}">

                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" value="{{$tag->name}}" class="form-control" required>

                        <label for="description">Description</label>
                        <textarea id="description" class="form-control" name="description" required>{{$tag->description}}</textarea>

                        <label for="category_id">Category</label>
                        <select name="category_id" class="form-control" id="category_id" required>
                            @foreach($categories as $category)
                            <option value="{{$category->id}}" @if($category->id  == @$tag->category->id) selected @endif>{{$category->name}}</option>
                            @endforeach
                        </select>

                        <br>
                        <button type="submit" class="btn btn-success">Salvar</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
