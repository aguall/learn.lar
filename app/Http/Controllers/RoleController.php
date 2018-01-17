<?php
namespace App\Http\Controllers;
use App\Roles;
use App\User;
use App\Users;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class RoleController extends Controller{
    public static $timestamps = false;

    public function homePage(){
        $users = Users::getAllUsers();
        $roles = Roles::getAll();
        $user = Auth::user();
        return view('roles/view',compact('roles','users','user'));
    }

    public function editPage($id){
        if($id!=1)
            {
                $result = Roles::getRoleById($id);
                $user = Auth::user();
                $roles = Roles::getAll();
                return view('roles/edit',compact('result','roles','user'));
            }
        else
            {
                return redirect('/view');
            }
    }

    public function RoleUpdate($id){
        if($id!=1)
            {
                $data = Input::All();
                Roles::updateRoleById($id,$data);
            }
        return redirect('/view');
    }

    public function createRolePage(){
        $user = Auth::user();
        return view('roles/create',compact('user'));
    }

    public function createRole(){
        $data = Input::All();
                $data_user = array(
                    'name' => $data['name'],
                );
                Roles::create($data_user);
        return redirect('/view');
    }

    public function deleteRole($id){
        if($id!=1)
            {
                Roles::destroy(array($id));
            }
        return redirect('/view');
    }

    public function showUsersWithThisRole($id){
        $user = Auth::user();
        $roles = Roles::getAll();
        $result=Users::getUsersByRole($id);
        return view('roles/showUWR',compact('result','user','roles'));
    }

    public function getUserById($id){
        $user = Auth::user();
        $users=Users::getUserById($id);
        $roles = Roles::getAll();
        $result=Users::getUserById($id);
        return view('roles/user',compact('result','user','roles','users'));
    }
}
