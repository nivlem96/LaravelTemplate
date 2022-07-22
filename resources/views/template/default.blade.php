<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('template.includes.head')
<body>
<div @class(['page'])>
    @include('template.includes.header')
    <div @class(['container'])>
        @yield('content')
    </div>
    @include('template.includes.footer')
</div>
@include('template.includes.scripts')
</body>
</html>
