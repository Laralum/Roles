@extends('laralum::layouts.master')
@section('icon', 'ion-edit')
@section('title', __('laralum_roles::general.edit_role'))
@section('subtitle', __('laralum_roles::general.edit_desc', ['id' => $role->id, 'time_ago' => $role->created_at->diffForHumans()]))
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
