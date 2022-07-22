<?php

use App\Models\Image;

/**
 * @var Image $image
 */
?>
@extends('template.authenticated')
@section('content')
    <div @class(['content','image'])>
        <div class="row">
            <div class="col-md-12">
                <img src="{{asset($image->path)}}" height="{{$image->height}}" width="{{$image->width}}"/>
            </div>
        </div>
        @if($image->children()->exists())
            @foreach($image->children as $child)
                <div class="row">
                    <div class="col-md-12">
                        <img src="{{asset($child->path)}}" height="{{$child->height}}" width="{{$child->width}}"/>
                    </div>
                </div>
            @endforeach
        @else
            <div class="row">
                <div class="col-md-12">
                    <img src="{{asset(Image::getResizedImage($image->path,100,100))}}" height="100" width="100"/>
                </div>
            </div>
        @endif
    </div>
@endsection
