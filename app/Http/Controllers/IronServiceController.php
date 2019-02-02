<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\IronService;

class IronServiceController extends Controller
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
    	$services = IronService::paginate(15);
        
        if(request()->segment(1) == 'api'){
            $services = IronService::all();
            return response()
            ->json(["services"=>$services],200); 
        }
        else{
    	    return view('iron.index',["services"=>$services]);
        }
    }

    public function create(){
    	return view('iron.create');
    }

    public function store(){
    	$iron = IronService::create([
    		'code' => request()->code,
    		'name' => request()->name,
    		'cost' => request()->cost,
            'promotion_cost' => request()->promotion_cost
    	]);

        if(request()->segment(1) == 'api'){
            return response()
            ->json(['service'=>$iron],200); 
        }
        else{
    	    return Redirect::to('iron-service');
        }
    }

    public function show(){

    }

    public function edit($id){
    	$service = IronService::findOrFail($id);

        if(request()->segment(1) == 'api'){
            return response()
            ->json(["service"=>$service],200); 
        }
        else{ 
    	    return view('iron.edit',["service"=>$service]);
        }
    }

    public function update($id){
    	$service = IronService::findOrFail($id);
    	$service->fill(request()->all());
        $service->update();

        if(request()->segment(1) == 'api'){
            return response()
            ->json(['service'=>$service],200);
        }
        else{
    	   return Redirect::to('iron-service');
        }
    }

    public function destroy($id){
    	IronService::destroy($id);

    	if(request()->segment(1) == 'api'){
            return response()
            ->json(['state' => 'OK'],200); 
        }
        else{
            return back();
        }
    }
}
