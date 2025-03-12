@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <form action="{!! url("publication/image/save/$publication->id/$category->id/$image->id") !!}" method="post" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <label for="item">Insert image to {{$category->name}}</label>
                <input type="file" name="photo" class="form-control" accept="image/*" @if(!$image->id) required @endif>
                <label for="title">Title</label>
                <input type="text" name="title" required maxlength="45" class="form-control" value="{{$image->title}}">
                <label for="description">Description</label>
                <textarea name="description" class="form-control">{{$image->description}}</textarea>
                <br>
                <button type="submit" class="btn btn-success">Salvar</button>
            </form>
        </div>
    </div>
@endsection