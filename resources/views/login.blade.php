@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    <h3>Choose your login method</h3>
                    <!--<a href="{{url('auth/facebook')}}" class="btn btn-primary">Facebook</a>-->
                    <a href="{{url('auth/google')}}" class="btn btn-danger">Google</a>
                    <!--<a href="{{url('auth/github')}}" class="btn btn-info">GitHub</a>-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
