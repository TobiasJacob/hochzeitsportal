@extends('layouts.app')

@section('content')
<div class="container">
        <a href="/admin/" class="btn">Zurück</a> 

        @include('common.errors')

        <form action="/admin/{{$vendor->id}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-row">
                <div class="form-group col-sm-6">
                    <label class="control-label">Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Name" value="{{old('name', null) != null ? old('name') : $vendor->name}}">
                </div>
                <div class="form-group col-sm-6">
                    <label class="control-label">Link</label>
                    <input type="text" name="link" class="form-control" placeholder="Link" value="{{old('link', null) != null ? old('link') : $vendor->link}}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-sm-6">
                    <label class="control-label">Kategorie</label>
                    <select type="text" name="category" class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{$category->name}}"
                                    {{ (old('category', null) != null ? old('category') : (is_object($vendor->category) ? $vendor->category->name : NULL ) == $category->name) ? 'selected' : ''}}>
                                    {{$category->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-sm-6">
                    <label class="control-label">Ranking</label>
                    <input type="text" name="searchScore" class="form-control" placeholder="Rank" value="{{old('searchScore', null) != null ? old('searchScore') : $vendor->searchScore}}">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label">Vorschaubild</label> <br />
                @if ($vendor->photoPath)
                    <img src="{{'/uploads/img/' . $vendor->photoPath}}" alt="Kein Bild" class="w-50">
                @endif
                <input type="file" name="imageFile" id="imageFile" class="form-control-file mt-2">
            </div>
    

            <div class="form-group">
                <label class="control-label">Beschreibung</label>
                <textarea name="description" class="form-control"  placeholder="Beschreibung">{{old('description', null) != null ? old('description') : $vendor->description}}</textarea>
            </div>

            <div class="form-group">
                <label class="control-label">Adresse</label>
                <input type="text" name="street" class="form-control" placeholder="Straße und Hausnummer" value="{{old('street', null) != null ? old('street') : $vendor->street}}">
            </div>

            <div class="form-row">
                <div class="form-group col-sm-4">
                    <input type="text" name="postalCode" class="form-control" placeholder="PLZ" value="{{old('postalCode', null) != null ? old('postalCode') : $vendor->postalCode}}">
                </div>
                <div class="form-group col-sm-8">
                    <input type="text" name="city" class="form-control" placeholder="Ort" value="{{old('city', null) != null ? old('city') : $vendor->city}}">
                </div>
            </div>
            
            <label class="control-label">Kontakt</label>
            <div class="form-row">
                <div class="form-group col-sm-6">
                    <input type="text" name="telephone" class="form-control" placeholder="Telefon" value="{{old('telephone', null) != null ? old('telephone') : $vendor->telephone}}">
                </div>
                <div class="form-group col-sm-6">
                    <input type="text" name="email" class="form-control" placeholder="E-Mail" value="{{old('email', null) != null ? old('email') : $vendor->email}}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-sm-6">
                    <input type="text" name="website" class="form-control" placeholder="Website" value="{{old('website', null) != null ? old('website') : $vendor->website}}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-sm-6">
                    <input type="text" name="facebook" class="form-control" placeholder="Facebook" value="{{old('facebook', null) != null ? old('facebook') : $vendor->facebook}}">
                </div>
                <div class="form-group col-sm-6">
                    <input type="text" name="instagram" class="form-control" placeholder="Instagram" value="{{old('instagram', null) != null ? old('instagram') : $vendor->instagram}}">
                </div>
            </div>

            <!-- Add vendor Button -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    Speichern
                </button>
            </div>
        </form>


        <form action="/admin/{{$vendor->id}}/detailPhoto" method="POST" class="form-horizontal" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label class="control-label">Detailbilder</label> <br />
                <div class="row">
                    <input type="file" name="detailPhoto" id="detailPhoto" class="form-control-file mt-2 col-sm-6">
                    <button type="submit" class="btn btn-secondary ">
                        Detailbild hinzufügen
                    </button>
                </div>
            </div>
        </form>

        <div>
            @foreach ($vendor->getDetailPhotosPath() as $photoPath) 
                <img src="{{'/uploads/img/' . $photoPath}}" alt="Kein Bild" class="w-25" />
                <a href="/admin/{{$vendor->id}}/deleteDetailPhoto/{{$photoPath}}" class="btn btn-danger">Löschen</a>
                <br />
            @endforeach
        </div>
        
</div>
@endsection
