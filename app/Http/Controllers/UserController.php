<?php

namespace App\Http\Controllers;
use App\Http\Requests\CreatedroleRequest;
use App\Http\Requests\DeleteroleRequest;
use App\Http\Requests\UpdateRequest;
use App\Http\Requests\createduserRequest;
use App\Http\Requests\DeleteuserRequest;
use App\Models\course;
use App\Models\calendar_course;
use App\Models\User;
use App\Models\roles;
use App\Models\users_system;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    public function role_user()
    {
        $count_course = count(course::all());
        $count_class = count(calendar_course::all());
        $count_users = count(User::all());
        $count_student=users_system::where('id_roles',  2)->count();
        $dataroles=roles::all();
  
        return view('role_user')
        ->with('datastudent', $count_student)->with('dataroles', $dataroles)->with('count_course', $count_course)->with('count_class', $count_class)->with('count_users', $count_users);
    }

    public function addRole(CreatedroleRequest $request)
    {
        roles::create(['name' => $request->rolename]);
        return response()->json(['check' => true, 'msg' => 'Thêm thành công']);
    }

    public function deleteRole(DeleteroleRequest $request)
    {
        roles::where('id',  $request->id)
            ->delete();
        return response()->json(['check' => true, 'msg' => 'Xóa loại tài khoản thành công']);
    }

    public function UpdateRole(UpdateRequest $request)
    {
        roles::where('id',  $request->id)
            ->update(['name' => $request->rolename]);
        return response()->json(['check' => true, 'msg' => 'Update loại tài khoản thành công']);
    }

    public function createduserview()
    {
        $datausers=users_system::all();
        $user = DB::table('users_system')
            ->join('roles', 'users_system.id_roles', '=', 'roles.id')
            ->select('users_system.*', 'roles.name as rolename')
            ->get();
        return view('created_user')
        ->with('data_users', $user);
    }
    
    public function select_roles(){
        $datausers=roles::all();
        $user = roles::find(1);
        $a=array();
        $id=array();
        $role= $user->name;
        for ($i=0; $i <count($datausers) ; $i++) {
            if ($datausers[$i]->name!=$role) {
                array_push($a,$datausers[$i]->name);
            } 
        }
        for ($i=0; $i <count($datausers) ; $i++) {
            if ($datausers[$i]->name!=$role) {
                array_push($id,$datausers[$i]->id);
            } 
        }
        return response()->json(['data' => $a,'id'=>$id]);
    }

    public function insert_users(createduserRequest $request)
    {
        users_system::create(['status' => $request->status,'name' => $request->name,'email'=> $request->email,'passwords'=> Hash::make($request->password),'phone'=> $request->phone,'id_roles'=> $request->id_roles]);
        User::create(['name' => $request->name,'email'=> $request->email,'password'=> Hash::make($request->password)]);
        return response()->json(['check' => true, 'msg' => 'Đã thêm tài khoản thành công']);
    }

    public function Updateusers(UpdateRequest $request)
    {
        users_system::where('id',  $request->id)
            ->update(['status' => $request->status,'name' => $request->name,'email'=> $request->email,'phone'=> $request->phone,'id_roles'=> $request->id_roles]);
        User::where('id',  $request->id)
            ->update(['name' => $request->name,'email'=> $request->email]);
        return response()->json(['check' => true, 'msg' => 'Update tài khoản thành công']);
    }

    public function deleteuser(DeleteuserRequest $request)
    {
        users_system::where('id',  $request->id)
            ->delete();
        User::where('id',  $request->id)
            ->delete();
        return response()->json(['check' => true, 'msg' => 'Xóa tài khoản thành công']);
    }

}
