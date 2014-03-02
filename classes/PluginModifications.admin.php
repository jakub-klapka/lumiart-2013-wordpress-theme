<?php

namespace Lumiart\Admin;


class PluginModifications {

	public function __construct()
	{

		/**
		 * WP SEO metabox lower prio
		 */
		add_filter( 'wpseo_metabox_prio', create_function(false, 'return "low";') );

		/*------------------------------*/
		/* ADD CUSTOM POST TYPES TO 'AT A GLANCE' WIDGET
		/*------------------------------*/
		add_action('dashboard_glance_items', array( $this, 'add_custom_post_counts' ) );

		add_action('admin_head', array( $this, 'my_custom_fonts' ) );

		/**
		 * Remove pages support
		 */
		add_action( 'init', array( $this, 'remove_pages_support' ) );

		/**
		 * Remove media attachement box in admin
		 */
		global $WPML_media;
		remove_action( 'icl_post_languages_options_after', array( $WPML_media, 'language_options' ) );

		/**
		 * Remove Copy content from Czech - as it dont work
		 */

		add_action( 'admin_head', array( $this, 'remove_copy_from_language_button' ) );



	}

	function add_custom_post_counts() {
		$post_types = array('portfolio', 'projects', 'flamingo_inbound'); // array of custom post types to add to 'At A Glance' widget
		foreach ($post_types as $pt) :
			$pt_info = get_post_type_object($pt); // get a specific CPT's details
			$num_posts = wp_count_posts($pt); // retrieve number of posts associated with this CPT
			$num = number_format_i18n($num_posts->publish); // number of published posts for this CPT
			$text = _n( $pt_info->labels->singular_name, $pt_info->labels->name, intval($num_posts->publish) ); // singular/plural text label for CPT
			echo '<li class="page-count '.$pt_info->name.'-count"><a href="edit.php?post_type='.$pt.'">'.$num.' '.$text.'</a></li>';
		endforeach;
	}

	function my_custom_fonts() {
		echo '<style>
			.page-count.portfolio-count a:before {content:\'\f232\' !important;}
			.page-count.projects-count a:before {content:\'\f180\' !important;}
			.page-count.flamingo_inbound-count a:before {content:\'\f125\' !important;}
			</style>';
	}

	public function remove_pages_support() {
		remove_post_type_support( 'page', 'author' );
		remove_post_type_support( 'page', 'thumbnail' );
		remove_post_type_support( 'page', 'custom-fields' );
		remove_post_type_support( 'page', 'comments' );

		remove_post_type_support( 'attachment', 'comments' );
		remove_post_type_support( 'attachment', 'author' );
	}

	function remove_copy_from_language_button() {
		global $sitepress;
		remove_action('icl_post_languages_options_after', array($sitepress, 'copy_from_original'));
	}

}

$lumi_plugin_modifications_admin = new PluginModifications();



