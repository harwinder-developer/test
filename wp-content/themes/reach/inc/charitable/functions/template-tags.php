<?php
/**
 * Custom template tags used when crowdfunding is enabled.
 *
 * @package     Reach
 * @category    Functions
 */

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

if ( ! function_exists( 'reach_crowdfunding_campaign_nav' ) ) :

	/**
	 * The callback function for the campaigns navigation
	 *
	 * @param   bool $echo
	 * @return  string
	 * @since   1.0.2
	 */
	function reach_crowdfunding_campaign_nav( $echo = true ) {
		$categories = get_categories( array(
			'taxonomy' => 'campaign_category',
			'orderby'  => 'name',
			'order'    => 'ASC',
		) );

		if ( empty( $categories ) ) {
			return;
		}

		$html = sprintf( '<ul class="menu menu-site"><li class="campaign_category with-icon" data-icon="&#xf02c;">%s', __( 'Categories', 'reach' ) );
		$html .= sprintf( '<ul><li><a href="%s">%s</a></li>', get_post_type_archive_link( 'campaign' ), __( 'All', 'reach' ) );

		foreach ( $categories as $category ) {
			$html .= sprintf( '<li><a href="%s">%s</a></li>', esc_url( get_term_link( $category ) ), $category->name );
		}

		$html .= '</li></ul>';

		if ( false === $echo ) {
			return $html;
		}

		echo $html;
	}

endif;

if ( ! function_exists( 'reach_campaign_ended_text' ) ) :

	/**
	 * Return the text to display when a campaign has finished.
	 *
	 * @return  string
	 * @since   1.0.0
	 */
	function reach_campaign_ended_text() {
		return __( '<span>Campaign</span> has ended', 'reach' );
	}

endif;

if ( ! function_exists( 'reach_template_campaign_loop_stats' ) ) :

	/**
	 * Display the campaign stats inside the campaign.
	 *
	 * @uses 	charitable_template
	 *
	 * @param   Charitable_Campaign $campaign
	 * @return  void
	 * @since   1.0.0
	 */
	function reach_template_campaign_loop_stats( Charitable_Campaign $campaign ) {
		charitable_template( 'campaign-loop/stats.php', array( 'campaign' => $campaign ) );
	}

endif;

if ( ! function_exists( 'reach_template_campaign_loop_creator' ) ) :

	/**
	 * Display the campaign stats inside the campaign.
	 *
	 * @uses 	charitable_template
	 *
	 * @param   Charitable_Campaign $campaign
	 * @return  void
	 * @since   1.0.0
	 */
	function reach_template_campaign_loop_creator( Charitable_Campaign $campaign ) {
		charitable_template( 'campaign-loop/creator.php', array( 'campaign' => $campaign ) );
	}

endif;

if ( ! function_exists( 'reach_template_campaign_summary' ) ) :

	/**
	 * Display the campaign summary block.
	 *
	 * @uses 	charitable_template
	 *
	 * @param   Charitable_Campaign $campaign
	 * @return  void
	 * @since   1.0.0
	 */
	function reach_template_campaign_summary( Charitable_Campaign $campaign ) {
		charitable_template( 'campaign/summary.php', array( 'campaign' => $campaign ) );
	}

endif;

if ( ! function_exists( 'reach_template_campaign_title' ) ) :

	/**
	 * Display the campaign title.
	 *
	 * @uses 	charitable_template
	 *
	 * @param   Charitable_Campaign $campaign
	 * @return  void
	 * @since   1.0.0
	 */
	function reach_template_campaign_title( Charitable_Campaign $campaign ) {
		charitable_template( 'campaign/title.php', array( 'campaign' => $campaign ) );
	}

endif;

