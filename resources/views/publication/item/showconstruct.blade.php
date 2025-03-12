@extends("layouts.$layout")

@section('content')
    @if($layout == 'apptree')
        <a href="{!! url("publication/treeview/$publication->id") !!}">Go Back to Publication</a>
    @endif
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>
                Construct: {{$construct->id}} - {{$construct->concept}}
                @can('rule','team')
                <a href="{{url("/publication/construct/insert/$publication->id/$construct->id")}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                @endcan
            </h4>
            <b>Related Extension:</b> {{$publication->short_title or ''}} - {{$publication->title}} ({{$publication->authors}})
            <h5>Priorization: {{$construct->priorization}}</h5>
        </div>

        <div class="panel-body">
            <div class="col-md-3">
            <h4>Description</h4>
                <p>{{$construct->description}}</p>
                <h4>Form</h4>
                <p>{{$construct->form}}</p>
                <h4>Classification</h4>
                <p>
                <dl>
                    @forelse($construct->representationForms()->get() as $rep)
                        <dt>{{$rep->classification->description}}</dt>
                         <dd>{{$rep->description}}</dd>
                    @empty
                        None
                    @endforelse
                </dl>
                </p>
            </div>
            <div class="col-md-3">
                <h4>Notation:</h4>
                <img src="{{url("images/$construct->image")}}" class="img-responsive">
                <h4>Example:</h4>
                <img src="{{url("images/$construct->example_image")}}" class="img-responsive">
            </div>
            <div class="col-md-6">
                <h4>Conflicts</h4>
                @forelse($construct->conflicts()->get() as $conflict)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            {{ $conflict->description }}
                        </div>
                        <div class="panel-body">
                            @foreach($conflict->constructs()->get() as $c)
                                <img src="{!! url("images/$c->image") !!}" class="img-rounded" width="150px">
                                {{$c->concept}} <br>
                            @endforeach
                        </div>
                    </div>
                @empty
                    No conflicts
                @endforelse

            </div>
        </div>
    </div>
</div>
@endsection