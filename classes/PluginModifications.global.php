<?php

namespace Lumiart\Glob;


class PluginModifications {

	public function __construct()
	{

		/**
		 * Flamingo meta caps
		 */
		remove_filter( 'map_meta_cap', 'flamingo_map_meta_cap' );
		add_filter( 'map_meta_cap', array( $this, 'mycustom_flamingo_map_meta_cap' ), 9, 4 );

		/**
		 * Cache json requests
		 */
		add_filter( 'wp_cache_eof_tags', array( $this, 'cache_json' ) );

	}

	function mycustom_flamingo_map_meta_cap( $caps, $cap, $user_id, $args ) {
		$meta_caps = array(
			'flamingo_edit_contacts' => 'publish_posts',
			'flamingo_edit_contact' => 'publish_posts',
			'flamingo_delete_contact' => 'publish_posts',
			'flamingo_edit_inbound_messages' => 'publish_posts',
			'flamingo_delete_inbound_message' => 'publish_posts',
			'flamingo_delete_inbound_messages' => 'publish_posts',
			'flamingo_spam_inbound_message' => 'publish_posts',
			'flamingo_unspam_inbound_message' => 'publish_posts' );

		$caps = array_diff( $caps, array_keys( $meta_caps ) );

		if ( isset( $meta_caps[$cap] ) )
			$caps[] = $meta_caps[$cap];

		return $caps;
	}

	public function cache_json($filter)
	{
		return '/(<\/html>|<\/rss>|<\/feed>|<\/urlset|<\?xml|<json_cache>)/i';
	}

}

$lumi_global_plugin_modification = new PluginModifications();