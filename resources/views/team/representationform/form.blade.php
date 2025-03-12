@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>Representation Form {{ $representation->description }}</h4></div>
                    <div class="panel-body">
                    <form action="{{url('team/representationform/save')}}" class="form-horizontal" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{$representation->id}}">

                        <label for="description">Description</label>
                        <textarea id="description" class="form-control" name="description" required>{{$representation->description}}</textarea>

                        <label for="category_id">Category</label>
                        <select name="classification_id" class="form-control" id="category_id" required>
                            @foreach($classifications as $classification)
                            <option value="{{$classification->id}}" @if($classification->id  == @$representation->classification->id) selected @endif>{{$classification->description}}</option>
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
