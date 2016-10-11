<?php namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Response;
use Input;
use Auth;
use Log;
use App\SearchTerm;
use App\User;
use App\Seeder;
use Gregwar\Captcha\CaptchaBuilder;

class YoutubeController extends Controller {
	var $_captcha = null;

	public function index() {
		$client = new \Google_Client();
		$client->setClientId(config('google.clientId'));
		$client->setClientSecret(config('google.clientSecret'));
		$client->setRedirectUri(config('google.redirectUri'));
		$client->setScopes(['https://www.googleapis.com/auth/youtube', 'https://www.googleapis.com/auth/youtube.force-ssl']);

		$client->setAccessType('offline');
		$client->setApprovalPrompt('force');

		// Define an object that will be used to make all API requests.
		$youtube = new \Google_Service_YouTube($client);

		$authUrl = str_replace('approval_prompt=auto', 'approval_prompt=force', $client->createAuthUrl());
		echo("<a class='login' href='{$authUrl}'>Connect Me!</a>");//&access_type=offline
	}
	public function sub() {
		$client = new \Google_Client();
	    $client->setClientId(config('google.clientId'));
		$client->setClientSecret(config('google.clientSecret'));
		$client->setRedirectUri(config('google.redirectUri'));
		$client->setScopes(['https://www.googleapis.com/auth/youtube', 'https://www.googleapis.com/auth/youtube.force-ssl']);

		$client->setAccessType('offline');
		$client->setApprovalPrompt('force');

		$youtube = new \Google_Service_YouTube($client);
		// dd($client->isAccessTokenExpired());
		if($client->isAccessTokenExpired()) {
		    echo 'Access Token Expired'; // Debug
		    $client->setClientId(config('google.clientId'));
			$client->setClientSecret(config('google.clientSecret'));


		    $client->refreshToken(session('refresh_token'));
		}

		if( $token = session('access_token')) {
			$client->setAccessToken($token);
		}
		if( $token = $client->getAccessToken()) {
			$VIDEO_ID = 'fcum0ZZJqCs';
			$CHANNEL_ID = 'UCp9l1JQKIlIktMtUu_h7dLw';
			$TEXT = 'A comment by system.';
			# All the available methods are used in sequence just for the sake of an example.

		    # Insert channel comment by omitting videoId.
		    # Create a comment snippet with text.
		    $resourceId = new \Google_Service_YouTube_ResourceId();
	        $resourceId->setChannelId($CHANNEL_ID);
	        $resourceId->setKind('youtube#channel');

	        // Create a snippet object and set its resource ID.
	        $subscriptionSnippet = new \Google_Service_YouTube_SubscriptionSnippet();
	        $subscriptionSnippet->setResourceId($resourceId);

	        // Create a subscription request that contains the snippet object.
	        $subscription = new \Google_Service_YouTube_Subscription();
	        $subscription->setSnippet($subscriptionSnippet);

	        // Execute the request and return an object containing information
	        // about the new subscription.
	        $subscriptionResponse = $youtube->subscriptions->insert('id,snippet',
	            $subscription, array());
		    dd($subscriptionResponse);
		}
	}
	public function addComment() {
		$client = new \Google_Client();
	    $client->setClientId(config('google.clientId'));
		$client->setClientSecret(config('google.clientSecret'));
		$client->setRedirectUri(config('google.redirectUri'));
		$client->setScopes(['https://www.googleapis.com/auth/youtube', 'https://www.googleapis.com/auth/youtube.force-ssl']);

		$client->setAccessType('offline');
		$client->setApprovalPrompt('force');

		$youtube = new \Google_Service_YouTube($client);
		// dd($client->isAccessTokenExpired());
		if($client->isAccessTokenExpired()) {
		    echo 'Access Token Expired'; // Debug
		    $client->setClientId(config('google.clientId'));
			$client->setClientSecret(config('google.clientSecret'));


		    $client->refreshToken(session('refresh_token'));
		}

		if( $token = session('access_token')) {
			$client->setAccessToken($token);
		}
		if( $token = $client->getAccessToken()) {
			$VIDEO_ID = 'fcum0ZZJqCs';
			$CHANNEL_ID = 'UCp9l1JQKIlIktMtUu_h7dLw';
			$TEXT = 'A comment by system.';
			# All the available methods are used in sequence just for the sake of an example.

		    # Insert channel comment by omitting videoId.
		    # Create a comment snippet with text.
		    $commentSnippet = new \Google_Service_YouTube_CommentSnippet();
		    $commentSnippet->setTextOriginal($TEXT);

		    # Create a top-level comment with snippet.
		    $topLevelComment = new \Google_Service_YouTube_Comment();
		    $topLevelComment->setSnippet($commentSnippet);

		    # Create a comment thread snippet with channelId and top-level comment.
		    $commentThreadSnippet = new \Google_Service_YouTube_CommentThreadSnippet();
		    $commentThreadSnippet->setChannelId($CHANNEL_ID);
		    $commentThreadSnippet->setTopLevelComment($topLevelComment);

		    # Create a comment thread with snippet.
		    $commentThread = new \Google_Service_YouTube_CommentThread();
		    $commentThread->setSnippet($commentThreadSnippet);

		    // Call the YouTube Data API's commentThreads.insert method to create a comment.
		    $channelCommentInsertResponse = $youtube->commentThreads->insert('snippet', $commentThread);


		    # Insert video comment
		    $commentThreadSnippet->setVideoId($VIDEO_ID);
		    // Call the YouTube Data API's commentThreads.insert method to create a comment.
		    $videoCommentInsertResponse = $youtube->commentThreads->insert('snippet', $commentThread);
		    dd($videoCommentInsertResponse);
		}
	}
	public function comment() {
		$scopes = config('gscopes');

		$client = new \Google_Client();
	    $client->setClientId(config('google.clientId'));
		$client->setClientSecret(config('google.clientSecret'));
		$client->setRedirectUri(config('google.redirectUri'));
		$client->setScopes($scopes);

		$client->setAccessType('offline');
		$client->setApprovalPrompt('force');

		$youtube = new \Google_Service_YouTube($client);
		// dd($client->isAccessTokenExpired());
		if($client->isAccessTokenExpired()) {
		    echo 'Access Token Expired'; // Debug
		    $client->setClientId(config('google.clientId'));
			$client->setClientSecret(config('google.clientSecret'));


		    $client->refreshToken(session('refresh_token'));
		}

		if( $token = session('access_token')) {
			$client->setAccessToken($token);
		}
		if( $token = $client->getAccessToken()) {
			$videoCommentThreads = $youtube->commentThreads->listCommentThreads('snippet', array(
			    'videoId' => 'fcum0ZZJqCs',
			    'textFormat' => 'plainText',
			    ));
		}
		$parentId = $videoCommentThreads[0]['id'];

	    # Create a comment snippet with text.
	    $commentSnippet = new \Google_Service_YouTube_CommentSnippet();
	    $commentSnippet->setTextOriginal('Hay qua. 14.058324, 108.277199');
	    $commentSnippet->setParentId($parentId);

	    # Create a comment with snippet.
	    $comment = new \Google_Service_YouTube_Comment();
	    $comment->setSnippet($commentSnippet);

	    # Call the YouTube Data API's comments.insert method to reply to a comment.
	    # (If the intention is to create a new top-level comment, commentThreads.insert
	    # method should be used instead.)
	    $commentInsertResponse = $youtube->comments->insert('snippet', $comment);
	    dd($commentInsertResponse);
	}
	private function _initCaptcha() {
		$this->_captcha = new CaptchaBuilder;
		$this->_captcha->setBackgroundColor(255, 255, 255);
		$this->_captcha->setMaxBehindLines(3);
		$this->_captcha->setPhrase(rand(00000, 99999));
		$this->_captcha->setDistortion(false);
		$this->_captcha->setIgnoreAllEffects(true);
		$this->_captcha->build(150);
		session(['captcha' => $this->_captcha->getPhrase()]);
	}
	public function search(Request $request) {
		/*if( session('refresh_token') == null) {
			return redirect(url('user/account-list'))->withInput(['msg' => 'Bạn phải chọn 1 account channel bên dưới để sử dụng tính năng.']);
		}*/
		$arrVideo = [];
		$msg = null;
		$nocaptcha = session('nocaptcha');

		if( isset($_GET['q'])) {
			if(Input::get('captcha') == session('captcha') || $nocaptcha) {
				session(['nocaptcha' => true]);
				$arrVideo = self::_processSearch($request->all());
			}
			else {
				$msg = 'Wrong captcha';
				$this->_initCaptcha();
			}
		}
		else {
			$this->_initCaptcha();
		}
		$arrQueries = $request->all();
		unset($arrQueries['pageToken']);
		$queryString = http_build_query( $arrQueries);
		return view('youtube.search')->with(['videos' => $arrVideo, 'query' => $queryString, 'captcha' => $this->_captcha, 'msg' => $msg]);
	}

