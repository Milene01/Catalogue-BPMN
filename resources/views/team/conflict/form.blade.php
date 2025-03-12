@extends('layouts.app')

@section('content')
    <script>

        $( function() {
            function log( message ) {
                $( "<div>" ).text( message ).prependTo( "#log" );
                $( "#log" ).scrollTop( 0 );
            }

            $( "#constructs" ).autocomplete({
                source: "{!! url('team/conflict/autocomplete') !!}",
                minLength: 2,
                select: function( event, ui ) {
                    $("#selected").append(
                            '<input type="checkbox" name="constructs[]" checked="checked" value="' + ui.item.id + '">' + ui.item.value + '<br>'
                    );
                    ui.item.value = "";
                    return false;
                }
            });
        } );


    </script>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>Conflict {{ $conflict->description }}</h4></div>
                    <div class="panel-body">
                    <form action="{{url('team/conflict/save')}}" class="form-horizontal" method="post">
                        {!! csrf_field() !!}
                        <input type="hidden" name="id" value="{{$conflict->id}}">
                        <label for="description">Description</label>
                        <input type="text" id="description" name="description" value="{{$conflict->description}}" class="form-control" required>
                        <br>
                        <label for="ccid">Conflict Type</label>
                        <select id="ccid" name="conflict_category_id" class="form-control">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" @if($category->id == $conflict->conflict_category_id) selected="selected" @endif>{{$category->description}}</option>
                            @endforeach
                        </select>
                        <div class="ui-widget">
                            <label for="constructs">Constructs: </label>
                            <input class="form-control" id="constructs" size="50" placeholder="Search by Construct Concept" value="">
                            <div id="selected">
                                @forelse($conflict->constructs()->get() as $con)
                                    <input type="checkbox" name="constructs[]" checked="checked" value="{{$con->id}}">{{$con->concept}}<br>
                                @empty

                                @endforelse
                            </div>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-success">Salvar</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
