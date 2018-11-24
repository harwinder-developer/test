<?php
/**
 * Charitable Currency helper.
 *
 * @package   Charitable/Classes/Charitable_Currency 
 * @author    Eric Daams
 * @copyright Copyright (c) 2018, Studio 164a
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since     1.0.0
 * @version   1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'Charitable_Currency' ) ) :

	/**
	 * Charitable_Currency
	 *
	 * @final
	 * @since 1.0.0
	 */
	final class Charitable_Currency {

		/**
		 * The single instance of this class.
		 *
		 * @var Charitable_Currency|null
		 */
		private static $instance = null;

		/**
		 * Every currency available.
		 *
		 * @var string[]
		 */
		private $currencies = array();

		/**
		 * Create class object. A private constructor, so this is used in a singleton context.
		 *
		 * @since 1.2.3
		 */
		private function __construct() {
		}

		/**
		 * Returns and/or create the single instance of this class.
		 *
		 * @since  1.2.3
		 *
		 * @return Charitable_Currency
		 */
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Return an amount as a monetary string.
		 *
		 * 50.00 -> $50.00
		 *
		 * @since  1.0.0
		 *
		 * @param  string    $amount        The amount to convert.
		 * @param  int|false $decimal_count Optional. If not set, default decimal count will be used.
		 * @param  boolean   $db_format     Optional. Whether the amount is in db format (i.e. using decimals for cents, regardless of site settings).
		 * @return string|WP_Error
		 */
		public function get_monetary_amount( $amount, $decimal_count = false, $db_format = false ) {
			if ( false === $decimal_count ) {
				$decimal_count = charitable_get_option( 'decimal_count', 2 );
			}

			$amount = $this->sanitize_monetary_amount( strval( $amount ), $db_format );

			$amount = number_format(
				$amount,
				(int) $decimal_count,
				$this->get_decimal_separator(),
				$this->get_thousands_separator()
			);

			$formatted = sprintf( $this->get_currency_format(), $this->get_currency_symbol(), $amount );

			return apply_filters( 'charitable_monetary_amount', $formatted, $amount );
		}

		/**
		 * Receives unfiltered monetary amount and sanitizes it, returning it as a float.
		 *
		 * $50.00 -> 50.00
		 *
		 * @since  1.0.0
		 *
		 * @param  string  $amount    The amount to sanitize.
		 * @param  boolean $db_format Optional. Whether the amount is in db format (i.e. using decimals for cents, regardless of site settings).
		 * @return float|WP_Error
		 */
		public function sanitize_monetary_amount( $amount, $db_format = false ) {
			/* Sending anything other than a string can cause unexpected returns, so we require strings. */
			if ( ! is_string( $amount ) ) {

				charitable_get_deprecated()->doing_it_wrong(
					__METHOD__,
					__( 'Amount must be passed as a string.', 'charitable' ),
					'1.0.0'
				);

				return new WP_Error( 'invalid_parameter_type', 'Amount must be passed as a string.' );
			}

			/**
			 * If we're using commas for decimals, we need to turn any commas into points, and
			 * we need to replace existing points with blank spaces. Example:
			 *
			 * 12.500,50 -> 12500.50
			 */
			if ( ! $db_format && $this->is_comma_decimal() ) {
				/* Convert to 12.500_50 */
				$amount = str_replace( ',', '_', $amount );
				/* Convert to 12500_50 */
				$amount = str_replace( '.', '', $amount );
				/* Convert to 12500.50 */
				$amount = str_replace( '_', '.', $amount );
			}

			$amount = str_replace( $this->get_currency_symbol(), '', $amount );

			return floatval( filter_var( $amount, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION ) );
		}

		/**
		 * Turns a database amount into an amount formatted for the currency that the site is in.
		 *
		 * @since  1.3.0
		 *
		 * @param  string $amount The amount to be sanitized.
		 * @return string
		 */
		public function sanitize_database_amount( $amount ) {
			if ( $this->is_comma_decimal() ) {
				$amount = str_replace( '.', ',', $amount );
			}

			return $amount;
		}

		/**
		 * Force a string amount into decimal based format, regardless of the site currency.
		 *
		 * This effectively reverses the effect of Charitable_Currency::sanitize_database_amount.
		 *
		 * @since  1.6.0
		 *
		 * @param  string $amount The amount to be cast to decimal format.
		 * @return string
		 */
		public function cast_to_decimal_format( $amount ) {
			if ( $this->is_comma_decimal() ) {
				$amount = str_replace( ',', '.', $amount );
			} else {
				$amount = str_replace( ',', '', $amount );
			}

			return $amount;
		}

		/**
		 * Checks whether the comma is being used as the separator.
		 *
		 * @since  1.0.0
		 *
		 * @return boolean
		 */
		public function is_comma_decimal() {
			return ( ',' == $this->get_decimal_separator() );
		}

		/**
		 * Return the currency format based on the position of the currency symbol.
		 *
		 * @since  1.0.0
		 *
		 * @return string
		 */
		public function get_currency_format() {
			$symbol_position = charitable_get_option( 'currency_format', 'left' );

			switch ( $symbol_position ) {
				case 'left':
					$format = '%1$s%2$s';
					break;
				case 'right':
					$format = '%2$s%1$s';
					break;
				case 'left-with-space':
					$format = '%1$s&nbsp;%2$s';
					break;
				case 'right-with-space':
					$format = '%2$s&nbsp;%1$s';
					break;
				default:
					$format = apply_filters( 'charitable_currency_format', '%1$s%2$s', $symbol_position );
			}

			return $format;
		}

		/**
		 * Get the currency format for accounting.js
		 *
		 * @since  1.3.0
		 *
		 * @return string
		 */
		public function get_accounting_js_format() {
			return apply_filters( 'charitable_accounting_js_currency_format', '%s%v' );
		}

		/**
		 * Return every currency symbol used with the
		 *
		 * @since  1.0.0
		 *
		 * @return string[]
		 */
		public function get_all_currencies() {
			if ( empty( $this->currencies ) ) {
				$this->currencies = apply_filters( 'charitable_currencies', array(
					'AED'	=> sprintf( __( 'Emirati Dirham (%s)', 'charitable' ), $this->get_currency_symbol( 'AED' ) ),
					'AUD'	=> sprintf( __( 'Australian Dollars (%s)', 'charitable' ), $this->get_currency_symbol( 'AUD' ) ),
					'ARS'	=> sprintf( __( 'Argentine Peso (%s)', 'charitable' ), $this->get_currency_symbol( 'ARS' ) ),
					'BDT'	=> sprintf( __( 'Bangladeshi Taka (%s)', 'charitable' ), $this->get_currency_symbol( 'BDT' ) ),
					'BOB'   => sprintf( __( 'Bolivian Bolíviano (%s)', 'charitable' ), $this->get_currency_symbol( 'BOB' ) ),
					'BRL'	=> sprintf( __( 'Brazilian Real (%s)', 'charitable' ), $this->get_currency_symbol( 'BRL' ) ),
					'BGN'	=> sprintf( __( 'Bulgarian Lev (%s)', 'charitable' ), $this->get_currency_symbol( 'BGN' ) ),
					'CAD'	=> sprintf( __( 'Canadian Dollar (%s)', 'charitable' ), $this->get_currency_symbol( 'CAD' ) ),
					'CHF'	=> sprintf( __( 'Swiss Franc (%s)', 'charitable' ), $this->get_currency_symbol( 'CHF' ) ),
					'CLP'	=> sprintf( __( 'Chilean Peso (%s)', 'charitable' ), $this->get_currency_symbol( 'CLP' ) ),
					'CNY'	=> sprintf( __( 'Chinese Yuan Renminbi (%s)', 'charitable' ), $this->get_currency_symbol( 'CNY' ) ),
					'CZK'	=> sprintf( __( 'Czech Koruna (%s)', 'charitable' ), $this->get_currency_symbol( 'CZK' ) ),
					'DKK'	=> sprintf( __( 'Danish Krone (%s)', 'charitable' ), $this->get_currency_symbol( 'DKK' ) ),
					'EGP'   => sprintf( __( 'Egyptian Pound (%s)', 'charitable' ), $this->get_currency_symbol( 'EGP' ) ),
					'EUR'	=> sprintf( __( 'Euro (%s)', 'charitable' ), $this->get_currency_symbol( 'EUR' ) ),
					'GBP'	=> sprintf( __( 'British Pound (%s)', 'charitable' ), $this->get_currency_symbol( 'GBP' ) ),
					'GHS' 	=> sprintf( __( 'Ghanaian Cedi (%s)', 'charitable' ), $this->get_currency_symbol( 'GHS' ) ),
					'HKD'	=> sprintf( __( 'Hong Kong Dollar (%s)', 'charitable' ), $this->get_currency_symbol( 'HKD' ) ),
					'HRK'	=> sprintf( __( 'Croatian Kuna (%s)', 'charitable' ), $this->get_currency_symbol( 'HRK' ) ),
					'HUF'	=> sprintf( __( 'Hungarian Forint (%s)', 'charitable' ), $this->get_currency_symbol( 'HUF' ) ),
					'IDR'	=> sprintf( __( 'Indonesian Rupiah (%s)', 'charitable' ), $this->get_currency_symbol( 'IDR' ) ),
					'ILS'	=> sprintf( __( 'Israeli Shekel (%s)', 'charitable' ), $this->get_currency_symbol( 'ILS' ) ),
					'INR'	=> sprintf( __( 'Indian Rupee (%s)', 'charitable' ), $this->get_currency_symbol( 'INR' ) ),
					'ISK'	=> sprintf( __( 'Icelandic Krona (%s)', 'charitable' ), $this->get_currency_symbol( 'ISK' ) ),
					'JPY'	=> sprintf( __( 'Japanese Yen (%s)', 'charitable' ), $this->get_currency_symbol( 'JPY' ) ),
					'KRW'	=> sprintf( __( 'South Korean Won (%s)', 'charitable' ), $this->get_currency_symbol( 'KRW' ) ),
					'MXN'	=> sprintf( __( 'Mexican Peso (%s)', 'charitable' ), $this->get_currency_symbol( 'MXN' ) ),
					'MYR'	=> sprintf( __( 'Malaysian Ringgit (%s)', 'charitable' ), $this->get_currency_symbol( 'MYR' ) ),
					'NGN'	=> sprintf( __( 'Nigerian Naira (%s)', 'charitable' ), $this->get_currency_symbol( 'NGN' ) ),
					'NOK'	=> sprintf( __( 'Norwegian Krone (%s)', 'charitable' ), $this->get_currency_symbol( 'NOK' ) ),
					'NZD'	=> sprintf( __( 'New Zealand Dollar (%s)', 'charitable' ), $this->get_currency_symbol( 'NZD' ) ),
					'PHP'	=> sprintf( __( 'Philippine Peso (%s)', 'charitable' ), $this->get_currency_symbol( 'PHP' ) ),
					'PLN'	=> sprintf( __( 'Polish Zloty (%s)', 'charitable' ), $this->get_currency_symbol( 'PLN' ) ),
					'RON'	=> sprintf( __( 'Romanian New Leu (%s)', 'charitable' ), $this->get_currency_symbol( 'RON' ) ),
					'RUB'	=> sprintf( __( 'Russian Ruble (%s)', 'charitable' ), $this->get_currency_symbol( 'RUB' ) ),
					'SEK'	=> sprintf( __( 'Swedish Krona (%s)', 'charitable' ), $this->get_currency_symbol( 'SEK' ) ),
					'SGD'	=> sprintf( __( 'Singapore Dollar (%s)', 'charitable' ), $this->get_currency_symbol( 'SGD' ) ),
					'THB'	=> sprintf( __( 'Thai Baht (%s)', 'charitable' ), $this->get_currency_symbol( 'THB' ) ),
					'TRY'	=> sprintf( __( 'Turkish Lira (%s)', 'charitable' ), $this->get_currency_symbol( 'TRY' ) ),
					'TWD'	=> sprintf( __( 'Taiwan New Dollar (%s)', 'charitable' ), $this->get_currency_symbol( 'TWD' ) ),
					'USD'	=> sprintf( __( 'US Dollar (%s)', 'charitable' ), $this->get_currency_symbol( 'USD' ) ),
					'VND'	=> sprintf( __( 'Vietnamese Dong (%s)', 'charitable' ), $this->get_currency_symbol( 'VND' ) ),
					'ZAR'	=> sprintf( __( 'South African Rand (%s)', 'charitable' ), $this->get_currency_symbol( 'ZAR' ) ),
				) );
			}//end if

			return $this->currencies;
		}

		/**
		 * Return the currency symbol for a given currency.
		 *
		 * This function was changed to a public method in 1.3.7.
		 *
		 * Credit: This is based on the WooCommerce implemenation.
		 *
		 * @since  1.0.0
		 *
		 * @param  string $currency Optional. If not set, currency is based on currently selected currency.
		 * @return string
		 */
		public function get_currency_symbol( $currency = '' ) {
			if ( ! strlen( $currency ) ) {
				$currency = charitable_get_option( 'currency', 'AUD' );
			}

			switch ( $currency ) {
				case 'AED':
					$currency_symbol = 'د.إ';
					break;
				case 'BDT':
					$currency_symbol = '&#2547;';
					break;
				case 'BOB':
					$currency_symbol = '&#66;&#115;&#46;';
					break;
				case 'BRL':
					$currency_symbol = '&#82;&#36;';
					break;
				case 'BGN':
					$currency_symbol = '&#1083;&#1074;.';
					break;
				case 'AUD':
				case 'ARS':
				case 'CAD':
				case 'CLP':
				case 'MXN':
				case 'NZD':
				case 'HKD':
				case 'SGD':
				case 'USD':
					$currency_symbol = '&#36;';
					break;
				case 'EGP':
					$currency_symbol = 'E&pound;';
					break;
				case 'EUR':
					$currency_symbol = '&euro;';
					break;
				case 'GHS':
					$currency_symbol = 'GH&#8373;';
					break;
				case 'CNY':
				case 'RMB':
				case 'JPY':
					$currency_symbol = '&yen;';
					break;
				case 'RUB':
					$currency_symbol = '&#1088;&#1091;&#1073;.';
					break;
				case 'KRW':
					$currency_symbol = '&#8361;';
					break;
				case 'TRY':
					$currency_symbol = '&#8378;';
					break;
				case 'NOK':
					$currency_symbol = '&#107;&#114;';
					break;
				case 'ZAR':
					$currency_symbol = '&#82;';
					break;
				case 'CZK':
					$currency_symbol = '&#75;&#269;';
					break;
				case 'MYR':
					$currency_symbol = '&#82;&#77;';
					break;
				case 'DKK':
					$currency_symbol = 'kr.';
					break;
				case 'HUF':
					$currency_symbol = '&#70;&#116;';
					break;
				case 'IDR':
					$currency_symbol = 'Rp';
					break;
				case 'INR':
					$currency_symbol = 'Rs.';
					break;
				case 'ISK':
					$currency_symbol = 'Kr.';
					break;
				case 'ILS':
					$currency_symbol = '&#8362;';
					break;
				case 'PHP':
					$currency_symbol = '&#8369;';
					break;
				case 'PLN':
					$currency_symbol = '&#122;&#322;';
					break;
				case 'SEK':
					$currency_symbol = '&#107;&#114;';
					break;
				case 'CHF':
					$currency_symbol = '&#67;&#72;&#70;';
					break;
				case 'TWD':
					$currency_symbol = '&#78;&#84;&#36;';
					break;
				case 'THB':
					$currency_symbol = '&#3647;';
					break;
				case 'GBP':
					$currency_symbol = '&pound;';
					break;
				case 'RON':
					$currency_symbol = 'lei';
					break;
				case 'VND':
					$currency_symbol = '&#8363;';
					break;
				case 'NGN':
					$currency_symbol = '&#8358;';
					break;
				case 'HRK':
					$currency_symbol = 'Kn';
					break;
				default    :
					$currency_symbol = '';
					break;
			}//end switch

			return apply_filters( 'charitable_currency_symbol', $currency_symbol, $currency );
		}

		/**
		 * Return the thousands separator.
		 *
		 * @since  1.5.0
		 *
		 * @return string
		 */
		public function get_thousands_separator() {
			$separator = charitable_get_option( 'thousands_separator', ',' );

			if ( 'none' == $separator ) {
				$separator = '';
			}

			return $separator;
		}

		/**
		 * Return the decimal separator.
		 *
		 * @since  1.5.0
		 *
		 * @return string
		 */
		public function get_decimal_separator() {
			return charitable_get_option( 'decimal_separator', '.' );
		}

		/**
		 * Return the number of decimals to use.
		 *
		 * @since  1.0.0
		 *
		 * @return int
		 */
		public function get_decimals() {
			return charitable_get_option( 'decimal_count', 2 );
		}
	}

endif;
