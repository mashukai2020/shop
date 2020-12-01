<?php

namespace App\Http\Controllers\Dian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class DianController extends Controller
{
    public function index(){
        $myArray=array(
            1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18
       );
    return view('dian/index',['myArray'=>$myArray]);
    }
    public function create(Request $request){
        $post=$request->except('_token');
        // dump($post);
        $res=table('dian')->insert();
        
    }

}
