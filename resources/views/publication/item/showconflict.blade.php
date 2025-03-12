@extends("layouts.app")

@section('content')

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>
                Conflict: {{$conflict->id}} - {{$conflict->description}}
                @can('rule','team')
                <a href="{{url("/team/conflict/edit/$conflict->id")}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                @endcan
            </h4>
            Type: {{$conflict->conflictCategory->description}}
        </div>

        <div class="panel-body">
            <div class="col-md-12">
                <h4>Constructs</h4>
                <table class="table table-striped">
                    <thead>
                        <th>Concept</th>
                        <th>Form</th>
                        <th>Description</th>
                        <th>Image</th>
                    </thead>
                    <tbody>
                        @foreach($conflict->constructs()->get() as $construct)
                            <tr>
                                <td><a href="{!! url("publication/construct/show/$construct->id") !!}">{{$construct->concept}}</a></td>
                                <td>{{$construct->form}}</td>
                                <td>{{$construct->description}}</td>
                                <td><img src="{!! url("/images/$construct->image") !!}"></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection