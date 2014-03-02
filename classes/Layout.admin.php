<?php

namespace Lumiart\Admin;


class Layout {

	public function __construct()
	{

		/**
		 * Main menu transient check
		 */
		add_action( 'save_post', array( $this, 'nav_menu_trans_check' ) );
	}

	public function nav_menu_trans_check( $post_id ) {
		if( get_post_type( $post_id ) == 'nav_menu_item' ) {

			$languages = icl_get_languages();
			foreach( $languages as $language ) {
				delete_transient( 'menu_markup_' . $language['language_code'] );
			}
		}
	}

}

$lumi_admin_layout = new Layout();