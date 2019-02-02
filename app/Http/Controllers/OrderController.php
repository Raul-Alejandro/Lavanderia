<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Order;
use App\User;
use App\Customer;
use App\Sucursal;
use App\WashOrder;
use App\IronOrder;
use App\DryCleanerOrder;
use App\WashService;
use App\IronService;
use App\DryCleanerService;
use App\Promotion;
use App\RequirementService;
use App\PromotionOrder;
use App\OrderUpdate;
use DB;
use View;

class OrderController extends Controller
{
    protected $orders;

    public function __construct(Order $orders){
        $this->orders = $orders;
        if(request()->segment(1) == 'api'){
            $this->middleware('auth:api', ['except' => ['show','search']]);
        }
        else{
            $this->middleware('auth');
            $this->middleware('super', ['only' => ['destroy']]);
        }
    }

    public function index(){
        $orders = DB::table('orders as o')
                ->join('customers as c','o.idCustomer','c.id')
                ->join('users as u','o.idUser','u.id')
                ->join('sucursals as s','o.idSucursal','s.id')
                ->select('o.id','c.name as customer', 'c.phone as phone','o.delivery_date','o.delivered','o.status','o.charge','o.payment_type','o.total','o.balance','u.name as user','s.name as sucursal','o.created_at','o.updated_at');
        
        if(request()->search){
            $ord = explode('X',request()->search);
            $orders = $orders->where('o.id',$ord[0]);
            //$orders = $orders->where('o.id','LIKE','%'.$ord[0].'%');
        }     
        if(request()->customer){
            $orders = $orders->where('c.name','LIKE','%'.request()->customer.'%');
        }
        if(request()->segment(1) == 'api'){
            if(request()->type == 'created_at'){   
                if(request()->start){
                    $orders = $orders->where('o.created_at','>=',request()->start);
                }
                if(request()->final){
                    $orders = $orders->where('o.created_at','<=',request()->final);
                }
            }
            if(request()->type == 'updated_at'){   
                if(request()->start){
                    $orders = $orders->where('o.updated_at','>=',request()->start);
                }
                if(request()->final){
                    $orders = $orders->where('o.updated_at','<=',request()->final);
                }
            }
        }
        else{
            if(request()->start){
                $orders = $orders->where('o.created_at','>=',request()->start);
            }
            if(request()->final){
                $orders = $orders->where('o.created_at','<=',request()->final);
            }
        }
        if(request()->sucursal){
            $orders = $orders->where('o.idSucursal',request()->sucursal);
        }
        if(request()->user()->type == 'EMPLEADO'){
            $orders = $orders->where('o.idSucursal',request()->user()->idSucursal);
        }

        $orders = $orders->latest('created_at');

        if(request()->segment(1) == 'api'){
            $orders = $orders->paginate(100);
            $all_orders = [];
            $all_washes = [];
            $all_irons = [];
            $all_dries = [];
            if(!request()->page){
                $page = 1;
            }
            else{
                $page = request()->page;
            }

            foreach($orders as $order){

                $washes = DB::table('orders as o')
                ->join('wash_orders as wo','wo.idOrder','o.id')
                ->select('wo.*')
                ->where('o.id',$order->id)
                ->get(); 

                $irons = DB::table('orders as o')
                ->join('iron_orders as io','io.idOrder','o.id')
                ->select('io.*')
                ->where('o.id',$order->id)
                ->get();

                $dries = DB::table('orders as o')
                ->join('dry_cleaner_orders as do','do.idOrder','o.id')
                ->select('do.*')
                ->where('o.id',$order->id)
                ->get();

                foreach($washes as $wash){
                    $all_washes[] = $wash;
                }
                foreach($irons as $iron){
                    $all_irons[] = $iron;
                }
                foreach($dries as $dry){
                    $all_dries[] = $dry;
                }

                $all_orders[] = ["order"=>$order,"wash_orders"=>$all_washes,"iron_orders"=>$all_irons,"dry_orders"=>$all_dries];
                $all_washes = [];
                $all_irons = [];
                $all_dries = [];

                $ords = new LengthAwarePaginator($all_orders, $orders->total(), 100, $page);
                $ords->setPath(request()->url());
            }
            return response()->json($ords,200);
            return response()->json(["orders"=>$orders],200);
        }
        
        $orders = $orders->paginate(10);

        $data["orders"] = $orders;
        $data["sucursals"] = Sucursal::pluck('name','id');
        if(request()->ajax()){
            $view = View::make('order.table_order')->with($data);
            $sections = $view->renderSections();

            return response()->json($sections['data']);
        }
        //return $orders->lastPage();
        return view('order.table_order', $data);   
    }

