<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
class Roles extends Model
{
    protected $table = 'roles';
    protected $fillable = [
        'name'
    ];
    public $timestamps = false;

    public static function getAll(){
        $result = Roles::all();

        return $result;
    }

    public static  function getRoleById($id){
        $result=Roles::where('id','=',$id)->first();
        return $result;
    }

    public static function updateRoleById($id, $data){
        $result = static::where('id','=',$id) -> first();
        if(isset($data['name'])){
            $result -> name = $data['name'];
        }
        $result -> save();

        return $result;
    }
}