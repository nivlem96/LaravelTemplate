<div @class(['menu','auth_menu', 'full-height'])>
    @if(auth()->hasUser())
        <ul>
            <li><a href="{{route('dashboard')}}">{{__('app.page.account')}}</a></li>
            @if(auth()->user()->can(['Log',\App\Models\Permission::KEY_ACCESS]))
                <li><a href="{{route('logs')}}">{{__('app.page.logs')}}</a></li>
            @endif
            @if(auth()->user()->can(['User',\App\Models\Permission::KEY_ACCESS_OTHER]))
                <li><a href="{{route('users')}}">{{__('app.page.users')}}</a></li>
            @endif
        </ul>
    @endif
</div>
