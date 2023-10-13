@extends('layouts.app')
@section('title', 'Create User')

@section('content')
    <div class="card-head-icon">
        <i class='bx bxs-user' style="color: rgb(8, 184, 8);"></i>
        <div>User Creation</div>
    </div>
    <div class="card mt-3 p-4">
        <span class="mb-4">User Creation</span>

        <form action="{{ route('admin.users.store') }}" method="post" id="user_create">
            @csrf
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="form-group mb-4">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="form-group mb-4">
                        <label for="">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <div class="form-group">
                        <label for="">Roles <span class="text-muted">(Please Select)</span></label>
                        <div class="mb-2">
                            <span class="text-white p-1 rounded-1 cursor-pointer select-all"
                                style="font-size: 12px; background: rgb(27, 199, 170);">Select
                                All</span>
                            <span class="text-white p-1 rounded-1 cursor-pointer disselect-all"
                                style="font-size: 12px; background: rgb(27, 199, 170);">Disselect
                                All</span>
                        </div>
                        <select name="roles[]" id="roles" class="select2 form-control" multiple="multiple">
                            @foreach ($roles as $id => $role)
                                <option value="{{ $role }}"
                                    {{ in_array($role, old('roles', [])) ? 'selected' : '' }}>
                                    {{ $role }}
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
    {!! JsValidator::formRequest('App\Http\Requests\Admin\StoreUserRequest', '#user_create') !!}

@endsection
