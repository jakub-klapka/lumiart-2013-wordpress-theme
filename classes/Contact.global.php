<?php

namespace Lumiart\Glob;


class Contact {

	public function __construct() {

		/*
		 * Register CPT for form fields etc.
		 */
		add_action( 'init', array( $this, 'register_cpt' ) );

	}

	public function register_cpt() {
		$labels = array(
			'name'               => 'Nastavení formulářů',
			'singular_name'      => 'Formulář',
			'add_new'            => 'Přidat',
			'add_new_item'       => 'Přidat formulář',
			'edit_item'          => 'Upravit formulář',
			'new_item'           => 'Nový formulář',
			'all_items'          => 'Všechny formuláře',
			'view_item'          => 'Ukázat formuláře',
			'search_items'       => 'Hledat formuláře',
			'not_found'          => 'Formuláře nenalezeny',
			'not_found_in_trash' => 'Formuláře nenalezeny ani v koši',
			'parent_item_colon'  => '',
			'menu_name'          => 'Nastavení formulářů'
		);
		register_post_type( 'lumiart_forms', array(
			'labels' => $labels,
			'show_ui' => true,
			'supports' => 'title',
			'query_var' => false
		) );
	}

}

$lumi_global_contact = new Contact;