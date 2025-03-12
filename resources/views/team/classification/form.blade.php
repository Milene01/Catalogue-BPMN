@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>Classification {{ $classification->name }}</h4></div>
                    <div class="panel-body">
                    <form action="{{url('team/classification/save')}}" class="form-horizontal" method="post">
                        {!! csrf_field() !!}
                        <input type="hidden" name="id" value="{{$classification->id}}">

                        <label for="description">Description</label>
                        <input type="text" id="description" name="description" value="{{$classification->description}}" class="form-control" required>
                        <br>
                        <button type="submit" class="btn btn-success">Salvar</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
