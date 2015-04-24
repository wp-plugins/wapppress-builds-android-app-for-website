<?php
class wappPress_customize extends wappPress {
	public function __construct() {
		if ( ! isset( $_GET['wapppress'] ) ){
			return;
		}
		
		if ( ! isset( $_GET['theme'] )) {
			add_action( 'admin_init', array( $this, 'return_url' ) );
		}
		add_filter( 'clean_url', array( $this, 'back_button_url' ) );
		add_filter( 'clean_url', array( $this, 'back_button_url' ) );
	}
	public function return_url() {
		wp_redirect( esc_url(add_query_arg( 'page', 'wapppresstheme',  admin_url( 'admin.php' ) ) ));
	}
	public function back_button_url( $changeUrl ) {
		if ( $changeUrl == admin_url( 'themes.php' ) ) {
			return  esc_url(add_query_arg( 'page', 'wapppresstheme', admin_url( 'admin.php' ) ));
		}
		return $changeUrl;
	}
}		