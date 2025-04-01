@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Construct List</h2>

    <form action="{{ url('/construct/list') }}" method="get" class="form-inline">
        <div class="form-group">
            <input type="text" name="c" class="form-control" placeholder="Search by Concept" value="{{ old('c', $concept) }}">
            <select name="a" class="form-control">
                <option value="0">-- Filter By Area --</option>
                @foreach($tags as $tag)
                    <option value="{{ $tag->content }}" @if($tag->content == old('a', $applicationArea)) selected="selected" @endif>
                        {{ $tag->content }}
                    </option>
                @endforeach
            </select>
            <select name="f" class="form-control">
                <option value="0">-- Filter By Form --</option>
                @foreach($forms as $formi)
                    <option value="{{$formi->form}}" @if($formi->form == old('f', $form)) selected="selected" @endif>{{$formi->form}}</option>
                @endforeach
            </select>
            <select name="t" class="form-control">
                <option value="0">-- Filter By Type --</option>
                @foreach($types as $t)
                    <option value="{{$t}}" @if($t == old('t', $type)) selected="selected" @endif>{{$t}}</option>
                @endforeach
            </select>
            <!-- <select name="cl" class="form-control">
                <option value="0">-- Filter By Classification --</option>
                @foreach($classifications as $c)
                    <optgroup label="{{$c->description}}">
                        @foreach($c->representationForms()->get() as $r)
                            <option value="{{$r->id}}" @if($r->id == old('cl', $classification)) selected="selected" @endif>{{$r->description}}</option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select> -->
            <button type="submit" class="btn btn-success">Search</button>
            <a href="{{ url('construct/list') }}" class="btn btn-warning">Clear</a>
        </div>
    </form>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Concept</th>
                <th>Form</th>
                <th>Type</th>
                <th>Image</th>
                <th>Priorization</th>
            </tr>
        </thead>
        @foreach ($constructs as $construct)
            <tr>
                <td><a href="{{url("/publication/construct/show/$construct->id")}}">{{ $construct->concept }}</a></td>
                <td>{{$construct->form}}</td>
                <td>{{$construct->type}}</td>
                <td><img src="{{ url("/images/$construct->image") }}"></td>
                <td>{{$construct->priorization}}</td>
            </tr>
        @endforeach
    </table>

    <!-- A linha crucial para manter os filtros ao navegar nas páginas -->
    {{ $constructs->appends(request()->except('page'))->links() }}

    <script>
        $(function(){ // let all dom elements are loaded
            $('#myModal').on('hide.bs.modal', function (e) {
                $(this).find('iframe').attr('src',"about:blank");
            });
        });
        $('.modalOpen').on('click',function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            $('.modal').on('shown.bs.modal',function(){      //correct here use 'shown.bs.modal' event which comes in bootstrap3
                $(this).find('iframe').attr('src',url);
            })
            $('#myModal').modal('show');
            return false;
        });
    </script>
</div>

@endsection
