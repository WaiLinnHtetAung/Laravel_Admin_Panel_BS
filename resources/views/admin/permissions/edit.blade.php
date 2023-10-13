@extends('layouts.app')
@section('title', 'Edit Permission')

@section('content')
    <div class="card-head-icon">
        <i class='bx bxs-check-shield' style="color: green"></i>
        <div>Permission Edition</div>
    </div>
    <div class="card mt-3 p-4 mt-3">
        <span class="mb-4">Permission Edition</span>
        <form action="{{ route('admin.permissions.update', $permission->id) }}" method="post" id="permission_edit">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="form-group mb-5">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $permission->name }}">
                    </div>

                    <div>
                        <button class="btn btn-secondary back-btn">Cancel</button>
                        <button class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\UpdatePermissionRequest', '#permission_edit') !!}
@endsection
