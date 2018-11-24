<?php
/**
 * Login endpoint.
 *
 * @package   Charitable/Classes/Charitable_Login_Endpoint
 * @author    Eric Daams
 * @copyright Copyright (c) 2018, Studio 164a
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since     1.5.0
 * @version   1.5.4
 */

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

if ( ! class_exists( 'Charitable_Login_Endpoint' ) ) :

	/**
	 * Charitable_Login_Endpoint
	 *
	 * @since 1.5.0
	 */
	class Charitable_Login_Endpoint extends Charitable_Endpoint {

		/* @var string */
		const ID = 'login';

		/**
		 * Object instantiation.
		 *
		 * @since 1.5.4
		 */
		public function __construct() {
			$this->cacheable = false;
		}

		/**
		 * Return the endpoint ID.
		 *
		 * @since  1.5.0
		 *
		 * @return string
		 */
		public static function get_endpoint_id() {
			return self::ID;
		}

		/**
		 * Add rewrite rules for the endpoint.
		 *
		 * @since 1.5.0
		 */
		public function setup_rewrite_rules() {}

		/**
		 * Return the endpoint URL.
		 *
		 * @since  1.5.0
		 *
		 * @global WP_Rewrite $wp_rewrite
		 * @param  array $args Mixed arguments.
		 * @return string
		 */
		public function get_page_url( $args = array() ) {
			$page = charitable_get_option( 'login_page', 'wp' );

			return 'wp' == $page ? wp_login_url() : get_permalink( $page );
		}

		/**
		 * Return whether we are currently viewing the endpoint.
		 *
		 * @since  1.5.0
		 *
		 * @global WP_Post $post
		 * @param  array $args Mixed arguments.
		 * @return boolean
		 */
		public function is_page( $args = array() ) {
			global $post, $wp_query;

			$page   = charitable_get_option( 'login_page', 'wp' );
			$strict = ! array_key_exists( 'strict', $args ) || $args['strict'];

			if ( 'wp' == $page ) {
				return $strict ? false : wp_login_url() == charitable_get_current_url();
			}

			if ( is_object( $post ) ) {
				return $page == $post->ID;
			}

			return false;
		}
	}

endif;
