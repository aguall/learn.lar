<?php
namespace App\Http\Controllers;
use App\Roles;
use App\User;
use App\Users;

use Illuminate\Support\Facades\Input;
class UserController extends Controller{
    public static $timestamps = false;
    public function homePage(){
        $users = Users::getAllUsers();
        $roles = Roles::getAll();

        return view('welcome',compact('users','roles'));
    }



    public function createPage(){
        $roles = Roles::getAll();
        return view('create',compact('roles'));
    }

    public function UserUpdate($id){
        $data = Input::All();
        Users::updateUserById($id, $data);

        return redirect() -> back();
    }

    public function deleteUserById($id){
        Users::destroy(array($id));

        return redirect() -> back();
    }

    public function createUser() {

        $data = Input::All();

        foreach($data['Phone'] as $key => $phone){
            if($phone) {
                $data_user = array(
                    'Phone' => $phone,
                    'name' => $data['name'][$key],
                    'firstname' => $data['firstname'][$key],
                    'City' => $data['City'][$key],
                    'activity' => $data['activity'][$key],
                    'role' => $data['role'],
                );

            Users::create($data_user);
            }
        }

        return redirect() -> to(url('/'));
    }
}