    public function create(){
        $wash_services = WashService::select('*')->orderby('name','ASC')->get();
    	$iron_services = IronService::select('id','name','cost','promotion_cost')->orderby('name','ASC')->get();//pluck('name','id');
    	$dry_services = DryCleanerService::select('id','name','cost')->orderby('name','ASC')->get();//pluck('name','id');
        $sucursals = Sucursal::pluck('name','id');
        $promotions = Promotion::where('status','ACTIVE')->orderby('name','ASC')->pluck('name','id');

        if(request()->segment(1) == 'api'){
            return response()
            ->json(["wash_services"=>$wash_services,"iron_services"=>$iron_services,"dry_services"=>$dry_services,"sucursals"=>$sucursals,"promotions"=>$promotions],200);
        }
        else{
    	   return view('order.create',["wash_services"=>$wash_services,"iron_services"=>$iron_services,"dry_services"=>$dry_services,"sucursals"=>$sucursals,"promotions"=>$promotions]);
        }
    }

    public function store(Request $request){
        //Se busca el cliente en la base de datos
        $customer = Customer::where('name',request()->customer)->first();

        //Si el cliente no esta registrado se crea su registro
        if(!$customer){
            if(request()->user()->type == 'SUPER'){
                $customer = Customer::create([
                    'name' => request()->customer,
                    'phone' => request()->phone,
                    'idSucursal' => request()->idSucursal
                ]);
            }
            else{
                $customer = Customer::create([
                    'name' => request()->customer,
                    'phone' => request()->phone,
                    'idSucursal' => request()->user()->sucursal->id
                ]);
            }
        }
        else{
            //Si el cliente esta registrado y se proporciona un telefono se actualiza
            if(!$customer->phone && request()->phone){
                $customer->phone = request()->phone;
                $customer->update();
            }
        }

        //Se crea el registro de la Orden
        $order = new Order;
        $order->idCustomer = $customer->id;
        $order->idUser = request()->user()->id;

        if(request()->user()->type == 'SUPER')
            $order->idSucursal = request()->idSucursal;
        else
            $order->idSucursal = request()->user()->sucursal->id;

        $order->delivery_date = request()->delivery_date." ".request()->hour;
        $order->descount = request()->descount;
        $order->payment_type = request()->payment_type;
        
        $order->save();

    	$total = 0;
        $total_wash = 0;
        $total_iron = 0;
        $total_dry = 0;
        $descount = 0;

    	//Wash Orders, get total
    	$w_num = 1;
        while($w_num != 0){   
        	if(request()->has('wash_service'.$w_num)){
                $service = WashService::find($request['wash_service'.$w_num]);
                $wash_order = new WashOrder;

                $wash_order->quantity = $request['wash_quantity'.$w_num];
                $wash_order->weight = $request['wash_weight'.$w_num];
                if($service->name == 'Secado por kilo')
                    $wash_order->weight = 0;
                $wash_order->cost = $service->cost;   
                
                if($request['wash_check'.$w_num])
                    $wash_order->free = 'SI';
                else
                    $wash_order->free = 'NO';

                $wash_order->service = $service->name;
                $wash_order->idOrder = $order->id;
                $wash_order->save();

                if($wash_order->free == 'NO'){
                    if($wash_order->weight != null){
                        if($service->name == 'Secado por kilo'){
                            if($wash_order->weight < 1.8)
                                $total_wash += 30;
                            else   
                                $total_wash += $wash_order->cost * $wash_order->weight; 
                        }
                        else if($wash_order->weight < 1.6)
                            $total_wash += 70;
                        else   
                            $total_wash += $wash_order->cost * $wash_order->weight;  
                    }
                    else
                        $total_wash += $wash_order->cost * $wash_order->quantity;   
                }
                $w_num = $w_num+1;
            }
            else{
                $w_num = 0;
            }
        }
    	
    	//Iron Orders, get total
    	$i_num = 1;
        while($i_num != 0){   
        	if(request()->has('iron_service'.$i_num)){
                $service = IronService::find($request['iron_service'.$i_num]);
                $iron_order = new IronOrder;

                /*if($request['iron_quantity'.$i_num] != null)
                    $iron_order->quantity = $request['iron_quantity'.$i_num];
                else
                    $iron_order->quantity = 1;*/

                $iron_order->quantity = $request['iron_quantity'.$i_num];

                if($service->promotion_cost != null && $request['iron_promotion'.$i_num]){
                    $iron_order->promotion = 'SI'; //$request['iron_promotion'.$i_num];
                    $iron_order->cost = $service->promotion_cost;
                }
                else{
                    $iron_order->promotion = 'NO';
                    $iron_order->cost = $service->cost;
                }

                if($request['iron_check'.$i_num])
                    $iron_order->free = 'SI';
                else
                    $iron_order->free = 'NO';

                $iron_order->service = $service->name;
                $iron_order->idOrder = $order->id;
                $iron_order->save();

                if($iron_order->free == 'NO')
                    $total_iron += $iron_order->cost * $iron_order->quantity; 

                $i_num = $i_num+1;
            }
            else{
                $i_num = 0;
            }
        }

    	//Dry Cleaner Orders, get total
        $d_num = 1;
        while($d_num != 0){   
        	if(request()->has('dry_service'.$d_num)){
                $service = DryCleanerService::find($request['dry_service'.$d_num]);
                $dry_order = new DryCleanerOrder;
                $sum = 0;

                /*if($request['dry_quantity'.$d_num] != null)
                    $dry_order->quantity = $request['dry_quantity'.$d_num];
                else
                    $dry_order->quantity = 1;*/

                $dry_order->quantity = $request['dry_quantity'.$d_num];
                $dry_order->descount = $request['dry_descount'.$d_num];
                $dry_order->cost = $service->cost;

                $dry_order->service = $service->name;
                $dry_order->idOrder = $order->id;
                $dry_order->save();

                $sum = $dry_order->cost * $dry_order->quantity; 

                if($dry_order->descount != null)
                    $sum -= $sum * ($dry_order->descount / 100);

                $total_dry += $sum;
                $d_num = $d_num+1;
            }
            else{
                $d_num = 0;
            }
        }

        if(request()->descount){
            //$descount = $total_wash + $total_iron;
            $descount = ($total_wash + $total_iron) * (request()->descount / 100);
        }

        $order->total = $total_wash + $total_iron + $total_dry - $descount;
        $order->total_wash = $total_wash;
        $order->total_iron = $total_iron;
        $order->total_dry = $total_dry;

        //$pay = $request['pay'];
        //Se crea una actualizacion por el dinero recibido
        $pay = request()->pay;
        if($pay){    
            $update = new OrderUpdate;
            $update->name = 'pay';
            if($order->total < $pay || $order->total == $pay){
                $update->price = $order->total;
                $order->status = 'PAID';
                $order->balance = 0;
            }
            else{
                $update->price = $pay;
                $order->balance = $order->total - $pay;
            }

            $update->status = 'DOWN';
            $update->idOrder = $order->id;
            $update->save();
        }
        else{
            $order->balance = $order->total;
        }

        $order->update();

        if(request()->promotion){   
            $promotion = Promotion::find(request()->promotion);
            PromotionOrder::create([
                'name' => $promotion->name,
                'description' => $promotion->description,
                'idOrder' => $order->id
            ]);
        }

        if(request()->segment(1) == 'api'){
            return response()
            ->json(['order'=>$order],200);
        }
        else{
            return Redirect::to('order');
        }
    }

