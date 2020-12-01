<?php

namespace App\Http\Controllers\Chou;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class ChouController extends Controller
{
    public function index(){
        return view('chou/index');
    }
    public function yunqi(){
        session_start();
        // dump($_SESSION);exit;
        if($_SESSION==''){
            return redirect('index/login');die;
        }
        $rand = mt_rand(1,666);
        // $rand = 1;
        $size = 0;
        if($rand==1){
            echo('牛逼啊一等奖');
            $size = 1;
        }else if($rand == 6 || $rand==66 || $rand==666){
            echo('二等奖牛逼呀');
            $size =2;
        }else{
            echo('谢谢入坑');
        }
        // dump($size);exit;
        // return $size;
        // if($size==1){
        //     echo json_encode(['code'=>'00000','msg'=>'一等奖！']);
        // }else if($size==2){
        //     echo json_encode(['code'=>'00000','msg'=>'二等奖！']);
        // }else{
        //     echo json_encode(['code'=>'00000','msg'=>'抽了个寂寞']);

        // }
    }

}


