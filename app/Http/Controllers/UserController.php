<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasRole('superadmin')) {
            $roles = Role::whereNotIn('name', ['superadmin'])->get();
        } elseif (Auth::user()->hasRole('admin')) {
            $roles = Role::whereNotIn('name', ['superadmin', 'admin'])->get();
        }
        return view('user.list', compact('roles'));
    }

    public function datatables_user(Request $request)
    {
        if ($request->ajax()) {
            $data = User::with('roles')->whereNot('name', 'superadmin')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('info', function ($value) {
                    return '<div class="row">
                        <div class="col-lg-3">Nama Lengkap</div>
                        <div class="col-lg-9">: ' . Str::upper($value->name) . '</div>
                        <div class="col-lg-3">Email</div>
                        <div class="col-lg-9">: ' . $value->email . '</div>
                    </div>';
                })
                ->addColumn('level', function ($value) {
                    return Str::upper(implode("", $value->getRoleNames()->toArray()));
                })
                ->addColumn('action', function ($value) {
                    $actionBtn = '<div class="dropdown">
                        <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aksi</button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a href="javascript:void(0)" class="dropdown-item" data-id="' . $value->id . '" id="btn-editUser">Edit</a>
                            <a href="javascript:void(0)" class="dropdown-item" data-id="' . $value->id . '" id="btn-deleteUser">Hapus</a>
                        </div>
                    </div>';
                    return $actionBtn;
                })
                ->rawColumns(['info', 'level', 'action'])
                ->make(true);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => Rule::when($request->id, 'required|string|email|max:255', 'required|string|email|max:255|unique:users'),
            'password' => 'required|string|min:6|confirmed',
            'level'    => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => FALSE,
                'error' => $validator->errors()->toArray()
            ]);
        }

        $data = [
            'name'     => $request->name,
            'email'    => $request->email,
        ];

        if ($request->id) {
            $user = User::find($request->id);
            User::where('id', $request->id)->update($data);
            $user->syncRoles($request->level);

            return response()->json([
                'status' => TRUE,
                'message' => 'Data berhasil diubah'
            ], 200);
        } else {
            $data['password'] = bcrypt($request->password);
            $data['created_at'] = date('Y-m-d H:i:s');
            $user = User::create($data);
            $user->syncRoles($request->level);

            return response()->json([
                'status' => TRUE,
                'message' => 'Data berhasil ditambahkan'
            ], 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user->roles->first();
        return response()->json([
            'data' => $user,
            'status' => true
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        return response()->json([
            'status' => true
        ], 200);
    }
}
