@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>Quality Assesment Criteria Edit</h4></div>
                    <div class="panel-body">
                    <form action="{{url('admin/quality/save')}}" class="form-horizontal" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{$quality->id}}">

                        <label for="question">Question</label>
                        <textarea id="question" class="form-control" name="question" required>{{$quality->question}}</textarea>

                        <label for="intermediary">Intermediary Value</label> YES (0, 0.5 or 1) and NO (0 or 1)
                        <select name="intermediary_value" class="form-control" id="type">
                                <option value="0" @if($quality->intermediary_value) selected @endif>NO</option>
                                <option value="1" @if($quality->intermediary_value) selected @endif>YES</option>
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
