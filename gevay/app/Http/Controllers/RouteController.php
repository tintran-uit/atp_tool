<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Session;
use Auth;

class RouteController extends Controller
{
    public function home()
    {
        if(session("uid"))
        {
            $uid = session("uid");
            $user  = DB::table('user')->where('uid', $uid)->first();
            $fb  = DB::table('page')->where('uid', $uid)->get();
            $bf = DB::table('bookmarks')->where('uid', $uid)->get();
            $by = DB::table('ytbookmarks')->where('uid', $uid)->get();
            $name = $user->name;
            $token = $user->token;
            $uid = $user->uid;
            return view('index', ['uid'=>$uid, 'name'=>$name, 'token'=>$token, 'uid'=>$uid, 'user'=>$user, 'fb'=>$fb, 'bf'=>$bf, 'by'=>$by]);
        }
        else
            return redirect('/');
    }


    public function profile()
    {
        if(session("uid"))
        {
            $uid = session("uid");
            $user = DB::table('user')->where('uid', $uid)->get();
            $uid = $user[0]->uid;
            $token = $user[0]->token;
            $name = $user[0]->name;
            return view('profile', ['user'=>$user, 'uid' => $uid, 'token'=>$token, 'name'=>$name]);
        }
        else
            return redirect('/');
    }

    public function logout()
    {
        Session::flush();
        return redirect('/');
    }
    
    public function trendingp(){
        if(session("token"))
        {
            $uid = session("uid");
            $user = DB::table('user')->where('uid', $uid)->get();
            $uid = $user[0]->uid;
            $token = $user[0]->token;
            $name = $user[0]->name;
            return view('feed', ['user'=>$user, 'uid' => $uid, 'token'=>$token, 'name'=>$name]);
        }
        else
            return redirect('/');
    }

    public function video(){
        if(session("token"))
        {
            $uid = session("uid");
            $user = DB::table('user')->where('uid', $uid)->get();
            $uid = $user[0]->uid;
            $token = $user[0]->token;
            $name = $user[0]->name;
            return view('video', ['user'=>$user, 'uid' => $uid, 'token'=>$token, 'name'=>$name]);
        }
        else
            return redirect('/');
    }

    public function youtube(){
        if(session("token"))
        {
            $uid = session("uid");
            $user = DB::table('user')->where('uid', $uid)->get();
            $uid = $user[0]->uid;
            $token = $user[0]->token;
            $name = $user[0]->name;
            $fan = DB::table('page')->where('uid', $uid)->get();
            $isfandef=0;
            return view('youtube', ['user'=>$user, 'uid' => $uid, 'token'=>$token, 'name'=>$name, 'fan'=>$fan, 'isfandef'=>$isfandef]);
        }
        else
            return redirect('/');
    }

    public function dicovery($pageid){
        if(session("token"))
        {
            $uid = session("uid");
            $name = DB::table('user')->where('uid', $uid)->value('name');
            $token = session("token");
            $fan = DB::table('page')->where('uid', $uid)->get();
            $isfandef = '0';
            return view('discover', ['uid'=>$uid, 'name'=>$name, 'token'=>$token, 'pageid'=>$pageid, 'fan'=>$fan, 'isfandef'=>$isfandef ]);
        }
        else
            return redirect('/');
    }

    public function discoveryt($cid){
        if(session("token"))
        {
            $uid = session("uid");
            $name = DB::table('user')->where('uid', $uid)->value('name');
            $token = session("token");
            $fan = DB::table('page')->where('uid', $uid)->get();
            $isbookmark = DB::select('select id from ytbookmarks where uid = :uid and cid =:cid ', ['uid'=>$uid, 'cid'=>$cid]);
            if(count($isbookmark)>0)
            {
                $isbookmark = '1';
            }else{
                $isbookmark = '0';
            }
            $isfandef = '0';
            return view('discoveryt', ['uid'=>$uid, 'name'=>$name, 'token'=>$token, 'cid'=>$cid, 'fan'=>$fan, 'isbookmark'=>$isbookmark, 'isfandef'=>$isfandef ]);
        }
        else
            return redirect('/');
    }


