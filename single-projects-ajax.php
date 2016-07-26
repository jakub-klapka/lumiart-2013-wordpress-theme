<?php
/*
 * AJAX response for project
 */
$o = lumi_load_template('Options');
$l = lumi_load_template('Layout');
$p = lumi_load_template('Portfolio');

the_post();
$output = array();

$output['client_heading'] = the_title('', '', false);
$image = get_field('image');
if($image) {
	ob_start();
	$l->responsive_image( $image, 'projects_image' );
	$image_markup = ob_get_clean();

	$output['project_image_markup'] = $image_markup;
}

//get_the_content in run through filters before output -> otherwise it will loose autop etc.
$content = get_the_content();
$content = apply_filters( 'the_content', $content );
$content = str_replace( ']]>', ']]&gt;', $content );

$output['project_description'] = $content;

if( $link = get_field( 'link' ) ){
	$output['link']['href'] = $link;

	$pre_link = $o->get_field('projects_pre_link', 'general_frontend');
	$pre_link = ( $pre_link ) ? $pre_link . ' ' : ''; //add space if we have prelink
	$output['link']['text'] = $pre_link . $p->single_portfolio_strip_link($link);
}

$projects_url = $o->get_field( 'projects_link', 'general_frontend' );
$post_slug = $GLOBALS['post']->post_name;
$url = $projects_url . '#' . $post_slug;

//ob_start();
//$l->addthis_toolbox( $url, $p->get_portfolio_title( true ) );
//$share_content = ob_get_clean();
$share_content = '';

$output['share_content'] = $share_content;

$output['_force_cache'] = '<json_cache>';

echo json_encode( $output );
?>