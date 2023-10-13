@extends('layouts.app')
@section('title', 'Edit Role')

@section('content')
    <div class="card-head-icon">
        <i class='bx bx-street-view' style="color: #e03517;"></i>
        <div>Roles Edition</div>
    </div>
    <div class="card mt-3 p-4">
        <span class="mb-4">Roles Edition</span>

        <form action="{{ route('admin.roles.update', $role->id) }}" method="post" id="role_edit">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-4 col-md-5 col-sm-12 col-12">
                    <div class="form-group mb-4">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $role->name, old('name') }}">
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
                                <option value="{{ $permission }}"
                                    {{ in_array($permission, old('permissions', [])) || $role->permissions->contains($id) ? 'selected' : '' }}>
                                    {{ $permission }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="mt-5">
                <button class="btn btn-secondary back-btn">Cancel</button>
                <button class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\UpdateRoleRequest', '#role_edit') !!}
    <script>
        $(document).ready(function() {
            $(document).on('click', '.select-all', function() {
                $('.select2 > option').prop("selected", true);
                $('.select2 > option').trigger("change");
            })

            $(document).on('click', '.disselect-all', function() {
                $('.select2 > option').prop("selected", false);
                $('.select2 > option').trigger("change");
            })
        })
    </script>
@endsection
