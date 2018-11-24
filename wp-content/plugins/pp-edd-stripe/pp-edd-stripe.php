<?php
/*
Plugin Name: Philanthropy Project - Custom Stripe Payment Gateway
Plugin URL: https://easydigitaldownloads.com/downloads/stripe-gateway/
Description: Adds a payment gateway for Stripe.com
Version: 2.6.11
Author:          Powering Philanthropy
Author URI:      http://www.poweringphilanthropy.com/
Text Domain: edds
Domain Path: languages
*/

class EDD_Stripe {

	private static $instance;

	private function __construct() {
	}

	public static function instance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof EDD_Stripe ) ) {
			self::$instance = new EDD_Stripe;

			if( version_compare( PHP_VERSION, '5.3.3', '<' ) ) {

				add_action( 'admin_notices', self::below_php_version_notice() );

			} else {

				self::$instance->setup_constants();

				add_action( 'init', array( self::$instance, 'load_textdomain' ) );

				self::$instance->includes();

				self::$instance->actions();
				self::$instance->filters();

				// if ( class_exists( 'EDD_License' ) && is_admin() ) {
				// 	new EDD_License( __FILE__, 'Stripe Payment Gateway', EDD_STRIPE_VERSION, 'Easy Digital Downloads', 'stripe_license_key' );
				// }

			}
		}

		return self::$instance;
	}

	function below_php_version_notice() {
		echo '<div class="error"><p>' . __( 'Your version of PHP is below the minimum version of PHP required by Easy Digital Downloads - Stripe Payment Gateway. Please contact your host and request that your version be upgraded to 5.3.3 or later.', 'edds' ) . '</p></div>';
	}

	private function setup_constants() {
		global $wpdb;

		if ( ! defined( 'EDDS_PLUGIN_DIR' ) ) {
			define( 'EDDS_PLUGIN_DIR', dirname( __FILE__ ) );
		}

		if ( ! defined( 'EDDSTRIPE_PLUGIN_URL' ) ) {
			define( 'EDDSTRIPE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
		}

		define( 'EDD_STRIPE_VERSION', '2.6.11' );

		define( 'PP_EDD_ORG_TABLE', $wpdb->prefix . 'organizations' );
	}

	private function includes() {
		if ( ! class_exists( 'Stripe\Stripe' ) ) {
			require_once EDDS_PLUGIN_DIR . '/vendor/autoload.php';
		}

		require_once EDDS_PLUGIN_DIR . '/includes/card-actions.php';
		require_once EDDS_PLUGIN_DIR . '/includes/functions.php';
		require_once EDDS_PLUGIN_DIR . '/includes/gateway-actions.php';
		require_once EDDS_PLUGIN_DIR . '/includes/gateway-filters.php';
		require_once EDDS_PLUGIN_DIR . '/includes/payment-actions.php';
		require_once EDDS_PLUGIN_DIR . '/includes/connect-actions.php';
		require_once EDDS_PLUGIN_DIR . '/includes/donor-covers-actions.php';
		require_once EDDS_PLUGIN_DIR . '/includes/scripts.php';
		require_once EDDS_PLUGIN_DIR . '/includes/template-functions.php';

		if ( is_admin() ) {
			// require_once EDDS_PLUGIN_DIR . '/includes/admin/class-pp-edd-stripe-admin.php';
			require_once EDDS_PLUGIN_DIR . '/includes/admin/admin-actions.php';
			require_once EDDS_PLUGIN_DIR . '/includes/admin/admin-filters.php';
			require_once EDDS_PLUGIN_DIR . '/includes/admin/settings.php';
			require_once EDDS_PLUGIN_DIR . '/includes/admin/upgrade-functions.php';
			require_once EDDS_PLUGIN_DIR . '/includes/admin/reporting/class-stripe-reports.php';
		}

		if ( defined( 'WP_CLI' ) && WP_CLI ) {
			require_once EDDS_PLUGIN_DIR . '/includes/integrations/wp-cli.php';
		}

	}

	private function actions() {
		add_action( 'admin_init', array( self::$instance, 'database_upgrades' ) );
		remove_action( 'edd_purchase_form_before_submit', 'edd_checkout_final_total', 999 );
		add_action( 'edd_purchase_form_before_submit',  array( self::$instance,'edd_checkout_final_total_updated'), 10 );
	}

	private function filters() {
		add_filter( 'edd_payment_gateways', array( self::$instance, 'register_gateway' ) );
	}

	public function database_upgrades() {
		$did_upgrade = false;
		$version     = get_option( 'edds_stripe_version' );

		if( ! $version || version_compare( $version, EDD_STRIPE_VERSION, '<' ) ) {

			$did_upgrade = true;

			switch( EDD_STRIPE_VERSION ) {

				case '2.5.8' :
					edd_update_option( 'stripe_checkout_remember', true );
					break;

			}

		}

		if( $did_upgrade ) {
			update_option( 'edds_stripe_version', EDD_STRIPE_VERSION );
		}
	}

	public function load_textdomain() {
		// Set filter for language directory
		$lang_dir = EDDS_PLUGIN_DIR . '/languages/';

		// Traditional WordPress plugin locale filter
		$locale = apply_filters( 'plugin_locale', get_locale(), 'edds' );
		$mofile = sprintf( '%1$s-%2$s.mo', 'edds', $locale );

		// Setup paths to current locale file
		$mofile_local   = $lang_dir . $mofile;
		$mofile_global  = WP_LANG_DIR . '/edd-stripe/' . $mofile;

		// Look in global /wp-content/languages/edd-stripe/ folder
		if( file_exists( $mofile_global ) ) {
			load_textdomain( 'edds', $mofile_global );

		// Look in local /wp-content/plugins/edd-stripe/languages/ folder
		} elseif( file_exists( $mofile_local ) ) {
			load_textdomain( 'edds', $mofile_local );

		} else {
			// Load the default language files
			load_plugin_textdomain( 'edds', false, $lang_dir );
		}
	}

	public function register_gateway( $gateways ) {
		// Format: ID => Name
		$gateways['stripe'] = array(
			'admin_label'    => 'Stripe',
			'checkout_label' => __( 'Credit Card', 'edds' ),
			'supports'       => array(
				'buy_now'
			)
		);
		return $gateways;
	}
	
	public function edd_checkout_final_total_updated() {
	if((isset($_POST['donor_selection']) && $_POST['donor_selection'] == "true") || !isset($_POST['donor_selection'])){
		$charges = pp_get_donor_fees_on_checkout();
		if($charges['donor-covers-fee'] ){	
			$currency_helper = charitable_get_currency_helper();
			$total = $currency_helper->get_monetary_amount($charges['gross-amount']);
		}else{
			$currency_helper = charitable_get_currency_helper();
			$total = $currency_helper->get_monetary_amount(edd_get_cart_total()); 
			$data_total = edd_get_cart_total(); 
		}}else {
			$currency_helper = charitable_get_currency_helper();
			$total = $currency_helper->get_monetary_amount(edd_get_cart_total()); 
			$data_total = edd_get_cart_total(); 
		}
		
		?>
		<p id="edd_final_total_wrap">
			<strong><?php _e( 'Purchase Total:', 'easy-digital-downloads' ); ?></strong>
			<span class="edd_cart_amount" data-subtotal="<?php echo edd_get_cart_subtotal(); ?>" data-total="<?php echo $data_total; ?>"><?php echo $total; ?></span>
		</p>
		<?php
		}

}

