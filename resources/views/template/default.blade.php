<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{env('APP_NAME')}}</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="<?php echo asset('css/app.css')?>" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<div @class(['page'])>
    <div @class(['header'])>
        <div @class(['row'])>
            <div @class(['col-md-4'])>
                <a href="{{route('home')}}"><img @class(['logo']) src="{{asset('images/logo.png')}}" alt="Logo"/></a>
            </div>
            <div @class(['col-md-8'])>
                <div @class(['nav-bar'])>
                    <ul @class(['nav-bar-nav'])>
                        <li @class(['nav-item'])>
                            <form @class(['locale']) action="{{route('localePost')}}" method="post">
                                @csrf <!-- {{ csrf_field() }} -->
                                <select class="" id="locale" name="locale" onchange="this.form.submit()">
                                    @foreach(\App\Helpers\LocaleHelper::getSupportedLanguages() as $language)
                                        <option value="{{$language}}" {{ app()->getLocale() === $language ? "selected" : "" }}>{{strtoupper($language)}}</option>
                                    @endforeach
                                </select>
                            </form>
                        </li>
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
            </div>
        </div>
    </div>
    <div @class(['container'])>
        @yield('content')
    </div>
    <div @class(['footer'])>
        <div @class(['row'])>
            <div @class(['col-md-4'])>
                <div @class(['row'])>
                    <div @class(['col-12'])>
                        <a href="melvinbeverwijk.nl">Portfolio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="<?php echo asset('js/app.js')?>"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
</body>
</html>
