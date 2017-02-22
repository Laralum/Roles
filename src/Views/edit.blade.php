@extends('laralum::layouts.master')
@section('icon', 'ion-edit')
@section('title', __('laralum_roles::general.edit_role'))
@section('subtitle', __('laralum_roles::general.edit_desc', ['id' => $role->id, 'time_ago' => $role->created_at->diffForHumans()]))
@section('breadcrumb')
    <ul class="uk-breadcrumb">
        <li><a href="{{ route('laralum::index') }}">@lang('laralum_roles::general.home')</a></li>
        <li><a href="{{ route('laralum::roles.index') }}">@lang('laralum_roles::general.role_list')</a></li>
        <li><span>@lang('laralum_roles::general.create_role')</span></li>
    </ul>
@endsection
@section('content')
    @include('laralum_roles::form', [
        'action' => route('laralum::roles.update', ['role' => $role]),
        'button' => __('laralum_roles::general.edit'),
        'title' => __('laralum_roles::general.edit_role', ['id' => $role->id]),
        'method' => 'PATCH',
        'role' => $role,
        'cancel' => route('laralum::roles.index')
    ])
@endsection
