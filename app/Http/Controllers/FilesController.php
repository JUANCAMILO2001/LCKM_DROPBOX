<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;



class FilesController extends Controller
{
    public function index(){
        $files = File::where('user_id',Auth::id())->latest()->get();
        return view('user.files.index', compact('files'));
    }
    public function show($id){
        $file = File::whereId($id)->firstOrFail();
        $user_id = Auth::id();
        if($file->user_id == $user_id){
            return redirect('/storage' . '/' . $user_id . '/' . $file->name);
        } else {
            abort(403);
        }
    }
    public function store(Request $request){
        $max_size = (int)ini_get('upload_max_filesize') * 10240;

        $files = $request->file('files');
        $user_id = Auth::id();

        if ($request->hasFile('files')){
            foreach ($files as $file) {


                if (Storage::putFileAs('/public/' . $user_id . '/', $file, $file->getClientOriginalName())){
                    File::create([
                        'name' => $file->getClientOriginalName(),
                        'user_id' => $user_id
                    ]);
                }
            }
            Alert::success('EXITO', 'Su archivo se subio correctamente');
            return back();
        }
        else{
                Alert::error('¡ERROR!', 'Debes subir UNO o MÁS archivos');
            return back();
        }





    }
    public function destroy(Request $request, $id)
    {
        $file = File::whereId($id)->firstOrFail();
        unlink(public_path('storage' . '/' . Auth::id() . '/' . $file->name));
        $file->delete();
        Alert::info('Atencion', 'se ha eliminado correctamente');
        return back();
    }
    }
