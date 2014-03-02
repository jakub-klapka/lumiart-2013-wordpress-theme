<?php

namespace Lumiart\Glob;


class Portfolio {

	public function __construct()
	{

		/**
		 * register CPTs
		 */
		add_action( 'init', array( $this, 'register_cpts' ) );

		/**
		 * Add json endpoint
		 */
		add_action( 'init', array( $this, 'add_json_endpoint' ) );

	}

	/**
	 * Register cpt
	 */
	public function register_cpts() {
		register_post_type( 'portfolio', array(
			'labels' => array(
				'name' => 'Portfolio',
				'all_items' => 'Všechny položky',
				'add_new' => 'Přidat',
				'add_new_item' => 'Přidat portfolio',
				'edit_item' => 'Upravit položku',
				'new_item' => 'Nové portfolio',
				'view_item' => 'Zobrazit portfolio',
				'search_items' => 'Hledat',
				'not_found' => 'Portfolio nenalezeno',
				'not_found_in_trash' => 'Portfolio nenalezeno ani v koši',
				'parent_item_colon' => 'Nadřazené portfolio'
			),
			'public' => true,
			'rewrite' => array(
				'slug' => _x( 'portfolio', 'URL slug', 'WPML theme' ),
				'feeds' => false,
				'pages' => false
			),
			'supports' => array( 'title', 'editor', 'revisions', 'page-attributes' )
		) );

		register_post_type( 'projects', array(
			'labels' => array(
				'name' => 'Projekty',
				'all_items' => 'Všechny položky',
				'add_new' => 'Přidat',
				'add_new_item' => 'Přidat projekt',
				'edit_item' => 'Upravit položku',
				'new_item' => 'Nový projekt',
				'view_item' => 'Zobrazit projekt',
				'search_items' => 'Hledat',
				'not_found' => 'Projekt nenalezen',
				'not_found_in_trash' => 'Projekt nenalezen ani v koši',
				'parent_item_colon' => 'Nadřazený projekt'
			),
			'public' => true,
			'supports' => array( 'title', 'editor', 'revisions', 'page-attributes' ),
			'rewrite' => array(
				'slug' => _x( 'projekty', 'URL slug', 'WPML theme' ),
				'feeds' => false,
				'pages' => false
			)
		) );


	}

	/**
	 * Add endpoint only for portfolio and projects /json/ to handle and cache jsons
	 */
	public function add_json_endpoint()
	{
		add_rewrite_endpoint( 'json', EP_PERMALINK );
	}


}

$lumi_global_portfolio = new Portfolio();