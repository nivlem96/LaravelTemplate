@extends('template.default')
@section('content')
    <div @class(['content','register'])>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{route('registerPost')}}" method="post">
            @csrf
            <table>
                <tr>
                    <td><label for="name">@lang('app.label.name')</label></td>
                    <td><input type="text" name="name" id="name"/></td>
                </tr>
                <tr>
                    <td><label for="email">@lang('app.label.email')</label></td>
                    <td><input type="email" name="email" id="email"/></td>
                </tr>
                <tr>
                    <td><label for="password">@lang('app.label.password')</label></td>
                    <td><input type="password" name="password" id="password"/></td>
                </tr>
                {{--                <tr>--}}
                {{--                    <td><label for="password_repeat">@lang('app.label.password_repeat')</label></td>--}}
                {{--                    <td><input type="password" name="password_repeat" id="password_repeat"/></td>--}}
                {{--                </tr>--}}
                <tr>
                    <td></td>
                    <td><input type="submit"></td>
                </tr>
            </table>
        </form>
    </div>
@endsection
