<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Customer;
use App\Sucursal;
use DB;
use View;

class CustomerController extends Controller
{
    /*
        Constructor del Controlador, se definen los middlewares adecuados por el tipo de peticion, ya sea api o web
    */
    public function __construct(){
        if(request()->segment(1) == 'api'){
            $this->middleware('auth:api');
        }
        else{
            $this->middleware('auth');
            $this->middleware('super',['except'=>['index']]);
        }
    }

    /*
        Esta Funcion muestra una lista paginada de los clientes que se han registrado en web
        En Api regresa un json de paginado de los clientes y status 200
        Permite busquedas personalizadas usando ajax y retorna una nueva instancia de la vista con los nuevos datos
    */
    public function index(){
    	$customers = Customer::paginate(20);
        $sucursals = Sucursal::pluck('name','id');

        if(request()->segment(1) == 'api'){
            return response()
            ->json(["customers"=>$customers],200);
        }
        else{
            //Si hay una peticion ajax se realizan la consulta a la base de datos
            if(request()->ajax()){
                $customers = DB::table('customers');

                if(request()->start){
                    $customers = $customers->where('created_at','>=',request()->start);
                }
                if(request()->final){
                    $customers = $customers->where('created_at','<=',request()->final);
                }
                if(request()->idSucursal){
                    $customers = $customers->where('idSucursal',request()->idSucursal);
                }

                $customers = $customers->paginate(20);
                
                $data["customers"] = $customers;
                $data["sucursals"] = $sucursals;
                
                $view = View::make('customer.table_customer')->with($data);
                $sections = $view->renderSections();
                return response()->json($sections['data']);
            }
            //Si es peticion web retorna la vista de la tabla de los clientes
    	    return view('customer.table_customer',["customers"=>$customers,"sucursals"=>$sucursals]);
        }
    }

    /*
        Esta funcion retorna la vista donde se lleva a cabo el registro de un cliente,
        la vista necesita una lista de los sucursales para que funcione
    */
    public function create(){
        $sucursals = Sucursal::pluck('name','id');
    	return view('customer.create',["sucursals"=>$sucursals]);
    }

    /*  
        Esta funcion se encarga de crear el nuevo registro del cliente, se ejecuta despues de un post desde el create
        Si la funcion se da por Api se retorna un json con los datos del cliente creado y status 200
        Si la peticion es Web al finalizar se redirecciona al index
    */  
    public function store(){
    	$customer = Customer::create([
    		'name' => request()->name,
    		'phone' => request()->phone,
            'idSucursal' => request()->idSucursal,
    	]);

        if(request()->segment(1) == 'api'){
            return response()
            ->json(["customer"=>$customer],200);
        }
        else{
    	    return Redirect::to('customer');
        }
    }

    /*
        Funcion para mostrar datos del modelo
    */
    public function show(){

    }

    /*
        Esta funcion carga una vista para con un formulario para editar el cliente, recibe por parametro el id del cliente
        Si se ejecuta por Api se retorna un json con el cliente y status 200
        Si se ejecuta en Web se retorna la vista 
    */
    public function edit($id){
    	$customer = Customer::findOrFail($id);

        if(request()->segment(1) == 'api'){
            return response()
            ->json(["customer"=>$customer],200);
        }
        else{
    	    return view('customer.edit',["customer"=>$customer]);
        }
    }

    /*
        Esta funcion se encarga de actualizar los datos de un cliente, recibe por parametro el id del cliente
        Si se ejecuta por Api se retorna un json con el cliente actualizado y status 200
        Si se ejecuta en Web al finalizar se redirecciona al index
    */
    public function update($id){
    	$customer = Customer::findOrFail($id);
    	$customer->fill(request()->all());
    	$customer->update();

        if(request()->segment(1) == 'api'){
            return response()
            ->json(["customer"=>$customer],200);
        }
        else{
    	    return Redirect::to('customer');
        }
    }

    /*
        Esta funcion elimina un cliente de la base de datos, recibe por parametro el id del cliente
        Si se ejecuta por Api se retorna un json con un status 200 para  
        En web se ejecuta usando un modal, al finalizar recarga la vista index
    */
    public function destroy($id){
    	Customer::destroy($id);

        if(request()->segment(1) == 'api'){
            return response()
            ->json(["state"=>"OK"],200);
        }
        else{
            return back();
        }
    }

    /*
    public function search(){
        $sucursals = Sucursal::pluck('name','id');
        $customers = DB::table('customers');

        if(request()->start){
            $customers = $customers->where('created_at','>=',request()->start);
        }
        if(request()->final){
            $customers = $customers->where('created_at','<=',request()->final);
        }
        if(request()->idSucursal){
            $customers = $customers->where('idSucursal',request()->idSucursal);
        }

        $customers = $customers->paginate(3);
        if(request()->segment(1) == 'api'){
            return response()
            ->json(["customers"=>$customers],200);
        }
        if(request()->ajax()){
            $view = View::make('customer.table_customer')->with('customers',$customers)->with('sucursals',$sucursals);
            $sections = $view->renderSections();
            return response()->json($sections['data']);
        }
    }

    public function pagination($customers){
        $sucursals = Sucursal::pluck('name','id');
        //$customers = DB::table('customers');
        //$customers = $customers->paginate(100);
        if(request()->ajax()){
            $view = View::make('customer.table_customer')->with('customers',$customers)->with('sucursals',$sucursals);
            $sections = $view->renderSections();
            return response()->json($sections['data']);
        }
    }

    public function page(){
        return "LESTO";
    }

    */
}
