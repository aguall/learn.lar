<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class Users extends Authenticatable
{
    protected $table = 'user';
    protected $fillable = [
        'name', 'firstname', 'Phone', 'City','activity','role','image_url'
    ];
    public $timestamps = false;

    public static function getUserById($id){

        $result = Users::where('id','=',$id)
            //-> where('name','=', 'FIDOR')
            //-> orWhere('name','like', 'FIDOR2')
            //-> notNull(...)
            //-> between(...)
            -> first();
            //-> get();
            //-> take(58) -> get();
            //-> count();
            //-> orderBy('date','desc') -> get();
            //-> groupBy('customer_id') -> get();
            //Users::selectRaw('users.name as user_name') -> get();
        return $result;
    }
    public static function updateUserById($id, $data){

        $result = static::where('id','=',$id) -> first();
        if(isset($data['name'])){
            $result -> name = $data['name'];
        }
        if(isset($data['firstname'])){
            $result -> firstname = $data['firstname'];
        }
        if(isset($data['Phone'])){
            $result -> Phone = $data['Phone'];
        }
        if(isset($data['City'])){
            $result -> City = $data['City'];
        }
        if(isset($data['activity'])){
            $result -> activity = $data['activity'];
        }
        if(isset($data['role'])){
            $result -> role = $data['role'];
        }
        if(isset($data['image_url'])){
            $result -> image_url = $data['image_url'];
        }
        $result -> save();

        return $result;
    }

    public static function getAllUsers(){
        $result =  DB::select('SELECT  * FROM  user');

        return $result;
    }

    public static function getUsersByRole($id){
        $result=Users::where('role','=',$id)->get();
        return $result;
    }

}