@extends('laralum::layouts.master')
@section('icon', 'ion-plus-round')
@section('title', __('laralum_roles::general.create_role'))
@section('subtitle', __('laralum_roles::general.create_role_desc'))
@section('breadcrumb')
    <ul class="uk-breadcrumb">
        <li><a href="{{ route('laralum::index') }}">@lang('laralum_roles::general.home')</a></li>
        <li><a href="{{ route('laralum::roles.index') }}">@lang('laralum_roles::general.role_list')</a></li>
        <li><span>@lang('laralum_roles::general.create_role')</span></li>
    </ul>
@endsection
@section('content')
    @include('laralum_roles::form', [
        'title' =>  __('laralum_roles::general.create_role'),
        'action' => route('laralum::roles.store'),
        'button' => __('laralum_roles::general.create'),
        'cancel' => route('laralum::roles.index')
    ])
@endsection
