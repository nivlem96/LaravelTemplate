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
