@extends('layouts.app')

@section('content')

        <div class="container">
        <h2>Conflicts List</h2>

        <form action="{{ url('/conflict/list') }}" method="get" class="form-inline">
            <div class="form-group">
                <select name="t" class="form-control">
                    <option value="0">-- Filter By Type --</option>
                    @foreach($types as $t)
                        <option value="{{$t->id}}" @if($t->id == $type) selected="selected" @endif>{{$t->description}}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-success">Search</button>
            </div>
        </form>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Constructs Involved </th>
                </tr>
            </thead>
            @foreach ($conflicts as $conflict)
                <tr>
                    <td><a href="{{url("/publication/conflict/show/$conflict->id")}}">{{ $conflict->description }}</a></td>
                    <td>{{$conflict->constructs()->count()}}</td>
                </tr>
            @endforeach
        </table>

        {{ $conflicts->setPath("/?t=$type")->links() }}


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