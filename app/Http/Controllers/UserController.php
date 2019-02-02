<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\Sucursal;
use App\Http\Requests\UserFormRequest;
use App\Http\Requests\UserEditFormRequest;
use App\Http\Requests\ProfileRequest;

class UserController extends Controller
{
    public function __construct(){
        if(request()->segment(1) == 'api'){
            $this->middleware('auth:api');
        }
        else{
            $this->middleware('auth');
            $this->middleware('userType',['except'=>['show','editprofile','updateProfile']]);
            $this->middleware('profile',['only'=>['show','editprofile','updateProfile']]);
        }
    }

    public function index(){
        if(request()->user()->type == 'SUPER'){
                $users = User::where('type','!=','SUPER')->get();
            }
            else{
                $users = User::where('type','!=','SUPER')
                                ->where('idSucursal',request()->user()->sucursal->id)
                                ->where('type','!=','ADMIN')
                                ->get();
            }
        if(request()->segment(1) == 'api'){
            return User::all();
        }
        else{
    	    return view('user.index',["users"=>$users]);
        }
    }

    public function create(){
        $sucursals = Sucursal::pluck('name','id');
        if(request()->segment(1) == 'api'){
            return response()
            ->json(["sucursals"=>$sucursals]);
        }
        else{
    	   return view('user.create',["sucursals"=>$sucursals]);
        }
    }

    public function store(UserFormRequest $request){
        if(request()->user()->type == 'SUPER'){          
            $user = User::create([
                'name' => request()->name,
                'email' => request()->email,
                'password' => bcrypt(request()->password),
                'type' => request()->type,
                'status' => 'ACTIVO',
                'idSucursal' => request()->idSucursal,
            ]);
        }
        else{
            $user = User::create([
                'name' => request()->name,
                'email' => request()->email,
                'password' => bcrypt(request()->password),
                'type' => 'EMPLEADO',
                'status' => 'ACTIVO',
                'idSucursal' => request()->user()->sucursal->id,
            ]);
        }

        if(request()->segment(1) == 'api'){
            $token =  $user->createToken('MyApp')->accessToken;
            return response()->json([
                'token'=>$token,'user'=>$user],200);
        }
        else{
    	   return Redirect::to('user');
        }
    }

    public function show(){
        return view('user.show',["user"=>request()->user()]);
    }

    public function edit($id){
    	$user = User::findOrFail($id);
        $sucursals = Sucursal::pluck('name','id');

        if(request()->segment(1) == 'api'){
            return response()
            ->json(["user"=>$user,"sucursals"=>$sucursals]);
        }
        else{
    	   return view('user.edit',["user"=>$user,"sucursals"=>$sucursals]);
        }
    }

    public function update(UserEditFormRequest $request, $id){
    	$user = User::findOrFail($id);

        $user->name = request()->name;
        if(request()->type)
            $user->type = request()->type;           
        if(request()->status)
            $user->status = request()->status;           
        if(request()->idSucursal)
            $user->idSucursal = request()->idSucursal;
        if(request()->password)
            $user->password = bcrypt(request()->password);
    	
    	$user->update();
        
        if(request()->segment(1) == 'api'){
            return response()
            ->json(['user' => $user],200);
        }
        else{
            if(request()->user()->type == 'EMPLEADO'){
                return redirect()->action('UserController@show', [request()->user()->id]);
            }
            return Redirect::to('user');
        }
    }

    public function updateProfile(ProfileRequest $request, $id){
        $user = User::findOrFail($id);
        $user->name = request()->name;
        $user->email = request()->email;
        if(request()->password){
            $user->password = bcrypt(request()->password);
        }
        
        $user->update();
        
        if(request()->segment(1) == 'api'){
            return response()
            ->json(['user' => $user],200);
        }
        else{
            if(request()->user()->type == 'EMPLEADO'){
                return redirect()->action('UserController@show', [request()->user()->id]);
            }
            return Redirect::to('user');
        }
    }

    public function destroy($id){
    	User::destroy($id);

        if(request()->segment(1) == 'api'){
            return response()
            ->json(['state' => 'OK'],200);
        }
        else{
            return back();
        }
    }

    public function editprofile($id){
        $user = User::findOrFail($id);
        return view('user.editprofile',["user"=>$user]);
    }
}
