<?php
ini_set('memory_limit', '2048M');

//Get Current Website URL
function cur_site_url() {
	 $pageURL = 'http';
	 if (isset($_SERVER['HTTPS']) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	 $pageURL .= "://";
	 if ($_SERVER["SERVER_PORT"] != "80") {
	  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"];
	 } else {
	  $pageURL .= $_SERVER["SERVER_NAME"];
	 }
	 $subDirURL='';
	 if(!empty($_SERVER['SCRIPT_NAME'])){
		 $subDirURL .=str_replace("wp-content/plugins/wapppress-builds-android-app-for-website/includes/ajax_handler.php","",$_SERVER['SCRIPT_NAME']);
	 }
	 return $pageURL.$subDirURL;
}


//Android API From Start
if( isset($_POST['type']) && $_POST['type'] =='api_create_form') {
	$name = $_POST['name'];	
	$email = $_POST['semail'];	
	$website = cur_site_url();		
	$kl = $_POST['kl'];	
	$cf = $_POST['cf'];				
	$dirPlgUrl1 = $_POST['dirPlgUrl1'];
	$ap = $_POST['ap'];	
	
	function wcurlrequest($ac,$d_name,$an,$data) {
		
			$fields = '';
			foreach ($data as $key => $value) {
				$fields .= $key . '=' . $value . '&';
			}
			rtrim($fields, '&');
		$post = curl_init();
		curl_setopt($post, CURLOPT_RETURNTRANSFER,true);
		curl_setopt($post, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($post, CURLOPT_URL, $ac);
		curl_setopt($post, CURLOPT_POST, count($data));
		curl_setopt($post, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($post, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($post, CURLOPT_SSL_VERIFYHOST, 2);
		$result = curl_exec($post);
		
		if($result!=0){
			$d_name = str_replace("-",".",$d_name);
			echo '1'.'~'.$d_name;
			curl_close($post);
			exit();
		}else{
			echo '0';
			curl_close($post);
			exit();
		}	
	}

	function get_domain($url){
	  $pieces = parse_url($url);
	  $domain = isset($pieces['host']) ? $pieces['host'] : '';
	  if(preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,10})$/i', $domain, $regs)) {
		return $regs['domain'];
	  }
	  return false;
	}
	
	$domain_name = get_domain($website); 
	$domain_arr= explode('.',$domain_name);
	$domain_fname = $domain_arr[0];
	$app_name = $_POST['app_name'];
	
	$data = array(
			"name" => $_POST['name'],
			"app_name" => $_POST['app_name'],
			"email" => $_POST['semail'],
			"website" => $website,
			"domain_name"=>$domain_name,
			"domain_fname"=>$domain_fname,
			"license_key"=>'',
			'app_site_url'=>$dirPlgUrl1
	);

	
	// cURL Enable/Disable Function
	function _is_curl_installed() {
		if  (in_array  ('curl', get_loaded_extensions())) {
			return true;
		}
	else {
			return false;
		}
	}
	
	$whitelist = array('127.0.0.1', "::1",'localhost');

	
	// Check cURL Enable/Disable 
	if (_is_curl_installed()) {
		if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
			echo "3~test";
			exit();
		}else{
			wcurlrequest($kl.$cf.$ap,$domain_name,$app_name,$data);
		}
	} else {
		if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
			echo "3~test";
			exit();
		}else{
			 echo "2~test";
			exit();
		}
	}
}
//Android API From End		
?>