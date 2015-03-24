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
						<li><a <?php if(isset($_GET['page']) && $_GET['page']=='wapppresstheme'){ echo 'class="active"'; } ?> href="<?php echo admin_url('admin.php?page=wapppresstheme'); ?>">Themes </a></li>
					</ul>
				</div>
			</div>
			<div class="clear">
			</div>
		</div>
	</div>
</div>