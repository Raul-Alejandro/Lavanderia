<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Inventory;
use App\Sucursal;
use App\InventoryUpdates;
use DB;
use View;

class InventoryController extends Controller
{
    public function __construct(){
        if(request()->segment(1) == 'api'){
            $this->middleware('auth:api');
        }
        else{
            $this->middleware('auth',['except' => ['consumedSupplies']]);
            $this->middleware('userType',['except' => ['destroy','consumedSupplies']]);
            $this->middleware('super',['only' => ['destroy']]);
        }
    }

    public function index(){
    	$inventories = DB::table('inventories as inv')
                         ->join('sucursals as s','inv.idSucursal','s.id')
                         ->select('inv.id','inv.product','inv.quantity','inv.measure','s.name as sucursal');

        if(request()->product)
            $inventories = $inventories->where('inv.product','LIKE','%'.request()->product.'%');  
        if(request()->less)
            $inventories = $inventories->where('inv.quantity','<',request()->less);
        if(request()->higher)
            $inventories = $inventories->where('inv.quantity','>',request()->higher);     
        if(request()->measure)
            $inventories = $inventories->where('inv.measure',request()->measure);
        if(request()->sucursal)
            $inventories = $inventories->where('inv.idSucursal',request()->sucursal);
        
        if(request()->segment(1) == 'api'){
            $inventories = $inventories->get();
            return $inventories;
        }

        $inventories = $inventories->orderby('inv.quantity','ASC');
        $inventories = $inventories->paginate(15);

        $data["inventories"] = $inventories;
        $data["sucursals"] = Sucursal::pluck('name','id');


        if(request()->ajax()){
            $view = View::make('inventory.table_inventory')->with($data);
            $sections = $view->renderSections();

            return response()->json($sections['data']);
        }
    	return view('inventory.table_inventory',$data);
    }

    public function create(){
    	$sucursals = Sucursal::pluck('name','id');
        if(request()->segment(1) == 'api'){
            return $sucursals;
        }
        else{
    	    return view('inventory.create',["sucursals"=>$sucursals]);
        }
    }

    public function store(){
        $inv = new Inventory;
        $inv->product = request()->product;  
        $inv->measure = request()->measure;
        $inv->quantity = request()->quantity;
        $inv->idSucursal = request()->idSucursal;
        $inv->save();
        
        if(request()->segment(1) == 'api'){
            return response()
            ->json(['inventory'=>$inv],200);
        }
        else{
    	    return Redirect::to('inventory');
        }
    }

    public function show(){

    }

    public function edit($id){
    	$inventory = Inventory::findOrFail($id);
    	$sucursals = Sucursal::pluck('name','id');

        if(request()->segment(1) == 'api'){
            return response()->
            json(["inventory"=>$inventory,"sucursals"=>$sucursals],200);
        }
        else{
        	return view('inventory.edit',["inventory"=>$inventory,"sucursals"=>$sucursals]);
        }
    }

    public function update($id){
    	$inventory = Inventory::findOrFail($id);
    	$inventory->fill(request()->all());
    	$inventory->update();

        if(request()->segment(1) == 'api'){
            return response()
            ->json(['state' => 'OK'],200);
        }
        else{
            return Redirect::to('inventory');
        }
    }

    public function destroy($id){
    	Inventory::destroy($id);

        if(request()->segment(1) == 'api'){
            return response()
            ->json(['state' => 'OK'],200);
        }
        else{
    	    return back();
        }
    }

    /*public function alta($id, Request $request){
        $inventory = Inventory::findOrFail($id);
        $quantity = $request['quantity'.$inventory->id];
        $inventory->quantity = $inventory->quantity + $quantity;
        $inventory->update();

        $update = InventoryUpdates::create([
            'type' => 'ALTA',
            'quantity' => $quantity,
            'idInventory' => $inventory->id
        ]);


        if(request()->segment(1) == 'api'){
            return response()
            ->json(["inventory"=>$inventory],200);
        }
        else{
            return back();
        }
    }

    public function baja($id, Request $request){
        $inventory = Inventory::findOrFail($id);
        $quantity = $request['quantity'.$inventory->id];

        if($inventory->quantity < $quantity){   
            $quantity = $inventory->quantity;
            $inventory->quantity = 0;            
        }
        else
            $inventory->quantity = $inventory->quantity - $quantity;

        $inventory->update();

        $update = InventoryUpdates::create([
            'type' => 'BAJA',
            'quantity' => $quantity,
            'idInventory' => $inventory->id
        ]);
        
        if(request()->segment(1) == 'api'){
            return response()
            ->json(["inventory"=>$inventory],200);
        }
        else{
            return back();
        }
    }*/

    public function alta($id){
        $inventory = Inventory::findOrFail($id);
        $quantity = request()->quantity;
        $inventory->quantity = $inventory->quantity + $quantity;
        $inventory->update();

        $update = InventoryUpdates::create([
            'type' => 'ALTA',
            'quantity' => $quantity,
            'idInventory' => $inventory->id
        ]);

        if(request()->ajax()){
            return response()->json(["inventory"=>$inventory],200);
        }
        if(request()->segment(1) == 'api'){
            return response()->json(["inventory"=>$inventory],200);
        }
        else{
            return back();
        }
    }

    public function baja($id){
        $inventory = Inventory::findOrFail($id);
        $quantity = request()->quantity;

        if($inventory->quantity < $quantity){   
            $quantity = $inventory->quantity;
            $inventory->quantity = 0;            
        }
        else
            $inventory->quantity = $inventory->quantity - $quantity;

        $inventory->update();

        $update = InventoryUpdates::create([
            'type' => 'BAJA',
            'quantity' => $quantity,
            'idInventory' => $inventory->id
        ]);
        if(request()->ajax()){
            return response()->json(["inventory"=>$inventory],200);
        }
        if(request()->segment(1) == 'api'){
            return response()->json(["inventory"=>$inventory],200);
        }
        else{
            return back();
        }
    }

    public function consumedSupplies(){
        $total_inventories = [];
        $consumed = 0;
        $inventories = DB::table('inventories as inv')
                        ->join('sucursals as s','inv.idSucursal','s.id')
                        ->select('inv.id','inv.product','inv.measure','s.name');
        if(request()->product)
            $inventories = $inventories->where('product','LIKE','%'.request()->product.'%');
        if(request()->sucursal)
            $inventories = $inventories->where('idSucursal',request()->sucursal);
        
        $inventories = $inventories->get();

        foreach ($inventories as $key => $inventory) {
            $updates = DB::table('inventory_updates as u')
                        ->join('inventories as i','u.idInventory','i.id')
                        ->select('u.type','u.quantity')
                        ->where('u.idInventory',$inventory->id);
            if(request()->start)
                $updates = $updates->where('u.created_at','>=',request()->start);
            if(request()->final)
                $updates = $updates->where('u.created_at','<=',request()->final);
            $updates = $updates->get();

            foreach ($updates as $update) {
                if($update->type == 'BAJA')
                    $consumed += $update->quantity;
            }
            $upd_inventory = ["product"=>$inventory->product,"measure"=>$inventory->measure,"sucursal"=>$inventory->name,"consumed"=>$consumed];
            $total_inventories[] = $upd_inventory;
            $consumed = 0;
        }

        if(request()->segment(1) == 'api'){
            return response()->json($total_inventories,200);
        }
    }
}