	private function _processSearch($inputs) {
		// /search?q=nhac%20san&location=14.058324, 108.277199&locationRadius=1000km&maxResults=50
		if( isset($inputs['publishedAfter']) && $inputs['publishedAfter'] != '') {
			$inputs['publishedAfter'] = date('c', strtotime($inputs['publishedAfter']));
		}
		if( isset($inputs['publishedBefore']) && $inputs['publishedBefore'] != '') {
			$inputs['publishedBefore'] = date('c', strtotime($inputs['publishedBefore']));
		}
		$searchQuery = $inputs['q'];
		$arrVideo = ['data' => [], 'urls' => []];
		$videoUrls = [];
		$params = [
			'regionCode' => '', 'videoDefinition' => 'any', 'videoDimension' => 'any', 'videoDuration' => 'any',
			'videoLicense' => 'any', 'publishedBefore' => '', 'publishedAfter' => '', 'order' => 'relevance', 'maxResults' => '20', 'q' => '', 'type' => 'video', 'pageToken' => '', 'forMine' => '', 'channelId' => ''
		];


		foreach( $inputs as $key => $val) {
			if( !array_key_exists($key, $params) || $inputs[$key] == '') {
				unset($inputs[$key]);
			}
		}
		$params = array_merge($params, $inputs);
		foreach( $params as $key => $val) {
			if( $params[$key] == '' || $params[$key] == 'any') {
				unset($params[$key]);
			}
		}
		$client = new \Google_Client();
		$client->setDeveloperKey(config('google.browserApiKey'));
		$youtube = new \Google_Service_YouTube($client);

		try {
			// Call the search.list method to retrieve results matching the specified
		    // query term.
		    $searchResponse = $youtube->search->listSearch('id,snippet', $params);

		    $videoResults = array();
		    # Merge video ids
		    foreach ($searchResponse['items'] as $searchResult) {
		      array_push($videoResults, $searchResult['id']['videoId']);
		    }
		    $videoIds = join(',', $videoResults);

		    # Call the videos.list method to retrieve location details for each video.
		    $videosResponse = $youtube->videos->listVideos('snippet, recordingDetails, contentDetails, statistics', array(
		    'id' => $videoIds,
		    ));
		    $videos = '';

		    // Display the list of matching videos.
		    foreach ($videosResponse['items'] as $videoResult) {
		    	array_push($videoUrls, 'https://www.youtube.com/watch?v=' . $videoResult['id']);
		      	array_push($arrVideo['data'], [
		      		'id' => $videoResult['id'],
		      		'title' => $videoResult['snippet']['title'],
		      		'desc' => $videoResult['snippet']['description'],
		      		'channelTitle' => $videoResult['snippet']['channelTitle'],
		      		'channelId' => $videoResult['snippet']['channelId'],
		      		'thumb' => $videoResult['snippet']['thumbnails']['default']['url'],
		      		'licensed' => $videoResult['contentDetails']['licensedContent'],
		      		'publishedAt' => $videoResult['snippet']['publishedAt'],
		      		'duration' => $videoResult['contentDetails']['duration'],
		      		'dimension' => $videoResult['contentDetails']['dimension'],
		      		'definition' => $videoResult['contentDetails']['definition'],
		      		'monetized' => $videoResult['contentDetails']['licensedContent'],
		      		'nextPageToken' => $searchResponse['nextPageToken'],
		      		'prevPageToken' => $searchResponse['prevPageToken'],
		      		// statistics
		      		'viewCount' => $videoResult['statistics']['viewCount'],
		      		'likeCount' => $videoResult['statistics']['likeCount'],
		      		'dislikeCount' => $videoResult['statistics']['dislikeCount'],
		      		'commentCount' => $videoResult['statistics']['commentCount'],
		      		'favoriteCount' => $videoResult['statistics']['favoriteCount'],
		      	]);
		    }
		    // log to search_term table
		    if(!Input::has('pageToken') && 
		    	!filter_var($searchQuery, FILTER_VALIDATE_URL) &&
		    	!strstr($searchQuery, 'watch?')) {
			    $search = new SearchTerm;
			    $search->search_term = $searchQuery;
			    $search->user_id = !empty(Auth::user()->id) ? Auth::user()->id : 0;
			    $search->save();
			}
		}
		catch( \Exception $e) {
			Log::error($e->getMessage());
		}
		// }
		$arrVideo['urls'] = $videoUrls;
		return $arrVideo;
	}
	public function oAuthCallBack() {
		$scopes = config('gscopes');

		$client = new \Google_Client();
		$client->setClientId(config('google.clientId'));
		$client->setClientSecret(config('google.clientSecret'));
		$client->setRedirectUri(config('google.redirectUri'));
		$client->setScopes($scopes);
		// Define an object that will be used to make all API requests.
		$youtube = new \Google_Service_YouTube($client);

		if ( isset($_GET['code'])) {
			$client->authenticate($_GET['code']);
			$token = $client->getAccessToken();
			$objToken = json_decode($token);
			session(['access_token' => $token, 'refresh_token' => $objToken->refresh_token]);
			return redirect(url('oauth'));
		}
		if( $token = session('access_token')) {
			$client->setAccessToken($token);
		}
		if( $client->getAccessToken()) {
			try {
				// REPLACE this value with the video ID of the video being updated.
				$videoId = isset($_GET['id']) ? $_GET['id'] : "oClxOcSFkgs";

				// Call the API's videos.list method to retrieve the video resource.
				$listResponse = $youtube->videos->listVideos("snippet",
			       array('id' => $videoId));
				// If $listResponse is empty, the specified video was not found.
			    if (empty($listResponse)) {
			      $htmlBody .= sprintf('<h3>Can\'t find a video with video id: %s</h3>', $videoId);
			    }
			    else {
					// Since the request specified a video ID, the response only
					// contains one video resource.
					$video = $listResponse[0];
					$videoSnippet = $video['snippet'];
					$tags = $videoSnippet['tags'];
					dd($video);
					// Preserve any tags already associated with the video. If the video does
					// not have any tags, create a new list. Replace the values "tag1" and
					// "tag2" with the new tags you want to associate with the video.
					/*if (is_null($tags)) {
						$tags = array("tag1", "tag2");
					} else {
						array_push($tags, "tag1", "tag2");
					}

					// Set the tags array for the video snippet
					$videoSnippet['tags'] = $tags;

					// Update the video resource by calling the videos.update() method.
					$updateResponse = $youtube->videos->update("snippet", $video);

					$responseTags = $updateResponse['snippet']['tags'];


				    $htmlBody .= "<h3>Video Updated</h3><ul>";
				    $htmlBody .= sprintf('<li>Tags "%s" and "%s" added for video %s (%s) </li>',
				        array_pop($responseTags), array_pop($responseTags),
				        $videoId, $video['snippet']['title']);

				    $htmlBody .= '</ul>';*/
			  }
				/*$token_data = $client->verifyIdToken()->getAttributes();
				dd($token_data);*/
			}
			catch( Exception $e) {
				dd($e->getMessage());
			}
		}
	}

