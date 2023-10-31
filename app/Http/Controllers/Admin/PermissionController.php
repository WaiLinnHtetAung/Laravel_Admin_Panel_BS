<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePermissionRequest;
use App\Http\Requests\Admin\UpdatePermissionRequest;
use DataTables;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->user()->can('permission_access')) {
            abort(403);
        }
        return view('admin.permissions.index');
    }

    /**
     * send data with datatable
     */
    public function dataTable()
    {
        $data = Permission::query();

        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('plus-icon', function ($each) {
                return null;
            })
            ->addColumn('action', function ($each) {
                $show_icon = '';
                $edit_icon = '';
                $del_icon = '';

                if (auth()->user()->can('permission_show')) {
                    $show_icon = '<a href="' . route('admin.permissions.show', $each->id) . '" class="text-warning me-3"><i class="bx bxs-show fs-4"></i></a>';
                }

                if (auth()->user()->can('permission_edit')) {
                    $edit_icon = '<a href="' . route('admin.permissions.edit', $each->id) . '" class="text-info me-3"><i class="bx bx-edit fs-4" ></i></a>';
                }

                if (auth()->user()->can('permission_delete')) {
                    $del_icon = '<a href="" class="text-danger delete-btn" data-id="' . $each->id . '"><i class="bx bxs-trash-alt fs-4" ></i></a>';

                }

                return '<div class="action-icon">' . $show_icon . $edit_icon . $del_icon . '</div>';
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePermissionRequest $request)
    {
        Permission::create($request->all());

        return redirect()->route('admin.permissions.index')->with('success', 'Successfully Created !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        return view('admin.permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', compact('permission'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        $permission->update($request->all());

        return redirect()->route('admin.permissions.index')->with('success', 'Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return 'success';
    }
}
