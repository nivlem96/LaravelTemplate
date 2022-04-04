@extends('template.default')
@section('content')
    <div @class(['content','forgot-password'])>
        <form action="{{route('password.request.post')}}" method="post">
        @csrf <!-- {{ csrf_field() }} -->
            <table>
                <tr>
                    <td><label for="email">@lang('app.label.email')</label></td>
                    <td><input type="email" name="email" id="email"/></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit"></td>
                </tr>
            </table>
        </form>
    </div>
@endsection