if ( ! function_exists( 'reach_template_campaign_featured_image' ) ) :

	/**
	 * Display the campaign featured image.
	 *
	 * @uses 	charitable_template
	 *
	 * @param   Charitable_Campaign $campaign
	 * @param   string $context
	 * @return  void
	 * @since   1.0.0
	 */
	function reach_template_campaign_featured_image( Charitable_Campaign $campaign, $context = 'summary' ) {
		charitable_template( 'campaign/featured-image.php', array( 'campaign' => $campaign, 'context' => $context ) );
	}

endif;

if ( ! function_exists( 'reach_template_campaign_progress_barometer' ) ) :

	/**
	 * Display the campaign progress barometer.
	 *
	 * @uses 	charitable_template
	 *
	 * @param   Charitable_Campaign $campaign
	 * @return  void
	 * @since   1.0.0
	 */
	function reach_template_campaign_progress_barometer( Charitable_Campaign $campaign ) {
		if ( $campaign->has_goal() ) {
			charitable_template( 'campaign/progress-barometer.php', array( 'campaign' => $campaign ) );
		}
	}

endif;

if ( ! function_exists( 'reach_template_campaign_stats' ) ) :

	/**
	 * Display the campaign stats.
	 *
	 * @uses 	charitable_template
	 *
	 * @param   Charitable_Campaign $campaign
	 * @return  void
	 * @since   1.0.0
	 */
	function reach_template_campaign_stats( Charitable_Campaign $campaign ) {
		charitable_template( 'campaign/stats.php', array( 'campaign' => $campaign ) );
	}

endif;

if ( ! function_exists( 'reach_template_campaign_share' ) ) :

	/**
	 * Display the campaign sharing icons.
	 *
	 * @uses 	charitable_template
	 *
	 * @param   Charitable_Campaign $campaign
	 * @return  void
	 * @since   1.0.0
	 */
	function reach_template_campaign_share( Charitable_Campaign $campaign ) {
		charitable_template( 'campaign/share.php', array( 'campaign' => $campaign ) );
	}

endif;

if ( ! function_exists( 'reach_template_campaign_after_content_widget_area' ) ) :

	/**
	 * Add a widget-ready area below the campaign content.
	 *
	 * @return  void
	 * @since   1.0.0
	 */
	function reach_template_campaign_after_content_widget_area() {
		get_sidebar( 'campaign-after' );
	}

endif;

if ( ! function_exists( 'reach_template_campaign_comments' ) ) :

	/**
	 * Add the campaign comments below the content.
	 *
	 * @return  void
	 * @since   1.0.0
	 */
	function reach_template_campaign_comments() {
		comments_template( '/comments-campaign.php', true );
	}

endif;

if ( ! function_exists( 'reach_template_campaign_media_before_summary' ) ) :

	/**
	 * Add the media element to display before the campaign summary.
	 *
	 * @param   Charitable_Campaign $campaign
	 * @return  void
	 * @since   1.0.0
	 */
	function reach_template_campaign_media_before_summary( Charitable_Campaign $campaign ) {
		$media = reach_get_theme()->get_theme_setting( 'campaign_media_placement', 'featured_image_in_summary' );

		if ( 'video_in_summary' == $media && function_exists( 'charitable_videos_template_campaign_video' ) ) {
			charitable_videos_template_campaign_video( $campaign );
		} else {
			reach_template_campaign_featured_image( $campaign, 'summary' );
		}
	}

endif;

if ( ! function_exists( 'reach_template_campaign_media_before_content' ) ) :

	/**
	 * Add the media element to display before the campaign summary.
	 *
	 * @param   Charitable_Campaign $campaign
	 * @return  void
	 * @since   1.0.0
	 */
	function reach_template_campaign_media_before_content( Charitable_Campaign $campaign ) {
		$media = reach_get_theme()->get_theme_setting( 'campaign_media_placement', 'featured_image_in_summary' );

		if ( 'video_in_summary' == $media ) {
			reach_template_campaign_featured_image( $campaign, 'content' );
		} elseif ( function_exists( 'charitable_videos_template_campaign_video' ) ) {
			charitable_videos_template_campaign_video( $campaign );
		}
	}

endif;
