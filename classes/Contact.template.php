<?php
/**
 * Handling of Contact page
 *
 * used in Contact page template
 */

namespace Lumiart\Template;


class ContactFrontend {

	private $form_cpt_id;

	public function __construct() {

		/*
		 * Enqueue styles
		 */
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
			wpcf7_enqueue_scripts();
			//wpcf7_enqueue_styles();
		}

		/*
		 * Add custom class to form
		 */
		add_filter('wpcf7_form_class_attr', array( $this, 'add_class_to_form' ) );

		/*
		 * Generate form fields
		 */
		add_filter( 'wpcf7_form_elements', array( $this, 'generate_fields' ) );

		/*
		 * Set form cpt id
		 */
		$cpt_obj = get_field( 'which_form', get_the_ID() );
		$this->form_cpt_id = $cpt_obj->ID;

	}

	public function enqueue_scripts() {
		wp_enqueue_style( 'kontakt' );
		wp_enqueue_script( 'kontakt' );

	}

	public function add_class_to_form( $input ) {
		return $input . ' contact_form';
	}

	public function generate_fields() {
		ob_start();
			require get_template_directory() . DIRECTORY_SEPARATOR . 'template_contact_fields.php';
		$output = ob_get_clean();
		return $output;
	}

	public function output_form() {
		$wpcf_obj = get_field('which_form_template', $this->form_cpt_id);
		echo do_shortcode( '[contact-form-7 id="' . $wpcf_obj->ID . '"]' );
	}

	public function get_current_form_id() {
		return $this->form_cpt_id;
	}

}

/*
 * Singleton init and public funcs
 */
global $lumi_template_contact;
$lumi_template_contact = new ContactFrontend;

function return_Contact() {
	global $lumi_template_contact;
	return $lumi_template_contact;
}
