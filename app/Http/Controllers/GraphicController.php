<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Inventory;
use App\Order;
use DB;
use View;
use App\Sucursal;

class GraphicController extends Controller
{
    public function __construct(){

    }

    public function customers(){
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
        if(request()->ajax()){
            $view = View::make('graphic.sections.section_table_customers')->with('customers',$customers)->with('sucursals',$sucursals);
            $sections = $view->renderSections();
            return response()->json($sections['data']);
        }
        else{
    	    return view('graphic.sections.section_table_customers',["customers"=>$customers,"sucursals"=>$sucursals]); 
        }
    }

    public function graphicCustomer($name){
        $customers = Customer::where('name','LIKE','%'.$name.'%')->get();
        //$view = View::make('graphic.sections.section_table_customers')->with('customers',$customers);
        if(request()->ajax()){
            //$sections = $view->renderSections();
            //return response()->json($sections['contentPanel']); 
            return response()->json(["customers"=>$customers],200);
        }
        else 
            return $view;
    }

    public function inventories(){

    }

    public function graphicInventory(){

    }

    public function orders(){

    }

    public function graphicOrder(){

    }

    public function services(){

    }

    public function graphicService(){

    }
}
