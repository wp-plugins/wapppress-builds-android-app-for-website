<?php
class wappPress_admin_setting extends wappPress {
	function __construct() {
		add_action( 'admin_menu', array( $this, 'maker_menu' ), 7);
		add_action( 'admin_init', array( $this, 'register_settings' ) );
		add_action( 'wp_ajax_search_post_handler', array( $this, 'search_post_results' ) );
		add_action( 'wp_ajax_create_app', array( $this, 'create_app' ) );
		if ( isset( $_GET['clear_app_cookie'] ) && 'true' === $_GET['clear_app_cookie'] ) {
			  self::reset_cookie();
		}
	}
	public function maker_menu() {
		$dirPlgUrl  = trailingslashit( plugins_url('wapppress-builds-android-app-for-website') );
		$pageTitle = __( 'WappPress', 'WappPress' );
		$maPlgin = 'wapppressplugin';
		$maSett = 'wapppresssettings';
		$maTheme = 'wapppresstheme';
		$maHelp = 'wapppressapp';
		$plgIcon  = $dirPlgUrl  . 'images/view.png';
		$dirInc1  = $dirPlgUrl  . 'includes/';
		
		// Create main menu 
		// add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function )
		$mainMenu = add_menu_page( $pageTitle, $pageTitle, 'manage_options', $maPlgin, array( $this, 'maker_basic_page' ),$plgIcon  );
		global $submenu;
		// Settings page sub menu
		$subSettingMenu = add_submenu_page($maPlgin, __( 'Settings', 'wappPress' ), __( 'Settings', 'wappPress' ),  'manage_options', $maSett, array( $this, 'maker_settings_page' ));
		$subThemeMenu = add_submenu_page($maPlgin, __( 'Themes', 'wappPress' ), __( 'Themes', 'wappPress' ),  'manage_options', $maTheme, array( $this, 'maker_theme_page' ));	
	
	}
	