    public function show($id){
    	$order = Order::findOrFail($id);
        $total_promotion = 0;

        //$total_promotion = $total_wash + $total_iron + $total_dry - $order->total;

        if(request()->segment(1) == 'api'){
            $ord = DB::table('orders as o')
            ->join('customers as c','o.idcustomer','c.id')
            ->join('users as u','o.idUser','u.id')
            ->join('sucursals as s','o.idsucursal','s.id')
            ->select('o.id','c.name as customer','o.delivery_date','o.status','o.total','o.balance','u.name as user','s.name as sucursal','o.created_at','o.updated_at')
            ->where('o.id',$order->id)
            ->get()->first(); 

            $wash_orders = DB::table('orders as o')
            ->join('wash_orders as wo','wo.idOrder','o.id')
            ->select('wo.*')
            ->where('o.id',$order->id)
            ->get(); 

            $iron_orders = DB::table('orders as o')
            ->join('iron_orders as io','io.idOrder','o.id')
            ->select('io.*')
            ->where('o.id',$order->id)
            ->get();

            $dry_orders = DB::table('orders as o')
            ->join('dry_cleaner_orders as do','do.idOrder','o.id')
            ->select('do.*')
            ->where('o.id',$order->id)
            ->get();

            return response()
            ->json(["order"=>$ord,"wash_orders"=>$wash_orders,"iron_orders"=>$iron_orders,
                "dry_orders"=>$dry_orders,"promotion"=>$order->promotion,"total_wash"=>$order->total_wash,
                "total_iron"=>$order->total_iron,"total_dry"=>$order->total_dry,"total_promotion"=>$total_promotion,
                ],200);
        }
        else{
    	   return view('order.show',["order"=>$order,"total_promotion"=>$total_promotion]);
        }
    }

