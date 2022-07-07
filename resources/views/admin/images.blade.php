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
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
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
                    <div class="col-md-2"><strong>@lang('validation.attributes.dimensions')</strong></div>
                    <div class="col-md-2"><strong>@lang('validation.attributes.size')</strong></div>
                    <div class="col-md-2"><strong>@lang('validation.attributes.created_at')</strong></div>
                    <div class="col-md-3"><strong>@lang('app.actions')</strong></div>
                </div>
                @foreach($images as $image)
                    <div class="row">
                        <div class="col-md-3">
                            <a href="{{route('image',['id'=>$image->id])}}">{{$image->name}}</a></div>
                        <div class="col-md-2">{{$image->width}} x {{$image->height}}</div>
                        <div class="col-md-2">{{$image->size}}</div>
                        <div class="col-md-2">{{$image->created_at}}</div>
                        <div class="col-md-3"><a href="{{route('deleteImage',['id'=>$image->id])}}">{{__('app.action.delete')}}</a></div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
