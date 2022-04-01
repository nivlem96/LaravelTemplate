@extends('template.default')
@section('content')
    <div @class(['content','dashboard'])>
        <p>{{__('app.message.logged_in')}}</p>
    </div>
@endsection
