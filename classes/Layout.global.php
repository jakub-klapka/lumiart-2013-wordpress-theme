<?php


namespace Lumiart\Glob;


class Layout {

	public $responsive_image_sizes;

	public function __construct()
	{

		/**
		 * Load textdomain
		 */
		load_theme_textdomain( 'WPML theme' );

		/**
		 * Register main menu
		 */
		add_action( 'init', array( $this, 'register_lumi_menu' ) );

		/**
		 * Responsive images
		 */
		$this->set_responsive_image_sizes();
		$this->register_responsive_images();
	}

	public function register_lumi_menu() {
		register_nav_menu( 'main_menu', 'Hlavní menu' );
	}

	private function set_responsive_image_sizes()
	{
		$this->responsive_image_sizes = array(
			'home_heading' => array(
				'1' => array( 342, 216 ),
				'2' => array( 418, 264 ),
				'3' => array( 513, 324 ),
				'4' => array( 703, 444 )
			),
			'home_testimonials' => array(
				'1' => array( 342, 144 ),
				'2' => array( 418, 176 ),
				'3' => array( 513, 216 ),
				'4' => array( 703, 296 )
			),
			'team_image' => array(
				'1' => array( 342, 216 ),
				'2' => array( 418, 264 ),
				'3' => array( 513, 324 ),
				'4' => array( 703, 444 )
			),
			'portfolio_image' => array(
				'1' => array( 342, 216 ),
				'2' => array( 418, 264 ),
				'3' => array( 513, 324 ),
				'4' => array( 703, 444 )
			),
			'portfolio_logo' => array(
				'mobile' => array( 9999, 104, true ), //last parameter true for soft-proportional crop
				'mobile_half' => array( 9999, 62, true ),
				'tablet' => array( 9999, 44, true ),
				'desktop' => array( 9999, 68, true )
			),
			'projects_image' => array(
				'1' => array( 342, 216 ),
				'2' => array( 418, 264 ),
				'3' => array( 513, 324 ),
				'4' => array( 703, 444 )
			)

		);
	}

	private function register_responsive_images()
	{
		foreach ( $this->responsive_image_sizes as $type => $size ) {
			foreach( $size as $device => $sizes ) {
				$image_handler = $type . '_' . $device;
				if( isset( $sizes[2] ) ){
					$hard_proportional_crop = ( $sizes[2] ) ? false : true; //if softproportional true -> hard is false :)
				} else {
					$hard_proportional_crop = true;
				}
				add_image_size( $image_handler, $sizes[0], $sizes[1], $hard_proportional_crop );
				add_image_size( $image_handler . '_x2', $sizes[0]*2, $sizes[1]*2, $hard_proportional_crop );
			}
		}

	}

}

$lumiart_global_layout = new Layout();