<?php

namespace Lumiart;


class TinymceModifications {

	public function __construct()
	{

		/**
		 * Tinymce css
		 */
		add_action( 'init', array( $this, 'register_editor_style' ) );

	}

	public function register_editor_style()
	{
		add_editor_style( 'css/editor-style.css' );
	}

}

$lumiart_tinymce_modifications = new TinymceModifications();