function edd_stripe() {

	if( ! function_exists( 'EDD' ) ) {
		return;
	}

	return EDD_Stripe::instance();
}
add_action( 'plugins_loaded', 'edd_stripe', 10 );

/**
 * Plugin activation
 *
 * @since       2.5.7
 * @return      void
 */
function edds_plugin_activation() {
	global $edd_options;

	/*
	 * Migrate settings from old 3rd party gateway
	 *
	 * See https://github.com/easydigitaldownloads/edd-stripe/issues/153
	 *
	 */

	$changed = false;
	$options = get_option( 'edd_settings', array() );

	// Set checkout button text
	if( ! empty( $options['stripe_checkout_button_label'] ) && empty( $options['stripe_checkout_button_text'] ) ) {

		$options['stripe_checkout_button_text'] = $options['stripe_checkout_button_label'];

		$changed = true;

	}

	// Set checkout logo
	if( ! empty( $options['stripe_checkout_popup_image'] ) && empty( $options['stripe_checkout_image'] ) ) {

		$options['stripe_checkout_image'] = $options['stripe_checkout_popup_image'];

		$changed = true;

	}

	// Set billing address requirement
	if( ! empty( $options['require_billing_address'] ) && empty( $options['stripe_checkout_billing'] ) ) {

		$options['stripe_checkout_billing'] = 1;

		$changed = true;

	}


	if( $changed ) {

		$options['stripe_checkout'] = 1;
		$options['gateways']['stripe'] = 1;

		if( isset( $options['gateway']['stripe_checkout'] ) ) {
			unset( $options['gateway']['stripe_checkout'] );
		}

		$merged_options = array_merge( $edd_options, $options );
		$edd_options    = $merged_options;
		update_option( 'edd_settings', $merged_options );

	}

	edd_update_option( 'stripe_use_existing_cards', 1 );

	if( is_plugin_active( 'edd-stripe-gateway/edd-stripe-gateway.php' ) ) {
		deactivate_plugins( 'edd-stripe-gateway/edd-stripe-gateway.php' );
	}
}
register_activation_hook( __FILE__, 'edds_plugin_activation' );

/** Backwards compatibility functions */
/**
 * Database Upgrade actions
 *
 * @access      public
 * @since       2.5.8
 * @return      void
 */
function edds_plugin_database_upgrades() {
	edd_stripe()->database_upgrades();
}


/**
 * Internationalization
 *
 * @since       1.6.6
 * @return      void
 */
function edds_textdomain() {
	edd_stripe()->load_textdomain();
}

/**
 * Register our payment gateway
 *
 * @since       1.0
 * @return      array
 */
function edds_register_gateway( $gateways ) {
	return edd_stripe()->register_gateway( $gateways );
}