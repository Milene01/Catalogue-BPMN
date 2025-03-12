@extends('layouts.app')

@section('content')
    <script>

        $( function() {

            $( "#root" ).autocomplete({
                source: "{!! url('team/publication/autocomplete') !!}",
                minLength: 2,
                select: function( event, ui ) {
                    $("#selected").append(
                            '<input type="checkbox" name="roots[]" checked="checked" value="' + ui.item.id + '">' + ui.item.value + '<br>'
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
                    <div class="panel-heading"><h4>Publication {{ $publication->name }}</h4></div>
                    <div class="panel-body">
                    <form action="{{url('/publication/save')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{$publication->id}}" >

                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" value="{{$publication->title}}" maxlength="255" class="form-control" required>

                        <label for="short_title">Short Title</label>
                        <input type="text" id="short_title" name="short_title" value="{{$publication->short_title}}" maxlength="100" class="form-control" >

                        <label for="year">Year</label>
                        <input type="number" id="year" name="year" value="{{$publication->year}}" maxlength="4" min="1000" class="form-control" required>

                        <label for="url">URL:</label>
                        <input type="url" id="url" name="url" value="{{$publication->url}}" maxlength="255" class="form-control">


                        <label for="type">Publication Type</label>
                        <select id="type" name="type" class="form-control" required>
                            @foreach(['Book Chapter','Journal','Conference'] as $type)
                                <option value="{{$type}}" @if($publication->type == $type) selected @endif>{{$type}}</option>
                            @endforeach
                        </select>

                        <label for="journal">Publication Name</label>
                        <input type="text" id="journal" name="journal" value="{{$publication->journal}}" maxlength="255" class="form-control" required>

                        <label for="authors">Authors</label>
                        <input type="text" id="authors" name="authors" value="{{$publication->authors}}" maxlength="255" class="form-control" required>

                        <label for="notes">Description</label>
                        <textarea id="notes" name="notes" class="form-control">{{$publication->notes}}</textarea>

                        <label for="publications_id">{{env('PUBLICATION_LIST_NAME')}} base</label>
                        <div class="ui-widget">
                            <input class="form-control" id="root" size="50" placeholder="Search by Root {{env('PUBLICATION_LIST_NAME')}}" value="">
                            <div id="selected">
                                @forelse($publication->roots()->get() as $r)
                                    <input type="checkbox" name="roots[]" checked="checked" value="{{$r->id}}">{{$r->short_title}} | {{$r->title}}<br>
                                @empty

                                @endforelse
                            </div>
                        </div>

                        <br>
                        <button type="submit" class="btn btn-success">Salvar</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
