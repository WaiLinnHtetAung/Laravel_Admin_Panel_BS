<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\User;
use DataTables;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->user()->can('user_access')) {
            abort(403);
        }

        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    public function dataTable()
    {
        $data = User::query();

        return Datatables::of($data)
            ->editColumn('plus-icon', function ($each) {
                return null;
            })
            ->addIndexColumn()
            ->addColumn('role', function ($each) {
                $roles = $each->roles->pluck('name');
                $output = '';
                foreach ($roles as $name) {
                    $output .= "<span class='badge bg-info rounded-pill me-1 mb-1'>$name</span>";
                }
                return $output;

            })
            ->addColumn('action', function ($each) {
                $show_icon = '';
                $edit_icon = '';
                $del_icon = '';

                if (auth()->user()->can('user_show')) {
                    $show_icon = '<a href="' . route('admin.users.show', $each->id) . '" class="text-warning me-3"><i class="bx bxs-show fs-4"></i></a>';
                }

                if (auth()->user()->can('user_edit')) {
                    $edit_icon = '<a href="' . route('admin.users.edit', $each->id) . '" class="text-info me-3"><i class="bx bx-edit fs-4" ></i></a>';
                }

                if (auth()->user()->can('user_delete')) {
                    $del_icon = '<a href="" class="text-danger delete-btn" data-id="' . $each->id . '"><i class="bx bxs-trash-alt fs-4" ></i></a>';
                }

                return '<div class="action-icon">' . $show_icon . $edit_icon . $del_icon . '</div>';
            })
            ->rawColumns(['role', 'action'])
            ->make(true);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::pluck('name', 'id');
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = User::create($request->all());

            $user->syncRoles($request->roles);

            DB::commit();

            return redirect()->route('admin.users.index')->with('success', 'User Created Successfully');
        } catch (\Exception $err) {
            dd($err->getMessage());
            return back()->with('fail', 'Something Wrong')->withInput();
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user = $user->load('roles');

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'id');
        $user = $user->load('roles');

        return view('admin.users.edit', compact('roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        DB::beginTransaction();
        try {
            $user->update($request->all());

            $user->syncRoles($request->roles);

            DB::commit();

            return redirect()->route('admin.users.index')->with('success', 'User Updated Successfully');
        } catch (\Exception $err) {
            dd($err->getMessage());
            return back()->with('fail', 'Something Wrong')->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
