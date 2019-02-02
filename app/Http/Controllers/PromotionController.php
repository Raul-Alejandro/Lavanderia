<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Promotion;
use App\RequirementService;
use App\WashService;
use App\IronService;
use App\DryCleanerService;
use DB;

class PromotionController extends Controller
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
    	$promotions = Promotion::paginate(20);

        if(request()->segment(1) == 'api'){
            $all_promotions = [];
            $all_requirements = [];

            $promotions = Promotion::all();
            foreach($promotions as $promotion){
                $requirements = $promotion->requirements;
                foreach($requirements as $requirement){
                    $all_requirements[] = $requirement;
                }
                //$prom = $promotion;// [$promotion,$all_requirements];
                $all_promotions[] = $promotion;
                $all_requirements = [];
            }
            return response()->json($all_promotions,200); 
            /*$promotions = DB::table('promotions as p')
                ->join('requirement_services as r','r.idPromotion','p.id')
                ->select('p.*','r.*')
                ->paginate(20);*/
            //$promotions = Promotion::all();
            /*$requirements = RequirementService::all();


            return response()
            ->json(["promotions"=>$promotions,"requirements"=>$requirements],200); */
        }
        else{
    	    return view('promotion.index',["promotions"=>$promotions]);
        }
    }

    public function create(){
        $wash_services = WashService::select('id','name')->orderby('name','ASC')->get();
        $iron_services = IronService::select('id','name')->orderby('name','ASC')->get();
        $dry_services = DryCleanerService::select('id','name','cost')->orderby('name','ASC')->get();

        if(request()->segment(1) == 'api'){
            return response()
            ->json(["wash_services"=>$wash_services,"iron_services"=>$iron_services,"dry_services"=>$dry_services],200); 
        }
        else{
        	return view('promotion.create',["wash_services"=>$wash_services,"iron_services"=>$iron_services,"dry_services"=>$dry_services]);
        }
    }

    public function store(Request $request){
    	$promotion = Promotion::create([
    		'name' => request()->name,
    		'description' => request()->description,
    		'status' => 'ACTIVE'
    	]);

        //Wash Orders
        $w_num = 1;
        while($w_num != 0){   
            if(request()->has('wash_service'.$w_num)){
                $requirement_prom = RequirementService::create([
                    'quantity' => $request['wash_quantity'.$w_num],
                    'type' => $request['wash_type'.$w_num],
                    'idWashService' => $request['wash_service'.$w_num],
                    'idPromotion' => $promotion->id
                ]);
                $w_num = $w_num+1;
            }
            else{
                $w_num = 0;
            }
        }
        
        //Iron Orders
        $i_num = 1;
        while($i_num != 0){   
            if(request()->has('iron_service'.$i_num)){
                $requirement_prom = RequirementService::create([
                    'quantity' => $request['iron_quantity'.$i_num],
                    'type' => $request['iron_type'.$i_num],
                    'idIronService' => $request['iron_service'.$i_num],
                    'idPromotion' => $promotion->id
                ]);
                $i_num = $i_num+1;
            }
            else{
                $i_num = 0;
            }
        }

        //Dry Cleaner Orders
        $d_num = 1;
        while($d_num != 0){   
            if(request()->has('dry_service'.$d_num)){
                $requirement_prom = RequirementService::create([
                    'quantity' => $request['dry_quantity'.$d_num],
                    'type' => $request['dry_type'.$d_num],
                    'idDryService' => $request['dry_service'.$d_num],
                    'idPromotion' => $promotion->id
                ]);
                $d_num = $d_num+1;
            }
            else{
                $d_num = 0;
            }
        }

        if(request()->segment(1) == 'api'){
            return response()
            ->json(["promotion"=>$promotion],200); 
        }
        else{
            return Redirect::to('promotion');
        }
        
    }

    public function show($id){
    	$promotion = Promotion::findOrFail($id);
    	return view('promotion.show',["promotion"=>$promotion]);
    }

    public function edit($id){
    	$promotion = Promotion::findOrFail($id);
    	return view('promotion.edit',["promotion"=>$promotion]);
    }

    public function update($id){
    	$promotion = Promotion::findOrFail($id);
    	$promotion->fill(request()->all());
    	$promotion->update();

        if(request()->segment(1) == 'api'){
            return response()
            ->json(["promotion"=>$promotion],200); 
        }
        else{
            return Redirect::to('promotion');
        }
    }

    public function destroy($id){
        Promotion::destroy($id);

        if(request()->segment(1) == 'api'){
            return response()
            ->json(["state"=>"OK"],200); 
        }
        else{
            return back();
        }
    }

    public function changeStatus($id){
    	$promotion = Promotion::findOrFail($id);
    	if($promotion->status == 'ACTIVE'){
    		$promotion->status = 'INACTIVE';
    	}
    	else{
    		$promotion->status = 'ACTIVE';
    	}
    	$promotion->update();

        if(request()->segment(1) == 'api'){
            return response()
            ->json(["promotion"=>$promotion],200); 
        }
        else{
    	    return back();
        }
    }

    public function createRequirement($id){
        $promotion = Promotion::findOrFail($id);
        $wash_services = WashService::select('id','name')->orderby('name','ASC')->get();
        $iron_services = IronService::select('id','name')->orderby('name','ASC')->get();
        $dry_services = DryCleanerService::select('id','name','cost')->orderby('name','ASC')->get();
        return view('promotion.createrequirement',["promotion"=>$promotion,"wash_services"=>$wash_services,"iron_services"=>$iron_services,"dry_services"=>$dry_services]);
    }

    public function editRequirement($promotion, $id){
        $requirement = RequirementService::findOrFail($id);
        if($requirement->idWashService){
            $services = WashService::pluck('name','id');
        }
        if($requirement->idIronService){
            $services = IronService::pluck('name','id');
        }
        if($requirement->idDryService){
            $services = DryCleanerService::pluck('name','id');
        }

        if(request()->segment(1) == 'api'){
            return response()
            ->json(["requirement"=>$requirement,"services"=>$services],200); 
        }
        else{
            return view('promotion.editrequirement',["promotion"=>$promotion,"requirement"=>$requirement,"services"=>$services]);
        }
    }

    public function updateRequirement($promotion, $id){
        $requirement = RequirementService::findOrFail($id);
        $requirement->fill(request()->all());
        $requirement->update();

        if(request()->segment(1) == 'api'){
            return response()
            ->json(["requirement"=>$requirement],200); 
        }
        else{
            return redirect()->action('PromotionController@show', $promotion);
        }
    }

    public function addRequirement($id, Request $request){
        $promotion = Promotion::findOrFail($id);

        //Wash Orders
        $w_num = 1;
        while($w_num != 0){   
            if(request()->has('wash_service'.$w_num)){
                $requirement_prom = RequirementService::create([
                    'quantity' => $request['wash_quantity'.$w_num],
                    'type' => $request['wash_type'.$w_num],
                    'idWashService' => $request['wash_service'.$w_num],
                    'idPromotion' => $promotion->id
                ]);
                $w_num = $w_num+1;
            }
            else{
                $w_num = 0;
            }
        }
        
        //Iron Orders
        $i_num = 1;
        while($i_num != 0){   
            if(request()->has('iron_service'.$i_num)){
                $requirement_prom = RequirementService::create([
                    'quantity' => $request['iron_quantity'.$i_num],
                    'type' => $request['iron_type'.$i_num],
                    'idIronService' => $request['iron_service'.$i_num],
                    'idPromotion' => $promotion->id
                ]);
                $i_num = $i_num+1;
            }
            else{
                $i_num = 0;
            }
        }

        //Dry Cleaner Orders
        $d_num = 1;
        while($d_num != 0){   
            if(request()->has('dry_service'.$d_num)){
                $requirement_prom = RequirementService::create([
                    'quantity' => $request['dry_quantity'.$d_num],
                    'type' => $request['dry_type'.$d_num],
                    'idDryService' => $request['dry_service'.$d_num],
                    'idPromotion' => $promotion->id
                ]);
                $d_num = $d_num+1;
            }
            else{
                $d_num = 0;
            }
        }

        if(request()->segment(1) == 'api'){
            return response()
            ->json(["status"=>"OK"],200); 
        }
        else{
            return redirect()->action('PromotionController@show', $promotion->id);
        }
    }

    public function getRequeriments($id){
        $promotion = Promotion::findOrFail($id);
        $costs = [];
        foreach($promotion->requirements as $requirement){
            if($requirement->idWashService != null)
                $costs[] = $requirement->washService->cost;
            if($requirement->idIronService != null)
                $costs[] = $requirement->ironService->cost;
            if($requirement->idDryService != null)
                $costs[] = $requirement->dryService->cost;
        }

        return response()->json([
            'requirements' => $promotion->requirements,
            'costs' => $costs,
        ],200);
    }
}
