<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use DB;
class JSRequestController extends Controller
{
    public $user;

    public function __construct()
    {
        if (Auth::check()) {
            $this->user = Auth::user();
        }
    }

    public function delAcc($uid)
    {
        if (Auth::check()) {
            $email  = $this->user->email;
            $token = DB::table('access_token')->where('email', $email)->get();
            $checkVet = false;
            if ($token) {
                foreach ($token as $value) {
                    if($value->userid==$uid){
                        $checkVet = true;
                    }
                }
            }

            if($checkVet){
                $check = DB::table('access_token')->where('userid', '=', $uid)->delete();
                if ($check) {
                    return "Xóa thành công: ".$uid;
                }
            }
            
            return "Xóa thất bại: ".$uid;
        }
        return redirect()->guest('login');
        
    }

    public function dsBai($poster, $timeketthuc, $timebatdau)
    {
        if (Auth::check()) {

            $data = DB::table('log')->where('uid', $poster)->get();
            $i=0;
            foreach ($data as $value) {
                $date = $value->timeadd;
                if(strtotime($timebatdau) > strtotime($date) || strtotime($timeketthuc)+ (60*60*24) < strtotime($date) ){
                    unset($data[$i]);
                }
                $i++;
            }
            return $data;
            
        }
        return redirect()->guest('login');
        
    }

    public function getUID($value)
    {
        if (Auth::check()) {
            $value = explode(',', $value);
            $b = $value[0];
            $get = $value[1];
            $token = $value[2];
            $json = file_get_contents('https://graph.facebook.com/'. $b . '/' . $get . '?limit=5000&access_token=' . $token);
            return $json;
        }
        return redirect()->guest('login');
        
    }
    

     public function myLoop(Request $postArr)
    {
        
        $s = $postArr->s;
        $uid = $postArr->uid;
        $arrUID = $postArr->arrUID;
        $msg = $postArr->msg;
        $token = $postArr->token;
        $linklink = $postArr->linklink;
        $img = $postArr->img;
        $uid2 = $postArr->uid2;
        $poster = $postArr->poster;

        switch ($s) {
            case '0':
                $to = "";
                foreach ($arrUID as $uid) {
                    $to .= '{"type": "id", "id": "'.$uid.'"},';
                }
                $url    = "https://graph.facebook.com/me/threads";
                    $data   = 'to='.urlencode('['.$to.']').'&message='.$msg;
                    $host   = "graph.facebook.com";
                    $result = $this->postz($url, $token, $host, $data);
                    $json = $result;
                    return $json;
                break;
            case '1':
             	$msg = urlencode($msg);
                $url    = "https://graph.facebook.com/?include_headers=false&decode_body_json=false&streamable_json_response=true&locale=vi_VN&client_country_code=VN";
                $data   = 'batch=%5B%7B%22method%22%3A%22POST%22%2C%22body%22%3A%22is_super_emoji_post%3Dfalse%26message%3D'.$msg.'%26link%3D'.$linklink.'%26nectar_module%3Dgroup_composer29%26audience_exp%3Dtrue%26time_since_original_post%3D1%26attach_place_suggestion%3Dtrue%26viewer_coordinates%3D%257B%2522latitude%2522%253A10.8491991%252C%2522longitude%2522%253A106.7470525%252C%2522accuracy%2522%253A16.70400047302246%257D%26format%3Djson%26connection_class%3DGOOD%26source_type%3Dgroup%26checkin_entry_point%3DBRANDING_OTHER%26locale%3Dvi_VN%26client_country_code%3DVN%26fb_api_req_friendly_name%3DgraphObjectPosts%22%2C%22name%22%3A%22graphObjectPosts%22%2C%22omit_response_on_success%22%3Afalse%2C%22relative_url%22%3A%22'.$uid.'%2Ffeed%22%7D%2C%7B%22method%22%3A%22POST%22%2C%22body%22%3A%22query_params%3D%257B%25221%2522%253A60%252C%25220%2522%253A%2522%257Bresult%253DgraphObjectPosts%253A%2524.id%257D%2522%252C%25224%2522%253A720%252C%252214%2522%253A60%252C%252226%2522%253A135%252C%252227%2522%253A203%252C%25222%2522%253A%25221.5%2522%252C%252223%2522%253A%2522feed%2522%252C%252225%2522%253A%2522false%2522%252C%2522enable_facepiles%2522%253A%2522false%2522%252C%2522max_facepile_reactors%2522%253A20%252C%25225%2522%253A%2522image%252Fjpeg%2522%252C%252215%2522%253A%2522image%252Fx-auto%2522%252C%252232%2522%253A%2522contain-fit%2522%252C%252230%2522%253A480%252C%252231%2522%253A2048%252C%252235%2522%253A240%252C%252236%2522%253A2048%252C%252233%2522%253A108%252C%252234%2522%253A2048%252C%252237%2522%253A9%252C%252238%2522%253A2048%252C%25229%2522%253A248%252C%25228%2522%253A480%252C%2522enable_ranked_replies%2522%253A%2522true%2522%252C%2522enable_private_reply%2522%253A%2522true%2522%252C%2522enable_comment_replies_single_most_recent%2522%253A%2522false%2522%252C%2522enable_comment_replies_most_recent%2522%253A%2522true%2522%252C%2522enable_comment_replies_least_recent%2522%253A%2522false%2522%252C%2522max_comment_replies%2522%253A3%252C%252222%2522%253A%2522false%2522%252C%252225%2522%253A%2522false%2522%252C%2522enable_facepiles%2522%253A%2522false%2522%252C%2522max_facepile_reactors%2522%253A20%257D%26method%3Dget%26query_id%3D10154105969271729%26strip_nulls%3Dtrue%26strip_defaults%3Dtrue%26locale%3Dvi_VN%26client_country_code%3DVN%26fb_api_req_friendly_name%3DStaticGraphQlPlatformStoryQuery%22%2C%22name%22%3A%22fetchPost%22%2C%22omit_response_on_success%22%3Afalse%2C%22relative_url%22%3A%22graphql%22%7D%5D&fb_api_caller_class=com.facebook.composer.publish.ComposerPublishServiceHandler&fb_api_req_friendly_name=publishPost';
                $host   = "graph.facebook.com";
                $codez = $this->postz($url, $token, $host, $data);
                $data = json_decode($codez);
                $data = $data[0];
                $code = $data[0];
                $code = $code->code;
                if($code == 200){
                    $data = $data[1];
                    $data = $data->body;
                    $id   = $data->id;
                    // add postid
                    $memo = 'Đăng bài vào group không xát định';
                    DB::table('log')->insert(
                        ['postid' => $id, 'uid' => $poster, 'email' => $this->user->email, 'memo'=>$memo]
                    );
                }
                return $codez;
                break;
            case '2':
                return $postArr;
                break;
            case '3':
                return $postArr;
                break;
            case '4':
                return $postArr;
                break;
            case '5':
                return $postArr;
                break;
            case '6':
                return $postArr;
                break;
            case '7':
                // $uid = $arrUID[0];
                // $url    = "https://graph.facebook.com/v1.0/" ;
                // $data   = $uid2 . '/members/' . $uid, 'access_token=' . $token . '&format=json&method=post&pretty=0&suppress_http_code=1';
                // $host   = "graph.facebook.com";
                // return $this->postz($url, $token, $host, $data);
                break;
            case '8':
                return $postArr;
                break;  
            default:
                break;
        }
        
        
        return $json;
    }