    public function edit(){

    }

    public function update($id){

    }

    public function destroy(){

    }

    /*public function pay($id, Request $request){
        $order = Order::findOrFail($id);

        $pay = $request['pay'.$order->id];

        if($order->balance < $pay || $order->balance == $pay){
            $order->status = 'PAID';
            $order->balance = 0;
        }
        else{
            $order->balance = $order->balance - $pay;
        }

        $order->update();

        if(request()->ajax()){
            return response()->json(["order"=>$order],200);
        }

        if(request()->segment(1) == 'api'){
            return response()
            ->json(["order"=>$order],200);
        }
        else{
            return back();
        }
    }*/

    public function pay($id){
        $order = Order::findOrFail($id);

        //Se crea una actualizacion por el dinero recibido
        $update = new OrderUpdate;
        $pay = request()->pay;

        $update->name = 'pay';

        if($order->balance < $pay || $order->balance == $pay){
            $update->price = $order->balance;
            $order->status = 'PAID';
            $order->balance = 0;
        }
        else{
            $update->price = $pay;
            $order->balance = $order->balance - $pay;
        }

        $update->status = 'DOWN';
        $update->idOrder = $order->id;
        $update->save();

        /*OrderUpdate::create([
            'name' => 'pay',
            'price' => $pay,
            'status' => 'DOWN',
            'idOrder' => $order->id
        ]);*/

        $order->update();

        if(request()->ajax()){
            return response()->json(["order"=>$order],200);
        }

        if(request()->segment(1) == 'api'){
            return response()->json(["order"=>$order],200);
        }
        else{
            return back();
        }
    }

    public function charge($id){
        $order = Order::findOrFail($id);
        $order->charge = request()->charge;
        $order->balance = $order->balance + request()->charge;
        $order->status = 'UNPAID';

        //Se crea una actualizacion por el cargo realizado
        OrderUpdate::create([
            'name' => 'charge',
            'price' => request()->charge,
            'status' => 'UP',
            'idOrder' => $order->id
        ]);
        $order->update();

        if(request()->ajax()){
            return response()->json(["order"=>$order],200);
        }

        if(request()->segment(1) == 'api'){
            return response()->json(["order"=>$order],200);
        }
    }

