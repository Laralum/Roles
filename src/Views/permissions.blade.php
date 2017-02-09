@extends('laralum::layouts.master')
@section('icon', 'mdi-key-change')
@section('title', 'Role Permissions')
@section('subtitle', 'Editing role #' . $role->id . ' permissions. Currently ' . $permissions->count() . ' available permissions')
@section('content')
    <div class="row">
        <div class="col col-md-12 col-lg-8 offset-lg-2">
            <div class="card shadow">
                <div class="card-block">
                    <form method="POST">
                        {{ csrf_field() }}
                        <h5>Available Permissions</h5><br />
                        <div class="row">
                            @foreach($permissions as $permission)
                                @php $current = 0; $max = round($permissions->count() / 2); @endphp
                                @if($current == 0 or $current == $max)
                                    <div class="col-md-12 col-lg-6">
                                @endif

                                <div class="form-check">
                                    <label class="custom-control custom-checkbox">
                                        <input name="{{ $permission->id }}" type="checkbox" class="custom-control-input" aria-describedby="{{ $permission->slug }}-desc" @if($role->hasPermission($permission)) checked @endif >
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">{{ $permission->name }}</span>
                                    </label>
                                    <small id="{{ $permission->slug }}-desc" class="form-text text-muted">
                                        {{ $permission->description }}
                                    </small>
                                </div>

                                @if($current == 0 or $current == $max)
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('laralum::roles.index') }}" class="btn btn-warning float-left">Cancel</a>
                                <button type="submit" class="btn btn-success float-right clickable">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
