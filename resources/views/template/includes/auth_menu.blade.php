<div @class(['menu','auth_menu', 'full-height'])>
    @if(auth()->hasUser())
        <ul>
            @if(auth()->user()->can(['User',\App\Models\Permission::KEY_ACCESS]))
                <li><a href="{{route('dashboard')}}">{{__('app.page.account')}}</a></li>
            @endif
            @if(auth()->user()->can(['User',\App\Models\Permission::KEY_ACCESS_OTHER]))
                <li><a href="{{route('users')}}">{{__('app.page.users')}}</a></li>
            @endif
            @if(auth()->user()->can(['Log',\App\Models\Permission::KEY_ACCESS]))
                <li><a href="{{route('logs')}}">{{__('app.page.logs')}}</a></li>
            @endif
            @if(auth()->user()->can(['PageView',\App\Models\Permission::KEY_ACCESS]))
                <li><a href="{{route('adminPageViews')}}">{{__('app.page.page_views')}}</a></li>
            @endif
            @if(auth()->user()->can(['Image',\App\Models\Permission::KEY_ACCESS]))
                <li><a href="{{route('images')}}">{{__('app.page.images')}}</a></li>
            @endif
        </ul>
    @endif
</div>
