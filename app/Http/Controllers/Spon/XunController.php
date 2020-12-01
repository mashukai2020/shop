<?php

namespace App\Http\Controllers\Spon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Goods;
use App\Wuser;

class XunController extends Controller
{
    public  function index(){
        echo"543";
    }
    public function suan(){
        return view('suan/suan');
    }
    public function create(Request $request){
        $post=$request->except('_token');
        if(($post['zhi'])==16){
            $res=dechex($post['shu']);
        }else if(($post['zhi'])==8){
            $res=decoct($post['shu']);
        }else if(($post['zhi'])==2){
            $res=decbin($post['shu']);
        }else if(($post['zhi'])==10){
            $res=($post['shu']);

        }else{
            $res="暂不支持其他算法";

        }
        echo $res;
    }
    //小程序
    public function xcx(Request $request){
        //获取code 配置url 里的 appid appsecret
        $code = $request->get('code');
        $APPID="wx310529f2e18792c9";
        $APPSECRET="478154df1a89c06762b9cea6be7bfdc7";
        $url = "https://api.weixin.qq.com/sns/jscode2session?appid={$APPID}&secret={$APPSECRET}&js_code={$code}&grant_type=authorization_code";
        // $resspan =file_get_contents($url);
        //转json串
        $data = json_decode(file_get_contents($url),true); 
        // print_r($data);
        if(isset($data['errcode'])){
            $resspan=[
                'errno'=>50001,
                'msg'=>'登入失败',
            ];
        }else{
            if(empty(\DB::table('xcx')->where('openid',$data['openid'])->first())){
                \DB::table('xcx')->insert($data);
            }
            $token = md5($data['openid'].$data['session_key'].mt_rand(0,999999));
            //保存token
            $redis_key = 'xcx_token:'.$token;
            // $redis_login_hash = 'h:xcx:login:'.$token;
            // $login_info = [
            //     'uid' => 1234, 
            //     'user_name' => "三个",
            //     'login_time' => data("Y-m-d H:i:s"),
            //     'login_ip' => $request->getClientIp()
            // ];
            // print_r($login_info);
            Redis::set($redis_key,time());
            //设置过期时间
            Redis::expire($redis_key,7200);

            $token;
            // print_r($token);
            $resspan=[
                'errno'=>0,
                'msg'=>'ok',
                'data'=>[
                    'token'=>$token
                ]
            ];
        }
        return $resspan;
    }
    public function goods(){
        $page_size= request()->size;
        $data= \DB::table('p_goods')->limit(10)->paginate($page_size);
        return $data;
    }
    // $page_size = $request->get(10);
    // $g= Goods::select('goods_id','goods_name','goods_img','shop_price')->paginate($page_size)->get();
    // $response = [
    //     'errno' => 0,
    //     'msg'=>'ok',
    //     'data'=>[
    //         'list' =>$g->items()
    //     ]
    //     ];
    // return $response;
    public function list(){
        // $token = request()->get('access_token');
        // //echo $token;
        // //验证token是否正确
        // $token_key =  'xcx_token:'. $token;
        // echo 'key: >>>> '.$token_key;
        // $res = Redis::get($token_key);
        // var_dump($res);die;
        $goods_id=request()->get('goods_id');
        // print_r($goods_id);
        $data=Goods::select('goods_id','goods_name','shop_price','goods_img','goods_imgs','goods_desc')->where('goods_id',$goods_id)->first()->toArray();
        // print_r($data);die;
        $array=[
            "goods_name"=>$data['goods_name'],
            "shop_price"=>$data['shop_price'],
            "goods_desc"=>$data['goods_desc'],
            "goods_img"=>$data['goods_img'],
            "goods_imgs"=>explode(',',$data['goods_imgs'])
 
        ];
        // dump($data);
        return $array;
    }
    public function cart(){
        $data=\DB::table('p_goods')->where('cart_status','=',2)->get();
        return $data;
    }
    public function getuser(){
        $code = request()->get('code');
        // echo $code;
        //使用code
        $userinfo =json_decode(file_get_contents("php://input"),true);
        $url = 'https://api.weixin.qq.com/sns/jscode2session?appid='.env('APPID').'&secret='.env('APPSECRET').'&js_code='.$code.'&grant_type=authorization_code';
        $data = json_decode(file_get_contents($url),true);
        if(isset($data['errcode'])){
            $response = [
                'error' =>50001,
                'msg' =>'登入失败',
            ];
        }else{
            $openid = $data['openid'];
            $u = Wuser::where(['openid'=>$openid])->first();
            if($u){
				return "登入过了"; 
            }else{
                $u_info = [
                    'openid' => $openid,
                    'nickname' => $userinfo['u']['nickName'],
                    'sex' => $userinfo['u']['gender'],
                    'language' => $userinfo['u']['language'],
                    'city' => $userinfo['u']['city'],
                    'province' => $userinfo['u']['province'],
                    'country' => $userinfo['u']['country'],
                    'headimgurl' => $userinfo['u']['avatarUrl'],
                    'time' => time(),
                    'type' =>3
                ]; 
				Wuser::insertGetId($u_info);
            }

        }

    }
}