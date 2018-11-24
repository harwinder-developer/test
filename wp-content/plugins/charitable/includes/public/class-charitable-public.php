<?php
/**
 * Charitable Public class.
 *
 * @package 	Charitable/Classes/Charitable_Public
 * @version     1.0.0
 * @author 		Eric Daams
 * @copyright 	Copyright (c) 2018, Studio 164a
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'Charitable_Public' ) ) :

	/**
	 * Charitable Public class.
	 *
	 * @final
	 * @since   1.0.0
	 */
	final class Charitable_Public {

		/**
		 * The single instance of this class.
		 *
		 * @since 1.2.0
		 *
		 * @var   Charitable_Public|null
		 */
		private static $instance = null;

		/**
		 * Returns and/or create the single instance of this class.
		 *
		 * @since  1.2.0
		 *
		 * @return Charitable_Public
		 */
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Set up the class.
		 *
		 * @since 1.0.0
		 */
		private function __construct() {
			add_action( 'after_setup_theme', array( $this, 'load_template_files' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'setup_scripts' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'maybe_enqueue_donation_form_scripts' ), 11 );
			add_action( 'charitable_campaign_loop_before', array( $this, 'maybe_enqueue_donation_form_scripts' ) );
			add_filter( 'post_class', array( $this, 'campaign_post_class' ) );
			add_filter( 'comments_open', array( $this, 'disable_comments_on_application_pages' ) );			

			do_action( 'charitable_public_start', $this );
		}

		/**
		 * Load the template functions after theme is loaded.
		 *
		 * This gives themes time to override the functions.
		 *
		 * @since  1.2.3
		 *
		 * @return void
		 */
		public function load_template_files() {
			require_once( 'charitable-template-functions.php' );
			require_once( 'charitable-template-hooks.php' );
		}

		/**
		 * Loads public facing scripts and stylesheets.
		 *
		 * @since  1.0.0
		 *
		 * @return void
		 */
		public function setup_scripts() {
			if ( ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ) {
				$suffix  = '';
				$version = '';
			} else {
				$suffix  = '.min';
				$version = charitable()->get_version();
			}

			$assets_dir = charitable()->get_path( 'assets', false );

			/* Main Charitable script. */
			$minimum    = charitable_get_minimum_donation_amount();
			$amount_msg = $minimum > 0
				? sprintf(
					/* Translators: %s: minimum donatino amount */
					__( 'You must donate at least %s.', 'charitable' ), charitable_format_money( $minimum )
				)
				: sprintf(
					/* Translators: %s: minimum donatino amount */
					__( 'You must donate more than %s.', 'charitable' ), charitable_format_money( $minimum )
				);

			/**
			 * Filter the Javascript vars array.
			 *
			 * @since 1.0.0
			 *
			 * @param array $vars The set of vars.
			 */
			$vars = apply_filters( 'charitable_javascript_vars', array(
				'ajaxurl'                      => admin_url( 'admin-ajax.php' ),
				'loading_gif'                  => $assets_dir . '/images/charitable-loading.gif',
				'currency_format_num_decimals' => esc_attr( charitable_get_currency_helper()->get_decimals() ),
				'currency_format_decimal_sep'  => esc_attr( charitable_get_currency_helper()->get_decimal_separator() ),
				'currency_format_thousand_sep' => esc_attr( charitable_get_currency_helper()->get_thousands_separator() ),
				'currency_format'              => esc_attr( charitable_get_currency_helper()->get_accounting_js_format() ), // For accounting.js.
				'minimum_donation'             => $minimum,
				'error_invalid_amount'         => $amount_msg,
				'error_required_fields'        => __( 'Please fill out all required fields.', 'charitable' ),
				'error_unknown'                => __( 'Your donation could not be processed. Please reload the page and try again.', 'charitable' ),
				'error_invalid_cc_number'      => __( 'The credit card passed is not valid.', 'charitable' ),
				'error_invalid_cc_expiry'      => __( 'The credit card expiry date is not valid.', 'charitable' ),
			) );

			/* Accounting.js */
			wp_register_script(
				'accounting',
				$assets_dir . 'js/libraries/accounting'. $suffix . '.js',
				array( 'jquery-core' ),
				$version,
				true
			);

			$deps = array( 'accounting', 'jquery-core' );

			if ( wp_script_is( 'charitable-sessions', 'enqueued' ) ) {
				array_unshift( $deps, 'charitable-sessions' );
			}

			wp_register_script(
				'charitable-script',
				$assets_dir . 'js/charitable'. $suffix . '.js',
				$deps,
				$version,
				true
			);

			wp_localize_script(
				'charitable-script',
				'CHARITABLE_VARS',
				$vars
			);

			/* Credit card validation */
			wp_register_script(
				'charitable-credit-card',
				$assets_dir . 'js/charitable-credit-card'. $suffix . '.js',
				array( 'charitable-script' ),
				$version,
				true
			);

			/* Main styles */
			wp_register_style(
				'charitable-styles',
				$assets_dir . 'css/charitable' . $suffix .'.css',
				array(),
				$version
			);

			wp_enqueue_style( 'charitable-styles' );

			/* Lean Modal is registered but NOT enqueued yet. */
			if ( 'modal' == charitable_get_option( 'donation_form_display', 'separate_page' ) ) {

				wp_register_script(
					'lean-modal',
					$assets_dir . 'js/libraries/leanModal' . $suffix . '.js',
					array( 'jquery-core' ),
					$version
				);

				wp_register_style(
					'lean-modal-css',
					$assets_dir . 'css/modal' . $suffix .'.css',
					array(),
					$version
				);

			}

			wp_register_style(
				'charitable-datepicker',
				$assets_dir . 'css/charitable-datepicker' . $suffix .'.css',
				array(),
				$version
			);

			/* pupload Fields is also registered but NOT enqueued. */
			$upload_vars = array(
				'remove_image' => _x( 'Remove', 'remove image button text', 'charitable' ),
				'max_file_uploads_single' => __( 'You can only upload %d file', 'charitable' ),
				'max_file_uploads_plural' => __( 'You can only upload a maximum of %d files', 'charitable' ),
				'max_file_size' => __( '%1$s exceeds the max upload size of %2$s', 'charitable' ),
				'upload_problem' => __( '%s failed to upload. Please try again.', 'charitable' ),
			);

			wp_register_script(
				'charitable-plup-fields',
				$assets_dir . 'js/charitable-plupload-fields' . $suffix . '.js',
				array( 'jquery-ui-sortable', 'wp-ajax-response', 'plupload-all' ),
				$version,
				true
			);

			wp_localize_script(
				'charitable-plup-fields',
				'CHARITABLE_UPLOAD_VARS',
				$upload_vars
			);

			wp_register_style(
				'charitable-plup-styles',
				$assets_dir . 'css/charitable-plupload-fields' . $suffix . '.css',
				array(),
				$version
			);
		}

		/**
		 * Conditionally load the donation form scripts if we're viewing the donation form.
		 *
		 * @since   1.4.0
		 *
		 * @return  boolean True if scripts were loaded. False otherwise.
		 */
		public function maybe_enqueue_donation_form_scripts() {
			$load = charitable_is_page( 'campaign_donation_page' );

			if ( ! $load ) {
				$load = 'charitable_campaign_loop_before' == current_action() && 'modal' == charitable_get_option( 'donation_form_display', 'separate_page' );
			}

			if ( $load ) {
				$this->enqueue_donation_form_scripts();
			}

			return $load;
		}

		/**
		 * Enqueues the donation form scripts.
		 *
		 * @since   1.4.6
		 *
		 * @return  void
		 */
		public function enqueue_donation_form_scripts() {
			wp_enqueue_script( 'charitable-script' );

			if ( Charitable_Gateways::get_instance()->any_gateway_supports( 'credit-card' ) ) {
				wp_enqueue_script( 'charitable-credit-card' );
			}
		}

		/**
		 * Adds custom post classes when viewing campaign.
		 *
		 * @since   1.0.0
		 *
		 * @param 	string[] $classes List of classes to be added with post_class().
		 * @return  string[]
		 */
		public function campaign_post_class( $classes ) {
			$campaign = charitable_get_current_campaign();

			if ( ! $campaign ) {
				return $classes;
			}

			$classes[] = $campaign->has_goal() ? 'campaign-has-goal' : 'campaign-has-no-goal';
			$classes[] = $campaign->is_endless() ? 'campaign-is-endless' : 'campaign-has-end-date';
			return $classes;
		}

		/**
		 * Disable comments on application pages like the donation page.
		 *
		 * @since   1.3.0
	 	 *
		 * @param   boolean $open Whether comments are open.
		 * @return  boolean
		 */
		public function disable_comments_on_application_pages( $open ) {
			/* If open is already false, just hit return. */
			if ( ! $open ) {
				return $open;
			}

			if ( charitable_is_page( 'campaign_donation_page', array( 'strict' => true ) )
			|| charitable_is_page( 'campaign_widget_page' )
			|| charitable_is_page( 'donation_receipt_page' )
			|| charitable_is_page( 'donation_processing_page' ) ) {
				 $open = false;
			}

			return $open;
		}
	}

endif;
