@extends('layouts.app')
@section('title', 'Create Permission')

@section('content')
    <div class="card-head-icon">
        <i class='bx bxs-check-shield' style="color: green"></i>
        <div>Create Permission</div>
    </div>
    <div class="card mt-3 p-4 mt-3">
        <span class="mb-4">Permission Creation</span>
        <form action="{{ route('admin.permissions.store') }}" method="post" id="permission_create">
            @csrf
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="form-group mb-3">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name">
                    </div>

                    <div>
                        <button class="btn btn-secondary back-btn">Cancel</button>
                        <button class="btn btn-primary">Create</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\StorePermissionRequest', '#permission_create') !!}
@endsection
