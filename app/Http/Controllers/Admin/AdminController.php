<?php
/**
 * Created by PhpStorm.
 * User: justOP
 * Date: 01.01.18
 * Time: 23:37
 */
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function show(){
        return view('AdminTest');
    }
}