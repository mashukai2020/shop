<?php

namespace App\Http\Controllers\Spon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class SponController extends Controller
{
    public  function index(){
        
        return view('spon/index');
    }
    public  function loc($qiqiqi){
        print_r($qiqiqi);
    }
}
