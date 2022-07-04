@extends('template.default')
@section('content')
    <div @class(['content','password-reset'])>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{route('password.reset.post')}}" method="post">
            <input name="token" id="oken" type="hidden" value="{{$token}}">
            @csrf <!-- {{ csrf_field() }} -->
            <table>
                @error('token')
                <tr>
                    <td colspan="2">
                        <div class="error">{{ $message }}</div>
                    </td>
                </tr>
                @enderror
                <tr>
                    <td><label for="email">@lang('app.label.email')</label></td>
                    <td><input type="email" name="email" id="email"/></td>
                </tr>
                @error('email')
                <tr>
                    <td colspan="2">
                        <div class="error">{{ $message }}</div>
                    </td>
                </tr>
                @enderror
                <tr>
                    <td><label for="password">@lang('app.label.password')</label></td>
                    <td><input type="password" name="password" id="password"/></td>
                </tr>
                @error('password')
                <tr>
                    <td colspan="2">
                        <div class="error">{{ $message }}</div>
                    </td>
                </tr>
                @enderror
                <tr>
                    <td><label for="password_confirmation">@lang('app.label.password.confirmation')</label></td>
                    <td><input type="password" name="password_confirmation" id="password_confirmation"/></td>
                </tr>
                @error('password_confirmation')
                <tr>
                    <td colspan="2">
                        <div class="error">{{ $message }}</div>
                    </td>
                </tr>
                @enderror
                <tr>
                    <td></td>
                    <td><input type="submit"></td>
                </tr>
            </table>
        </form>
    </div>
@endsection
