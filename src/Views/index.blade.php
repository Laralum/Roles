@extends('laralum::layouts.master')
@section('icon', 'mdi-svg')
@section('title', 'Roles')
@section('subtitle', 'Roles will allow you to bind users into categories creating independent permissions for each user.')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-block">
                    <h5>Quick Actions</h5><br />
                    <a class="btn btn-success" href="{{ route('laralum::roles.create') }}">Create Role</a>
                    <a class="btn btn-primary disabled" href="#">Roles Settings</a>
                    <br />
                </div>
            </div>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col col-md-12">
            <div class="card shadow">
                <div class="card-block">
                    @if ($roles->count() == 0)
                        <center>
                            <br /><br />
                            <h3>There are no roles yet</h3>
                            <h1 class="mdi mdi-emoticon-sad"></h1>
                            <br />
                        </center>
                    @else
                        <h5>Role list</h5><br />
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <th>{{ $role->id }}</th>
                                            <td>
                                                <span style="color: {{ $role->color }}">{{ $role->name }}</span>
                                            </td>
                                            <td>{{ $role->description }}</td>
                                            <td>
                                                <a href="{{ route('laralum::roles.edit', ['id' => $role->id]) }}" class="btn btn-primary btn-sm">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>
                                                <a href="{{ route('laralum::roles.permissions', ['id' => $role->id]) }}" class="btn btn-primary btn-sm">
                                                    <i class="mdi mdi-key-variant"></i>
                                                </a>
                                                <a href="{{ route('laralum::roles.destroy.confirm', ['id' => $role->id]) }}" class="btn btn-danger btn-sm">
                                                    <i class="mdi mdi-delete"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
