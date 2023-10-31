<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRoleRequest;
use App\Http\Requests\Admin\UpdateRoleRequest;
use DataTables;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->user()->can('role_access')) {
            abort(403);
        }

        return view('admin.roles.index');
    }

    /**
     * send data using datatable
     */
    public function dataTable()
    {
        $data = Role::query();

        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('plus-icon', function ($each) {
                return null;
            })
            ->addColumn('permissions', function ($each) {
                $permissions = $each->permissions->pluck('name');
                $output = '';
                foreach ($permissions as $name) {
                    $output .= "<span class='badge bg-info rounded-pill me-1 mb-1'>$name</span>";
                }
                return $output;
            })
            ->addColumn('action', function ($each) {
                $show_icon = '';
                $edit_icon = '';
                $del_icon = '';

                if (auth()->user()->can('role_show')) {
                    $show_icon = '<a href="' . route('admin.roles.show', $each->id) . '" class="text-warning me-3"><i class="bx bxs-show fs-4"></i></a>';
                }

                if (auth()->user()->can('role_edit')) {
                    $edit_icon = '<a href="' . route('admin.roles.edit', $each->id) . '" class="text-info me-3"><i class="bx bx-edit fs-4" ></i></a>';

                }

                if (auth()->user()->can('role_delete')) {
                    $del_icon = '<a href="" class="text-danger delete-btn" data-id="' . $each->id . '"><i class="bx bxs-trash-alt fs-4" ></i></a>';

                }

                return '<div class="action-icon text-nowrap">' . $show_icon . $edit_icon . $del_icon . '</div>';
            })
            ->rawColumns(['permissions', 'action'])
            ->make(true);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        DB::beginTransaction();
        try {
            $role = Role::create([
                'name' => $request->name,
            ]);

            $role->givePermissionTo($request->permissions);

            DB::commit();

            return redirect()->route('admin.roles.index')->with('success', 'Role Created Successfully');
        } catch (\Exception $err) {
            return back()->with('fail', 'Something Wrong')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $role = $role->load('permissions');

        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $role = $role->load('permissions');
        $permissions = Permission::pluck('name', 'id');

        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        DB::beginTransaction();
        try {
            $role->update([
                'name' => $request->name,
            ]);

            $old_permissions = $role->permissions->pluck('name')->toArray();
            $role->revokePermissionTo($old_permissions);
            $role->givePermissionTo($request->permissions);

            DB::commit();

            return redirect()->route('admin.roles.index')->with('success', 'Role Updated Successfully');
        } catch (\Exception $err) {
            return back()->with('fail', 'Something Wrong')->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return 'success';
    }
}
