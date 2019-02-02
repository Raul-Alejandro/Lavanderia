<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Sucursal;

class SucursalController extends Controller
{
    public function __construct(){
        if(request()->segment(1) == 'api'){
            $this->middleware('auth:api');
        }
        else{
            $this->middleware('auth');
            $this->middleware('super');
        }
    }

    public function index(){
    	$sucursals = Sucursal::all();
        if(request()->segment(1) == 'api'){
            return response()
            ->json(["sucursals"=>$sucursals],200);
        }
        else{
        	return view('sucursal.index',["sucursals"=>$sucursals]); 
        }
    }

    public function create(){
    	return view('sucursal.create');
    }

    public function store(){
    	$sucursal = Sucursal::create([
    		'name' => request()->name,
    	]);

        if(request()->segment(1) == 'api'){
            return response()
            ->json(['sucursal'=>$sucursal],200);
        }
        else{
    	   return Redirect::to('sucursal');
        }
    }

    public function show(){

    }

    public function edit($id){
    	$sucursal = Sucursal::findOrFail($id);

        if(request()->segment(1) == 'api'){
            return response()
            ->json(["sucursal"=>$sucursal],200);
        }
        else{
            return view('sucursal.edit',["sucursal"=>$sucursal]);
        }
    }

    public function update($id){
    	$sucursal = Sucursal::findOrFail($id);
    	$sucursal->fill(request()->all());
    	$sucursal->update();

        if(request()->segment(1) == 'api'){
            return response()
            ->json(['sucursal'=>$sucursal],200);
        }
        else{
    	   return Redirect::to('sucursal');
        }
    }

    public function destroy($id){
    	Sucursal::destroy($id);

        if(request()->segment(1) == 'api'){
            return response()
            ->json(['state' => 'OK'],200);
        }
        else{
    	   return back();
        }
    }
}
