<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(){
        //$users = User::select(['id','username','full_name','email','contact_no','user_group','is_active'])->get();
        return view('admin.users.userList');
    }

    public function getUsers(Request $request)
    {
        if ($request->ajax()) {

            $users = User::select([
                'id',
                'username',
                'full_name',
                'contact_no',
                'email',
                'user_group',
                'is_active'
            ]);

            return DataTables::of($users)

                ->addIndexColumn()

                ->addColumn('status', function ($user) {
                    return $user->is_active
                        ? '<span class="badge bg-success">Active</span>'
                        : '<span class="badge bg-danger">Inactive</span>';
                })

                ->addColumn('action', function ($user) {
                    return '
                        <a href="#"
                           class="btn btn-sm btn-primary">
                           Edit
                        </a>
                    ';
                })

                ->rawColumns(['status', 'action'])
                ->make(true);

                // <a href="'.route('admin.users.edit', $user->id).'"
                //            class="btn btn-sm btn-primary">
                //            Edit
                //         </a>
        }
    }
}