    public function delivery($id){
        $order = Order::findOrFail($id);
        $order->delivered = date('Y-m-d H:i:s');

        //Se crea una actualizacion al entregar el pedido
        OrderUpdate::create([
            'name' => 'deliver',
            'idOrder' => $order->id
        ]);
        $order->update();

        if(request()->ajax()){
            return response()->json(["order"=>$order],200);
        }

        if(request()->segment(1) == 'api'){
            return response()->json(["order"=>$order],200);
        }
        else{
            return back();
        }
    }

    public function searchCustomers(){
        return Customer::where('name','LIKE','%'.request()->q.'%')->get();
    }

    public function searchOrders(){
        $ord = explode('X',request()->q);
        return Order::where('id','LIKE','%'.$ord[0].'%')->get();
    }

    public function search(){
        $orders = DB::table('orders');

        if(request()->search){
            $orders = $orders->where('id','LIKE','%'.request()->search.'%');
        }     

        if(request()->start){
            $orders = $orders->where('created_at','>=',request()->start);
        }
        if(request()->final){
            $orders = $orders->where('created_at','<=',request()->final);
        }
        if(request()->idSucursal){
            $orders = $orders->where('idSucursal',request()->idSucursal);
        }

        $orders = $orders->paginate(100);
        //return $orders;
        if(request()->segment(1) == 'api'){
            return response()
            ->json(["orders"=>$orders],200);
        }
        if(request()->ajax()){
            $view = View::make('order.table_order')->with('orders',$orders);
            $sections = $view->renderSections();
            return response()->json($sections['data']);
        }
    }

    public function getOrder($id){
        $orders = Order::where('id','LIKE','%'.$id.'%')->get();//('id',$id)->get();
        $sucursals = [];
        $customers = [];
        $users = [];

        foreach($orders as $order){
            $sucursals[] = $order->sucursal;
            $customers[] = $order->customer;
            $users[] = $order->user;
        }
        return response()
            ->json(["orders"=>$orders,"sucursals"=>$sucursals,"customers"=>$customers,"users"=>$users],200);
    }

    public function ajax(){
        //return json() "PRUEBA SUCCESFUL";
        return response()->json([
            'message' => 'PRUEBA SUCCESFUL',
        ]);
    }

    public function editWeight($id){
        $wash_order = WashOrder::findOrFail($id);
        $order = Order::findOrFail($wash_order->idOrder);
        
        $wash_order->weight = request()->weight;
        $wash_order->update();
        
        if($wash_order->weight < 1.8)
            $total = 30;
        else   
            $total = $wash_order->cost * $wash_order->weight; 

        $order->total += $total;
        $order->total_wash += $total;
        $order->balance += $total;
        $order->status = 'UNPAID';

        //Se crea una actualizacion por el registro del peso
        OrderUpdate::create([
            'name' => 'weight',
            'quantity' => request()->weight,
            'price' => $total,
            'status' => 'UP',
            'idOrder' => $order->id
        ]);

        $order->update();

        return redirect()->action('OrderController@show',$wash_order->idOrder);
    }

    public function add_ironOrders($id){
        $data["order"] = Order::findOrFail($id);
        $data["iron_services"] = IronService::select('id','name','cost','promotion_cost')->orderby('name','ASC')->get();
        return view('order.add_ironOrders',$data);        
    }

