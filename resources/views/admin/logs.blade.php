<?php

use App\Models\Log;
use Illuminate\Database\Eloquent\Collection;

/**
 * @var Log[]|Collection $logs
 */
?>
@extends('template.authenticated')
@section('content')
    <div @class(['content','order-success'])>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-2"><strong>@lang('validation.attributes.code')</strong></div>
                    <div class="col-md-7"><strong>@lang('validation.attributes.message')</strong></div>
                    <div class="col-md-3"><strong>@lang('validation.attributes.created_at')</strong></div>
                </div>
                @foreach($logs as $log)
                    <a href="{{route('log',['id'=>$log->id])}}">
                        <div class="row">
                            <div class="col-md-2">{{$log->code}}</div>
                            <div class="col-md-7">{{$log->message}}</div>
                            <div class="col-md-3">{{$log->created_at}}</div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
