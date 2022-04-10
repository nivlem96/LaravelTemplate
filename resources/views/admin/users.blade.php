<?php
/**
 * @var Collection|User[] $users
 * @var User $authUser
 */

use App\Models\User;
use Ramsey\Collection\Collection;

?>
@extends('template.default')
@section('content')
    <div @class(['content','users'])>
        <p>{{__('app.message.users')}}</p>

        <table>
            <tr>
                <th>@lang('app.label.name')</th>
                <th>@lang('app.label.actions')</th>
            </tr>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    @if(($user->id === $authUser->id && $authUser->can('User',\App\Models\Permission::KEY_DELETE)) || $authUser->can(['User',\App\Models\Permission::KEY_DELETE_OTHER]))
                        <td><a href="{{route('deleteUser',$user->id)}}">@lang('app.action.delete')</a></td>
                    @endif
                </tr>
            @endforeach
        </table>
    </div>
@endsection
