@extends('laralum::layouts.master')
@section('icon', 'mdi-pencil-circle')
@section('title', 'Edit role')
@section('subtitle', "You're editing role #" . $role->id . " created " . $role->created_at->diffForHumans())
@section('content')
    @include('laralum_roles::form', [
        'action' => route('laralum::roles.update', ['role' => $role]),
        'button' => 'Edit',
        'method' => 'PATCH',
        'role' => $role,
        'cancel' => route('laralum::roles.index')
    ])
@endsection
