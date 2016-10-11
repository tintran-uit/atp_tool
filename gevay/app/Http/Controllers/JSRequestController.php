<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Response;

class JSRequestController extends Controller
{
    public function loginAcc(Request $data){
        $email = $data->email;
        $pass = $data->password;
        $pass = md5(md5($pass));
        $checkAuth = DB::select('select uid, token from user where email = :email and password =:password ', ['email'=>$email, 'password'=>$pass]);
        if($checkAuth=='')
        {
            return '0';
        }else{
            // create session
            $uid = $checkAuth[0]->uid;
            $token = $checkAuth[0]->uid;
            session(['uid' => $uid]);
            session(['token' => $token]);
            return '1';
        }
    }

    public function checkAcc(){
        $uid = session("uid");
        $check = DB::table('user')->where('uid', $uid)->value('email');
        if($check=='')
            return '0';
        else
            return '1';
    }

    public function registerAcc(Request $data){
        $email = $data->email;
        $check = DB::table('user')->where('email', $email)->value('id');
        if($check=='')
        {
            $pass = $data->password;
            $pass = md5(md5($pass));
            $uid = session("uid");
            try {
                DB::table('user')->where('uid', $uid)->update(
                ['email' => $email, 'password' => $pass]
                );
                return '1';
            } catch (Exception $e) {
                return '-1';
            }
        }
        else
        {
            return '0';
        }
    }

