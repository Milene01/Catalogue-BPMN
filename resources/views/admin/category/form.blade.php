@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>Category {{ $category->name }}</h4></div>
                    <div class="panel-body">
                    <form action="{{url('admin/category/save')}}" class="form-horizontal" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{$category->id}}">

                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" value="{{$category->name}}" class="form-control" required>

                        <label for="description">Description</label>
                        <textarea id="description" class="form-control" name="description" required>{{$category->description}}</textarea>

                        <label for="type">Type</label>
                        <select name="type" class="form-control" id="type" required>
                            @foreach($category->getTypes() as $categ)
                                <option value="{{$categ}}" @if($categ == $category->type) selected @endif>{{$categ}}</option>
                            @endforeach
                        </select>

                        <label for="total">Total</label> 0 = no limit, 1 = only 1
                        <select name="total_allowed" id="total" class="form-control">
                            <option value="0" @if(!$category->total_allowed) selected="selected" @endif>Unlimited</option>
                            <option value="1" @if($category->total_allowed) selected="selected" @endif>Only one</option>
                        </select>
                        Except by TextField, this accept only one!
                        <br>
                        <br>
                        <label for="image_category">Is a Image Category?</label>
                        <select name="image_category" class="form-control" id="image_category">
                            <option value="0"  @if(!$category->image_category) selected @endif>No</option>
                            <option value="1" @if($category->image_category) selected @endif>Yes</option>
                        </select>
                        <br>
                        <button type="submit" class="btn btn-success">Salvar</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
