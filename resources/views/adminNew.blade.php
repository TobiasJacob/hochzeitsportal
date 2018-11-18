
@extends('layouts.app')

@section('content')

<!-- Bootstrap Boilerplate... -->

<div class="container">
        <a href="/admin/" class="btn">Zurück</a> 

    <!-- New vendor Form -->
    <form action="/admin/newVendor" method="POST" class="form-horizontal">
        {{ csrf_field() }}

        @include('common.errors')

        <div class="form-group">
            <label for="vendor" class="col-sm-3 control-label">Name</label>
            <div class="col-sm-6">
                <input type="text" name="name" id="vendor-name" class="form-control" value="{{old('name')}}">
            </div>
        </div>

        <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Link</label>
            <div class="col-sm-6">
                <input type="text" name="link" id="vendor-name" class="form-control" value="{{old('link')}}">
            </div>
        </div>

        <div class="form-group">
            <label for="category" class="col-sm-3 control-label">Kategorie</label>
            <div class="col-sm-6">
                <select type="text" name="category" id="vendor-name" class="form-control" value="{{old('category')}}">
                    @foreach ($categories as $category)
                        <option>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <!-- Add vendor Button -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default">
                    Hinzufügen
                </button>
            </div>
        </div>
    </form>
</div>

@endsection