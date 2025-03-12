<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            {{$publication->title}}
            @can('rule','team')
            <a href="{{url("/publication/edit/$publication->id")}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
            <a href="{{url("/publication/quality/$publication->id")}}"><i class="fa fa-balance-scale" aria-hidden="true"></i></a>
            @endcan
            @if($publication->url)
                <a href="{{$publication->url}}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a>
            @endif
        </h3>
        <b>Author:</b> {{$publication->authors}} <br>
        <b>Type:</b> {{$publication->type}} <br>
        <b>Name:</b> {{$publication->journal}} <br>
        <b>Year:</b> {{$publication->year}} <br>
        <b>Description:</b> {{$publication->notes or ''}}
                @if($publication->roots->count() > 0)
                    <br>
                    <b>{{env('PUBLICATION_LIST_NAME')}} Base: </b>
                    <ul>
                        @foreach($publication->roots()->get() as $p)
                            <li><a href="{!! url("publication/view/$p->id") !!}">{{$p->short_title}} {{$p->title}}</a> </li>
                        @endforeach
                    </ul>
                @endif
        </dl><br>
    </div>

    <div class="panel-body">
        @foreach($categories as $category)
            <div class="col-md-3">
                <h4>
                    {{$category->name}} @can('rule','team') <a href="{{url("/publication/item/insert/$publication->id/$category->id")}}"><i class="fa fa-pencil" aria-hidden="true"></i>
                    </a> @endcan
                </h4>
                @if($category->type == 'text')
                    @forelse($publication->textByCategoryId($category->id)->get() as $response)
                        <p>{{$response->content}}</p>
                    @empty
                        <p>--- // ---</p>
                    @endforelse
                @elseif ($category->type == 'tag')
                    @forelse($publication->tagByCategoryId($category->id)->get() as $response)
                        <span class="label label-info">{{$response->name}} &nbsp;   </span>
                    @empty
                        <p>--- // ---</p>
                    @endforelse
                @endif
                <hr>
            </div>
        @endforeach
        <hr>
        <div class="col-md-12">
            @can('rule','team')
            @if(env('CONSTRUCT_LIST'))
            <a href="{{url("/publication/construct/insert/$publication->id")}}"><i class="fa fa-pencil" aria-hidden="true"></i> Insert New Construct</a>
            @endif
            @endcan
            @if($publication->constructs()->count() > 0)
                <h3>Constructs</h3>
                    <div class="col-md-12">
                        <table class="table table-responsive">
                            <caption></caption>
                            <thead>
                            <th>ID</th>
                            <th>Concept</th>
                            <th>Type</th>
                            <th>Image</th>
                            <th>Option</th>
                            </thead>
                            <tbody>
                            @foreach($publication->constructs()->get() as $construct)
                                <tr>
                                    <td>{{$construct->id}} </td>
                                    <td>{{$construct->concept}}</td>
                                    <td>{{$construct->type}}</td>
                                    <td><img width="100px" src="{{ url("images/$construct->image") }}"></td>
                                    <td><a href="{{url("publication/construct/show/$construct->id")}}">Detail</a>
                                        @can('rule','team')
                                            <a href="{{url("publication/construct/insert/$publication->id/$construct->id")}}">Edit</a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <hr>
                    </div>
            @endif

            @if($images->count() > 0)
            <h3>Images List</h3>

            @foreach($images as $imageCategory)
                {{$imageCategory->name}} @can('rule','team')
                <a href="{{url("/publication/image/insert/$publication->id/$imageCategory->id")}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                @endcan
                <div class="col-md-12">
                    <table class="table table-responsive">
                        <caption></caption>
                        <thead>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Option</th>
                        </thead>
                        <tbody>
                        @foreach($imageCategory->images()->where('publication_id','=',$publication->id)->get() as $img)
                            <tr>
                                <td><img width="100px" src="{{ url("images/$img->filename") }}"> </td>
                                <td>{{$img->title}}</td>
                                <td>{{$img->description}}</td>
                                <td><a href="{{url("publication/image/show/$img->id")}}">Show</a>
                                    @can('rule','team')
                                    <a href="{{url("publication/image/insert/$img->publication_id/$img->category_id/$img->id")}}">Edit</a></td>
                                @endcan
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <hr>
                </div>
            @endforeach
            @endif
        </div>
    </div>
    <div class="panel-footer">
        <a href="{{url("/suggest/publication/$publication->id")}}" class="btn btn-warning"><i class="fa fa-pencil-square" aria-hidden="true"></i>Suggests Update Info</a><br>
        Status: @if($publication->approved == null) In review @elseif($publication->approved == true) Approved @else Reject @endif
        @can('rule','team')
        @if($publication->approved == 1 OR $publication->approved == null)
            <a href="{!! url("/team/publication/reject/$publication->id") !!}" class="btn btn-danger">Reject</a>
        @endif
        @if($publication->approved == 0 OR $publication->approved == null)
            <a href="{!! url("/team/publication/accept/$publication->id") !!}" class="btn btn-success">Accept</a>
        @endif
        @endcan
    </div>
</div>