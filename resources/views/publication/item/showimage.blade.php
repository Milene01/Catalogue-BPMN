@extends('layouts.app')

@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>
                {{$publication->title}}
                @can('rule','team')
                <a href="{{url("/publication/edit/$publication->id")}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                <a href="{{url("/publication/quality/$publication->id")}}"><i class="fa fa-balance-scale" aria-hidden="true"></i></a>
                @endcan
                @if($publication->url)
                    <a href="{{$publication->url}}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a>
                @endif
            </h3>
            <b>Author:</b> {{$publication->authors}} <br>
            <b>Name:</b> {{$publication->journal}} <br>
            <b>Type:</b> {{$publication->type}} <br>
            <b>Year:</b> {{$publication->year}} <br>
            <b>Notes:</b> {{$publication->notes or ''}}
        </div>

        <div class="panel-body">
            <div class="col-md-4">
            <img src="{{url("images/$image->filename")}}" class="img-responsive">
            </div>
            <div class="col-md-6">
            @foreach($categories as $category)
                <div class="col-md-3">
                    <h4>
                        {{$category->name}} @can('rule','team') <a href="{{url("/publication/item/insert/$publication->id/$category->id/$image->id")}}"><i class="fa fa-pencil" aria-hidden="true"></i>
                        </a> @endcan
                    </h4>
                    @if($category->type == 'text')
                        @forelse($publication->textFields()
                        ->where('category_id','=',$category->id)
                        ->where('images_id','=',$image->id)
                        ->get() as $response)
                            <p>{{$response->content}}</p>
                        @empty
                            <p>--- // ---</p>
                        @endforelse
                    @elseif ($category->type == 'tag')
                        @forelse($image->tags()
                        ->where('category_id','=',$category->id)
                        ->get() as $response)
                            <span class="label label-info">{{$response->name}} &nbsp;   </span>
                        @empty
                            <p>--- // ---</p>
                        @endforelse
                    @endif
                    <hr>
                </div>
            @endforeach
            </div>
        </div>
        <div class="panel-footer">

        </div>
    </div>
</div>
@endsection