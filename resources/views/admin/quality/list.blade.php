@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Quality Assesment Criteria <a href="{{ url('admin/quality/edit') }}" class="btn btn-info">New</a> </div>

                    <div class="panel-body">
                        <table class="table table-bordered table-striped table-hovered">
                            <thead>
                            <tr>
                                <td>Question</td>
                                <td>Intermediary Value</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($qualityQuestions as $qualityQuestion)
                                <tr>
                                    <td><a href="{{ url("admin/quality/edit/{$qualityQuestion->id}") }}">{{$qualityQuestion->question}}</a></td>
                                    <td>@if($qualityQuestion->intermediary_value) YES @else NO @endif</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $qualityQuestions->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