    public function postz($url, $token, $host, $data)
    {
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, gzencode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, Array(
            'Authorization: OAuth '.$token,
            'User-Agent: Dalvik/1.6.0 (Linux; U; Android 4.4.2; 1201 Build/KOT49H) [FBAN/FB4A;FBAV/50.0.0.0.52;FBPN/com.facebook.katana;FBLC/vi_VN;FBBV/15584428;FBCR/VIETTEL;FBMF/OPPO;FBBD/OPPO;FBDV/1201;FBSV/4.4.2;FBCA/armeabi-v7a:armeabi;FBDM/{density=1.5,width=480,height=854};FB_FW/1;]',
            'X-FB-Connection-Type: WIFI',
            'x-fb-net-hni: 45204',
            'x-fb-sim-hni: 45204',
            'x-fb-net-sid: ',
            'X-FB-HTTP-Engine: Apache',
            'Transfer-Encoding: chunked',
            'Content-Type: application/x-www-form-urlencoded',
            'Content-Encoding: gzip',
            'Host: '.$host,
            'Connection: Keep-Alive',
            'Accept-Encoding: gzip'
        ));
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $res = curl_exec($ch);
        curl_close($ch);
        return $res;
    }

    public function xulyLoop1($uid, $msg, $token, $linklink, $img)
    {
        if($img != "")
        {
            return $img;
            $url = 'https://graph.facebook.com/' . $uid . '/albums?method=post&name=RIP.VN&message=' . $msg . '&access_token=' . $token;
            $json = file_get_contents($url);
            $postid = json_decode($json)->id;
            if(strlen($postid)>5)
            {
                $url = 'https://graph.facebook.com/' . $postid . '/photos?method=post&access_token=' . $token . "&url=" . $linklink;
                return '0';
                return $url;
                // return $json = file_get_contents($url);
            }else{
                return '1';
            }

            
        }else{
            // $data = 'batch=' . urlencode('[{"method":"POST","body":"is_super_emoji_post=false&message=' . $msg . '&link=' . $linklink . '&nectar_module=group_composer&audience_exp=true&time_since_original_post=413&attach_place_suggestion=true&format=json&connection_class=EXCELLENT&source_type=group&checkin_entry_point=BRANDING_OTHER&locale=vi_VN&client_country_code=VN&fb_api_req_friendly_name=graphObjectPosts","name":"graphObjectPosts","omit_response_on_success":false,"relative_url":"' . $uid . '/feed"}]') . '&fb_api_caller_class=com.facebook.composer.publish.ComposerPublishServiceHandler&fb_api_req_friendly_name=publishPost&access_token=' . $token;
            // return $url = 'https://graph.facebook.com/?include_headers=false&decode_body_json=false&streamable_json_response=true&locale=vi_VN&client_country_code=VN,'.$data;
            return 'uid'.$uid.'&msg='.$msg.'&token='.$token.'&linklink='.$linklink.'&img='.$img;
            // $json = file_get_contents($url);
            // return $json;
        }
        
    }

}
