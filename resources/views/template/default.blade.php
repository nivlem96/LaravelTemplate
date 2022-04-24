<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{env('APP_NAME')}}</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="<?php echo asset('css/app.css')?>" rel="stylesheet" type="text/css">
</head>
<body>
<div @class(['page'])>
    <div @class(['container'])>
        <div @class(['nav-bar'])>
            <ul @class(['nav-bar-nav'])>
                <li @class(['nav-item'])>
                    <form @class(['locale']) action="{{route('localePost')}}" method="post">
                        @csrf <!-- {{ csrf_field() }} -->
                        <label for="locale">Locale:</label>
                        <select class="" id="locale" name="locale" onchange="this.form.submit()">
                            @foreach(\App\Helpers\LanguageHelper::getSupportedLanguages() as $language)
                                <option value="{{$language}}" {{ app()->getLocale() === $language ? "selected" : "" }}>{{__('app.language.' . $language)}}</option>
                            @endforeach
                        </select>
                    </form>
                </li>
                <li @class(['nav-item'])><a href="{{route('home')}}">@lang('app.page.home')</a></li>
                @if(\Illuminate\Support\Facades\Auth::user() !== null)
                    <li @class(['nav-item'])><a href="{{route('dashboard')}}">{{\Illuminate\Support\Facades\Auth::user()->name}}</a></li>
                    @if(\Illuminate\Support\Facades\Auth::user()->can(['user',\App\Models\Permission::KEY_ACCESS_OTHER]))
                        <li><a href="{{route('users')}}">@lang('app.page.users')</a></li>
                    @endif
                    <li @class(['nav-item'])><a href="{{route('signOut')}}">@lang('app.page.sign_out')</a></li>
                @else
                    <li @class(['nav-item'])><a href="{{route('login')}}">@lang('app.page.login')</a></li>
                    <li @class(['nav-item'])><a href="{{route('register')}}">@lang('app.page.register')</a></li>
                @endif
            </ul>
        </div>
        @yield('content')
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="<?php echo asset('js/app.js')?>"></script>
</body>
</html>
