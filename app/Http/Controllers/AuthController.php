<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\tbl_perfil;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class AuthController extends Controller
{
    public function index()
    {
        $auth=User::select('id','name','email','estado')->get();
        return view('auth.index')->with('auth', $auth);
    }

    public function login()
    {
        return view('auth.login');
    }

    public function create()
    {
        $perfil = tbl_perfil::all()->pluck('nombre_perfil', 'id');
        return view('auth.register', compact('perfil'));
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $request->session()->Token();
            // dd($rol->nombre_perfil);
            
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
            'confirm' => 'required|same:password'
        ]);

        $data = $request->except('confirm', 'password');
        $data['password'] = Hash::make($request->password);
        User::create($data);
        return redirect()->route('auth.index');
    }

    public function edit($id)
    {
        $auth = User::find($id);
        $perfil = tbl_perfil::all()->pluck('nombre_perfil', 'id');
        return view('auth.register', compact('perfil','auth'));
    }

    public function update(Request $request, $id)
    {
        $vp = $request['password'];
        $vc = $request['confirm'];

        if($vp == null && $vc == null){
            $request->validate([
                'name' => 'required',
                'email' => 'required|email'
            ]);

            $data = User::find($id);
            $data->fill($request->only('id_perfil','name','email','estado'));
            $data->save();
        }else{
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'min:8',
                'confirm' => 'required|same:password'
            ]);

            $data = User::find($id);
            $data->fill($request->only('id_perfil','name','email','password','estado'));
            $data->password = Hash::make($request->password);
            $data->save();
            // dd($data->password);
        }

        Session::flash('mensaje','¡Registro editado con exito!');
        return redirect()->route('auth.index');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout','index','create','store','edit','update');
    }

}
