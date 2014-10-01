<?php

namespace Lumiart\Template;


class Layout {

	public function lumi_deffered_scripts() {

		$scripts = apply_filters( 'lumi_deffered_scripts', array( '//s7.addthis.com/js/300/addthis_widget.js' ) );

		if( !empty( $scripts ) ): ?>
			<script type="text/javascript">
				$(window).load(function(){ <?php
				foreach( $scripts as $script ): ?>
					$.getScript('<?php echo $script; ?>');<?php
				endforeach; ?>
				});
			</script><?php
		endif;

	}

	function lumi_display_main_menu() {
		/*transient stats:
				with menu: 62 queries
				without: 42 q
				transient: 44q - nice :)
				*/
		$menu_markup = get_transient( 'menu_markup_' . ICL_LANGUAGE_CODE );
		if( $menu_markup === false ) {
			//we don't have transient, have to make one

			global $lumi_classes_path;
			include_once $lumi_classes_path . 'MainMenuWalker.php';
			ob_start();
			wp_nav_menu( array(
				'theme_location'  => 'main_menu',
				'container'       => false,
				'menu_class'      => false,
				'menu_id'         => false,
				'fallback_cb'     => 'wp_page_menu',
				'items_wrap'      => '<ul role="navigation">%3$s</ul>',
				'depth'           => 1,
				'walker'          => new \Lumiart\MainMenuWalker()
			) );
			$new_menu_markup = ob_get_clean();

			set_transient( 'menu_markup_' . ICL_LANGUAGE_CODE, $new_menu_markup, 60*60*24*31 );

			echo $new_menu_markup;
		} else {
			echo $menu_markup;
		}
	}


	/**
	 * Language switch link
	* @return string
	 */
	public function lm_language_switch_anchor() {
		$languages = icl_get_languages('skip_missing=0');
		if ( ICL_LANGUAGE_CODE == 'cs' ) {
			return $languages['en']['url'];
		} elseif ( ICL_LANGUAGE_CODE == 'en' ) {
			return $languages['cs']['url'];
		} else {
			return '';
		}
	}


	/**
	 * Echo responsive image markup
	* @param $image_id
	* @param $image_size_handle
	* @param string $img_aditional_markup
	 */
	public function responsive_image( $image_id, $image_size_handle, $img_aditional_markup = '' ) {

		$meta = wp_get_attachment_metadata( $image_id );

		$avail_sizes = array();

		global $lumiart_global_layout;
		$lumi_responsive_images_sizes = $lumiart_global_layout->responsive_image_sizes;

		//get size handlers for current image
		$f = array_filter( array_keys( $lumi_responsive_images_sizes ), function( $item ) use ( $image_size_handle ){
			return ( strpos( $item, $image_size_handle ) === 0 ) ? true : false;
		} );
		$current_sizes = array_intersect_key( $lumi_responsive_images_sizes, array_flip( $f ));

		$current_sizes = $current_sizes[$image_size_handle];

		//add retina sizes
		foreach( $current_sizes as $key => $size_arr ) {
			$current_sizes[ $key . '_x2' ] = array( $size_arr[0] * 2, $size_arr[1] * 2 );
		}

		//add correct prefix
		$current_handlers = array();

		foreach( $current_sizes as $size_handle => $size_arr ) {
			$current_handlers[ $image_size_handle . '_' . $size_handle ] = $size_arr;
		}

		//Get image sizes
		$image_sizes = array();

		foreach( $current_handlers as $handler => $size_arr ) {
			$current_thumb = wp_get_attachment_image_src( $image_id, $handler );
			if( $current_thumb[3] === true ) { //only those which get resized
				$image_sizes[$handler] = array(
					'url' => $current_thumb[0],
					'width' => $current_thumb[1],
					'height' => $current_thumb[2]
				);
			}
		}

		//if original image has right ratio, add it to the list
		$original = wp_get_attachment_image_src( $image_id, 'full' );
		if( $original[1] / $original[2] === reset($current_handlers)[0] / reset($current_handlers)[1] ) {
			$image_sizes['original'] = array(
				'url' => $original[0],
				'width' => $original[1],
				'height' => $original[2]
			);
		}

		$srcset = ''; $first = true;
		foreach( $image_sizes as $handle => $size_arr ) {
			if( $first !== true ) {
				$srcset .= ', ';
			}
			$srcset .= $size_arr['url'] . ' ' . $size_arr['width'] . 'w';
			$first = false;
		}

		//SIZES
		switch( $image_size_handle ) {
			case 'home_heading':
				$sizes = '(max-width: 767px) 100vw, (max-width: 1024px) 50vw, (max-width: 1500px) 30vw, 450px';
				break;
			case 'home_testimonials':
				$sizes = '(max-width: 767px) 100vw, (max-width: 1024px) 50vw, (max-width: 1500px) 35vw, 470px';
				break;
			case 'team_image':
				$sizes = '(max-width: 767px) 100vw, (max-width: 1500px) 50vw, 700px';
				break;
			case 'portfolio_image':
				$sizes = '(max-width: 767px) 100vw, (max-width: 1024px) 60vw, (max-width: 1500px) 30vw, 450px';
				break;
			case 'portfolio_logo':
				$sizes = '(max-width: 767px) 100vw, (max-width: 1500px) 30vw, 460px';
				break;
			case 'projects_image':
				$sizes = '(max-width: 767px) 100vw, (max-width: 1024px) 60vw, (max-width: 1500px) 30vw, 450px';
				break;
			default:
				$sizes = '100vw';
		}


		printf( '<img srcset="%s" sizes="%s" alt="%s"/>',
			$srcset, $sizes, $meta['alt'] );


	}

	/**
	 * Hover images markup
	 */
	public function hover_images_svg() {
		?>
		<svg class="svg_corner_top" xmlns="http://www.w3.org/2000/svg" version="1.1" id="blue" x="0" y="0" viewBox="0 0 24 24" xml:space="preserve">
			<path class="st0" d="M0 24v-2L22 0h2L0 24z"/>
			<path class="st1" d="M7 0L0 7v9L16 0H7zM1 8l7-7h5L1 13V8z"/>
		</svg>
			<svg class="svg_corner_bottom" xmlns="http://www.w3.org/2000/svg" version="1.1" id="blue" x="0px" y="0px" width="37px" height="37px" viewBox="0 0 37 37" xml:space="preserve">
			<path class="st1" d="M8 37h14l15-15V8L8 37zM36 21L21 36H11l25-25V21z"/>
			<path class="st0" d="M37 0v2L2 37H0L37 0z"/>
		</svg>
	<?php
	}

	/**
	 * Addthis toolbox echo
	 */
	public function addthis_toolbox( $url = false, $title = false ) {
		?>
		<!-- AddThis Button BEGIN -->
		<div id="addthis_toolbox" class="addthis_toolbox addthis_default_style addthis_32x32_style"<?php if($url): ?> addthis:url="<?php echo $url; ?>"<?php endif; if($title):?> addthis:title="<?php echo $title; ?>"<?php endif; ?>>
			<a class="addthis_button_facebook"></a>
			<a class="addthis_button_twitter"></a>
			<a class="addthis_button_google_plusone_share"></a>
			<a class="addthis_button_compact"></a><a class="addthis_counter addthis_bubble_style" id="atcounter"></a>
		</div>
		<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-526188d2385057bf"></script>
		<!-- AddThis Button END -->
	<?php
	}

}

global $lumi_template_layout;
$lumi_template_layout = new Layout();

function return_Layout() {
	global $lumi_template_layout;
	return $lumi_template_layout;
}