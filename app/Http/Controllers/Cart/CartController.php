<?php

namespace App\Http\Controllers\Cart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use app\Model\Cart;
use Validator;
use App\http\Requests\StoreBrandPost;
use Illuminate\Validation\Rule;
class CartController extends Controller
{
    public function cart_do(Request $request){
        session_start();
        $post=$request->except('_token');
        $post['user_id']=3836;
        $post['ctime']=time();
        // dump($post);exit;
        if($post['buy_number']>20){
            echo"不能大于20";
            $goods_id=$post['goods_id'];
            $res= \DB::table('p_goods')->where('goods_id',$goods_id)->first();
            if($res==''){
                echo"无商品";
                return view('index/index');
            }
    
            return view('goods/list',['res'=>$res]);exit;
        }else{
            $goods = \DB::table('cart')->where('goods_id',$post['goods_id'])->value('buy_number');
            // dump($post);
            // dump($goods);exit;
            if($goods==''){
                $res = \DB::table('cart')->insert($post);
            }else{
                $data['buy_number']=$goods+$post['buy_number'];
                if($data['buy_number']>20){
                    echo"购物车的数量不能大于20";
                    $goods_id=$post['goods_id'];
                    $res= \DB::table('p_goods')->where('goods_id',$goods_id)->first();
                    if($res==''){
                        echo"无商品";
                        return view('index/index');
                    }
            
                    return view('goods/list',['res'=>$res]);exit;
                }else{
                    $update=[
                        'buy_number' => $data['buy_number'],
                    ];
    
                // dump($data);exit;
                $add = \DB::table('cart')->where('goods_id',$post['goods_id'])->update($update);
                }

            }
    
            return redirect('cart/cartlist');
        }
        
    }
    public function cartlist(){
        $res = \DB::table('cart')
              ->join('p_goods','cart.goods_id','=','p_goods.goods_id')
              ->orderBy('ctime','desc')->paginate(100000);
        // print_r($res);exit;
        return view('goods/cart',['res'=>$res]);
    }
    public function delete($cart_id)
    {
        //
        $res= \DB::table('cart')->where('cart_id',$cart_id)->delete();
        if($res){
            echo json_encode(['code'=>'00000','msg'=>'删除成功！']);die;
        }
    }
    public function zong($cart_id){
        // dump($cart_id);
        $res = \DB::table('cart')
                ->join('p_goods','cart.goods_id','=','p_goods.goods_id')
                ->where('cart_id',$cart_id)
                ->value('shop_price');
        $res3 = \DB::table('cart')
                ->join('p_goods','cart.goods_id','=','p_goods.goods_id')
                ->where('cart_id',$cart_id)
                ->value('goods_id');
        $res1 = \DB::table('cart')->where('cart_id',$cart_id)->value('buy_number');

        $res2['zong_price'] = $res1*$res;
        $res2['goods_id']=$res3;
        $res2['user_id']=3836;
        $data = \DB::table('order')->insert($res2);
        if($data){
            echo json_encode(['code'=>'00000','msg'=>'勾选成功！']);die;
        }
    }
    public function deng(Request $request){
        session_start();
 
        if ($request->session()->has('user')) {
            echo"1";

        }else{
            echo"2";
        }
    }
    

}