<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class AdminRoleController extends Controller
{
    private $role;
    private $permission;
    public function __construct(Role $role,Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }

    public function index(){
        $roles = $this->role->paginate(10);
        return view('admin.role.index',compact('roles'));
    }

    public function create(){
        $permissionsParent = $this->permission->where('parent_id',0)->get();
        return view('admin.role.add',compact('permissionsParent'));
    }

    public function store(Request $request){
       $role = $this->role->create([
            'name' => $request -> name,
            'display_name' => $request -> display_name
        ]);

       $role->permissions()->attach($request->permission_id);

       return redirect()->route('roles.index');
    }

    public function edit($id){
        $permissionsParent = $this->permission->where('parent_id',0)->get();
        $role = $this->role->find($id);
        $permissionsChecked = $role->permissions;
        return view('admin.role.edit',compact('permissionsParent','role','permissionsChecked'));
    }

    public function update(Request $request,$id){
         $this->role->find($id)->update([
            'name' => $request -> name,
            'display_name' => $request -> display_name
        ]);
        $role = $this->role->find($id);
        $role->permissions()->sync($request->permission_id);

        return redirect()->route('roles.index');
    }

    public function delete($id){
        try {
            $this->role->find($id)->delete();
            return response()->json([
                'code'=>200,
                'message'=>'success'
            ],200);

        }catch (\Exception $exception){
            Log::error('Message:'.$exception->getMessage().'--- Line'.$exception->getLine());
            return response()->json([
                'code'=>500,
                'message'=>'fail'
            ],500);
        }
    }
}
