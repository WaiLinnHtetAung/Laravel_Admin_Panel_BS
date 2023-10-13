@extends('layouts.app')
@section('title', 'Permissions Detail')

@section('content')
    <div class="card-head-icon">
        <i class='bx bxs-check-shield' style="color: green"></i>
        <div>Permissions Detail</div>
    </div>

    <div class="card mt-3">
        <div class="d-flex justify-content-between m-3">
            <span>Permissions Detail</span>

        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="DataTable">
                <tr>
                    <td width="20%">ID</td>
                    <td>{{ $permission->id }}</td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>{{ $permission->name }}</td>
                </tr>
            </table>
            <button class="btn btn-outline-secondary mt-3 back-btn">Back to List</button>
        </div>
    </div>
@endsection
