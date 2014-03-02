<?php

namespace Lumiart\Glob;


class Options {

	public function __construct()
	{

		/**
		 * Register CPT
		 */
		add_action( 'init', array( $this, 'register_cpt' ) );

	}

	public function register_cpt()
	{
		register_post_type('options', array(
			'labels' => array(
				'name' => 'Nastavení šablony',
				'singular_name' => 'Nastavení',
				'all_items' => 'Všechna nastavení',
				'add_new' => 'Přidat',
				'add_new_item' => 'Přidat nastavení',
				'edit_item' => 'Upravit nastavení',
				'new_item' => 'Nové nastavení',
				'view_item' => 'Ukázat nastavení',
				'search_items' => 'Hledat nastavení',
				'not_found' => 'Nastavení nenalezeno',
				'not_found_in_trash' => 'Nastavení nenalezeno ani v koši',
				'parent_item_colon' => 'Nadřazené nastavení'
			),
			'show_ui' => true,
			'supports' => array( 'title', 'revisions', 'page-attributes' ),
			'query_var' => false,
			'show_in_menu' => true
		));
	}

}

$lumi_global_options = new Options();