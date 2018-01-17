<?php
namespace App\Http\Controllers;
use App\Roles;
use App\User;
use App\Users;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class UserController extends Controller{
    public static $timestamps = false;

    public function homePage(){
        $users = Users::getAllUsers();
        $roles = Roles::getAll();
        $user = Auth::user();

        return view('welcome',compact('users','roles','user'));
    }



    public function createPage(){
        $roles = Roles::getAll();
        return view('create',compact('roles'));
    }

    public function UserUpdate($id){
        $data = Input::All();

        if (Input::hasFile('image')) {
            $name = time() . '_' . $data['image']->getClientOriginalName();
            Input::file('image')->move(public_path() . '/avatars/', $name);
            $data['image_url'] = 'avatars/' . $name;
        }

        Users::updateUserById($id, $data);

        $result = true;

        if(isset($data['image_url'])) {
            $result = $data['image_url'];
        }
        return json_encode($result);
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
                    'image' => $data['image_url'],
                );

            Users::create($data_user);
            }
        }

        return redirect() -> to(url('/'));
    }

    public function upload(Request $request)
    {
        foreach ($request->file() as $file) {
            foreach ($file as $f) {
                $f->move(storage_path('images'), time().'_'.$f->getClientOriginalName());
            }
        }
    }
}