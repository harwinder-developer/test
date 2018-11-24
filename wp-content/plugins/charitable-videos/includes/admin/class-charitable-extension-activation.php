<?php
/**
 * Activation handler for Charitable extensions.
 *
 * @package     Charitable/Activation Handler
 * @since       1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

/**
 * Charitable_Extension_Activation
 *
 * @since       1.0.0
 */
class Charitable_Extension_Activation {

	public $plugin_name, $plugin_path, $plugin_file, $has_charitable, $charitable_base;

	/**
	 * Setup the activation class
	 *
	 * @param 		string $plugin_path The absolute path to the plugin's directory.
	 * @param 		string $plugin_file The absolute path to the main plugin file.
	 * @access      public
	 * @since       1.0.0
	 * @return      void
	 */
	public function __construct( $plugin_path, $plugin_file ) {

		// We need plugin.php!
		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );

		$plugins = get_plugins();

		// Set plugin directory
		$plugin_path = array_filter( explode( '/', $plugin_path ) );
		$this->plugin_path = end( $plugin_path );

		// Set plugin file
		$this->plugin_file = $plugin_file;

		// Set plugin name
		$plugin_file_path = $this->plugin_path . '/' . $this->plugin_file;

		if ( isset( $plugins[ $plugin_file_path ]['Name'] ) ) {

			$this->plugin_name = str_replace( 'Charitable - ', '', $plugins[ $plugin_file_path ]['Name'] );

		} else {

			$this->plugin_name = __( 'This plugin', 'charitable-videos' );

		}

		// Is Charitable installed?
		foreach ( $plugins as $plugin_path => $plugin ) {

			if ( 'Charitable' == $plugin['Name'] ) {

				$this->has_charitable = true;
				$this->charitable_base = $plugin_path;
				break;

			}
		}
	}


	/**
	 * Process plugin deactivation
	 *
	 * @return      void
	 * @access      public
	 * @since       1.0.0
	 */
	public function run() {
		add_action( 'admin_notices', array( $this, 'missing_charitable_notice' ) );
	}

	/**
	 * Display notice if Charitable isn't installed
	 *
	 * @return      string The notice to display
	 * @access      public
	 * @since       1.0.0
	 */
	public function missing_charitable_notice() {
		if ( $this->has_charitable ) {
			$url  = esc_url( wp_nonce_url( admin_url( 'plugins.php?action=activate&plugin=' . $this->charitable_base ), 'activate-plugin_' . $this->charitable_base ) );
			$link = '<a href="' . $url . '">' . __( 'activate it', 'charitable-videos' ) . '</a>';
		} else {
			$url  = esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=charitable' ), 'install-plugin_charitable' ) );
			$link = '<a href="' . $url . '">' . __( 'install it', 'charitable-videos' ) . '</a>';
		}

		echo '<div class="error"><p>' . sprintf( _x( '%s requires Charitable! Please %s to continue!', 'Plugin requires Charitable! Please install/activate it to continue!', 'charitable-videos' ), $this->plugin_name, $link ) . '</p></div>';
	}
}
