<?php

namespace Lumiart\Frontend;


class Layout {

	public function __construct()
	{

		/**
		 * Register all styles and scripts
		 */
		add_action( 'wp_enqueue_scripts', array( $this, 'register_styles' ) );

		/**
		 * Translation stuff
		 */
		define('ICL_DONT_LOAD_NAVIGATION_CSS', true);
		define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true);
		define('ICL_DONT_LOAD_LANGUAGES_JS', true);
		global $sitepress;
		remove_action( 'wp_head', array($sitepress, 'meta_generator_tag' ) );



	}

	public function register_styles()
	{
		//globals
		wp_register_style( 'layout', get_bloginfo('template_url') . '/css/layout.css', array(), LUMI_CSS_VER );

		wp_deregister_script( 'jquery' );
		wp_register_script( 'modernizr', get_bloginfo('template_url') . '/js/modernizr.js' );
		wp_register_script( 'picturefill', get_bloginfo('template_url') . '/js/picturefill.min.js', array(), LUMI_CSS_VER );
		wp_register_script( 'jquery', get_bloginfo('template_url') . '/js/jquery-1.10.2.min.js', array(), LUMI_CSS_VER );
		wp_register_script( 'jquery_mobile', get_bloginfo('template_url') . '/js/jquery.mobile.custom.min.js', array( 'jquery' ), LUMI_CSS_VER );
		//wp_register_script( 'addthis', '//s7.addthis.com/js/300/addthis_widget.js' ); //will be deffered
		wp_register_script( 'layout', get_bloginfo('template_url') . '/js/layout.min.js', array( 'modernizr', 'picturefill' , 'jquery', 'jquery_mobile' ), LUMI_CSS_VER );

		//enqueue globals
		wp_enqueue_style( 'layout' );
		wp_enqueue_script( 'layout' );

		//handlebars
		wp_register_script( 'handlebars_runtime', get_bloginfo('template_url') . '/js/handlebars.runtime.min.js', array(), LUMI_CSS_VER );

		//home
		wp_register_style( 'home', get_bloginfo( 'template_url' ) . '/css/home.css', array( 'layout' ), LUMI_CSS_VER );
		wp_register_script( 'home', get_bloginfo( 'template_url' ) . '/js/home.min.js', array( 'layout' ), LUMI_CSS_VER );

		//team
		wp_register_script( 'email_decode', get_template_directory_uri() . '/js/email_decode.min.js', array( 'layout' ), LUMI_CSS_VER );
		wp_register_style( 'about_us', get_bloginfo('template_url') . '/css/team.css', array('layout'), LUMI_CSS_VER );
		wp_register_script( 'about_us', get_bloginfo( 'template_url' ) . '/js/team.min.js', array( 'layout', 'email_decode' ), LUMI_CSS_VER );

		//portfolio
		wp_register_style( 'portfolio', get_bloginfo('template_url') . '/css/portfolio.css', array( 'layout' ), LUMI_CSS_VER );
		wp_register_script( 'portfolio_hb_template', get_bloginfo('template_url') . '/js/portfolio_hb_template.min.js', array( 'handlebars_runtime' ), LUMI_CSS_VER );
		wp_register_script( 'portfolio', get_bloginfo('template_url') . '/js/portfolio.min.js', array( 'layout', 'portfolio_hb_template' ), LUMI_CSS_VER );

		//projects
		wp_register_script( 'projects_hb_template', get_bloginfo('template_url') . '/js/projects_hb_template.min.js', array( 'handlebars_runtime' ), LUMI_CSS_VER );
		wp_register_script( 'projects', get_bloginfo('template_url') . '/js/portfolio.min.js', array( 'layout', 'projects_hb_template' ), LUMI_CSS_VER );

		//kontakt
		wp_register_style( 'kontakt', get_bloginfo( 'template_url' ) . '/css/contact.css', array( 'layout' ), LUMI_CSS_VER );
		wp_register_script( 'autosize', get_bloginfo( 'template_url' ) . '/js/jquery.autosize.min.js', array( 'jquery' ), LUMI_CSS_VER );
		wp_register_script( 'kontakt', get_bloginfo( 'template_url' ) . '/js/contact.min.js', array( 'layout', 'jquery', 'autosize' ), LUMI_CSS_VER );
	}

}

$lumi_frontend_layout = new Layout();