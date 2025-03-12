@extends('layouts.app')

@section('content')
    <div class="container">
    <form action="{!! url('/suggest') !!}" method="post">
        {!! csrf_field() !!}
        <label>Title of the Extension Paper</label>
        <input type="text" name="title" required class="form-control">
        <label>Link to Access to the Paper</label>
        <input type="url" name="url" required class="form-control">
        <label>Your E-mail</label>
        <input type="email" name="email" required class="form-control">
        <!--<div class="g-recaptcha" data-sitekey="{!! env('GOOGLE_RECAPTCHA_SITE_KEY') !!}"></div>-->
        <button type="submit" class="btn btn-success">Send</button>
    </form>
    </div>
<script src='https://www.google.com/recaptcha/api.js'></script>
@endsection