@extends('errors::minimal')

@section('title', __('errors.page.maintenance.title'))
@section('code', '503')
@section('message', __('errors.page.maintenance.body'))
