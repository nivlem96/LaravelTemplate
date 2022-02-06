<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="<?php echo asset('css/app.css')?>" rel="stylesheet" type="text/css">
</head>
<body>
<div @class(['page'])>
    <div @class(['container'])>
        <div @class(['nav-bar'])>
            <ul @class(['nav-bar-nav'])>
                <li @class(['nav-item'])>
                    <form @class(['locale']) action="{{url('/locale')}}" method="post">
                    @csrf <!-- {{ csrf_field() }} -->
                        <label for="locale">Locale:</label>
                        <select class="" id="locale" name="locale" onchange="this.form.submit()">
                            <option value=""></option>
                            <option value="en">{{__('app.language.en')}}</option>
                            <option value="nl">{{__('app.language.nl')}}</option>
                        </select>
                    </form>
                </li>
            </ul>
        </div>
        @yield('content')
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="<?php echo asset('js/app.js')?>"></script>
</body>
</html>
