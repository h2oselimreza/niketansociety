<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserGroupController extends Controller
{
    public function index(){
        //$users = User::select(['id','username','full_name','email','contact_no','user_group','is_active'])->get();
        return view('admin.user_groups.index');
    }

    public function getUserGroups(Request $request)
    {
        if ($request->ajax()) {

            $userGroups = UserGroup::select([
                'id',
                'group_name',
                'is_active'
            ]);

            return DataTables::of($userGroups)

                ->addIndexColumn()

                ->addColumn('is_active', function ($userGroups) {
                    return $userGroups->is_active
                        ? 'Active'
                        : 'Inactive';
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
