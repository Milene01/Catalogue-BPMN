@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
                <form action="{!! url("publication/item/save/$publication->id/$category->id/$image->id") !!}" method="post">
                    {!! csrf_field() !!}
                <label for="item">Select item for {{$category->name}}</label>
                <select id="item" name="item[]" @if($category->total_allowed != 1) multiple @endif class="form-control" size="15">
                    @foreach($category->tags()->orderBy('name')->get() as $tag)
                        @if(!$image->id)
                            @if($publication->tags()->where('id','=',$tag->id)->count() == 1)
                            <option value="{{$tag->id}}" selected="selected">{{$tag->name}}</option>
                            @else
                            <option value="{{$tag->id}}">{{$tag->name}}</option>
                            @endif
                        @else
                            @if($image->tags()->where('id','=',$tag->id)->count() == 1)
                                <option value="{{$tag->id}}" selected="selected">{{$tag->name}}</option>
                            @else
                                <option value="{{$tag->id}}">{{$tag->name}}</option>
                            @endif
                        @endif
                    @endforeach
                </select>
                    @if($category->total_allowed != 1)
                        <label>Others: Commas separated. Ex.: newTag1,newTag2,new tag 3 </label>
                        <textarea class="form-control" name="others"></textarea>
                    @endif
                    <button type="submit" class="btn btn-success">Salvar</button>
                </form>
        </div>
    </div>
@endsection