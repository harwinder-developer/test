<?php
/**
 * Display select field.
 *
 * @author      Eric Daams
 * @package     Charitable/Admin Views/Metaboxes
 * @copyright   Copyright (c) 2018, Studio 164a
 * @since       1.4.6
 * @version     1.5.0
 */

if ( ! array_key_exists( 'form_view', $view_args ) || ! $view_args['form_view']->field_has_required_args( $view_args ) ) {
	return;
}

?>
<div id="<?php echo esc_attr( $view_args['wrapper_id'] ); ?>" class="<?php echo esc_attr( $view_args['wrapper_class'] ); ?>">
	<?php if ( isset( $view_args['label'] ) ) : ?>
		<label for="<?php echo esc_attr( $view_args['id'] ); ?>"><?php echo esc_html( $view_args['label'] ); ?></label>
	<?php endif ?>
	<select id="<?php echo esc_attr( $view_args['id'] ); ?>" name="<?php echo esc_attr( $view_args['key'] ); ?>" tabindex="<?php echo esc_attr( $view_args['tabindex'] ); ?>" <?php echo charitable_get_arbitrary_attributes( $view_args ); ?>>
	<?php
	foreach ( $view_args['options'] as $key => $option ) :
		if ( is_array( $option ) ) :
			$label = isset( $option['label'] ) ? $option['label'] : '';
			?>
			<optgroup label="<?php echo esc_attr( $label ); ?>">
			<?php foreach ( $option['options'] as $k => $opt ) : ?>
				<option value="<?php echo esc_attr( $k ); ?>" <?php selected( $k, $view_args['value'] ); ?>><?php echo $opt ?></option>
			<?php endforeach ?>
			</optgroup>
		<?php else : ?>
			<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $key, $view_args['value'] ); ?>><?php echo $option ?></option>
		<?php
		endif;
	endforeach;
	?>
	</select>
	<?php if ( isset( $view_args['description'] ) ) : ?>
		<span class="charitable-helper"><?php echo esc_html( $view_args['description'] ); ?></span>
	<?php endif ?>
</div><!-- #<?php echo $view_args['wrapper_id']; ?> -->