    public function store_ironOrders(Request $request, $id){
        //return request();
        $order = Order::findOrFail($id);
        $total_services = 0;
        $total_iron = 0;

        $i_num = 1;
        while($i_num != 0){   
            if(request()->has('iron_service'.$i_num)){
                $service = IronService::find($request['iron_service'.$i_num]);
                $iron_order = new IronOrder;

                $iron_order->quantity = $request['iron_quantity'.$i_num];

                if($service->promotion_cost != null && $request['iron_promotion'.$i_num]){
                    $iron_order->promotion = 'SI'; //$request['iron_promotion'.$i_num];
                    $iron_order->cost = $service->promotion_cost;
                }
                else{
                    $iron_order->promotion = 'NO';
                    $iron_order->cost = $service->cost;
                }

                if($request['iron_check'.$i_num])
                    $iron_order->free = 'SI';
                else
                    $iron_order->free = 'NO';

                $iron_order->service = $service->name;
                $iron_order->idOrder = $order->id;
                $iron_order->save();

                if($iron_order->free == 'NO')
                    $total_iron += $iron_order->cost * $iron_order->quantity; 

                $i_num = $i_num+1;
                $total_services += 1;
            }
            else{
                $i_num = 0;
            }
        }

        $order->total += $total_iron;
        $order->total_iron = $total_iron;
        $order->balance += $total_iron;
        $order->status = 'UNPAID';

        //Se crea una actualizacion por el registro del peso
        OrderUpdate::create([
            'name' => 'iron_services',
            'quantity' => $total_services,
            'price' => $total_iron,
            'status' => 'UP',
            'idOrder' => $order->id
        ]);

        $order->update();
        return redirect()->action('OrderController@show',$order->id);
    }

    public function dailyCash(){
        $sucursals = Sucursal::all();
        $result = [];
        $prices = DB::table('order_updates as u')
                ->join('orders as o','u.idOrder','o.id')
                ->join('sucursals as s','o.idSucursal','s.id')
                ->select('u.price','u.status','s.name')
                ->where('u.status','DOWN');

        if(request()->start)
            $prices = $prices->where('u.created_at','>=',request()->start);
        if(request()->final){   
            $final = request()->final;
            $prices = $prices->where('u.created_at','<=',$final);
        }
        else{
            $final = strtotime('+1 day', strtotime(request()->start));
            $final = date('Y-m-d H:i:s',$final);
            $prices = $prices->where('u.created_at','<=',$final);
        }
        if(request()->sucursal){
            $prices = $prices->where('o.idSucursal',request()->sucursal);
        }

        $prices = $prices->get();

        foreach($sucursals as $sucursal){
            $result[$sucursal->name] = 0;
        }

        foreach($prices as $price){
            $result[$price->name] += $price->price;
        }
        if(request()->segment(1) == 'api'){
            return response()
            ->json(["day"=>request()->start,"final"=>$final,"result"=>$result],200);//,"prices"=>$prices],200);
        }
    }

    public function notDelivered(){
        $sucursals = Sucursal::all();
        $result = [];
        $orders = DB::table('orders as o')
                ->join('customers as c','o.idCustomer','c.id')
                ->join('users as u','o.idUser','u.id')
                ->join('sucursals as s','o.idSucursal','s.id')
                ->select('o.id','c.name as customer', 'c.phone as phone','o.delivery_date','o.delivered','o.status','o.charge','o.payment_type','o.total','o.balance','u.name as user','s.name as sucursal','o.created_at','o.updated_at')
                ->where('delivered',null);

        if(request()->start){
            $orders = $orders->where('o.created_at','>=',request()->start);
        }
        if(request()->final){
           $orders = $orders->where('o.created_at','<=',request()->final);
        }

        $orders = $orders->get();

        foreach($sucursals as $sucursal){
            $result[$sucursal->name] = [];
        }

        foreach($orders as $order){
            $result[$order->sucursal][] = $order;
        }

        if(request()->segment(1) == 'api'){
            return response()
            ->json(["start"=>request()->start,"final"=>request()->final,"result"=>$result],200);
        }
    }

    public function notPayed(){
        $sucursals = Sucursal::all();
        $result = [];
        $orders = DB::table('orders as o')
                ->join('customers as c','o.idCustomer','c.id')
                ->join('users as u','o.idUser','u.id')
                ->join('sucursals as s','o.idSucursal','s.id')
                ->select('o.id','c.name as customer', 'c.phone as phone','o.delivery_date','o.delivered','o.status','o.charge','o.payment_type','o.total','o.balance','u.name as user','s.name as sucursal','o.created_at','o.updated_at')
                ->where('o.status','UNPAID');

        if(request()->start){
            $orders = $orders->where('o.created_at','>=',request()->start);
        }
        if(request()->final){
           $orders = $orders->where('o.created_at','<=',request()->final);
        }

        $orders = $orders->get();

        foreach($sucursals as $sucursal){
            $result[$sucursal->name] = [];
        }

        foreach($orders as $order){
            $result[$order->sucursal][] = $order;
        }

        if(request()->segment(1) == 'api'){
            return response()
            ->json(["start"=>request()->start,"final"=>request()->final,"result"=>$result],200);
        }
    }

