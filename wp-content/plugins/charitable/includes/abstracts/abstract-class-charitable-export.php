<?php
/**
 * Abstract class defining Export model.
 *
 * @package     Charitable/Classes/Charitable_Export
 * @version     1.0.0
 * @author      Eric Daams
 * @copyright   Copyright (c) 2018, Studio 164a
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'Charitable_Export' ) ) :

	/**
	 * Charitable_Export
	 *
	 * @abstract
	 * @since   1.0.0
	 */
	abstract class Charitable_Export {

		/**
		 * @var     string  The type of export.
		 */
		const EXPORT_TYPE = '';

		/**
		 * @var     string[] The CSV's columns.
		 */
		protected $columns;

		/**
		 * @var     mixed[] Optional array of arguments.
		 */
		protected $args;

		/**
		 * @var     mixed[] Array of default arguments.
		 */
		protected $defaults = array();

		/**
		 * Create class object.
		 *
		 * @since   1.0.0
		 *
		 * @param   mixed[] $args
		 */
		public function __construct( $args = array() ) {
			$this->columns = $this->get_csv_columns();
			$this->args    = wp_parse_args( $args, $this->defaults );

			$this->export();
		}

		/**
		 * Returns whether the current user can export data.
		 *
		 * @since   1.0.0
		 *
		 * @return  boolean
		 */
		public function can_export() {
			return (bool) apply_filters( 'charitable_export_capability', current_user_can( 'export_charitable_reports' ), $this );
		}

		/**
		 * Export the CSV file.
		 *
		 * @since   1.0.0
		 *
		 * @return  void
		 */
		protected function export() {
			$data = array_map( array( $this, 'map_data' ), $this->get_data() );

			$this->print_headers();

			/* Create a file pointer connected to the output stream */
			$output = fopen( 'php://output', 'w' );

			/* Print first row headers. */
			fputcsv( $output, array_values( $this->columns ) );

			/* Print the data */
			foreach ( $data as $row ) {
				fputcsv( $output, $row );
			}

			fclose( $output );

			exit();
		}

		/**
		 * Receives a row of data and maps it to the keys defined in the columns.
		 *
		 * @since   1.0.0
		 *
		 * @param   object|array $data
		 * @return  mixed
		 */
		protected function map_data( $data ) {
			/* Cast the data to array */
			if ( ! is_array( $data ) ) {
				$data = (array) $data;
			}

			$row = array();

			foreach ( $this->columns as $key => $label ) {
				$value = isset( $data[ $key ] ) ? $data[ $key ] : '';
				$value = apply_filters( 'charitable_export_data_key_value', $value, $key, $data );
				$row[] = $value;
			}

			return $row;
		}

		/**
		 * Print the CSV document headers.
		 *
		 * @since   1.0.0
		 *
		 * @return  void
		 */
		protected function print_headers() {
			ignore_user_abort( true );

			if ( ! charitable_is_func_disabled( 'set_time_limit' ) && ! ini_get( 'safe_mode' ) ) {
				set_time_limit( 0 );
			}

			/* Check for PHP 5.3+ */
			if ( function_exists( 'get_called_class' ) ) {
				$class  = get_called_class();
				$export = $class::EXPORT_TYPE;
			} else {
				$export = '';
			}

			nocache_headers();
			header( 'Content-Type: text/csv; charset=utf-8' );
			header( 'Content-Disposition: attachment; filename=charitable-export-' . $export . '-' . date( 'm-d-Y' ) . '.csv' );
			header( 'Expires: 0' );
		}

		/**
		 * Get merged fields.
		 *
		 * @since  1.6.0
		 *
		 * @param  array $default_columns   The default set of columns to include in the export.
		 * @param  array $fields            A set of fields retrieved from the Campaigns/Donations Fields API.
		 * @param  array $non_field_columns Extra fields not include in the Fields API.
		 * @param  array $filtered          The default columns after they have been passed through a filter.
		 * @return array
		 */
		protected function get_merged_fields( $default_columns, $fields, $non_field_columns, $filtered ) {
			/* Get all fields that were removed either by the filter or the Fields API. */
			$removed = array_merge(
				array_diff_key( $default_columns, $fields, $non_field_columns ), /* Fields API */
				array_diff_key( $default_columns, $filtered ) /* Filter */
			);

			/* Get all fields that were added either by the filter or the Fields API. */
			$added = array_merge(
				array_diff_key( $fields, $default_columns ), /* Fields API */
				array_diff_key( $filtered, $default_columns ) /* Filter */
			);

			/* Get all of the default columns that were not removed. */
			$columns = array_diff_key( $default_columns, $removed );

			/* Finally, merge with all added columns and return. */
			return array_merge( $columns, $added );
		}

		/**
		 * Return the CSV column headers.
		 *
		 * The columns are set as a key=>label array, where the key is used to retrieve the data for that column.
		 *
		 * @since   1.0.0
		 *
		 * @return  string[]
		 */
		abstract protected function get_csv_columns();

		/**
		 * Get the data to be exported.
		 *
		 * @since   1.0.0
		 *
		 * @return  array
		 */
		abstract protected function get_data();
	}

endif;
