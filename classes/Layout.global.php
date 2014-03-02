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
	}

	public function register_lumi_menu() {
		register_nav_menu( 'main_menu', 'Hlavní menu' );
	}

	private function set_responsive_image_sizes()
	{
		$this->responsive_image_sizes = array(
			'home_heading' => array(
				'mobile' => array( 722, 456 ),
				'mobile_half' => array( 418, 264 ),
				'tablet' => array( 475, 300 ),
				'desktop' => array( 456, 288 )
			),
			'home_testimonials' => array(
				'mobile' => array( 722, 304 ),
				'mobile_half' => array( 418, 176 ),
				'tablet' => array( 475, 200 ),
				'desktop' => array( 475, 200 )
			),
			'team_image' => array(
				'mobile' => array( 722, 456 ),
				'mobile_half' => array( 418, 264 ),
				'tablet' => array( 456, 288 ),
				'desktop' => array( 703, 444 )
			),
			'portfolio_image' => array(
				'mobile' => array( 722, 456 ),
				'mobile_half' => array( 418, 264 ),
				'tablet' => array( 608, 384 ),
				'desktop' => array( 456, 288 )
			),
			'portfolio_logo' => array(
				'mobile' => array( 9999, 104, true ), //last parameter true for soft-proportional crop
				'mobile_half' => array( 9999, 62, true ),
				'tablet' => array( 9999, 44, true ),
				'desktop' => array( 9999, 68, true )
			),
			'projects_image' => array(
				'mobile' => array( 722, 456 ),
				'mobile_half' => array( 418, 264 ),
				'tablet' => array( 608, 384 ),
				'desktop' => array( 475, 300 )
			)

		);
	}

	private function register_responsive_images()
	{
		foreach ( $this->responsive_image_sizes as $type => $devices ) {
			foreach( $devices as $device => $sizes ) {
				$image_handler = $type . '_' . $device;
				if( isset( $sizes[2] ) ){
					$hard_proportional_crop = ( $sizes[2] ) ? false : true; //if softproportional true -> hard is false :)
				} else {
					$hard_proportional_crop = true;
				}
				add_image_size( $image_handler, $sizes[0], $sizes[1], $hard_proportional_crop );
				add_image_size( $image_handler . '_retina', $sizes[0]*2, $sizes[1]*2, $hard_proportional_crop );
			}
		}

	}

}

$lumiart_global_layout = new Layout();