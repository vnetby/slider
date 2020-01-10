<?php namespace ACF_FCE;

class Requirements {

	use Singleton;

	/**
	 * All about requirements checks
	 *
	 * @return bool
	 */
	public function check_requirements() {
		if ( ! function_exists( 'acf' ) ) {
			$this->display_error( __( 'Advanced Custom Fields is a required plugin.', 'acf-flexible-content-extended' ) );

			return false;
		}

		if ( '5.6.0' > acf()->version ) {
			$this->display_error( __( 'Advanced Custom Fields should be on version 5.6.0 or above.', 'acf-flexible-content-extended' ) );

			return false;
		};

		return true;
	}

	// Display message and handle errors
	public function display_error( $message ) {
		trigger_error( $message );

		add_action( 'admin_notices', function () use ( $message ) {
			printf( '<div class="notice error is-dismissible"><p>%s</p></div>', $message );
		} );

		// Deactive self
		add_action( 'admin_init', function () {
			deactivate_plugins( ACF_FCE_ACF_OPTIONS_MAIN_FILE_DIR );
			unset( $_GET['activate'] );
		} );
	}
}
