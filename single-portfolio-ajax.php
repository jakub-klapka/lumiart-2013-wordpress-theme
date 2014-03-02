<?php
/*
 * AJAX response for portfolio
 */
$o = lumi_load_template( 'Options' );
$l = lumi_load_template('Layout');
$p = lumi_load_template('Portfolio');

the_post();
$output = array();

$output['client_heading'] = get_the_title();
$images = get_field('images');
if($images) {
	$output['images'] = array();
	foreach($images as $image) {

		ob_start();
		$l->responsive_image( $image['id'], 'portfolio_image' );
		$image_markup = ob_get_clean();

		$output['images'][] = array( 'markup' => $image_markup );
	}
}

if( $link = get_field( 'link' ) ){
	$output['link']['href'] = $link;

	$pre_link = $o->get_field('portfolio_pre_link', 'general_frontend');
	$pre_link = ( $pre_link ) ? $pre_link . ' ' : ''; //add space if we have prelink
	$output['link']['text'] = $pre_link . $p->single_portfolio_strip_link($link);
}

$portfolio_url = $o->get_field( 'portfolio_link', 'general_frontend' );
$post_slug = $GLOBALS['post']->post_name;
$url = $portfolio_url . '#' . $post_slug;

ob_start();
$l->addthis_toolbox( $url, $p->get_portfolio_title() );
$share_content = ob_get_clean();

$output['share_content'] = $share_content;

$output['_force_cache'] = '<json_cache>';

echo json_encode( $output );