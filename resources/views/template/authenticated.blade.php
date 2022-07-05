<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('template.includes.head')
<body>
<div @class(['page'])>
    @include('template.includes.header')
    @include('template.includes.auth_menu')
    <div @class(['container'])>
        @yield('content')
    </div>
    @include('template.includes.footer')
</div>
@include('template.includes.scripts')
</body>
</html>
