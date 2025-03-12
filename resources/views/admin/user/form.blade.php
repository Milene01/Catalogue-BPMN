@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>User {{ $user->name }}</h4></div>
                    <div class="panel-body">
                    <form action="{{url('admin/user/save')}}" class="form-horizontal" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{$user->id}}">

                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" value="{{$user->name}}" disabled class="form-control">

                        <label for="name">E-mail</label>
                        <input type="text" id="email" name="email" value="{{$user->email}}" disabled class="form-control">

                        <label for="rule">Rule</label>
                        <select name="rule" class="form-control" id="rule">
                            @foreach($user->getRules() as $rule)
                            <option value="{{$rule}}" @if($rule == $user->rule) selected @endif>{{$rule}}</option>
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
