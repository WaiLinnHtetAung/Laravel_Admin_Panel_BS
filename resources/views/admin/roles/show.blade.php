@extends('layouts.app')
@section('title', 'Role Detail')

@section('content')
    <div class="card-head-icon">
        <i class='bx bx-street-view' style="color: #e03517;"></i>
        <div>Role Detail</div>
    </div>

    <div class="card mt-3">
        <div class="d-flex justify-content-between m-3">
            <span>Role Detail</span>

        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="DataTable">
                <tr>
                    <th width="25%">ID</th>
                    <td>{{ $role->id }}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{ $role->name }}</td>
                </tr>
                <tr>
                    <th>Permissions</th>
                    <td>
                        @foreach ($role->permissions as $permission)
                            <span class="badge rounded-pill bg-info">{{ $permission->name ?? '' }}</span>
                        @endforeach
                    </td>
                </tr>
            </table>
            <button class="btn btn-outline-secondary mt-3 back-btn">Back to List</button>
        </div>
    </div>
@endsection
