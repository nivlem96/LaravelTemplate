@extends('template.default')
@section('content')
    <div @class(['content','login'])>
        <form action="/login" method="post">
        @csrf <!-- {{ csrf_field() }} -->
            <table>
                <tr>
                    <td><label for="email">@lang('app.label.email')</label></td>
                    <td><input type="email" name="email" id="email"/></td>
                </tr>
                <tr>
                    <td><label for="password">@lang('app.label.password')</label></td>
                    <td><input type="password" name="password" id="password"/></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit"></td>
                </tr>
            </table>
        </form>
    </div>
@endsection
