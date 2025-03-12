@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Suggest for: {{$publication->title}} </h3>
    <form action="{!! url("/suggest/publication/$publication->id") !!}" method="post">
        {!! csrf_field() !!}
        <label>Your suggests:</label>
        <textarea name="suggest" required class="form-control"></textarea>
        <label>Your E-mail</label>
        <input type="email" name="email" required class="form-control">
        <div class="g-recaptcha" data-sitekey="{!! env('GOOGLE_RECAPTCHA_SITE_KEY') !!}"></div>
        <button type="submit" class="btn btn-success">Send</button>
    </form>
    </div>
<script src='https://www.google.com/recaptcha/api.js'></script>
@endsection
