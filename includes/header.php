<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<title>WappPress::Basic</title>
<script type="text/javascript">
jQuery(document).ready(function($){
	/* prepend menu icon */
	jQuery('#nav-wrap').prepend('<div id="menu-icon">Menu</div>');
	/* toggle nav */
	jQuery("#menu-icon").on("click", function(){
		jQuery("#nav").slideToggle();
		jQuery(this).toggleClass("active");
	});
});
</script>
<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery('.tabs .tab-links a').on('click', function(e)  {
        var currentAttrValue = jQuery(this).attr('href');
        // Show/Hide Tabs
        jQuery('.tabs ' + currentAttrValue).show().siblings().hide();
        // Change/remove current tab to active
        jQuery(this).parent('li').addClass('active').siblings().removeClass('active');
        e.preventDefault();
    });
});

jQuery(document).ready(function () {
	jQuery('#toggle-view span,#toggle-view h3').click(function () {
	//$('#toggle-view h3').click(function () {
		var text = jQuery(this).siblings('div.panel');
		if (text.is(':hidden')) {
			text.slideDown('200');
			jQuery(this).siblings('span').html('<img src="<?php echo  plugins_url( '../images/down_arrow.png',  __FILE__ ) ?>" alt="down-arrow"/> ');
		} else {
			text.slideUp('200');	
			jQuery(this).siblings('span').html('<img src="<?php echo plugins_url( '../images/arrow.png',  __FILE__ ) ?>" alt="up-arrow"/> ');			
		}
	});
});
</script>
</head>
<body>
<div class="header">
	<div class="wrapper">
		<div class="inner-header">
			<div class="logo">
				<a href="<?php echo admin_url('admin.php?page=wapppressplugin'); ?>"><img src="<?php echo plugins_url( '../images/logo.png',  __FILE__ ) ?>" title="" alt=""/></a>
			</div>
			<div class="right-header">
				<div class="navigation">
					<ul>
						<li><a <?php if(isset($_GET['page']) && $_GET['page']=='wapppressplugin'){ echo 'class="active"'; } ?> href="<?php echo admin_url('admin.php?page=wapppressplugin'); ?>"  >WappPress </a></li>
						<li><a <?php if(isset($_GET['page']) && $_GET['page']=='wapppresssettings'){ echo 'class="active"'; } ?> href="<?php echo admin_url('admin.php?page=wapppresssettings'); ?>" >Settings & Build App </a></li>
						<li><a <?php if(isset($_GET['page']) && $_GET['page']=='wapppresssettings#bulid'){ echo 'class="active"'; } ?> href="<?php echo admin_url('admin.php?page=wapppresssettings#bulid'); ?>" >Build Android App </a></li>
						<li><a <?php if(isset($_GET['page']) && $_GET['page']=='wapppresstheme'){ echo 'class="active"'; } ?> href="<?php echo admin_url('admin.php?page=wapppresstheme'); ?>">Themes </a></li>
					</ul>
				</div>
			</div>
			<div class="clear">
			</div>
		</div>
	</div>
</div>
<?php 
//
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
			 $subDirURL .= str_replace("wp-admin/admin.php","",$_SERVER['SCRIPT_NAME']);
		 }
		 return $pageURL.$subDirURL;
	}
	function get_domain_name($url)
	{
	  $pieces = parse_url($url);
	  $domain_n='';
	  $domain = isset($pieces['host']) ? $pieces['host'] : '';
	  if(preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,10})$/i', $domain, $regs)) {
		return $regs['domain'];
	  }
	  return false;
	}
	function get_app_url($request_type='complile')
	{
		$compile_id = COMPILE_ID;
							
		$pageURL = curl_site_url();
			
		$dirIncImg  = trailingslashit(plugins_url('wappPress'));						
		
		$domain_name = get_domain_name($pageURL); 
		$auth = urlencode(base64_encode($domain_name.'~wapppress~'.$pageURL.'~wapppress~'.time()));
		$compile_connector = '/api';
		if($request_type=='complile'){$compile_params    = '/create-api-app.php?auth_key=';}
		return $compile_id.$compile_connector.$compile_params.$auth;
	}
	//