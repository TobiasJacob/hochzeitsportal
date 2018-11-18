
@extends('layouts.app')

@section('head')
{!! Mapper::renderJavascript() !!}
@endsection

@section('contentOutsideApp')
<div class="container">
        @if (count($vendor->getDetailPhotosPath()) > 0)
        <div class="row mb-3 border-bottom pb-3">
                <div id="carouselExampleControls" class="carousel slide col-sm" data-ride="carousel" style="overflow: hidden;">
                        <div class="carousel-inner">
                                @foreach ($vendor->getDetailPhotosPath() as $photoPath) 
                                        <div class="carousel-item {{$loop->first ? 'active' : ''}}">
                                                <img src="{{'/uploads/img/' . $photoPath}}" alt="Kein Bild" class="d-block w-100" />
                                        </div>
                                @endforeach
                        </div>
                        @if (count($vendor->getDetailPhotosPath()) > 1)
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                        </a>
                        @endif
                </div>
        </div>
        @endif
        <div>
                <a href="/" class="btn">Zurück</a> <br />
                <h1>{{$vendor->name}}</h1> <br />
                <p>{{ $vendor->description }}</p>
        </div>

        <div class="row mt-3 mb-5 border-top">
                <div class="col-md-6 col-lg-3 mt-3" style="min-height: 300px;">
	                {!! Mapper::render() !!}
                </div>
                <div class="col-md-6 col-lg-3 mt-3">
                        <address class="mb-0">
                                <strong class="tb-lora">{{$vendor->name}}</strong><br />
                                {{$vendor->street}} <br />
                                {{$vendor->postalCode}} {{$vendor->city}}
                        </address>
                </div>
                <div class="col-md-6 col-lg-3 mt-3">
                        <a href="tel:{{$vendor->telephone}}">{{$vendor->telephone}}</a><br />
                        <a href="mailto:{{$vendor->email}}">{{$vendor->email}}</a><br />
                        <a href="{{$vendor->website}}">{{$vendor->website}}</a><br />
                </div>
                <div class="col-md-6 col-lg-3 mt-3">
                        Facebook: <a href="{{$vendor->facebook}}">{{$vendor->facebook}}</a><br />
                        Instagram: <a href="{{$vendor->instagram}}">{{$vendor->instagram}}</a><br />
                </div>
        </div>
</div>
@endsection
