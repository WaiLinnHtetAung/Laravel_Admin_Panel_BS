@extends('layouts.app')
@section('title', 'User Detail')

@section('content')
    <div class="card-head-icon">
        <i class='bx bxs-user' style="color: rgb(8, 184, 8);"></i>
        <div>User Detail</div>
    </div>

    <div class="card mt-3">
        <div class="d-flex justify-content-between m-3">
            <span>User Detail</span>

        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="DataTable">
                <tr>
                    <th width="25%">ID</th>
                    <td>{{ $user->id }}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>Roles</th>
                    <td>
                        @foreach ($user->roles as $role)
                            <span class="badge rounded-pill bg-info">{{ $role->name ?? '' }}</span>
                        @endforeach
                    </td>
                </tr>
            </table>
            <button class="btn btn-outline-secondary mt-3 back-btn">Back to List</button>
        </div>
    </div>
@endsection