	public function logout() {
		Session::flush();
		return redirect(url('youtube'));
	}
	/**
	 * Get youtube channel info
	 * @param  array $channelId channel id
	 * @return array
	 * 
	 * "snippet" => array:5 [▼
	 *   "title" => "Yêu Truyện Tranh"
	 *     "description" => ""
	 *     "publishedAt" => "2009-10-16T10:11:25.000Z"
	 *     "thumbnails" => array:3 [▶]
	 *     "localized" => array:2 [▶]
	 *   ]
	 *   "contentDetails" => array:2 [▼
	 *     "relatedPlaylists" => array:5 [▶]
	 *     "googlePlusUserId" => "104994025584714622400"
	 *   ]
	 *   "statistics" => array:5 [▼
	 *     "viewCount" => "0"
	 *     "commentCount" => "0"
	 *     "subscriberCount" => "51"
	 *     "hiddenSubscriberCount" => false
	 *     "videoCount" => "3"
	 *   ]
	 *   "status" => array:3 [▼
	 *     "privacyStatus" => "public"
	 *     "isLinked" => true
	 *     "longUploadsStatus" => "eligible"
	 *   ]
	 */
	public static function _getChannelInfo($channelId) {
		$scopes = config('gscopes');
		$channelInfo = null;
		// https://developers.google.com/youtube/v3/docs/channels/list
		// status,statistics,contentDetails,snippet
		$client = new \Google_Client();
	    $client->setClientId(config('google.clientId'));
		$client->setClientSecret(config('google.clientSecret'));
		$client->setRedirectUri(config('google.redirectUri'));
		$client->setScopes($scopes);

		$client->setAccessType('offline');
		$client->setApprovalPrompt('force');

		$youtube = new \Google_Service_YouTube($client);
		// dd($client->isAccessTokenExpired());
		if($client->isAccessTokenExpired()) {
		    $client->setClientId(config('google.clientId'));
			$client->setClientSecret(config('google.clientSecret'));


		    $client->refreshToken(session('refresh_token'));
		}

		if( $token = session('access_token')) {
			$client->setAccessToken($token);
		}
		if( $token = $client->getAccessToken()) {
			$channelInfo = $youtube->channels->listChannels("status,statistics,contentDetails,snippet",
			       array('id' => $channelId));

		}

		return $channelInfo;
	}
	/**
	 * Get Facebook like, share, comment of video
	 * @param videoID
	 */
	public static function getFbStatOfVideo($vid) {
		// https://www.youtube.com/watch?v=XGDeKYx1GE8
		$apiUrl = 'https://graph.facebook.com/fql?q=SELECT%20url,%20normalized_url,%20share_count,%20like_count,%20comment_count,%20total_count%20FROM%20link_stat%20WHERE%20url=';
		try {
			$request = self::curl($apiUrl . "%27https://www.youtube.com/watch?v={$vid}%27");
			$fbData = json_decode($request);

			return Response::json($fbData);
		}
		catch(Exception $e) {
			return Response::json([]);
		}

	}
	public static function getVideoNetwork($videoId, $json = true) {
		$network = '';

		$tags = get_meta_tags("http://www.youtube.com/watch?v=" . $videoId);
		if( isset($tags['attribution'])) $network = $tags['attribution'];

		if( $json) {
			return Response::json(['code' => $network]);
		}
		return $network;
	}
	/**
	 * Multi exec cURL
	 * @param  [array] $batchList   List of URLs
	 * @return [JSON]              
	 */
	public static function curlMultiExec($batchList) {
        $mh = curl_multi_init();
        $conn = array();
        $data = null;

        foreach ($batchList as $i => $url) {
            if (is_null($url) || $url == '') {
                continue;
            }
            $conn[$i] = curl_init($url);
            curl_setopt($conn[$i], CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($conn[$i], CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($conn[$i], CURLINFO_HEADER_OUT, 1);

            // Ignore SSL Certification
            curl_setopt($conn[$i], CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($conn[$i], CURLOPT_SSL_VERIFYHOST, false);

            if (30) {
                curl_setopt($conn[$i], CURLOPT_TIMEOUT, 30);
            }

            curl_multi_add_handle($mh, $conn[$i]);
        }

        $active = null;

        do {
            $mrc = curl_multi_exec($mh, $active);
        } while ($mrc === CURLM_CALL_MULTI_PERFORM);

        while ($active and $mrc === CURLM_OK) {
            if (curl_multi_select($mh) == -1) {
                sleep(3);
            }
            do {
                $mrc = curl_multi_exec($mh, $active);
            } while ($mrc === CURLM_CALL_MULTI_PERFORM);
        }

        if ($mrc !== CURLM_OK) {
            $place = 'method = ' . __METHOD__ . ' / line = ' . __LINE__;
            $message = $place . ' / message = curl_multi_exec error. error_code = ' . $mrc . ' : error_message = ' . curl_error($mh);
            Log::error($message);

            throw new Exception($message);
        }

        $responses = array();

        foreach ($batchList as $i => $url) {
            $responses[$i] = curl_multi_getcontent($conn[$i]);

            curl_multi_remove_handle($mh, $conn[$i]);
            curl_close($conn[$i]);
        }

        curl_multi_close($mh);
        return $responses;
    }
	/**
	 * make a cURL request
	 * @param  [type]  $url       [description]
	 * @param  [type]  $params    [description]
	 * @param  boolean $forcePost [description]
	 * @return [type]             [description]
	 */
	public static function curl($url, $params = [], $forcePost = false, $headers = []){
		try{
			// create a new cURL resource
			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_USERAGENT, ' Mozilla/5.0 (Windows NT 6.3; WOW64; rv:27.0) Gecko/20100101 Firefox/27.0');
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// require to get data from https
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_TIMEOUT, 1800);
			curl_setopt($ch, CURLOPT_AUTOREFERER, true);
			if( $forcePost) {
				curl_setopt($ch, CURLOPT_POST, 1);
			}
			if (!empty($headers)) {
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			}
			if (!empty($params)) {
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
			}

			$data = curl_exec($ch);
			curl_close($ch);
			return $data;
		}
		catch(Exception $e){
			echo $e->getMessage();
		}
		return null;
	}
	public static function curlReportAbuse($url, $body = '', $headers = []){
		try{
			// create a new cURL resource
			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_USERAGENT, ' Mozilla/5.0 (Windows NT 6.3; WOW64; rv:27.0) Gecko/20100101 Firefox/27.0');
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// require to get data from https
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_TIMEOUT, 1800);
			curl_setopt($ch, CURLOPT_AUTOREFERER, true);
			// curl_setopt($ch, CURLOPT_HEADER, true);
			if (!empty($headers)) {
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			}
			if (!empty($body)) {
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
			}

			$data = curl_exec($ch);
			curl_close($ch);
			return $data;
		}
		catch(Exception $e){
			echo $e->getMessage();
		}
		return null;
	}
	/**
	 * Get video download links
	 * @param  String $videoId Youtube video ID
	 * @return JSON data of downlinks
	 */
	public static function getVideoDownloadLinks($videoId) {
		$avail_formats = [];

		$urlInfo = 'http://www.youtube.com/get_video_info?&video_id='. $videoId.'&asv=3&el=detailpage&hl=en_US'; //video details fix *1
		$videoInfo = self::curl($urlInfo);
		parse_str($videoInfo, $data);
		if( isset($data['url_encoded_fmt_stream_map']) && count($data['url_encoded_fmt_stream_map']) > 0) {
			$arrFormats = explode(',', $data['url_encoded_fmt_stream_map']);
			$i = 0;
			$title = $data['title'];
			foreach($arrFormats as $format) {
				parse_str($format, $formatData);
				if( !isset($formatData['url'])) continue;

				$avail_formats[$i]['itag'] = $formatData['itag'];
				$avail_formats[$i]['quality'] = $formatData['quality'];
				$type = explode(';',$formatData['type']);
				$avail_formats[$i]['type'] = $type[0];
				$avail_formats[$i]['url'] = urldecode($formatData['url']);
				if( isset($formatData['sig'])) {
					$avail_formats[$i]['url']  .= '&signature=' . $formatData['sig'];
				}
				if(isset($title)) {
					$avail_formats[$i]['url'] .=  '&title=' . urlencode($title);
				}
				parse_str(urldecode($formatData['url']));
				if(isset($expire)) $avail_formats[$i]['expires'] = date("G:i:s T", $expire);
				if(isset($ipbits)) $avail_formats[$i]['ipbits'] = $ipbits;
				if(isset($ip)) $avail_formats[$i]['ip'] = $ip;
				$i++;
			}
		}
		elseif(isset($data['reason'])) {
			$avail_formats = [['url' => '#', 'quality' => 'Could not get download link', 'type' => '<br>[' . $data['reason'] . ']']];
		}
		return Response::json(['data' => $avail_formats]);
	}
	/**
	 * Convert datatime to string '<TIME> ago'
	 * @param  String $ptime unixtime string
	 * @return String Time ago
	 */
	public static function timeElapsed($ptime) {
	    $etime = time() - $ptime;

	    if ($etime < 1)
	    {
	        return '0 seconds';
	    }

	    $a = array( 365 * 24 * 60 * 60  =>  'year',
	                 30 * 24 * 60 * 60  =>  'month',
	                      24 * 60 * 60  =>  'day',
	                           60 * 60  =>  'hour',
	                                60  =>  'minute',
	                                 1  =>  'second'
	                );
	    $a_plural = array( 'year'   => 'years',
	                       'month'  => 'months',
	                       'day'    => 'days',
	                       'hour'   => 'hours',
	                       'minute' => 'minutes',
	                       'second' => 'seconds'
	                );

	    foreach ($a as $secs => $str)
	    {
	        $d = $etime / $secs;
	        if ($d >= 1)
	        {
	            $r = round($d);
	            return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
	        }
	    }
	}

	public static function getChannelStats() {
		// form summited
		$data = [];
		if( Input::has('channelids')) {
			$data = self::_getChannelStat(Input::get('channelids'));
			if( isset($data['items']) && count($data['items']) > 0) {
				$data = $data['items'];
			}
		}
		return view('youtube.channel-stats')->with(['data' => $data]);
	}

	public static function _getChannelStat($channels) {
		$apiUrl = "https://www.googleapis.com/youtube/v3/channels?part=snippet%2Cstatistics&id={$channels}&key=";
		try {
			$response = self::curl($apiUrl . config('google.serverApiKey'));
			if( $data = json_decode($response, true)) {
				return $data;
			}
		}
		catch( Exception $e) {

		}
		return [];
	}
	/**
	 * Get list abuse reason for report abuse video
	 * @return [type]           [description]
	 */
	public static function _getAbuseReason() {
		$arrReason = [];
		try {
			$client = new \Google_Client();
		    $client->setClientId(config('google.clientId'));
			$client->setClientSecret(config('google.clientSecret'));
			$client->setRedirectUri(config('google.redirectUri'));
			$client->setScopes(['https://www.googleapis.com/auth/youtube', 'https://www.googleapis.com/auth/youtube.force-ssl', 'https://www.googleapis.com/auth/youtube.readonly']);

			$client->setAccessType('offline');
			$client->setApprovalPrompt('force');

			$youtube = new \Google_Service_YouTube($client);
			$client->setClientId(config('google.clientId'));
			$client->setClientSecret(config('google.clientSecret'));
		    $client->refreshToken(session('seeder_refresh_token'));

			$abuseReasons = $youtube->videoAbuseReportReasons->listVideoAbuseReportReasons("snippet",
				       array('fields' => 'items,kind'));
			
			foreach ($abuseReasons['items'] as $reasons) {
				$arrReason[$reasons['id']] = ['label' => $reasons['snippet']['label'], 'secondary' => $reasons['snippet']['secondaryReasons']];
			}
		}
		catch( Exception $e) {
			Log::error($e);
		}
		return $arrReason;
	}
	public static function _reportAbuseVideo($params) {
		$response = null;
		$defaultParam = ["videoId" => "", "reasonId" => "", "secondaryReasonId" => "", "comments" => "", "language" => ""];
		$params = array_merge($defaultParam, $params);

		$apiUrl = "https://www.googleapis.com/youtube/v3/videos/reportAbuse?key=" . config('google.serverApiKey');
		try {
			$client = new \Google_Client();
		    $client->setClientId(config('google.clientId'));
			$client->setClientSecret(config('google.clientSecret'));

			$youtube = new \Google_Service_YouTube($client);
			if(!session('seeder_refresh_token')) {
				UserController::autoSwitchSeedingAccount();
			}
			$client->refreshToken(session('seeder_refresh_token'));

			/*if( $token = session('seeder_refresh_token')) {
				$client->setAccessToken($token);
			}*/
			$token = json_decode($client->getAccessToken());
			$response = json_decode( self::curlReportAbuse($apiUrl, json_encode($params), ['Authorization: Bearer ' . $token->access_token, 'Content-Type: application/json']), true);
			if($response == '') {
				return true;
			}
			else {
				return $response['error']['errors'][0]['message'];
			}
			return false;
		}
		catch( \Exception $e) {
			Log::error($e);
		}
		return [];
	}
	/**
	 * Report abuse video
	 * @param  [type] $params [description]
	 * @return [type]         [description]
	 */
	public static function _reportAbuseVideoApi($params) {
		$response = null;
		$defaultParam = ["videoId" => "", "reasonId" => "", "secondaryReasonId" => "", "comments" => "", "language" => ""];
		$params = array_merge($defaultParam, $params);
		try {
			$client = new \Google_Client();
		    $client->setClientId(config('google.clientId'));
			$client->setClientSecret(config('google.clientSecret'));
			$client->setRedirectUri(config('google.redirectUri'));
			$client->setScopes(['https://www.googleapis.com/auth/youtube', 'https://www.googleapis.com/auth/youtube.force-ssl', 'https://www.googleapis.com/auth/youtubepartner']);

			$client->setAccessType('offline');
			$client->setApprovalPrompt('force');

			$youtube = new \Google_Service_YouTube($client);
			if($client->isAccessTokenExpired()) {
			    $client->setClientId(config('google.clientId'));
				$client->setClientSecret(config('google.clientSecret'));


			    $client->refreshToken(session('refresh_token'));
			}

			if( $token = session('access_token')) {
				$client->setAccessToken($token);
			}
			// set reasonId
			$reasonId = new \Google_Service_YouTube_VideoAbuseReportReasonId;
			$reasonId->setValue($params['reasonId']);
			// set secondaryReasonId
			$secondaryReasonId = new \Google_Service_YouTube_VideoAbuseReportReasonId;
			$secondaryReasonId->setValue($params['secondaryReasonId']);
			// init Google_Service_YouTube_VideoAbuseReport obj
			$videoReport = new \Google_Service_YouTube_VideoAbuseReport;
			$videoReport->setVideoId($params['videoId']);
			$videoReport->setReasonId($reasonId);
			$videoReport->setSecondaryReasonId($secondaryReasonId);
			$videoReport->setComments($params['comments']);
			$response = $youtube->videos->reportAbuse($videoReport);
			dd($response);

		}
		catch( \Exception $e) {
			Log::error($e);
			dd($e->getMessage());
		}
		// return $response;
	}
	/**
	 * Get video's blocked countries
	 * @return [view] json
	 */
	public static function getVideoDetailApi() {
		$videoIds = Input::get('videoids');

		$arrBlocked = [];
		try {
			$data = self::_getBrowserApi('https://www.googleapis.com/youtube/v3/videos?part=contentDetails,snippet&id=' . $videoIds);
			$tags = null;
			$blocked = null;
			foreach($data['items'] as $video) {
				if(isset($video['snippet']['tags'])) {
					$tags = $video['snippet']['tags'];
				}
				if(isset($video['contentDetails']['regionRestriction']['blocked'])) {
					$blocked = $video['contentDetails']['regionRestriction']['blocked'];
				}
				array_push($arrBlocked, ['id' => $video['id'] ,'blocked' => $blocked, 'tags' => $tags]);
			}
		}
		catch(Exception $e) {
			Log::error($e);
		}
		return Response::json(['data' => $arrBlocked]);
	}
	public static function _getBrowserApi($url) {
		$apiUrl = $url . "&key=" . config('google.serverApiKey');
		try {
			$response = self::curl($apiUrl);
			if( $data = json_decode($response, true)) {
				return $data;
			}
		}
		catch( Exception $e) {

		}
		return [];
	}

	public function getThumbnails() {
		return view('youtube.get-thumb');
	}

	public function processReportVideo() {
		$params = [
			'videoId' 			=> Input::get('videoId'),
			'reasonId' 			=> Input::get('reasonId'),
			'secondaryReasonId' => Input::get('secondaryReasonId'),
			'comments' 			=> Input::get('comments'),
			'language' 			=> Input::get('language'),
		];
		$return = ['status' => 0, 'msg' => ''];
		$res = $this->_reportAbuseVideo($params);
		if( $res === true) {
			$return['status']   = 1;
			$return['msg'] 		= 'Report success for video <strong>' . $params['videoId'] . '</strong><br><small>Reported as: ' . session('seeder_account_name') . '</small>';
		}
		else {
			$return['status']   = 0;
			$return['msg'] 		= 'Report failed for video <strong>' . $params['videoId'] . '</strong><br>' . $res . '<br><small>Reported as: ' . session('seeder_account_name') . '</small>';
		}
		return Response::json($return);
	}
	public function reportVideo() {
		if(!Auth::user()->id) return redirect(url('auth/login'));
		$totalSeedingAccount = intval(Seeder::countSeedingAccountByOwner(Auth::user()->id));
		if($totalSeedingAccount <= 0) {
			return redirect(url('seeder/add'))->withInput(['msg' => 'In order to use report feature, you need to add at least one seeding account. Click the button below to add seeding account']);
		}
		if( session('seeder_refresh_token') == null) {
			UserController::autoSwitchSeedingAccount();
		}
		if( Auth::user()->user_role != 1) \App::abort(403, 'Access denied');
		$reasons = $this->_getAbuseReason();
		return view('youtube.report')->with(['reasons' => $reasons, 'account' => session('seeder_account_name'), 'totalSeeder' => $totalSeedingAccount]);
	}
}