<?php
/**
 * Display text field.
 *
 * @author      Eric Daams
 * @package     Charitable/Admin Views/Metaboxes
 * @copyright   Copyright (c) 2018, Studio 164a
 * @since       1.2.0
 */

if ( ! array_key_exists( 'form_view', $view_args ) || ! $view_args['form_view']->field_has_required_args( $view_args ) ) {
    return;
}

?>
<div id="<?php echo esc_attr( $view_args['wrapper_id'] ); ?>" class="<?php echo esc_attr( $view_args['wrapper_class'] ); ?>">
	<?php if ( isset( $view_args['label'] ) ) : ?>
        <label for="<?php echo esc_attr( $view_args['id'] ); ?>"><?php echo esc_html( $view_args['label'] ); ?></label>
    <?php endif ?>
	<textarea id="<?php echo esc_attr( $view_args['id'] ); ?>" name="<?php echo esc_attr( $view_args['key'] ); ?>" tabindex="<?php echo esc_attr( $view_args['tabindex'] ); ?>"><?php echo esc_textarea( $view_args['value'] ); ?></textarea>
	<?php if ( isset( $view_args['description'] ) ) : ?>
		<span class="charitable-helper"><?php echo esc_html( $view_args['description'] ); ?></span>
	<?php endif ?>
</div><!-- #<?php echo $view_args['wrapper_id']; ?> -->
