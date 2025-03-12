@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <form action="{!! url("publication/item/save/$publication->id/$category->id/$image->id") !!}" method="post">
                    {!! csrf_field() !!}

                    <label for="text">{{$category->name}}</label>
                    <textarea name="text" id="text" class="form-control">{{$publication->textFields()->where('category_id','=',$category->id)->first()->content or ''}}</textarea>
                    <button type="submit" class="btn btn-success">Salvar</button>
                </form>
            </div>
        </div>
    </div>
@endsection