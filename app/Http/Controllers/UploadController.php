<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Users;

class UploadController extends Controller
{
    public function getForm()
    {
        return view('upload-form');
    }

    public function upload(Request $request)
    {
        foreach ($request->file() as $file) {
            foreach ($file as $f) {
                $f->move(storage_path('images'), time().'_'.$f->getClientOriginalName());
                $data_user = array(
                    'image' => $data['image'],
                );
            }
        }
       return redirect() -> back();
    }
}