@extends('laralum::layouts.master')
@section('icon', 'ion-unlocked')
@section('title', __('laralum_roles::general.role_permissions'))
@section('subtitle', __('laralum_roles::general.permissions_desc', ['id' => $role->id, 'total' => $permissions->count()]))
@section('breadcrumb')
    <ul class="uk-breadcrumb">
        <li><a href="{{ route('laralum::index') }}">@lang('laralum_roles::general.home')</a></li>
        <li><a href="{{ route('laralum::roles.index') }}">@lang('laralum_roles::general.role_list')</a></li>
        <li><span>@lang('laralum_roles::general.role_permissions')</span></li>
    </ul>
@endsection
@section('content')
    <div class="uk-container uk-container-large">
        <div uk-grid>
            <div class="uk-width-1-1@s uk-width-1-5@l uk-width-1-3@xl"></div>
            <div class="uk-width-1-1@s uk-width-3-5@l uk-width-1-3@xl">
                <div class="uk-card uk-card-default">
                    <div class="uk-card-header">
                        @lang('laralum_roles::general.available_permissions')
                    </div>
                    <div class="uk-card-body">
                        <form class="uk-form-stacked" method="POST">
                            {{ csrf_field() }}
                            @if(isset($method)) {{ method_field($method) }} @endif
                            <fieldset class="uk-fieldset">
                                   <div class="uk-margin uk-grid">
                                   @foreach($permissions as $permission)
                                       <div class="uk-width-1-1@m uk-width-1-2@l uk-margin-small-bottom">
                                           <label><input class="uk-checkbox" name="{{ $permission->id }}" type="checkbox"  @if($role->hasPermission($permission)) checked @endif> {{ $permission->name }}</label>
                                           <div class="uk-text-meta">
                                               ({{ $permission->slug }})
                                               <br>
                                               {{ $permission->description }}
                                           </div>
                                       </div>
                                   @endforeach
                                   </div>
                                   <div class="uk-margin">
                                       <a href="{{ route('laralum::users.index') }}" class="uk-button uk-button-default uk-align-left"> @lang('laralum_roles::general.cancel')</a>
                                       <button type="submit" class="uk-button uk-button-primary uk-align-right">
                                           <span class="ion-forward"></span>&nbsp; @lang('laralum_roles::general.submit')
                                       </button>
                                   </div>
                               </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            <div class="uk-width-1-1@s uk-width-1-5@l uk-width-1-3@xl"></div>
        </div>
    </div>
@endsection
