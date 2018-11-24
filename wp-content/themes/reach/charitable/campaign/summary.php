<?php
/**
 * The template for displaying the campaign summary at the top of a single campaign page.
 *
 * Override this template by copying it to your-child-theme/charitable/campaign/summary.php
 *
 * @author  Studio 164a
 * @package Reach
 * @since   1.0.0
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

/**
 * @var 	Charitable_Campaign
 */
$campaign = $view_args['campaign'];

$classes = 'campaign-summary current-campaign feature-block cf';

if ( ! reach_campaign_has_media( $campaign->ID ) ) {
	$classes .= ' no-media';
}

if ( $campaign->has_ended() ) {
	$classes .= ' campaign-ended';
}

if ( 0 < $campaign->get( 'end_date' ) ) {
	$classes .= ' campaign-has-countdown';
}

if ( $campaign->has_goal() ) {
	$classes .= ' campaign-has-goal';
}

?>
<section class="<?php echo $classes ?>">
	<div class="shadow-wrapper">
		<div class="layout-wrapper">
			<?php
			/**
			 * @hook charitable_campaign_summary_before
			 */
			do_action( 'charitable_campaign_summary_before', $campaign );
			?>
			<div class="campaign-details cf">
				<?php
				/**
				 * @hook charitable_campaign_summary
				 */
				do_action( 'charitable_campaign_summary', $campaign );
				?>
			</div><!-- .campaign-details -->
			<?php
			/**
			 * @hook charitable_campaign_summary_after
			 */
			do_action( 'charitable_campaign_summary_after', $campaign );
			?>
		</div><!-- .layout-wrapper -->
	</div><!-- .shadow-wrapper -->
</section><!-- .campaign-summary -->
