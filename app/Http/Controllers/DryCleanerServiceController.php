<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\DryCleanerService;

class DryCleanerServiceController extends Controller
{
    /*
        Constructor del controlador, se definen los middleware usados para Api y Web
    */
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

    /*
        Esta funcion crea la una lista paginada del total de servicios de tintoreria
        Si se ejecuta en Api se retorna json de los servicios y status 200
        Si se ejecuta en web carga la vista "index" con los servicios
    */
    public function index(){
    	$services = DryCleanerService::paginate(15);

        if(request()->segment(1) == 'api'){
            $services = DryCleanerService::all();
            return response()
            ->json(["services"=>$services],200); 
        }
        else{
    	    return view('dry.index',["services"=>$services]);
        }
    }

    /*
        Esta funcion regresa la vista "create" con el formulario para registrar un nuevo servicio de tintoreria
    */
    public function create(){
    	return view('dry.create');
    }

    /*
        Esta funcion crea el registro de un servicio por medio de un POST
        Si se ejecuta por Api se retorna un json con el servicio creado y status 200
        Si se ejecuta en Web al finalizar se redirecciona al index
    */
    public function store(){
    	$dry = DryCleanerService::create([
    		'code' => request()->code,
    		'name' => request()->name,
    		'cost' => request()->cost
    	]);

        if(request()->segment(1) == 'api'){
            return response()
            ->json(['service'=>$dry],200); 
        }
        else{  
    	    return Redirect::to('dry-service');
        }
    }

    /*
        Funcion para mostrar los datos del modelo
    */
    public function show(){

    }

    /*
        Esta funcion retorna una vista con el formulario para editar el servicio, se necesita por parametro el id del servicio
    */
    public function edit($id){
    	$service = DryCleanerService::findOrFail($id);

        if(request()->segment(1) == 'api'){
            return response()
            ->json(["service"=>$service]); 
        }
        else{
    	    return view('dry.edit',["service"=>$service]);
        }
    }

    /*
        Esta funcion actualiza los datos de un servicio, necesitar por parametro el id del servicio
        Si se ejecuta por Api retorna un json con el servicio actualizado y status 200
        Si se ejecuta en Web al finalizar se redirecciona al index 
    */
    public function update($id){
    	$service = DryCleanerService::findOrFail($id);
    	$service->fill(request()->all());
        $service->update();

        if(request()->segment(1) == 'api'){
            return response()
            ->json(['service'=>$service],200); 
        }
        else{ 
    	    return Redirect::to('dry-service');
        } 
    }

    /*
        Esta funcion elimina un servicio de la base de datos, necesita por parametro el id del servicio
        Si se ejectua por Api se retorna un json con status 200
        Si se ejecuta en Web al finalizar se recarga el index
    */
    public function destroy($id){
    	DryCleanerService::destroy($id);
        
        if(request()->segment(1) == 'api'){
            return response()
            ->json(['state' => 'OK'],200);
        }
        else{  
    	    return back();
        }
    }
}
