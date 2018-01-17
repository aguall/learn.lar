<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Roles extends Authenticatable
{

    protected $table = 'roles';
    protected $fillable = [
        'role'
    ];
    public static function getList($id, $data){
        Roles::where('id','=',$id)
            -> update(array(
                'name' => $data['name'],
                'firstname' => $data['firstname'],
                'Phone' => $data['Phone'],
                'City' => $data['City'],
            ));
    }
}