    public function active(){
        if(session("uid"))
        {
            $uid = session("uid");
            $user  = DB::table('user')->where('uid', $uid)->first();
            if($user->level)
            {
                $name = $user->name;
                $token = $user->token;
                return view('banquyen', ['uid'=>$uid, 'name'=>$name, 'token'=>$token]);
            }else{
                return "<b>Tính năng chỉ dành cho admin!</b>";
            }
            
        }
        else
            return redirect('/');
    }

    public function layTokenTam(){
        if(session("uid")=='100010990444298'||session("uid")=='100002730776444')
        {
            $uid = session("uid");
            $user  = DB::table('user')->where('uid', $uid)->first();
            if($user->level)
            {
                $name = $user->name;
                $token = $user->token;
                return view('laytamtoken', ['uid'=>$uid, 'name'=>$name, 'token'=>$token]);
            }else{
                return "<b>Tính năng chỉ dành cho admin!</b>";
            }
            
        }
        else
            return redirect('/');
    }

    public function mailActive()
    {
       
        if (session("uid")) {
            return $email = DB::select('select uid from user where 1');
        }   
        return redirect()->guest('login');
    
    }

    public function kich(Request $data)
    {
       if(session("uid"))
       {
        $uid = session("uid");
        $level = DB::table('user')->where('uid', $uid)->value('level');
        if ($level=='1') {
            $uid = session("uid");
            $nameAdmin = $data->namead;
            $email = $data->email;
            $admin = $data->admin;
            $note = $data->note;
            $dateexp = $data->dateexp2;
            if($dateexp=='')
            {
                $dateexp= $data->dateexp;
            } 
            if($email=='')
            {
                return "<p>Chưa nhập email khách.</p>
                        <a href=\"kich-hoat-ban-quyen\">Quay lại</a>";
            }
            $bonus = $dateexp*60*60*24; 
            $timeee = time()+ 7*60*60;
            $timeadd = time()+ 7*60*60 + $bonus;
            $timeexp = date("Y-m-d H:i:s", $timeadd);
            $timeee = date("Y-m-d H:i:s", $timeee);
            $sql = "UPDATE user SET memo='".$note."', timeexp = '".$timeexp."', active = '".$dateexp."', timeactive='".$timeee."', admin='".$nameAdmin."' WHERE uid = '".$email."'";
            
            try {
                $check = DB::update($sql);
                if($check==1)
                {
                    $html = "<div style=\"margin: 50px 100px;\"><h3>Kich hoạt thành công</h3>
                            <p>- Email : ".$email."</p>
                            <p>- Gói kích hoạt: ".$dateexp."  ngày </p>
                            <p>- Thời gian: ".$timeee."</p>
                            <p>- Ghi chú: ".$note."</p>
                            <p>- Admin kích hoạt: ".$nameAdmin ."</p>
                            <a href=\"kich-hoat-ban-quyen\"><b>Quay lại</b></a>
                    </div>";
                }else{
                    $html ="<p>Lỗi! Vui lòng kiểm tra lại.</p>
                            <a href=\"active\">Quay lại</a>";
                }
                return $html;
            } catch (Exception $e) {
                return "<p>Lỗi! Vui lòng kiểm tra lại.</p>
                            <a href=\"active\">Quay lại</a>";
            }

        }   
        return "Tính năng chỉ dành cho admin";
       }
        return redirect()->guest('login');
    
    }


    public function checkpoint()
    {
        if (session("uid")) {
            $uid = session("uid");
            $dateexp = DB::table('user')->where('uid', $uid)->value('timeexp');
            $toDate = date('Y-m-d');
            if(strtotime($toDate)>=strtotime($dateexp))
            {
                return '0';
            }
            return '1';
        }   
        return redirect()->guest('login');
    }


}
