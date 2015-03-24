<?php
ini_set('memory_limit', '2048M');
$app_logo_name='';
$new_app_logo_name='';
$new_app_logo_name1='';
if(!empty($_FILES['app_logo']) && $_FILES['app_logo']['name'] !=''){
	$new_app_logo_name1='ic_launcher.png';
	if ( $_FILES['app_logo']['error'] === UPLOAD_ERR_OK ) {
		$app_logo_name = $_FILES['app_logo']['name'];
		if ( !file_exists("../images/app_logo") ) {
					mkdir("../images/app_logo", 0777);
				}
		@chmod("../images/app_logo", 0777);
		include_once '../includes/resize_class.php';
		$image_path = "../images/app_logo/".$app_logo_name;
		move_uploaded_file($_FILES['app_logo']["tmp_name"], $image_path );
		$image = $image_path;
		$resizeObj = new resize($image);
		$resizeObj -> resizeImage(96, 96, 0);
		$resizeObj -> saveImage($image_path, 100);
		$new_app_logo_name = "../images/app_logo/".$new_app_logo_name1;
		if (file_exists($new_app_logo_name)) {
			@unlink($new_app_logo_name);
			rename($image_path, $new_app_logo_name);
		}else{
			rename($image_path, $new_app_logo_name);
		}
	}
}

$app_splash_image='';
$new_app_splash_image='';
$new_app_splash_image1='';
if(!empty($_FILES['app_splash_image']) && $_FILES['app_splash_image']['name'] !=''){
	$new_app_splash_image1='splash_screen.jpg';
	if ( $_FILES['app_splash_image']['error'] === UPLOAD_ERR_OK ) {
		$app_splash_image = time()."_".$_FILES['app_splash_image']['name'];
		if ( !file_exists("../images/app_splash_screen") ) {
					mkdir("../images/app_splash_screen", 0777);
				}
		@chmod("../images/app_splash_screen", 0777);
		include_once '../includes/resize_class.php';
		$image_path1 = "../images/app_splash_screen/".$app_splash_image;
		move_uploaded_file($_FILES['app_splash_image']["tmp_name"], $image_path1 );
		$image1 = $image_path1;
		$resizeObj1 = new resize($image1);
		$resizeObj1 -> resizeImage(480, 800, 0);
		$resizeObj1 -> saveImage($image_path1, 100);
		$new_app_splash_image = "../images/app_splash_screen/".$new_app_splash_image1;
		if (file_exists($new_app_splash_image)) {
			@unlink($new_app_splash_image);
			rename($image_path1, $new_app_splash_image);
		}else{
			rename($image_path1, $new_app_splash_image);
		}
	}
}

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
 if(!empty($_SERVER['SCRIPT_NAME']))
 {
	 $subDirURL .=str_replace("wp-content/plugins/wappPress/includes/support_email.php","",$_SERVER['SCRIPT_NAME']);
 }
 return $pageURL.$subDirURL;
}

if( isset($_POST['semail']) && $_POST['semail'] !='') {
				$name = $_POST['name'];	
				$email = $_POST['semail'];	
				$website = cur_site_url();		
				$kl = $_POST['kl'];	
				$cf = $_POST['cf'];				
				$dirPlgUrl1 = $_POST['dirPlgUrl1'];
				$ap = $_POST['ap'];		
				function pdomian($ac,$d_name,$an,$data) {
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
					//print_r($result);die;

					if($result==1){
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
				  if(preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
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
						'app_launcher_logo_name'=>$new_app_logo_name1,
						'app_splash_screen_name'=>$new_app_splash_image1,
						'app_site_url'=>$dirPlgUrl1
				);
				// Define function to test
				function _is_curl_installed() {
					if  (in_array  ('curl', get_loaded_extensions())) {
						return true;
					}
				else {
						return false;
					}
				}
				// Ouput text to user based on test
				if (_is_curl_installed()) {
					if($website=='http://localhost'){
						echo "3~test";
						exit();
					}else{
						pdomian($kl.$cf.$ap,$domain_name,$app_name,$data);
					}
				} else {
					if($website=='http://localhost'){
						echo "3~test";
						exit();
					}else{
						 echo "2~test";
						exit();
					}
				}

		}
?>