    public function totalBalance(){
        $sucursals = Sucursal::all();
        $result = [];
        $orders = DB::table('orders as o')
                ->join('sucursals as s','o.idSucursal','s.id')
                ->select('o.balance','s.name as sucursal')
                ->where('o.balance','>',0);

        if(request()->start){
            $orders = $orders->where('o.created_at','>=',request()->start);
        }
        if(request()->final){
           $orders = $orders->where('o.created_at','<=',request()->final);
        }

        $orders = $orders->get();

        foreach($sucursals as $sucursal){
            $result[$sucursal->name] = 0;
        }

        foreach($orders as $order){
            $result[$order->sucursal] += $order->balance;
        }

        if(request()->segment(1) == 'api'){
            return response()
            ->json(["start"=>request()->start,"final"=>request()->final,"result"=>$result],200);
        }
    }

    public function totalCharges(){
        $sucursals = Sucursal::all();
        $result = [];
        $charges = DB::table('order_updates as u')
                ->join('orders as o','u.idOrder','o.id')
                ->join('sucursals as s','o.idSucursal','s.id')
                ->select('u.price','u.status','s.name')
                ->where('u.name','charge');

        if(request()->start)
            $charges = $charges->where('u.created_at','>=',request()->start);
        if(request()->final){   
            $final = request()->final;
            $charges = $charges->where('u.created_at','<=',$final);
        }
        else{
            $final = strtotime('+1 day', strtotime(request()->start));
            $final = date('Y-m-d H:i:s',$final);
            $charges = $charges->where('u.created_at','<=',$final);
        }
        if(request()->sucursal){
            $charges = $charges->where('o.idSucursal',request()->sucursal);
        }

        $charges = $charges->get();

        foreach($sucursals as $sucursal){
            $result[$sucursal->name] = 0;
        }

        foreach($charges as $charge){
            $result[$charge->name] += $charge->price;
        }
        if(request()->segment(1) == 'api'){
            return response()
            ->json(["day"=>request()->start,"final"=>$final,"result"=>$result,"charges"=>$charges],200);
        }
    }

    public function lateNotDelivered(){
        $sucursals = Sucursal::all();
        $result = [];
        $orders = DB::table('orders as o')
                ->join('customers as c','o.idCustomer','c.id')
                ->join('users as u','o.idUser','u.id')
                ->join('sucursals as s','o.idSucursal','s.id')
                ->select('o.id','c.name as customer', 'c.phone as phone','o.delivery_date','o.delivered','o.status','o.charge','o.payment_type','o.total','o.balance','u.name as user','s.name as sucursal','o.created_at','o.updated_at')
                ->where('o.delivered','>','o.delivery_date');

        if(request()->start){
            $orders = $orders->where('o.created_at','>=',request()->start);
        }
        if(request()->final){
            $final = request()->final;
            $orders = $orders->where('o.created_at','<=',request()->final);
        }
        else{
            $final = strtotime('+1 day', strtotime(request()->start));
            $final = date('Y-m-d H:i:s',$final);
            $orders = $orders->where('u.created_at','<=',$final);
        }

        $orders = $orders->orderby('o.created_at','DESC');
        $orders = $orders->get();

        foreach($sucursals as $sucursal){
            $result[$sucursal->name] = [];
        }

        foreach($orders as $order){
            $result[$order->sucursal][] = $order;
        }

        if(request()->segment(1) == 'api'){
            return response()
            ->json(["start"=>request()->start,"final"=>request()->final,"result"=>$result],200);
        }
    }
}
