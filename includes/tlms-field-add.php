<?php
function tlms_register_meta_boxes() {
    add_meta_box( 'tlmsc', __( 'Tutor LMS Course Show / Hidden Field For User', 'tlms' ), 'tlms_display_callback', 'courses' );
}
add_action( 'add_meta_boxes', 'tlms_register_meta_boxes' );


function tlms_display_callback( $post ) {

	wp_nonce_field( 'tlms_meta_box', 'tlms_meta_box_nonce' );

	$value = get_post_meta( $post->ID, 'tlms_show_or_hide', true ); 

	?>
	<label for="tlms_new_field"><?php _e( "Choose value:", 'choose_value' ); ?></label>
	<br />  
	<input type="radio" name="tlms_item" value="tlms_show" <?php checked( $value, 'tlms_show' ); ?> >Show<br>
	<input type="radio" name="tlms_item" value="tlms_hidden" <?php checked( $value, 'tlms_hidden' ); ?> >Hidden<br>

	<?php
}

function tlms_save_meta_box_data( $post_id ) {

	if ( !isset( $_POST['tlms_meta_box_nonce'] ) ) {
			return;
	}

	if ( !wp_verify_nonce( $_POST['tlms_meta_box_nonce'], 'tlms_meta_box' ) ) {
			return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
	}

	if ( !current_user_can( 'edit_post', $post_id ) ) {
			return;
	}

	$new_meta_value = ( isset( $_POST['tlms_item'] ) ? sanitize_html_class( $_POST['tlms_item'] ) : '' );

	update_post_meta( $post_id, 'tlms_show_or_hide', $new_meta_value );

}

add_action( 'save_post', 'tlms_save_meta_box_data' );