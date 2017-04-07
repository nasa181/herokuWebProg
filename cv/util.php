<?php
function demo_add_common_head(){
		print '
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
			<link rel="stylesheet" href="style.css">
		';
}
function demo_page_data($page=null){
	$data = array();
	session_start();
	
	$CLIENT_ID     = 'pqoplsQPnT6QQEBlxNGDwuViuVYljvO3S51I6PgG';
	$CLIENT_SECRET = 'fjFjSuIwfPayxEJV3pVmgupSpjwMyorG9q6iWvyN';
	$REDIRECT_URI           = 'https://testherokuwebprog.herokuapp.com/cv';
	$AUTHORIZATION_ENDPOINT = 'https://mycourseville.com/api/oauth/authorize';
	$TOKEN_ENDPOINT         = 'https://mycourseville.com/api/oauth/access_token';
	
	if(!isset($_SESSION['cvaccesstoken'])){
		//NOT Logged in
		if(!isset($_GET['code'])){
			$login_url = $AUTHORIZATION_ENDPOINT.'?response_type=code&client_id='.$CLIENT_ID.'&redirect_uri='.$REDIRECT_URI;
			$data['content'] = '<div class="w3-margin-left">';
			$data['content'] .= '  <a href="'.$login_url.'" class="w3-button w3-border-blue w3-hover-blue w3-hover-text-black w3-border">Login with myCourseVille</a>';
			$data['content'] .= '<div>';
		}else{
			$post_data = array(
				'grant_type=authorization_code',
				'client_id='.$CLIENT_ID,
				'client_secret='.$CLIENT_SECRET, 
				'redirect_uri='.$REDIRECT_URI,
				'code='.$_GET['code']
			);
			demo_get_cvaccesstoken($TOKEN_ENDPOINT,$post_data);
		}
	}
	
	$now = time();
	if(isset($_SESSION['cvrefreshtoken'])&&($now>=$_SESSION['cvtokenexpire'])){
		$post_data = array(
			'grant_type=refresh_token',
			'client_id='.$CLIENT_ID,
			'client_secret='.$CLIENT_SECRET, 
			'refresh_token='.$_SESSION['cvrefreshtoken']
		);
		demo_get_cvaccesstoken($TOKEN_ENDPOINT,$post_data);
	}
	
	if(isset($_SESSION['cvaccesstoken'])){
		if(!isset($page)){
			$page = 'main';
		}
		
		if($page=='logout'){
			$_SESSION = array();
			session_destroy();
			header('Location: ?page=main');
			die();
		}else{
			$data['content'] = '';
			$data['content'] .= demo_render_userinfo();
			
			if($page=='main'){
				$data['content'] .= demo_render_courselist();
			}
			
			$data['content'] .= demo_render_debug_info();
		}
	};
	return $data;
}

function demo_get_cvaccesstoken($url,$post_data){
	$ch = curl_init(); 
 	curl_setopt($ch,CURLOPT_URL,$url); 
	curl_setopt($ch,CURLOPT_POST,true); 
    curl_setopt($ch,CURLOPT_POSTFIELDS,implode('&',$post_data)); 
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	$result_json = curl_exec($ch);
	if($result_json===false){
		//$data['content'] .= '<p>cURL returns FALSE';
	}else{
		$result = json_decode($result_json); 	
	}
	curl_close($ch);
	$_SESSION['cvaccesstoken'] = $result->access_token;
	$_SESSION['cvrefreshtoken'] = $result->refresh_token;
	$_SESSION['cvtokenexpire'] = time()+$result->expires_in;
}

function demo_cvapi($endpoint,$get_data=null,$post_data=null){
    $headers = array(
        'Authorization: Bearer '.$_SESSION['cvaccesstoken'],
    );
	$get_param = '';
	foreach($get_data as $key=>$value){
		$get_param .= $key.'='.$value.'&'; 
	}
	$get_param = rtrim($get_param);
	if($get_param!=''){
		$get_param = '?'.$get_param;
	}
	$post_param = '';
	foreach($post_data as $key=>$value){
		$post_param .= $key.'='.$value.'&'; 
	}
	$post_param = rtrim($post_param);
	$url = 'https://mycourseville.com/api/v1/public/'.$endpoint.$get_param;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, count($post_data));
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_param);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
    $response = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return array('httpcode'=>$httpcode,'url'=>$url,'response'=>json_decode($response));
}

function demo_render_userinfo(){
	$cvapi_obj = demo_cvapi('get/user/info');
	$html = '';
	$html .= '<div class="w3-padding w3-container w3-row" id="demo-account">';
	$html .= '  <div class="w3-container w3-half">';
	if($cvapi_obj['httpcode']==200){
		$name_string = $cvapi_obj['response']->data->staff->firstname_th;
		$name_string .= ' '.$cvapi_obj['response']->data->staff->lastname_th;
		if(trim($name_string)==''){
			$name_string = $cvapi_obj['response']->data->staff->firstname_en;
			$name_string .= ' '.$cvapi_obj['response']->data->staff->lastname_en;
		}
		if(trim($name_string)==''){
			$name_string = $cvapi_obj['response']->data->student->firstname_th;
			$name_string .= ' '.$cvapi_obj['response']->data->student->lastname_th;
		}
		if(trim($name_string)==''){
			$name_string = $cvapi_obj['response']->data->student->firstname_en;
			$name_string .= ' '.$cvapi_obj['response']->data->student->lastname_en;
		}
		
		$html .= $name_string;	
	}else{
		$html .= 'Error calling get/user/info (code:'.$cvapi_obj['httpcode'].')';
	}
	$html .= '  </div>';
	$html .= '  <div class="w3-container w3-half w3-right-align">';
	$html .= '    <a href="?page=logout" class="w3-hover-blue w3-hover-text-black">Log Out</a>';
	$html .= '  </div>';
	$html .= '</div>';
	return $html;
}

function demo_render_courselist(){
	$cvapi_obj = demo_cvapi('get/user/courses');
	$html = '';
	$html .= '<div class="w3-container w3-margin" id="demo-courselist">';
	if($cvapi_obj['httpcode']==200){
		if(count($cvapi_obj['response']->data->staff)>0){
			$html .= '<header>Courses I taught</header>';
			$html .= '  <ul>';
			foreach($cvapi_obj['response']->data->staff as $course){
				$html .= '    <li>'.$course->year.'/'.$course->semester.': '.$course->course_no.'</li>';	
			}
			$html .= '  </ul>';
		}
		if(count($cvapi_obj['response']->data->student)>0){
			$html .= '<header>Courses I joined</header>';	
			$html .= '  <ul>';
			foreach($cvapi_obj['response']->data->student as $course){
				$html .= '    <li>'.$course->year.'/'.$course->semester.': '.$course->course_no.'</li>';
			}
			$html .= '  </ul>';
		}
	}else{
		$html .= 'Error calling get/user/courses (code:'.$cvapi_obj['httpcode'].')';
	}
	$html .= '</div>';
	return $html;
}
function demo_render_debug_info(){
	$now = time();
	$html = '';
	$html .= '<div class="w3-container w3-margin" id="demo-debug">';
	$html .= '  <div>'.nl2br(print_r($_SESSION,true)).'</div>';
	$html .= '  <div> NOW = '.$now.', Token expires at '.$_SESSION['cvtokenexpire'].' ('.($_SESSION['cvtokenexpire']-$now).' sec left) </div>';
	$html .= '</div>';
	return $html;
}
?>