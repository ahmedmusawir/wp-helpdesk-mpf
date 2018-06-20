<?php

WP METABOX TEXTAREA CODE 

/**
* Custom Metabox TextArea Class
*/
class MPFAddCustomMetaboxTextArea
{
	
	function __construct()
	{
		add_action( 'add_meta_boxes', array( $this, 'addMetaboxTextArea' ) );
		add_action( 'save_post', array( $this, 'saveMetaboxTextArea' ) );
	}

	public function addMetaboxTextArea() {
		/**
		 *
		 * $id,
		   $title,
		   $callback,
		   $screen -> post type, comment etc.,
		   $context -> normal, side and advanced, 
		   $priority -> default, high, low,
		   $callback_args 
		 *
		 */
		
		add_meta_box( 
			'mpf_textarea_metabox', 
			'MPF Textarea Metabox', 
			array( $this, 'textareaDisplayMPF' ), 
			'post', 
			'normal', 
			'high', 
			null 
		);
	}

	public function textareaDisplayMPF( $post ) {

		$value = get_post_meta( $post->ID, '_mpf_textarea_meta_key', true );

		wp_nonce_field( basename( __FILE__ ), 'mpf_textarea_meta_box_nonce' );

	?>

 		<textarea class="widefat" name="mpf_textarea_metabox"><?php echo $value; ?></textarea>

	<?php
	}

	public function saveMetaboxTextArea( $post_id )	{

		$is_autosave = wp_is_post_autosave( $post_id );
		$is_revision = wp_is_post_revision( $post_id );

		$is_valid_nonce = false;

		if ( isset( $_POST[ 'mpf_textarea_meta_box_nonce' ] ) ) {

			if ( wp_verify_nonce( $_POST[ 'mpf_textarea_meta_box_nonce' ], basename( __FILE__ ) ) ) {

				$is_valid_nonce = true;

			}

		}

		if ( $is_autosave || $is_revision || !$is_valid_nonce ) return;
		

		if ( array_key_exists( 'mpf_textarea_metabox', $_POST ) ) {		
			/**
			 *
			 * update post meta 
				
				$post_id,
				$meta_key,
				$meta_value,
				$previous_value (optional)
			 *
			 */
			$textarea_content = sanitize_text_field( $_POST[ 'mpf_textarea_metabox' ] );

			update_post_meta( 
				$post_id, 											 // Post ID
				'_mpf_textarea_meta_key', 							 // Meta key			
				$textarea_content									// Meta value 
			);
		}
	}	
}
