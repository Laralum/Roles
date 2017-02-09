@extends('laralum::layouts.master')
@section('icon', 'mdi-plus-circle')
@section('title', 'Create role')
@section('subtitle', 'Create a new role to the database')
@section('content')
    @include('laralum_roles::form', [
        'action' => route('laralum::roles.store'),
        'button' => 'Create',
        'cancel' => route('laralum::roles.index')
    ])
@endsection
