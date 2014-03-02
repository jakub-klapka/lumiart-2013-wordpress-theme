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

		$upload_dir = wp_upload_dir();
		preg_match( '/(.+\/).+$/', $meta['file'], $matches ); //get subdir out of meta[file], because in sizes list is filename only
		$subdir = ( isset($matches[1]) ) ? $matches[1] : '';
		$upload_url = $upload_dir['url'] . '/' . $subdir;

		$alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);

		//if we have image with exact size, wp dont push it as thumbnail, we have to compensate for that
		global $lumiart_global_layout;
		$lumi_responsive_images_sizes = $lumiart_global_layout->responsive_image_sizes;

		foreach( $lumi_responsive_images_sizes[$image_size_handle] as $device =>$sizes ) {
			if( $meta['width'] == $sizes[0] && $meta['height'] == $sizes[1] ) { //we got image which has exact sizes for output
				$striped_filename = str_replace( $subdir, '', $meta['file'] );
				$meta['sizes'][$image_size_handle . '_' . $device]['file'] = $striped_filename; //trick our next script, that we have this thumb...
			}
			if( $meta['width'] == ( $sizes[0] * 2 ) && $meta['height'] == ( $sizes[1] * 2 ) ) {
				$meta['sizes'][$image_size_handle . '_' . $device . '_retina']['file'] = $meta['file'];
			}

		}

		$mobile_mq = '(max-width: 767px)';
		$mobile_half_mq = '(max-width: 480px)';
		$tablet_mq = '(min-width: 768px) and (max-width: 1024px)';
		$desktop_mq = '(min-width: 1025px)';
		$retina_mq = ' and (-webkit-min-device-pixel-ratio: 2),(min-resolution: 192dpi)';

		?>
		<span data-picture data-alt="<?php echo $alt; ?>">
			<span data-src="<?php echo $upload_url . $meta['sizes'][$image_size_handle . '_desktop']['file']; ?>"></span>
			<?php if( isset( $meta['sizes'][$image_size_handle . '_mobile']['file'] ) ):
				$current_file = $meta['sizes'][$image_size_handle . '_mobile']['file']; ?>
				<span data-src="<?php echo $upload_url . $current_file; ?>" data-media="<?php echo $mobile_mq; ?>"></span>
			<?php endif; ?>
			<?php if( isset( $meta['sizes'][$image_size_handle . '_mobile_retina']['file'] ) ):
				$current_file = $meta['sizes'][$image_size_handle . '_mobile_retina']['file']; ?>
				<span data-src="<?php echo $upload_url . $current_file; ?>" data-media="<?php echo $mobile_mq . $retina_mq; ?>"></span>
			<?php endif; ?>

			<?php if( isset( $meta['sizes'][$image_size_handle . '_mobile_half']['file'] ) ):
				$current_file = $meta['sizes'][$image_size_handle . '_mobile_half']['file']; ?>
				<span data-src="<?php echo $upload_url . $current_file; ?>" data-media="<?php echo $mobile_half_mq; ?>"></span>
			<?php endif; ?>
			<?php if( isset( $meta['sizes'][$image_size_handle . '_mobile_half_retina']['file'] ) ):
				$current_file = $meta['sizes'][$image_size_handle . '_mobile_half_retina']['file']; ?>
				<span data-src="<?php echo $upload_url . $current_file; ?>" data-media="<?php echo $mobile_half_mq . $retina_mq; ?>"></span>
			<?php endif; ?>

			<?php if( isset( $meta['sizes'][$image_size_handle . '_tablet']['file'] ) ):
				$current_file = $meta['sizes'][$image_size_handle . '_tablet']['file']; ?>
				<span data-src="<?php echo $upload_url . $current_file; ?>" data-media="<?php echo $tablet_mq; ?>"></span>
			<?php endif; ?>
			<?php if( isset( $meta['sizes'][$image_size_handle . '_tablet_retina']['file'] ) ):
				$current_file = $meta['sizes'][$image_size_handle . '_tablet_retina']['file']; ?>
				<span data-src="<?php echo $upload_url . $current_file; ?>" data-media="<?php echo $tablet_mq . $retina_mq; ?>"></span>
			<?php endif; ?>
			<?php if( isset( $meta['sizes'][$image_size_handle . '_desktop']['file'] ) ):
				$current_file = $meta['sizes'][$image_size_handle . '_desktop']['file']; ?>
				<span data-src="<?php echo $upload_url . $current_file; ?>" data-media="<?php echo $desktop_mq; ?>"></span>
			<?php endif; ?>
			<?php if( isset( $meta['sizes'][$image_size_handle . '_desktop_retina']['file'] ) ):
				$current_file = $meta['sizes'][$image_size_handle . '_desktop_retina']['file']; ?>
				<span data-src="<?php echo $upload_url . $current_file; ?>" data-media="<?php echo $desktop_mq . $retina_mq; ?>"></span>
			<?php endif; ?>
			<noscript><?php	if( !empty( $img_aditional_markup ) ) { $img_aditional_markup = ' ' . $img_aditional_markup; } ?>
				<img src="<?php echo $upload_url . $meta['sizes'][$image_size_handle . '_desktop']['file']; ?>" alt="<?php echo $alt; ?>" <?php echo $img_aditional_markup; ?>>
			</noscript>
		</span><?php

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