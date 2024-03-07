<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class AdminUserController extends Controller
{

    private $user;
    private $role;
    public function __construct(User $user,Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }

    public function index(){
        $users = $this->user->paginate(10);
        return view('admin.user.index',compact('users'));


    }

    public function create(){
        $roles= $this->role->all();

        return view('admin.user.add',compact('roles'));
    }

    public function store(Request $request){
        try {
            DB::beginTransaction();
            $user = $this->user->create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=> Hash::make($request->password)
            ]);
            $roleIds = $request->role_id;
            $user->roles()->attach($roleIds);
            DB::commit();
            return redirect()->route('users.index');
        }catch (\Exception $exception){
            DB::rollBack();
            Log::error('Message:'.$exception->getMessage().'--- Line'.$exception->getLine());
        }
    }

    public function edit($id){
        $roles= $this->role->all();
        $user = $this->user->find($id);
        $rolesOfUser = $user->roles;
        return view('admin.user.edit',compact('roles','user','rolesOfUser'));
    }

    public function update(Request $request,$id){
        try {
            DB::beginTransaction();
            $this->user->find($id)->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=> Hash::make($request->password)
            ]);
            $user = $this->user->find($id);
            $roleIds = $request->role_id;
            $user->roles()->sync($roleIds);
            DB::commit();
            return redirect()->route('users.index');
        }catch (\Exception $exception){
            DB::rollBack();
            Log::error('Message:'.$exception->getMessage().'--- Line'.$exception->getLine());
        }
    }

    public function delete($id){
        try {
            $this->user->find($id)->delete();
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
