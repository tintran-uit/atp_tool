<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use DB;
use Session;
class HomeController extends Controller
{
    public $user;
    public $token;
    public function __construct()
    {
        //check
        if (Auth::check()) {
            $this->user = Auth::user();
            $email  = $this->user->email;
            $this->token = DB::table('access_token')->where('email', $email)->get();
        }
        

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if (Auth::check()) {
            return view('Account.index', ['user' => $this->user, 'token' => $this->token]);
        }   
            return redirect()->guest('login');
    }

    public function AccessToken()
    {
        if (Auth::check()) {
            return view('Account.AccessToken', ['user' => $this->user, 'token' => $this->token]);
        }   
            return redirect()->guest('login');
        
    }


    public function ChangePass(Request $request)
    {
        if (Auth::check()) {
            $password = md5(md5($request->password));
            $email = Auth::user()->email;
            DB::table('user')
                ->where('email', $email)
                ->update(['password' => $password]);
            return redirect()->guest('quan-ly-tai-khoan');
        }   
            return redirect()->guest('login');
        
    }

    public function SentMessage()
    {
        if (Auth::check()) {
            return view('SentMessage.SentMessage', ['user' => $this->user, 'token' => $this->token]);
        }   
            return redirect()->guest('login');
    }

    public function PostGroup()
    {
        if (Auth::check()) {
            return view('post.PostGroup', ['user' => $this->user, 'token' => $this->token]);
        }   
            return redirect()->guest('login');
    }

    public function PostImage()
    {
        if (Auth::check()) {
            return view('post.PostImage', ['user' => $this->user, 'token' => $this->token]);
        }   
            return redirect()->guest('login');
    }

    public function PostToWall()
    {
        if (Auth::check()) {
            return view('post.PostToWall', ['user' => $this->user, 'token' => $this->token]);
        }   
            return redirect()->guest('login');
    }

    public function UpTop()
    {
        if (Auth::check()) {
            return view('upTop.UpTop', ['user' => $this->user, 'token' => $this->token]);
        }   
            return redirect()->guest('login');
    }

    public function CheckPhone(Request $request)
    {
        if (Auth::check()) {
            $email = $this->user->email;
            $phone = $request->phone;
            DB::table('user')
                ->where('email', $email)
                ->update(['ref' => $phone]);
            return redirect('quan-ly-tai-khoan');
        }   
            return redirect()->guest('login');
    }

    public function AddFriend()
    {
        if (Auth::check()) {
            return view('tools.AddFriend', ['user' => $this->user, 'token' => $this->token]);
        }   
            return redirect()->guest('login');
    }

    public function LikePage()
    {
        if (Auth::check()) {
            return view('tools.LikePage', ['user' => $this->user, 'token' => $this->token]);
        }   
            return redirect()->guest('login');
    }

    public function AddEvent()
    {
        if (Auth::check()) {
            return view('tools.AddEvent', ['user' => $this->user, 'token' => $this->token]);
        }   
            return redirect()->guest('login');
    }

    public function AddGroup()
    {
        if (Auth::check()) {
            return view('tools.AddGroup', ['user' => $this->user, 'token' => $this->token]);
        }   
            return redirect()->guest('login');
    }

    public function AddFriendToGroup()
    {
        if (Auth::check()) {
            return view('tools.AddFriendToGroup', ['user' => $this->user, 'token' => $this->token]);
        }   
            return redirect()->guest('login');
    }

    public function ToGroup()
    {
        if (Auth::check()) {
            return view('tools.ToGroup', ['user' => $this->user, 'token' => $this->token]);
        }   
            return redirect()->guest('login');
    }

    public function Unfriend()
    {
        if (Auth::check()) {
            return view('tools.Unfriend', ['user' => $this->user, 'token' => $this->token]);
        }   
            return redirect()->guest('login');
    }
    
    public function addAcc(Request $request)
    {
        $access = $request->mytoken;
        $pass  = $request->password;
        if (Auth::check()) {
            $soAcc = count($this->token);
            $msg = "";
            $vip = $this->user->vip;
            if($vip==1)
            {
                $vip=100;
            }
            if($vip==0)
            {
                $vip=10;
            }
            if($soAcc<$vip)
            {
                
                    if($access){
                        $info = $this->getinfoz($access);
                        if($info->name != ""){     
                            $check = DB::table('access_token')
                                ->where('userid',$info->id)->get();
                            if(count($check) == 0)
                            {                      
                                DB::table('access_token')
                                    ->insert(['id' => NULL,'access_token' =>  $access, 'fullname' =>  $info->name, 'userid' =>  $info->id, 'email' => $this->user->email]);
                                $msg = array('check' => 1,'msg' =>"Thêm tài khoản ".$info->name." thành công.");
                            }
                            else
                            {
                                $msg = array('check' => 0, 'msg' =>"Nick ".$info->name." đã tồn tại trong tài khoản: ".$check[0]->email);
                            }
                        } 
                        else
                             $msg = array('check' =>0, 'msg' =>"Hệ thống không thể thêm được tài khoản này");
                    }
          
            }
            else
                $msg = array('check' =>0, 'msg' =>"Hệ thống giới hạn số lượng tài khoản facebook được thêm là: 10");
            return $msg;
        }   
            return redirect()->guest('login');
    }

    public function getz($url){ 
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $userAgent = 'User-Agent: Dalvik/1.6.0 (Linux; U; Android 4.3; Z10 Build/10.3.2.110) [FBAN/FB4A;FBAV/19.0.0.23.14;FBLC/vi_VN;FBBV/4694056;FBCR/null;FBMF/RIM;FBBD/BlackBerry;FBDV/Z10;FBSV/4.3;FBCA/armeabi-v7a:armeabi;FBDM/{density=2.0,width=768,height=1174};FB_FW/1;]';
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'X-Forwarded-For: 187.235.36.50',
            'Client-Ip: 187.235.36.50',
            'Via: 187.235.36.50'
            ));
        curl_setopt($curl, CURLOPT_USERAGENT, $userAgent);
        $str = curl_exec($curl);
        curl_close($curl);
        return $str;
    }
    public function getinfoz($access_token)
    {
        $graph_url= "https://graph.beta.facebook.com/me/?access_token=" .$access_token;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $graph_url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $userAgent = 'Dalvik/1.6.0 (Linux; U; Android 4.4.2; VPhone Build/KOT49H) [FBAN/MobileAdsManagerAndroid;FBAV/14.0.0.73.92;FBBV/22740569;FBLC/en_US;FBMF/bignox;FBBD/Android;FBDV/VPhone;FBSV/4.4.2;FBCA/x86:armeabi-v7a;FBDM/{density=1.5625,width=1280,height=720};FB_FW/1;]';
        curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
        $output = json_decode(curl_exec($ch));
        curl_close($ch);
        return $output;
    }

    public function ThanhToan()
    {
        if (Auth::check()) {
            return view('thanhToan.thanhToan', ['user' => $this->user, 'token' => $this->token]);
        }   
            return redirect()->guest('login');
    }

    public function CheckPoint($random){
        if (Auth::check()) {
            $value = Session::get('cookie');
            $cookie = $this->user->cookie;
            $timeactive = $this->user->timeexp;
            $toDate = date('Y-m-d');
            if(strtotime($toDate) >= strtotime($timeactive))
            {
                return '3';
            }
            if($cookie == $value || $cookie == '')
                return  '1';
            return '1';
        }  
        else 
        	return '0';
    }
}
