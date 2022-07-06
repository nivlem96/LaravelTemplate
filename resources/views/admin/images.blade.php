<?php

use App\Models\Log;
use Illuminate\Database\Eloquent\Collection;

/**
 * @var Log[]|Collection $logs
 */
?>
@extends('template.authenticated')
@section('content')
    <div @class(['content','images'])>
        <div class="row">
            <div class="col-md-12">
                <form enctype="multipart/form-data" method="post" action="{{route('postImage')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <label for="image">{{__('validation.attributes.image')}}</label>
                        </div>
                        <div class="col-md-8">
                            <input type="file" name="image" id="image">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-8">
                            <input type="submit">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3"><strong>@lang('validation.attributes.name')</strong></div>
                    <div class="col-md-3"><strong>@lang('validation.attributes.width')</strong></div>
                    <div class="col-md-3"><strong>@lang('validation.attributes.heigth')</strong></div>
                    <div class="col-md-3"><strong>@lang('validation.attributes.created_at')</strong></div>
                </div>
                @foreach($images as $image)
                    <a href="{{route('image',['id'=>$image->id])}}">
                        <div class="row">
                            <div class="col-md-3">{{$image->name}}</div>
                            <div class="col-md-3">{{$image->width}}</div>
                            <div class="col-md-3">{{$image->heigth}}</div>
                            <div class="col-md-3">{{$image->created_at}}</div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
