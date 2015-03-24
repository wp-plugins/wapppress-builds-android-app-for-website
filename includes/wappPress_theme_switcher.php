<?php
class wappPress_theme_switcher extends wappPress {
	public $appSet   = null;
	const WAPPPRESS_SETTINGS     = 'wapppress_settings';
	public $mainTemplate   = null;
	public $mainStylesheet = null;
	public $mainTheme      = null;
	public $wappTheme      = false;
	
	public function __construct() {
		add_action( 'plugins_loaded', array( $this, 'admin_switch_theme' ), 9999 );
		add_filter( 'pre_option_show_on_front', array( $this, 'show_on_front' ) );
		add_filter( 'pre_option_page_on_front', array( $this, 'page_on_front' ) );
		$this->mainTheme = wp_get_theme();
	}
	
	public function admin_switch_theme() {
		$checkSwitch = (is_admin() && ! $this->wapppress_customizer());
		if ( $checkSwitch ) { 
			return;
		}
			$appSet='';
		if ( $appSet !== null ){
			 $appSet;
		}else{
			
			$appSet = isset( $_GET['wapppress'] ) && ($_GET['wapppress'] == 1 || isset( $_COOKIE['wapppress_app'] )) && ($_COOKIE['wapppress_app'] === 'true');
		}
		if(empty($appSet)){
			setcookie( 'wapppress_app', 'true', time() + ( DAY_IN_SECONDS * 30 ) );
		}
		
		$wapppressSetting = @get_option(WAPPPRESS_SETTINGS);
		
		$checkStatus= ( $wapppressSetting['wapppress_theme_setting'] && ( (!$appSet && wp_is_mobile()) || $appSet || ( $wapppressSetting['wapppress_theme_switch'] == 'on' && current_user_can( 'manage_options' ))  || $this->wappPress_customizer()));
		
		if(! $checkStatus){
			return;
		}

		$this->wappTheme = wp_get_theme( $wapppressSetting['wapppress_theme_setting']);
		
		add_filter( 'option_template', array( $this, 'templateRequest' ), 10);
		add_filter( 'option_stylesheet', array( $this, 'stylesheetRequest' ), 10);
		add_filter( 'template', array( $this, 'switchTheme' ) );
	}
	
	public function wappPress_customizer() {
		if ( isset( $this->wapp_customizer ) ){
			return $this->wapp_customizer;
		}	
		$options = @get_option(WAPPPRESS_SETTINGS);
		$themeName = $options['wapppress_theme_setting'];
		$this->wapp_customizer = isset( $_GET['wapppress_theme_setting'],$_GET['theme'] ) || ( isset($_GET['wp_customize'],$_GET['theme'] ) && $themeName == $_GET['theme']  );
		return $this->wapp_customizer;
	}
	
	public function templateRequest( $template ) {
		$this->mainTemplate = null === $this->mainTemplate ? $template : $this->mainTemplate;
		return $this->switchTheme( $template );
	}
	
	public function stylesheetRequest( $stylesheet ) {
		$this->mainStylesheet = null === $this->mainStylesheet ? $stylesheet : $this->mainStylesheet;
		return $this->switchTheme( $stylesheet, true );
		
	}
	
	public function switchTheme( $template = '', $stylesheetRequest = false ) {
		$wapppressSetting = @get_option(WAPPPRESS_SETTINGS);

		if ( ! $template ) {
			$template = $stylesheetRequest ? $this->mainStylesheet : $this->mainTemplate;
		}
		
		if ( ! $this->wappTheme){
			return $template;
		}
		
		$template = $stylesheetRequest ? $wapppressSetting['wapppress_theme_setting'] : $this->wappTheme->get_template();
		
		return $template;
	}
	
	 public function show_on_front() {
		$this->mainTheme = wp_get_theme();
		if ( $this->mainTheme->template == $this->switchTheme() && ! is_admin() ) {
			return 'page';
		}
		return false;
	}
	
	 public function page_on_front() {
		$wapppressSetting = @get_option(WAPPPRESS_SETTINGS);
		$this->mainTheme = wp_get_theme();
		if ( $this->mainTheme->template == $this->switchTheme() && ! is_admin() ) {
			return $wapppressSetting['wapppress_home_setting'];
	  	}
		return false;
	}
}