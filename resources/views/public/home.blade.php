@extends('template.default')
@section('content')
    <div @class(['content','home'])>
        <p>{{__('app.message.welcome')}}</p>
    </div>
@endsection
