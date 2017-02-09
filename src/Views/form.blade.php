<div class="row">
    <div class="col-md-12 col-lg-6 offset-lg-3">
        <div class="card shadow">
            <div class="card-block">
                <form action="{{$action}}" method="POST">
                    {!! csrf_field() !!}
                    @if(isset($method)) {{ method_field($method) }} @endif
                    @php
                        $fields = ['name', 'color'];
                    @endphp
                    @foreach ($fields as $field)
                        <div class="form-group">
                            <label for="{{ $field }}">{{ ucfirst($field) }}</label>
                            <input type="text" name="{{ $field }}" value="{{ old($field, isset($role->$field) ? $role->$field : '' ) }}" class="form-control" id="{{ $field }}">
                            <strong class="text-danger">{{ $errors->first($field) }}</strong>
                        </div>
                    @endforeach
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', isset($role->description) ? $role->description : '' ) }}</textarea>
                        <strong class="text-danger">{{ $errors->first('description') }}</strong>
                    </div>
                    <a href="{{ $cancel }}" class="btn btn-warning float-left">Cancel</a>
                    <button type="submit" class="btn btn-success float-right clickable">{{ $button }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