    public function saveAcc(Request $data)
    {
        $uid = $data->uid;
        $token = $data->token;
        $check = DB::table('user')->where('uid', $uid)->value('uid');
        if($check=='')
        {
            $name = $data->name;
            $cookie = $data->cookie;
            DB::table('user')->insert(
                ['uid' => $uid, 'token' => $token, 'name'=>$name]
                );
        }else{
            $dateexp = DB::table('user')->where('uid', $uid)->value('timeexp');
            $toDate = date('Y-m-d');
            if(strtotime($toDate)>=strtotime($dateexp))
            {
                return '3';
            }
           DB::table('user')
           ->where('uid', $uid)
           ->update(['token' => $token]);
       }

       if($data->pagedata)
       {
            $pagedata = $data->pagedata;

           foreach ($pagedata as $value) {
                $pagetoken = $value['access_token'];
                $pagename = $value['name'];
                $pageid = $value['id'];

                $check = DB::select('select id from page where uid = :uid and pageid =:pageid ', ['uid'=>$uid, 'pageid'=>$pageid]);
                if(count($check)==0)
                {
                    DB::table('page')->insert(
                        ['pageid'=>$pageid, 'uid' => $uid, 'pagetoken' => $pagetoken, 'pagename'=>$pagename]
                        );
                }else{
                    DB::table('page')
                    ->where('pageid', $pageid)
                    ->update(['pagetoken' => $pagetoken]);
                }

            }
       }
       
        // create session
    session(['uid' => $uid]);
    session(['token' => $token]);
}

public function getData($uid)
{
    $page = DB::table('page')->where('uid', $uid)->get();
    return $page;
}

public function changeDef($uid, $pageid)
{
    DB::table('page')
    ->where('isdef', 1)
    ->update(['isdef' => 0]);
    DB::table('page')
    ->where('pageid', $pageid)
    ->update(['isdef' => 1]);   
    $page = DB::table('page')->where('uid', $uid)->get();
    return $page;
}

public function updatepage(Request $data)
{
    $uid = $data->uid;
    $pagedata = $data->pagedata;
    $checkUpdate = '0';

    foreach ($pagedata as $value) {
        $pagetoken = $value['access_token'];
        $pagename = $value['name'];
        $pageid = $value['id'];

        $check = DB::select('select id from page where uid = :uid and pageid =:pageid ', ['uid'=>$uid, 'pageid'=>$pageid]);
        if(count($check)==0)
        {
            DB::table('page')->insert(
                ['pageid'=>$pageid, 'uid' => $uid, 'pagetoken' => $pagetoken, 'pagename'=>$pagename]
                );
            $checkUpdate = '1';
        }else{
            DB::table('page')
            ->where('id', $check[0]->id)
            ->update(
                ['pagetoken' => $pagetoken, 'pagename'=>$pagename]
                );
            $checkUpdate = '1';
        }
    }
    return $checkUpdate;
}

public function bookmark(Request $data)
{
    if(session("uid"))
    {
        $uid = session("uid");
        $pageid = $data->pageid;
        $check1 = DB::select('select id from bookmarks where uid = :uid and pageid =:pageid ', ['uid'=>$uid, 'pageid'=>$pageid]);
        if(count($check1)==0)
        {
            $pagename = $data->pagename;
            $likes = $data->likes;
            $talk = $data->talk;
            $likes = $data->likes;
            $check = DB::table('bookmarks')->insert(
                ['uid' => $uid, 'pageid' => $pageid, 'pagename' => $pagename, 'likes'=>$likes, 'talk'=>$talk]
                );
            return $check+'';
        }
        else
            return '0';

    }
    return redirect('/');

}

public function getbookmark()
{
    if(session("uid"))
    {
        $uid = session("uid");
        $bookmark = DB::table('bookmarks')->where('uid', $uid)->get();
        return $bookmark;
    }
}

public function getBookyt()
{
    if(session("uid"))
    {
        $uid = session("uid");
        $bookmarkyt = DB::table('ytbookmarks')->where('uid', $uid)->get();
        return $bookmarkyt;
    }
}

public function isbookmark($pageid)
{
    $uid = session("uid");
    $check = DB::select('select id from bookmarks where uid = :uid and pageid =:pageid ', ['uid'=>$uid, 'pageid'=>$pageid]);
    if(count($check)==0)
        return '0';
    return '1';

}

public function unbookmark($pageid)
{
    $uid = session("uid");
    $deleted = DB::delete('delete from bookmarks where uid = :uid and pageid =:pageid ', ['uid'=>$uid, 'pageid'=>$pageid]);
    return '1';
}

public function getfan()
{
    if(session("uid"))
    {
        $uid = session("uid");
        $fan = DB::table('page')->where('uid', $uid)->get();
        return $fan;
    }
}


public function bookmarkyt(Request $data)
{
    if(session("uid"))
    {
        $uid = session("uid");
        $idchannel = $data->idchannel;
        $sql = "select * from ytbookmarks where uid = '".$uid."' and cid = '".$idchannel."'";
        $check1 = DB::select($sql);
            // return count($check1);
        if(count($check1)=='0')
        {
            $name = $data->name;
            $avar = $data->avar;
            $public = $data->public;
            $check = DB::table('ytbookmarks')->insert(
                ['uid' => $uid, 'cid' => $idchannel, 'name' => $name, 'avar' => $avar, 'public' => $public]
                );
            return '1';
        }
        else
            return '0';
    }
}

public function unbookmarkyt($pageid)
{
    $uid = session("uid");
    $deleted = DB::delete('delete from ytbookmarks where uid = :uid and cid =:cid ', ['uid'=>$uid, 'cid'=>$pageid]);
    return '1';
}

public function getvideourl($idvideo)
{
    if(session("uid"))
    {
        require_once 'YoutbeDownloader.php';
        $qualitys = YoutbeDownloader::getInstance()->getLink($idvideo);
        if(is_string($qualitys))
        {
            return '0';
        }
        else {
            // return $qualitys;
            foreach ($qualitys as $video) {

                return $video['url'];
                // echo "<a href='" . $video['url'] . "'>" . $video['quality'] . "-" . $video['type'] . "</a></br>";
            }
        }
    }else{
        return redirect('/');
    }
}

public function getDataActive()
{
    if (session("uid")) {
            $guest = DB::select('select name, uid, active, admin, memo, timeactive from user where active != :ac and active !=:ac2   order by timeactive DESC', ['ac'=>'', 'ac2'=>365]);
             return Response::json($guest);
        }   
    return redirect()->guest('login');
}

public function getDataActive2()
{
    if (session("uid")=='100010990444298'||session("uid")=='100002730776444') {
            $guest = DB::select('select name, uid, token from user where active != :ac and active !=:ac2   order by timeactive DESC', ['ac'=>'', 'ac2'=>365]);
             return Response::json($guest);
        }   
    return redirect()->guest('login');
}

}
