<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\WashService;

class WashServiceController extends Controller
{
    public function __construct(){
        if(request()->segment(1) == 'api'){
            $this->middleware('auth:api');
        }
        else{
            $this->middleware('auth');
            $this->middleware('userType', ['except' => ['index','destroy']]);
            $this->middleware('super', ['only' => ['destroy']]);
        }
    }

    public function index(){
    	$services = WashService::paginate(15);

        if(request()->segment(1) == 'api'){
            $services = WashService::all();
            return response()
            ->json(["services"=>$services],200);
        }
        else{
        	return view('wash.index',["services"=>$services]);
        }
    }

    public function create(){
    	return view('wash.create');
    }

    public function store(){
    	$service = WashService::create([
    		'code' => request()->code,
    		'name' => request()->name,
            'measure' => request()->measure,
    		'cost' => request()->cost,
    	]);

        if(request()->segment(1) == 'api'){
            return response()
            ->json(['service'=>$service],200);
        }
        else{
    	    return Redirect::to('wash-service');
        }
    }

    public function show(){

    }

    public function edit($id){
    	$service = WashService::findOrFail($id);

        if(request()->segment(1) == 'api'){
            return response()
            ->json(["service"=>$service],200);
        }
        else{
    	    return view('wash.edit',["service"=>$service]);
        }
    }

    public function update($id){
    	$service = WashService::findOrFail($id);
    	$service->fill(request()->all());
        $service->update();
        
        if(request()->segment(1) == 'api'){
            return response()
            ->json(['service'=>$service],200); 
        }
        else{
    	   return Redirect::to('wash-service');
        }
    }

    public function destroy($id){
    	WashService::destroy($id);
        
        if(request()->segment(1) == 'api'){
            return response()
            ->json(['state' => 'OK'],200);
        }
        else{
    	   return back();
        }
    }
}
