<?php

namespace Lumiart\Frontend;


class Shortcodes {

	public function __construct()
	{
		/**
		 * Responsive list SC
		 */
		add_shortcode( 'responsive_list', array( $this, 'responsive_list_shortcode' ) );
	}

	function responsive_list_shortcode( $atts, $content = null ) {
		$items = preg_split('/\R/', $content);
		$items = array_filter( $items, function($input) {
			$discarders = array( '', '<br>', '<br/>', '<br />' );
			return !in_array( $input, $discarders );
		} );

		$items_in_first_half = ceil( count( $items ) / 2 );
		$splited = array_chunk( $items, $items_in_first_half );

		//TODO: get rid of OB
		ob_start(); ?>
		<div class="home_ul_wrap">
		<div class="column">
			<ul>
				<?php foreach( $splited[0] as $item ): ?>
					<li><?php echo $item; ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div class="column">
			<ul>
				<?php foreach( $splited[1] as $item ): ?>
					<li><?php echo $item; ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
		</div><?php

		$output = ob_get_clean();

		return $output;
	}

}

$lumi_frontend_shortcodes = new Shortcodes();