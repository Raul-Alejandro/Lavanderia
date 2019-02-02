<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Image;

class ImageController extends Controller
{
    public function __construct(){

    }

    public function index(){
    	$images => Image::all();
    	if(request()->segment(1) == 'api'){
            return $images;
        }
        else{
           return view('image.index');
        }
    }

    public function create(){
    	return view('image.create');
    }

    public function store(){
    	if(request()->segment(1) == 'api'){
            return response()
            ->json(['state' => 'OK']);
        }
        else{
           return Redirect::to('image');
        }
    }

    public function show(){

    }

    public function edit($id){
    	$image = Image::findOrFail($id);
    	if(request()->segment(1) == 'api'){
            return $image;
        }
        else{
           return view('image.edit',["image"=>$image]);
        }
    }

    public function update($id){
    	$image = Image::findOrFail($id);

    	if(request()->segment(1) == 'api'){
            return response()
            ->json(['state' => 'OK']);
        }
        else{
           return Redirect::to('image');
        }
    }

    public function destroy($id){
    	Image::destroy($id);
    	if(request()->segment(1) == 'api'){
            return response()
            ->json(['state' => 'OK']);
        }
        else{
           return back();
        }
    }
}
