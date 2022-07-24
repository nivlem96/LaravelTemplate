<?php

use Illuminate\Database\Eloquent\Collection;

/**
 * @var PageView[]|Collection $pageViews
 */
?>
@extends('template.authenticated')
@section('content')
    <div @class(['content','order-success'])>
        <div class="row">
            <div class="col-md-4">
                <strong>@lang('app.page_views.label.unique.day')</strong>
            </div>
            <div class="col-md-8">
                {{\App\Models\PageView::getPageViewDashboard(1,true)}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <strong>@lang('app.page_views.label.total.day')</strong>
            </div>
            <div class="col-md-8">
                {{\App\Models\PageView::getPageViewDashboard(1,false)}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <strong>@lang('app.page_views.label.unique.week')</strong>
            </div>
            <div class="col-md-8">
                {{\App\Models\PageView::getPageViewDashboard(7,true)}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <strong>@lang('app.page_views.label.total.week')</strong>
            </div>
            <div class="col-md-8">
                {{\App\Models\PageView::getPageViewDashboard(7,false)}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <strong>@lang('app.page_views.label.unique.month')</strong>
            </div>
            <div class="col-md-8">
                {{\App\Models\PageView::getPageViewDashboard(31,true)}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <strong>@lang('app.page_views.label.total.month')</strong>
            </div>
            <div class="col-md-8">
                {{\App\Models\PageView::getPageViewDashboard(31,false)}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3"><strong>@lang('validation.attributes.ip')</strong></div>
                    <div class="col-md-3"><strong>@lang('validation.attributes.user_agent')</strong></div>
                    <div class="col-md-5"><strong>@lang('validation.attributes.uri')</strong></div>
                    <div class="col-md-1"><strong>@lang('validation.attributes.created_at')</strong></div>
                </div>
                @foreach($pageViews as $pageView)
                    <div class="row">
                        <div class="col-md-3">{{$pageView->ip}}</div>
                        <div class="col-md-3">{{$pageView->user_agent}}</div>
                        <div class="col-md-5">{{$pageView->uri}}</div>
                        <div class="col-md-1">{{$pageView->created_at}}</div>
                    </div>
                @endforeach
            </div>
        </div>
        {{$pageViews->links()}}
    </div>
@endsection
