<?php

/**
* Register our settings section
*
* @return array
*/
function edds_settings_section( $sections ) {
	$sections['edd-stripe'] = __( 'Stripe', 'edds' );

	return $sections;
}
add_filter( 'edd_settings_sections_gateways', 'edds_settings_section' );

/**
 * Register the gateway settings
 *
 * @access      public
 * @since       1.0
 * @return      array
 */

function edds_add_settings( $settings ) {

	$stripe_settings = array(
		array(
			'id'   => 'stripe_connect_settings',
			'name'  => '<strong>' . __( 'Stripe Connect Settings', 'edds' ) . '</strong>',
			'desc'  => __( 'Configure the Stripe connect settings', 'edds' ),
			'type'  => 'header'
		),
		array(
			'id'    => 'stripe_connect_description',
			'type'  => 'descriptive_text',
			'name'  => __( 'Redirects & Webhook', 'edds' ),
			'desc'  =>
				'<p>' . sprintf( __( 'In order for Stripe connect to function completely, you must <a href="%s" target="_blank">register application</a> and set redirect.', 'edds' ), 'https://dashboard.stripe.com/account/applications/settings' ) . '</p>' .
				'<p><strong>' . sprintf( __( '- %s', 'edds' ), home_url( 'index.php?connect-listener=payout-account' ) ) . '</strong></p>' .
				'<p>' . sprintf( __( 'and add this to your Stripe webhooks on your <a href="%s" target="_blank">dashboard</a>', 'edds' ), 'https://dashboard.stripe.com/account/webhooks' ) . '</p>' .
				'<p><strong>' . sprintf( __( '- %s', 'edds' ), home_url( 'index.php?connect-listener=webhook' ) ) . '</strong></p>'
		),
		array(
			'id'   => 'test_client_id',
			'name'  => __( 'Test Client ID', 'edds' ),
			'desc'  => __( 'Enter your test / development client id, found in your Stripe Account Settings', 'edds' ),
			'type'  => 'text',
			'size'  => 'regular'
		),
		array(
			'id'   => 'live_client_id',
			'name'  => __( 'Live Client ID', 'edds' ),
			'desc'  => __( 'Enter your live Client ID, found in your Stripe Account Settings', 'edds' ),
			'type'  => 'text',
			'size'  => 'regular'
		),
		array(
			'id'   => 'donor_covers_fee',
			'name'  => __( 'Donor Covers Fee', 'edds' ),
			'desc'  => __( 'Enable donor covers fee at checkout', 'edds' ),
			'type'  => 'checkbox',
			'size'  => 'regular'
		),
		array(
			'id'   => 'payout_stripe_account',
			'name'  => __( 'Stripe Account for Payout', 'edds' ),
			'desc'  => __( 'Platform stripe account for payout', 'edds' ),
			'type'  => 'authorize_button',
		),
 		array(
 			'id'   => 'purchase_summary_prefix',
 			'name' => __( 'Prefix on Payment', 'edds' ),
 			'desc' => __( 'Prefix for purchase summary {prefix}- Campaign Name', 'edds' ),
 			'type' => 'text',
 		),


		array(
			'id'   => 'stripe_settings',
			'name'  => '<strong>' . __( 'Stripe Settings', 'edds' ) . '</strong>',
			'desc'  => __( 'Configure the Stripe settings', 'edds' ),
			'type'  => 'header'
		),
		array(
			'id'   => 'test_secret_key',
			'name'  => __( 'Test Secret Key', 'edds' ),
			'desc'  => __( 'Enter your test secret key, found in your Stripe Account Settings', 'edds' ),
			'type'  => 'text',
			'size'  => 'regular'
		),
		array(
			'id'   => 'test_publishable_key',
			'name'  => __( 'Test Publishable Key', 'edds' ),
			'desc'  => __( 'Enter your test publishable key, found in your Stripe Account Settings', 'edds' ),
			'type'  => 'text',
			'size'  => 'regular'
		),
		array(
			'id'   => 'live_secret_key',
			'name'  => __( 'Live Secret Key', 'edds' ),
			'desc'  => __( 'Enter your live secret key, found in your Stripe Account Settings', 'edds' ),
			'type'  => 'text',
			'size'  => 'regular'
		),
		array(
			'id'   => 'live_publishable_key',
			'name'  => __( 'Live Publishable Key', 'edds' ),
			'desc'  => __( 'Enter your live publishable key, found in your Stripe Account Settings', 'edds' ),
			'type'  => 'text',
			'size'  => 'regular'
		),
		array(
			'id'    => 'stripe_webhook_description',
			'type'  => 'descriptive_text',
			'name'  => __( 'Webhooks', 'edds' ),
			'desc'  =>
				'<p>' . sprintf( __( 'In order for Stripe to function completely, you must configure your Stripe webhooks. Visit your <a href="%s" target="_blank">account dashboard</a> to configure them. Please add a webhook endpoint for the URL below.', 'edds' ), 'https://dashboard.stripe.com/account/webhooks' ) . '</p>' .
				'<p><strong>' . sprintf( __( 'Webhook URL: %s', 'edds' ), home_url( 'index.php?edd-listener=stripe' ) ) . '</strong></p>' .
				'<p>' . sprintf( __( 'See our <a href="%s">documentation</a> for more information.', 'edds' ), 'http://docs.easydigitaldownloads.com/article/405-setup-documentation-for-stripe-payment-gateway' ) . '</p>'
		),
		array(
			'id'    => 'stripe_billing_fields',
			'name'  => __( 'Billing Address Display', 'edds' ),
			'desc'  => __( 'Select how you would like to display the billing address fields on the checkout form. <p><strong>Notes</strong>:</p><p>If taxes are enabled, this option cannot be changed from "Full address".</p><p>This setting does <em>not</em> apply to Stripe Checkout options below.</p><p>If set to "No address fields", you <strong>must</strong> disable "zip code verification" in your Stripe account.</p>', 'edds' ),
			'type'  => 'select',
			'options' => array(
				'full'        => __( 'Full address', 'edds' ),
				'zip_country' => __( 'Zip / Postal Code and Country only', 'edds' ),
				'none'        => __( 'No address fields', 'edds' )
			),
			'std'   => 'full'
		),
 		array(
			'id'   => 'stripe_use_existing_cards',
			'name'  => __( 'Show previously used cards?', 'edds' ),
			'desc'  => __( 'When enabled, provides logged in customers with a list of previously used payment methods, for faster checkout.', 'edds' ),
			'type'  => 'checkbox'
		),
 		array(
 			'id'   => 'stripe_statement_descriptor',
 			'name' => __( 'Statement Descriptor', 'edds' ),
 			'desc' => __( 'Choose how charges will appear on customer\'s credit card statements. <em>Max 22 characters</em>', 'edds' ),
 			'type' => 'text',
 		),
		array(
			'id'   => 'stripe_preapprove_only',
			'name'  => __( 'Preapprove Only?', 'edds' ),
			'desc'  => __( 'Check this if you would like to preapprove payments but not charge until a later date.', 'edds' ),
			'type'  => 'checkbox',
			'tooltip_title' => __( 'What does checking preapprove do?', 'edds' ),
			'tooltip_desc'  => __( 'If you choose this option, Stripe will not charge the customer right away after checkout, and the payment status will be set to preapproved in Easy Digital Downloads. You (as the admin) can then manually change the status to Complete by going to Payment History and changing the status of the payment to Complete. Once you change it to Complete, the customer will be charged. Note that most typical stores will not need this option.', 'edds' ),
		),
		array(
			'id'    => 'stripe_checkout_settings',
			'name'  => __( 'Stripe Checkout Options', 'edds' ),
			'type'  => 'header'
		),
		array(
			'id'    => 'stripe_checkout',
			'name'  => __( 'Enable Stripe Checkout', 'edds' ),
			'desc'  => __( 'Check this if you would like to enable the <a target="_blank" href="https://stripe.com/checkout">Stripe Checkout</a> modal window on the main checkout screen.', 'edds' ),
			'type'  => 'checkbox'
		),
		array(
			'id'    => 'stripe_checkout_button_text',
			'name'  => __( 'Complete Purchase Text', 'edds' ),
			'desc'  => __( 'Enter the text shown on the checkout\'s submit button. This is the button that opens the Stripe Checkout modal window.', 'edds' ),
			'type'  => 'text',
			'std'   => __( 'Next', 'edds' )
		),
		array(
			'id'    => 'stripe_checkout_image',
			'name'  => __( 'Checkout Logo', 'edds' ),
			'desc'  => __( 'Upload an image to be shown on the Stripe Checkout modal window. Recommended minimum size is 128x128px. Leave blank to disable the image.', 'edds' ),
			'type'  => 'upload'
		),
		array(
			'id'    => 'stripe_checkout_billing',
			'name'  => __( 'Enable Billing Address', 'edds' ),
			'desc'  => __( 'Check this box to instruct Stripe to collect a billing address in the Checkout modal window.', 'edds' ),
			'type'  => 'checkbox',
			'std'   => 0,
		),
		array(
			'id'    => 'stripe_checkout_zip_code',
			'name'  => __( 'Enable Zip / Postal Code', 'edds' ),
			'desc'  => __( 'Check this box to instruct Stripe to collect a zip / postal code in the Checkout modal window.', 'edds' ),
			'type'  => 'checkbox',
			'std'   => 0,
		),
		array(
			'id'    => 'stripe_checkout_remember',
			'name'  => __( 'Enable Remember Me', 'edds' ),
			'desc'  => __( 'Check this box to enable the Remember Me option in the Stripe Checkout modal window.', 'edds' ),
			'type'  => 'checkbox',
			'std'   => 0,
		),
	);

	if ( version_compare( EDD_VERSION, 2.5, '>=' ) ) {
		$stripe_settings = array( 'edd-stripe' => $stripe_settings );
	}

	return array_merge( $settings, $stripe_settings );
}
add_filter( 'edd_settings_gateways', 'edds_add_settings' );

/**
 * Force full billing address display when taxes are enabled
 *
 * @access      public
 * @since       2.5
 * @return      string
 */
function edd_stripe_sanitize_stripe_billing_fields_save( $value, $key ) {

	if( 'stripe_billing_fields' == $key && edd_use_taxes() ) {

		$value = 'full';

	}

	return $value;

}
add_filter( 'edd_settings_sanitize_select', 'edd_stripe_sanitize_stripe_billing_fields_save', 10, 2 );

/**
 * Filter the output of the statement descriptor option to add a max length to the text string
 *
 * @since 2.6
 * @param $html string The full html for the setting output
 * @param $args array  The original arguments passed in to output the html
 *
 * @return string
 */
function edd_stripe_max_length_statement_descriptor( $html, $args ) {
	if ( 'stripe_statement_descriptor' !== $args['id'] ) {
		return $html;
	}

	$html = str_replace( '<input type="text"', '<input type="text" maxlength="22"', $html );

	return $html;
}
add_filter( 'edd_after_setting_output', 'edd_stripe_max_length_statement_descriptor', 10, 2 );