	//Basic Page 
	public function maker_basic_page(){
	require_once(  'header.php' );
	?>
	<div class="contant-section1">
	<div class="section">
		<div class="wrapper">
			<div class="contant-section">
				<h5>
				<img src="<?php echo plugins_url( '../images/img1.png',  __FILE__ ) ?>" title="img1" alt="img1"/> &nbsp; <i>Build Android App in real-time for any wordpress website</i>
				</h5>
				<h3>
				WappPress <span>BASIC VERSION<span> &nbsp; &nbsp;<strong>(free)</strong>
				</h3>
				<p>
					With WappPress Basic Version you will enjoy following features
				</p>
				<div class="inner-contant">
					<div class="list-sec">
						<ul>
							<li>Select different home page for Mobile app</li>
							<li>Select Different theme for website & mobile app   </li>
							<li>Select and customize launcher icon</li>
							<li>Upload your own custom icon</li>
							<li>Select and customize splash screen</li>
							<li>Upload your own splash screen </li>
							<span style='font-size:10px;margin-left:20px;'>( You can upload your own splash screen image, this will be used to capture the user's attention for a short time as a promotion or lead-in)</span><br /><br />
							<li>Push Notification <span style='color: red;display: inline;float: none;'>(New)</span></li>
							<li>Ads Free - i.e. no ads/brand name include inside</li>
							<li>Allow to Build Android App in Real Time</li>
							<li>Android App Validity – 15 Days</li>
						</ul>
						<span><a href="<?php echo admin_url('admin.php?page=wapppresssettings'); ?>"><img src="<?php echo plugins_url( '../images/btn.png',  __FILE__ ) ?>" title="" alt=""/></a></span>
					</div>
					<div class="img-box img-box2">
						<img src="<?php echo plugins_url( '../images/mob.png',  __FILE__ ) ?>" title="" alt=""/>
					</div>
					<div class="clear">
					</div>
				</div>
				<div class="sec-2">
					<div class="left-heading">
						<h3>
						WappPress <span class="pro-version">PRO VERSION</span>
						</h3>
					</div>
					<div class="right-heading">
						<h3><span>(FOR JUST &nbsp;<strong>$18</strong> &nbsp; ONLY )</span></h3>
					</div>
					<div class="clear">
					</div>
					<p>
						Use WappPress Pro Version to enjoy following features
					</p>
					<div class="inner-contant">
						<div class="list-sec1">
							<ul>
								<li>Select different home page for Mobile app</li>
								<li>Select Different theme for website & mobile app</li>
								<li>Select and customize launcher icon</li>
								<li>Upload your own custom icon</li>
								<li>Select and customize splash screen</li>
								<li>Upload your own splash screen </li>
								<span style='font-size:10px;float:left;margin-left:24px;'>( You can upload your own splash screen image, this will be used to capture the user's attention for a short time as a promotion or lead-in)</span><br /><br />
								<li>Push Notification <span style='color: red;display: inline;float: none;'>(New)</span></li>
								<li>Ads Free - i.e. no ads/brand name include inside</li>
								<li>Allow to Build Android App in Real Time</li>
								<li>Android App Validity – Unlimited Time</li>
							</ul>
							
							<span><a href="http://goo.gl/bcEb25" target='_blank'  ><img src="<?php echo plugins_url( '../images/btn2.png',  __FILE__ ) ?>" title="" alt=""/></a></span>
							<span>
							<h2>$18 <strong>Only</strong></h2>
							</span>
						</div>
						<div class="img-box">
							<img src="<?php echo plugins_url( '../images/mob.png',  __FILE__ ) ?>" title="" alt=""/>
						</div>
						<div class="clear">
						</div>
					</div>
				</div>
				<div class="sec-3">
					<h3> Publish App </h3>
					<p>
						If you need any help regarding publishing your app on Google Play <span><a href="mailto:info@wapppress.com">contact US</a></span>
					</p>
				</div>
			</div>
		</div>
	</div>	
	</div>	
	
	<!---=== Pro PopUp Div  Start ===--->
		<div id="pro_popup">
			<div class="form_upload">
				<span class="close" onclick="close_popup('pro_popup')">x</span>
				<h2 style='text-align:center;'>WappPress Pro version</h2>
					<div style='text-align:center;'>
						<h3><span style='color: #FB9700;display: inline-block;font-family: "open_sansbold";font-size: 12px;'>(FOR JUST &nbsp;<strong style='font-size: 20px;color:#e20202;'>$18</strong> &nbsp; ONLY )</span></h3>
					</div>
					<div style='float:left;display: inline-block;font-family: "open_sansbold";font-size: 12px;'>
						<a  target='_blank' href="javascript:void(0);" ><img src="<?php echo plugins_url( '../images/btn2.png',  __FILE__ ) ?>" title="" alt="Proceed To Buy"/></a>
					</div>
			</div>
		</div>	
	<!---=== Pro PopUp Div  End ===--->
	
	<?php	
	require_once(  'footer.php' );
	}
	
	// Setting Page 
	public function maker_settings_page(){
	require_once(  'header.php' );
	$dirIncImg  = trailingslashit( plugins_url('wapppress-builds-android-app-for-website') );
	$options = get_option('wapppress_settings');
	$args= array();	
	$all_themes = wp_get_themes( $args );
	$check = isset( $options['wapppress_theme_switch'] ) ? esc_attr( $options['wapppress_theme_switch'] ) : '';
	$authorCheck = isset( $options['wapppress_theme_author'] ) ? esc_attr( $options['wapppress_theme_author'] ) : '';
	$dateCheck = isset( $options['wapppress_theme_date'] ) ? esc_attr( $options['wapppress_theme_date'] ) : '';
	$commentCheck = isset( $options['wapppress_theme_comment'] ) ? esc_attr( $options['wapppress_theme_comment'] ) : '';
	
	$frontpage_id2 =  get_option('page_on_front'); 
	if($options['wapppress_theme_switch'] =='on'){ ?>
	<input type="hidden" id="wapppress_url"  value='<?php echo get_site_url() ; ?>' /> 
	<?php }else{ ?>
	<input type="hidden" id="wapppress_url"  value='<?php echo get_site_url().'/?wapppress=1' ; ?>' /> 
	<?php } ?>
	<div class="contant-section1">
	<div class="section">
	<div class="wrapper">
		<div class="contant-section">
			<div class="setting-head">
				<h3>1. SETTINGS</h3>
				<img src="<?php echo plugins_url( '../images/line.png',  __FILE__ ) ?>" title="" alt=""/>
			</div>
			<div class="setting-box">
				<div class="inner_left">
					<div class="inner_header2">
						<div class="tabs">
							<div class="tab-content">
							<form method="post" action="options.php">
								<div id="tab1" class="tab active">
									<ul id="toggle-view">
									<?php
										// settings_fields( $option_group )
										settings_fields( 'wapppress_group' );
										// do_settings_sections( $page )
										do_settings_sections( __FILE__ );
										?>
										<li>
										<h3 class="test">Enter Your App name</h3>
										<span><img src="<?php echo plugins_url( '../images/arrow.png',  __FILE__ ) ?>" alt=""></span>
										<div class="panel">
											<p>
												<input class="app_input"  type="text" id="wapppress_name" name="wapppress_settings[wapppress_name]" value="<?php echo $options['wapppress_name']; ?>" />
											</p>
										</div>
										</li>
										<li>
										<h3>Enable/Disable theme setting on desktop</h3>
										<span><img src="<?php echo plugins_url( '../images/arrow.png',  __FILE__ ) ?>" alt=""></span>
										<div class="panel">
											<p>
												<input type="radio" name="wapppress_settings[wapppress_theme_switch]"<?php checked( $check, 'on'.false ); ?> value='on' /> Enable &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" value=''  name="wapppress_settings[wapppress_theme_switch]" <?php checked( $check, ''.false ); ?> /> Disable
											</p>
										</div>
										</li>
										<li>
										<h3>Select Theme</h3>
										<span><img src="<?php echo plugins_url( '../images/arrow.png',  __FILE__ ) ?>" alt=""></span>
										<div class="panel">
											<p>
												<select name="wapppress_settings[wapppress_theme_setting]" id="wapppress_theme_setting"  class="app_input_select">
													<?php $the = array(); 
													foreach($all_themes as $theme_val =>$theme_name){ 
													 $nonce = wp_create_nonce('switch-theme_'.$theme_val);
													 $src = admin_url().'customize.php?action=preview&theme='.$theme_val;
													 $theme_val = $theme_val == 'option-none' ? '' : esc_attr( $theme_val ); 
													 echo $the[ $theme_val ] = '<option id="'.$src.'" value="'. $theme_val .'" '. selected( $options['wapppress_theme_setting'],$theme_val, false) .'>'. esc_html( $theme_name ) .'</option>
													'."\n"; 
													} ?>
												</select>
											</p>
										</div>
										</li>
										<li>
										<h3>Use a unique homepage for your app</h3>
										<span><img src="<?php echo plugins_url( '../images/arrow.png',  __FILE__ ) ?>" alt=""></span>
										<div class="panel">
											<p>Start typing to search for a page, or enter a page ID.</p>
											<p>
												<?php $frontpage_id1 =  get_option('page_on_front'); 
												if($frontpage_id1 !=$options['wapppress_home_setting']){
												?>
												<input class="app_input"  type="text" id="wapppress_home_setting" name="wapppress_settings[wapppress_home_setting]" value="<?php echo $options['wapppress_home_setting']; ?>" />
												<?php }else{ ?>
												<input class="app_input"  type="text" id="wapppress_home_setting" name="wapppress_settings[wapppress_home_setting]" value="" />
												<?php } ?>
											</p>
									<div class='wapppress_field_markup_text' id="wapppress_field_markup_text"></div>
										</div>
										</li>
										<li>
										<h3>Customize Your Theme</h3>
										<span><img src="<?php echo plugins_url( '../images/arrow.png',  __FILE__ ) ?>" alt=""></span>
										<div class="panel">
											<p>
												<input  type="checkbox" name="wapppress_settings[wapppress_theme_date]"  class="checkbox"  <?php checked( $dateCheck, 'on'.false ); ?> /> Display Date
											</p>
											<p>
												<input  type="checkbox" name="wapppress_settings[wapppress_theme_comment]"  class="checkbox"  <?php checked($commentCheck, 'on'.false ); ?> />  Display Comments
											</p>
											
										</div>
										</li>
									</ul>
								</div>
								
								<div class="save-btn">
									<input id="submit" style='padding: 0 !important;' type="image" src="<?php echo plugins_url( '../images/btn3.png',  __FILE__ ) ?>" value="Save Changes" name="submit">
									
								</div>
								<div style='margin-top:15px;'>
								<a href='#bulid'><img src='<?php echo plugins_url( '../images/btn6.png',  __FILE__ ) ?>' /></a>
								</div>
							</div>
							</form>
							
						</div>
					</div>
				</div>
				<div class="wrap-right mobileFrame">
					<iframe frameborder="0" allowtransparency="no" name="mobile_frame" id="mobile_frame" src="<?php echo get_site_url() ; ?>"/>
					</iframe>
				</div>
				
				<div class="clear">
				</div>
			</div>
			<div id='bulid'>&nbsp;</div>
			<div class="sec-2" style="border-bottom:0px;">
				<div class="setting-sec">
					<div class="setting-head" id='head'>
						<h3>2. BUILD ANDROID APP</h3>
						<img src="<?php echo plugins_url( '../images/line.png',  __FILE__ ) ?>" title="" alt=""/>
					</div>
					<div id='supportId' style='color: red; font-weight: bold; text-align: center; font-size: 16px;padding: 10px;'></div>
					<form role="form" action="#"  id="customer_support">
					<input type="hidden" name='dirPlgUrl1' id='dirPlgUrl1' value='<?php echo $dirIncImg; ?>'/>
					<div class="setting-form">
						<div class="supportForms_input">
							<p>
								Name:- <br /><input type="text" name='name' id='name' />
							</p>
						</div>
						<br/>
						<div class="supportForms_input">
							<p>
								Email:- <br /><input type="text" name='semail' id='semail' />
							</p>
						</div>
						<br/>
						<div class="supportForms_input">
							<p>
								 App Name (<em><span class='fon_cls'>Please enter only unique app name.</span></em>) :- <br /><input type="text" name='app_name' id='app_name' />
							</p>
						</div>
						<br/>
						
						<div class="clear">
						</div>
						
						<div class="sve_change_btn sve_change_btn2">
							<input id="submit"  type="image" src="<?php echo plugins_url( '../images/btn4.png',  __FILE__ ) ?>" value="Save Changes" name="submit">
							<span id='dwnloakId' style="display: block; margin-right: 160px;float:right;" ></span>
						</div>
						<span style='color:#6D6D6D;font-size:13px;'><b>Note:</b> <strong style='color: #0074a2;'>"BUILD/Generate App"</strong> feature will only  work  for the website/s hosted on live server, it would not work in localhost / local server.</span>
					</div>
					</form>
					
					<script type="text/javascript">
					jQuery(document).ready(function () {
						jQuery('input:radio[name="custom_splash_logo"]').filter('[value="0"]').attr('checked', true);
						jQuery('input:radio[name="custom_launcher_logo"]').filter('[value="0"]').attr('checked', true);
					});	
					function show_launcher_logo_form(fromId){
						if(fromId==0){
							jQuery('#upload_logo_form').show('slow');
							jQuery('#custom_logo_form').hide('fast');
						}else if(fromId==1){
							jQuery('#custom_logo_form').show('slow');
							jQuery('#upload_logo_form').hide('fast');
						}
						
					}
					
					function show_splash_screen_logo_form(fId){
						if(fId==0){
							jQuery('#upload_splash_form').show('slow');
							jQuery('#custom_splash_form').hide('fast');
						}else if(fId==1){
							jQuery('#custom_splash_form').show('slow');
							jQuery('#upload_splash_form').hide('fast');
						}
						
					}
					
					jQuery.validator.addMethod("alphanumeric", function(value, element) {
						return this.optional(element) || /^[a-zA-Z0-9]+$/i.test(value);
					}, "Only allow alpha/numeric.");

						jQuery( "#customer_support" ).validate({
								rules: {
									name:{
										required: true
									},
									semail: {
										required: true,
										email:true
									},
									app_name: {
										required: true,
										alphanumeric: true,
										maxlength:30
									}
								},
								messages: {
										name: {
											required: "Please enter your name."
										},
										semail: {
											required: "Please enter your email."
										},
										app_name: {
											required: "Please enter only unique app name."
										}
									},
									submitHandler: function(form) {
									 ajax_api_form();
								}
						});
						</script>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<?php require_once( 'footer.php' );
}
	//App Core Setting function	
	function register_settings() {
		// register_setting( $option_group, $option_name, $sanitize_callback )
		register_setting( 'wapppress_group', 'wapppress_settings', array($this, 'settings_validate') );
	}
	
	function settings_validate($arr_input) {
		$frontpage_id =  get_option('page_on_front');
		$options = get_option('wapppress_settings');
		$options['wapppress_name'] = trim( $arr_input['wapppress_name'] );
		$options['wapppress_theme_switch'] = trim( $arr_input['wapppress_theme_switch'] );
		$options['wapppress_theme_setting'] = trim( $arr_input['wapppress_theme_setting'] );
		if(!empty($arr_input['wapppress_home_setting'])){
			$options['wapppress_home_setting'] =	trim( $arr_input['wapppress_home_setting']);
		}else{
			$options['wapppress_home_setting'] =	trim( $frontpage_id );
		}
		$options['wapppress_theme_author'] = trim( $arr_input['wapppress_theme_author'] );
		$options['wapppress_theme_date'] = trim( $arr_input['wapppress_theme_date'] );
		$options['wapppress_theme_comment'] = trim( $arr_input['wapppress_theme_comment'] );
		return $options;
	}
	
	// Theme Page 
	public function maker_theme_page(){
	require_once( 'header.php' );
	$args =array();
	$themes = wp_get_themes( $args );
	$dirIncImg  = trailingslashit( plugins_url('wapppress-builds-android-app-for-website') );
?>	
<div class="contant-section1">
<div class="section">
	<div class="wrapper">
		<div class="contant-section">
			<h5>
			<img src="<?php echo plugins_url( '../images/img1.png',  __FILE__ ) ?>" title="" alt=""/> &nbsp; <i>All Themes Listing</i>
			</h5>
			<div class="wrapper">
				<div class="container_main">
					<?php $the = array(); foreach($themes as $theme_val => $theme_name){
					$options = get_option('wapppress_settings');
					$currentTheme= $options['wapppress_theme_setting'];
					if($currentTheme==$theme_val){
					$theme_img = get_theme_root_uri().'/'.$theme_val.'/'.'screenshot.png';
					$url = esc_url(add_query_arg( array('wapppress' => true,'theme' =>$currentTheme,), admin_url( 'customize.php' )) );
					 ?>
					<div class="theme-box-main">
						<div class="theme_box">
							<span><img src="<?php echo $theme_img?>" alt="<?php echo $theme_name?>" width='244' height="225" /></span>
							<a class="customize" href="<?php  echo $url; ?>">Customize</a>
						</div>
						<p>
							<img src="<?php echo plugins_url( '../images/shadow.png',  __FILE__ ) ?>" title=""/>
						</p>
					</div>
					<?php } } ?>
					<?php
					$the = array(); foreach($themes as $theme_val => $theme_name){
					$options = get_option('wapppress_settings');
					$currentTheme= $options['wapppress_theme_setting'];
					if($currentTheme!=$theme_val){
					$theme_img = get_theme_root_uri().'/'.$theme_val.'/'.'screenshot.png';
					$nonce = wp_create_nonce('switch-theme_'.$theme_val);
					?>
					<div class="theme-box-main">
						<div class="theme_box">
							<span><img src="<?php echo $theme_img; ?>" alt="<?php echo $theme_name; ?>" width='244' height="225" /></span>
							<a class="customize" style="opacity:0.5;pointer-events: none;" href="<?php  echo $url; ?>">Customize</a>
						</div>
						<p>
							<img src="<?php echo plugins_url( '../images/shadow.png',  __FILE__ ) ?>" title=""/>
						</p>
					</div>
					<?php } } ?>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
</div>
</div>

<?php require_once( 'footer.php' );
}
	

//Create App 
public function  create_app(){


//Android API Form Start
if( isset($_POST['type']) && $_POST['type'] =='api_create_form') {

	//Get Current Website URL
	function curl_site_url() {
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
			 $subDirURL .= str_replace("/wp-admin/admin-ajax.php","",$_SERVER['SCRIPT_NAME']);
		 }
		 return $pageURL.$subDirURL;
	}
	
	$name = $_POST['name'];	
	$email = $_POST['semail'];	
	$website = curl_site_url();													
	$dirPlgUrl1 = $_POST['dirPlgUrl1'];
	$ap = $_POST['ap'];	
	$ip = $_POST['ip'];	
	$file = $_POST['file'];	
	function wcurlrequest($ac,$d_name,$an,$data) {
		set_time_limit(600);
		$fields = '';
		foreach ($data as $key => $value) {
			$fields .= $key . '=' . $value . '&';
		}
		rtrim($fields, '&');
	
		$post = curl_init();
		curl_setopt($post, CURLOPT_URL,$ac);
		curl_setopt($post, CURLOPT_VERBOSE, 0);  
		curl_setopt($post, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($post, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($post, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($post, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($post, CURLOPT_TIMEOUT, 900);
		$agent = 'Mozilla/5.0 (X11; U; Linux x86_64; pl-PL; rv:1.9.2.22) Gecko/20110905 Ubuntu/10.04 (lucid) Firefox/3.6.22';
		if(!empty($_SERVER['HTTP_USER_AGENT'])){
			$agent = $_SERVER['HTTP_USER_AGENT'];
		}
		curl_setopt($post, CURLOPT_USERAGENT, $agent);
		curl_setopt($post, CURLOPT_FAILONERROR, 1);
		curl_setopt($post, CURLOPT_POST, count($data));
		curl_setopt($post, CURLOPT_POSTFIELDS, $fields);
		$result = curl_exec($post);
        $code = curl_getinfo($post, CURLINFO_HTTP_CODE);
        $success = ($code == 200);
        curl_close($post);
        if (!$success) {
			 $str = "0~test";
			 wp_send_json_success( $str );
			 exit();
        } else {
			if($result!=0){
				$dirPath = dirname(__FILE__);
				$myFile = $dirPath."/wp_comment.txt";
				$fh = fopen($myFile, 'w') or die("can't open file");
				$stringData = $result;
				fwrite($fh, $stringData);
				fclose($fh);
				$d_name = str_replace("-",".",$d_name);
				$str = '1~'.$d_name;
				wp_send_json_success( $str );
				exit();
			}else{
				wp_send_json_success( $str );
				$str = '0~test';
				exit();
			}
		
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
			'app_site_url'=>$dirPlgUrl1
		);
	
	
	// cURL Enable/Disable Function
	function _is_curl_installed() {
		if  (in_array  ('curl', get_loaded_extensions())) {
			return true;
		} else {
			return false;
		}
	}
	
	$whitelist = array('127.0.0.1', "::1",'localhost');

	// Check cURL Enable/Disable 
	if (_is_curl_installed()) {
		if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
			$str = "3~test";
			wp_send_json_success( $str );
			exit();
		}else{	
			wcurlrequest($ip.$ap.$file,$domain_name,$app_name,$data);
			exit();
		}
	} else {
		if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
			$str = "3~test";
			wp_send_json_success( $str );
			exit();
		}else{
			$str = "2~test";
			wp_send_json_success( $str );
			exit();
		}
	}
}
//Android API Form End		

}
	
	
	
 public function search_post_results() 
 {
	   $searchVal = sanitize_text_field($_POST['search_val']);
	   $nonceVal = sanitize_text_field($_POST['nonce']);
		if( !(isset($searchVal,$nonceVal) && wp_verify_nonce($nonceVal, 'wapppress_group-options' ) ) ){
			wp_send_json_error( '<p>'. __( 'Security check failed', 'wapppress' ) .'</p>' );
		}	
		
		if ( empty( $searchVal ) ){
			wp_send_json_error( '<p>'. __( 'Please Try Again', 'wapppress' ) .'</p>' );
		}
		global $wpdb;
		$allResults = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_title LIKE '%%%s%%' AND post_status = 'publish' AND post_type = 'page' LIMIT 10", $searchVal ) );
		if ( empty( $allResults ) ){
			wp_send_json_error( '<p>'. __('No Results Found', 'wapppress' ) .'</p>' );
		}
		if ( !empty( $allResults ) ){
			$str = '<p>'. __('Please choose a page', 'wapppress' ) .'</p>';
			$str .= '<ol>';
			foreach ( $allResults as $postID ) {
				$str .= '<li><a href="'. get_permalink( $postID ) .'"  data-postID="'. $postID .'">'. get_the_title( $postID ) .'</a></li>';
			}
			$str .= '</ol>';
			wp_reset_postdata();
			wp_send_json_success( $str );
		}
	}
	
	public function reset_cookie() {
		setcookie( 'wapppress_app', 'true', time() - DAY_IN_SECONDS );
	}
}
new wappPress_admin_setting();
