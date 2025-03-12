@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <form action="{!! url("publication/construct/save") !!}" method="post" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <input type="hidden" name="publication_id"  value="{{$publication->id}}">
                <input type="hidden" name="id"  value="{{$construct->id}}">

                <label for="concept">Concept</label>
                <input type="text" name="concept" required maxlength="255" class="form-control" value="{{$construct->concept}}">

                <label for="description">Description</label>
                <textarea name="description" class="form-control">{{$construct->description}}</textarea>

                <label for="form">Form</label>
                <input type="text" name="form" maxlength="255" class="form-control" value="{{$construct->form}}" required>

                <label for="type">Type</label>
                <select name="type" class="form-control">
                    <option value="entity">Entity</option>
                    <option value="relantioship">Relantioship</option>
                    <!--@if($construct->type)
                        <option value="{{$construct->type}}">{{$construct->type}}</option>
                    @endif-->
                </select>
                <label for="image">Construct Image</label>
                <input type="file" name="image" class="form-control" accept="image/*">

                <label for="example_image">Usage Example</label>
                <input type="file" name="example_image" class="form-control" accept="image/*">

                <label for="priorization">Priorization</label>
                <input type="number" class="form-control" min="0" max="5" name="priorization" value="{{$construct->priorization}}">
                <hr>
                <label for="representation">Finalities/Representation Form</label><br>
                @foreach($classifications as $classification)
                    <h5>{{$classification->description}}</h5>
                    <hr>
                    @foreach($classification->representationForms()->get() as $rep)
                        <input type="checkbox" name="representation[]" value="{{$rep->id}}"
                        @if($construct->representationForms()
                        ->where('representation_forms_id','=',$rep->id)
                        ->count() > 0) checked="checked" @endif
                            >{{$rep->description}} &nbsp;
                        <br>
                    @endforeach
                    <hr>
                @endforeach
                <hr>
                <br>
                <button type="submit" class="btn btn-success">Salvar</button>
            </form>
        </div>
    </div>

@endsection