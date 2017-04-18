@php
    $roles = \Laralum\Roles\Models\Role::all();
    $values = $roles->map(function($role) {
        return $role->users->count();
    })->toArray();
@endphp
@if ( count($values) <= 0 || collect($values)->sum() <= 0)
    <div style="height: 400px; position: relative;">
        <center>
            @lang('laralum_roles::general.role_users_c')
        </center>
        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
            <center>
                <i class="ion-sad-outline" style="font-size: 100px;"></i><br />
                <span>@lang('laralum_roles::general.no_data')</span>
            </center>
        </div>
    </div>
@else
    {!!
        \ConsoleTVs\Charts\Facades\Charts::create('pie', 'highcharts')
            ->title(__('laralum_roles::general.role_users_c'))->dimensions(0, 400)
            ->labels($roles->pluck('name')->toArray())
            ->values($values)
            ->colors($roles->pluck('color')->toArray())
            ->render()
    !!}
@endif
