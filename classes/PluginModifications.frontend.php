<?php

namespace Lumiart\Frontend;


class PluginModifications {

	public function __construct()
	{

		/**
		 * Contact form different spinner
		 */
		add_filter('wpcf7_ajax_loader', array( $this, 'change_ajax_loader_url' ) );

	}

	public function change_ajax_loader_url($input) {
		return get_bloginfo('template_url') . '/images/form_preloader.gif';
	}


}

$lumiart_frontend_plugin_modification = new PluginModifications();