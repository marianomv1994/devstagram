<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function crear() 
    {
        return view('auth.register');
    }
    public function store(Request $request)
    {
        //dd($request);
        //dd($request->get('name'));
        
        //Modificar el request

        $request->request->add(['username' => Str::slug( $request->username)]);

        //validacion

        $this->validate($request,[
            'name'=>'required|min:5|max:30',
            'username'=> 'required|unique:users|min:3|max:20',
            'email'=>'required|unique:users|email|max:60',
            'password'=> 'required|confirmed|min:6',
        ]);

        //insert en base de datos
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email'=> $request->email,
            'password'=> Hash::make( $request->password),
        ]);
        //redireccionar
        return redirect()->route('posts.index');
    }
}
