@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>{{ $publication->title }}</h4>{{ $publication->authors }}</div>
                    <div class="panel-body">
                    <form action="{{url('/publication/quality')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" name="publication_id" value="{{$publication->id}}">
                        @foreach($qualityQuestions as $question)
                            <label for="{{$question->id}}">{{$question->question}}</label>
                        <br>
                            <input type="radio" name="{{$question->id}}" value="0" required @if($selectedQuestion[$question->id] == 0) checked @endif>0
                            @if ($question->intermediary_value)
                                <input type="radio" name="{{$question->id}}" value="0.5" @if($selectedQuestion[$question->id] == 0.5) checked @endif>0.5
                            @endif
                            <input type="radio" name="{{$question->id}}" value="1" @if($selectedQuestion[$question->id] == 1) checked @endif>1
                            <br>
                            <br>
                        @endforeach
                        <button type="submit" class="btn btn-success">Salvar</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
