@extends('template.default')
@section('content')
    <div @class(['content','home'])>
        <div @class(['row'])>
            <div @class(['col-12'])>
                <h1>{{__('app.title.home')}}</h1>
            </div>
        </div>
        <div @class(['row'])>
            <div @class(['col-12'])>
                {!! __('app.message.home') !!}
            </div>
        </div>
    </div>
@endsection
