<?php

use App\Models\Log;

/**
 * @var Log $log
 */
?>
@extends('template.authenticated')
@section('content')
    <div @class(['content','shipment-form'])>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-2">
                        <strong>{{__('validation.attributes.code')}}</strong>
                    </div>
                    <div class="col-md-10">
                        {{$log->code}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <strong>{{__('validation.attributes.file')}}</strong>
                    </div>
                    <div class="col-md-10">
                        {{$log->file}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <strong>{{__('validation.attributes.line')}}</strong>
                    </div>
                    <div class="col-md-10">
                        {{$log->line}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <strong>{{__('validation.attributes.message')}}</strong>
                    </div>
                    <div class="col-md-10">
                        {{$log->message}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <strong>{{__('validation.attributes.trace')}}</strong>
                    </div>
                    <div class="col-md-10">
                        @foreach($log->trace as $traceLine)
                            <div @class(['row'])>
                                <div @class(['col-md-12'])>
                                    {{$traceLine['file'] . ':' . $traceLine['line']}}
                                </div>
                                <div @class(['col-md-12'])>
                                    {{$traceLine['function']}}
                                </div>
                                @if($traceLine['class'] ?? false)
                                    <div @class(['col-md-12'])>
                                        {{$traceLine['class']}}
                                    </div>
                                @endif
                                @if($traceLine['args'] ?? false)
                                    <div @class(['col-md-12'])>
                                        {{json_encode($traceLine['args'])}}
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
