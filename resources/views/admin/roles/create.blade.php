@extends('layouts.app')
@section('title', 'Create Role')

@section('content')
    <div class="card-head-icon">
        <i class='bx bx-street-view' style="color: #e03517;"></i>
        <div>Roles Creation</div>
    </div>
    <div class="card mt-3 p-4">
        <span class="mb-4">Roles Creation</span>

        <form action="{{ route('admin.roles.store') }}" method="post" id="role_create">
            @csrf
            <div class="row">
                <div class="col-lg-4 col-md-5 col-sm-12 col-12">
                    <div class="form-group mb-4">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Permission <span class="text-muted">(Please Select)</span></label>
                        <div class="mb-2">
                            <span class="text-white p-1 rounded-1 cursor-pointer select-all"
                                style="font-size: 12px; background: rgb(27, 199, 170);">Select
                                All</span>
                            <span class="text-white p-1 rounded-1 cursor-pointer disselect-all"
                                style="font-size: 12px; background: rgb(27, 199, 170);">Disselect
                                All</span>
                        </div>
                        <select name="permissions[]" id="permissions" class="select2 form-control" multiple="multiple">
                            @foreach ($permissions as $id => $permission)
                                <option value="{{ $permission->name }}"
                                    {{ in_array($permission->name, old('permissions', [])) ? 'selected' : '' }}>
                                    {{ $permission->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="mt-5">
                <button class="btn btn-secondary back-btn">Cancel</button>
                <button class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\StoreRoleRequest', '#role_create') !!}

@endsection
